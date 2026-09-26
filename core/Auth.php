<?php
// MedReach - Sessions, role guard, sign-in / sign-up / password reset
// (business tier: shared by every role)
require_once __DIR__ . '/../data/auth/UserData.php';
require_once __DIR__ . '/Mailer.php';

const MR_ROLE_HOME = [
  'patient'    => 'patient-dashboard.php',
  'pharmacist' => 'pharmacy-dashboard.php',
  'delivery'   => 'delivery-dashboard.php',
  'admin'      => 'admin-dashboard.php',
];

// Sign-in / sign-up tabs. Patients are active once their email is verified;
// pharmacists and delivery people wait for admin approval. Admin accounts
// are never self-registered.
const MR_PUBLIC_ROLES = [
  'patient'    => 'Patient | Guardian',
  'pharmacist' => 'Pharmacist',
  'delivery'   => 'Delivery',
];

const MR_VEHICLE_TYPES = [
  'motorbike'     => 'Motorbike',
  'three_wheeler' => 'Three-wheeler',
  'car'           => 'Car',
  'van'           => 'Van',
];

const MR_PENDING_APPROVAL = 'Your account is waiting for admin approval. We\'ll email you once it\'s approved.';

const MR_OTP_TTL      = 600; // seconds a code stays valid
const MR_OTP_COOLDOWN = 60;  // seconds before another code can be sent
const MR_OTP_MAX_TRIES = 5;

function mr_session(): void
{
  if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.use_strict_mode', '1');
    session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax']);
    session_start();
  }
}

function mr_redirect(string $url): never
{
  header('Location: ' . $url);
  exit;
}

function mr_csrf_token(): string
{
  mr_session();
  return $_SESSION['csrf'] ??= bin2hex(random_bytes(32));
}

function mr_csrf_ok(array $in): bool
{
  return hash_equals(mr_csrf_token(), (string) ($in['csrf'] ?? ''));
}

// One-shot message carried across a redirect.
function mr_flash(?string $type = null, string $text = ''): ?array
{
  mr_session();
  if ($type !== null) {
    $_SESSION['flash'] = ['type' => $type, 'text' => $text];
    return null;
  }
  $flash = $_SESSION['flash'] ?? null;
  unset($_SESSION['flash']);
  return $flash;
}

function mr_error(string $text): array
{
  return ['type' => 'error', 'text' => $text];
}

function mr_require_role(string $role): void
{
  mr_session();
  $current = $_SESSION['role'] ?? null;
  if ($current === null) {
    mr_redirect('sign-in.php');
  }
  if ($current !== $role) {
    mr_redirect(MR_ROLE_HOME[$current]);
  }
}

// Signed-in users skip the sign-in / sign-up pages.
function mr_redirect_if_signed_in(): void
{
  mr_session();
  if (isset($_SESSION['role'])) {
    mr_redirect(MR_ROLE_HOME[$_SESSION['role']]);
  }
}

function mr_log_in(array $user): never
{
  session_regenerate_id(true);
  unset($_SESSION['otp_email']);
  $_SESSION['user_id'] = (int) $user['user_id'];
  $_SESSION['role']    = $user['role'];
  $_SESSION['name']    = $user['first_name'];
  mr_redirect(MR_ROLE_HOME[$user['role']]);
}

function mr_sign_out(): never
{
  mr_session();
  $_SESSION = [];
  session_destroy();
  mr_redirect('sign-in.php');
}

// ---- One-time codes -------------------------------------------------------

const MR_MAIL_FAILED = 'We couldn\'t send the email right now. Try "Resend code" in a moment.';

// The account a code flow is for: deactivated accounts never receive codes.
function mr_otp_user(string $email): ?array
{
  $user = mr_user_find_by_email($email);
  return $user && $user['status'] !== 'deactivated' ? $user : null;
}

// Emails a fresh code; it only replaces the previous one if the email went out.
function mr_otp_send(array $user, string $purpose): bool
{
  $code   = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
  $action = $purpose === 'verify_email' ? 'verify your email' : 'reset your password';
  $sent   = mr_send_mail(
    $user['email'],
    "Your MedReach code: $code",
    "Hi {$user['first_name']},\n\nUse this code to $action: $code\n\n"
      . 'It expires in ' . (MR_OTP_TTL / 60) . " minutes. If you didn't ask for it, you can ignore this email."
  );
  if ($sent) {
    mr_otp_save((int) $user['user_id'], $purpose, password_hash($code, PASSWORD_DEFAULT), MR_OTP_TTL);
  }
  return $sent;
}

// Starts a code flow and remembers which email the next page is checking.
function mr_otp_start(?array $user, string $email, string $purpose): void
{
  $_SESSION['otp_email'] = $email;
  if ($user && !mr_otp_send($user, $purpose)) {
    mr_flash('error', MR_MAIL_FAILED);
  }
}

// Returns an error message, or null when the code is correct (and consumed).
function mr_otp_check(int $userId, string $purpose, string $code): ?string
{
  $otp = mr_otp_find($userId, $purpose);
  if (!$otp || $otp['is_expired'] || $otp['attempts'] >= MR_OTP_MAX_TRIES) {
    return 'This code has expired. Send a new one and try again.';
  }
  if (!password_verify($code, $otp['code_hash'])) {
    mr_otp_add_attempt($userId, $purpose);
    return 'That code is incorrect.';
  }
  mr_otp_delete($userId, $purpose);
  return null;
}

function mr_otp_resend(string $purpose, array $in): array
{
  if (!mr_csrf_ok($in)) {
    return mr_error('Your session expired. Please try again.');
  }
  $user = mr_otp_user($_SESSION['otp_email'] ?? '');
  $otp  = $user ? mr_otp_find((int) $user['user_id'], $purpose) : null;
  if ($otp && $otp['age'] < MR_OTP_COOLDOWN) {
    return mr_error('Please wait ' . (MR_OTP_COOLDOWN - $otp['age']) . ' seconds before requesting another code.');
  }
  if ($user && !mr_otp_send($user, $purpose)) {
    return mr_error(MR_MAIL_FAILED);
  }
  return ['type' => 'success', 'text' => 'A new code is on its way.'];
}

// ---- Page handlers: each returns a flash message, or redirects on success --

function mr_handle_sign_in(array $in): ?array
{
  if (!mr_csrf_ok($in)) {
    return mr_error('Your session expired. Please try again.');
  }
  $email = strtolower(trim($in['email'] ?? ''));
  $user  = mr_user_find_by_email($email);

  // No lockout after repeated failures yet; add per-email throttling before going live.
  if (!$user || !password_verify($in['password'] ?? '', $user['password_hash'])) {
    return mr_error('Incorrect email or password.');
  }
  if ($user['status'] === 'deactivated') {
    return mr_error('This account has been deactivated. Contact MedReach support.');
  }
  if ($user['role'] !== 'admin' && $user['role'] !== ($in['role'] ?? '')) {
    return mr_error('This is a ' . MR_PUBLIC_ROLES[$user['role']] . ' account. Switch to that tab to sign in.');
  }
  if (!$user['is_verified']) {
    mr_otp_start($user, $email, 'verify_email');
    mr_redirect('verify-email.php');
  }
  if ($user['status'] === 'pending') {
    return mr_error(MR_PENDING_APPROVAL);
  }
  mr_log_in($user);
}

// Role-specific sign-up fields. Returns [error, extra] where extra holds the
// cleaned values for mr_account_create().
function mr_sign_up_extra(string $role, array $in): array
{
  $t = fn (string $key) => trim($in[$key] ?? '');

  if ($role === 'patient') {
    $dob = $t('date_of_birth');
    $error = match (true) {
      $dob !== '' && (!($d = DateTime::createFromFormat('!Y-m-d', $dob)) || $d > new DateTime()) => 'Enter a valid date of birth.',
      mb_strlen($t('address')) > 255 => 'Address is too long.',
      default => null,
    };
    return [$error, [
      'date_of_birth' => $dob ?: null,
      'address'       => $t('address') ?: null,
      'is_guardian'   => empty($in['is_guardian']) ? 0 : 1,
    ]];
  }

  if ($role === 'pharmacist') {
    $error = match (true) {
      $t('pharmacy_name') === '' || mb_strlen($t('pharmacy_name')) > 100 => 'Enter the pharmacy name.',
      !preg_match('/^[A-Za-z0-9\/-]{4,30}$/', $t('licence_no'))          => 'Enter the NMRA licence number, e.g. PH-2026-0418.',
      $t('pharmacy_address') === '' || mb_strlen($t('pharmacy_address')) > 255 => 'Enter the pharmacy address.',
      $t('city') === '' || mb_strlen($t('city')) > 50                     => 'Enter the city.',
      mb_strlen($t('operating_hours')) > 100                              => 'Opening hours are too long.',
      default => null,
    };
    return [$error, [
      'pharmacy_name'    => $t('pharmacy_name'),
      'licence_no'       => strtoupper($t('licence_no')),
      'pharmacy_address' => $t('pharmacy_address'),
      'city'             => $t('city'),
      'operating_hours'  => $t('operating_hours') ?: null,
    ]];
  }

  // delivery: old NIC is 9 digits + V/X, new NIC is 12 digits
  $nic = strtoupper(str_replace(' ', '', $t('nic_no')));
  $error = match (true) {
    !preg_match('/^(\d{9}[VX]|\d{12})$/', $nic)                  => 'Enter a valid NIC number, e.g. 199512345678 or 951234567V.',
    !isset(MR_VEHICLE_TYPES[$t('vehicle_type')])                 => 'Choose your vehicle type.',
    !preg_match('/^[A-Za-z]{0,3}[ -]?[A-Za-z0-9]{1,4}[ -]?\d{4}$/', $t('vehicle_number')) => 'Enter a valid vehicle number, e.g. WP BAB-1234.',
    default => null,
  };
  return [$error, [
    'nic_no'         => $nic,
    'vehicle_type'   => $t('vehicle_type'),
    'vehicle_number' => strtoupper($t('vehicle_number')),
  ]];
}

function mr_handle_sign_up(array $in): ?array
{
  if (!mr_csrf_ok($in)) {
    return mr_error('Your session expired. Please try again.');
  }
  $first    = trim($in['first_name'] ?? '');
  $last     = trim($in['last_name'] ?? '');
  $email    = strtolower(trim($in['email'] ?? ''));
  $phone    = trim($in['phone'] ?? '');
  $password = $in['password'] ?? '';
  $role     = $in['role'] ?? '';

  $error = match (true) {
    !isset(MR_PUBLIC_ROLES[$role])                          => 'Choose an account type.',
    $first === '' || mb_strlen($first) > 50                 => 'Enter your first name.',
    $last === '' || mb_strlen($last) > 50                   => 'Enter your last name.',
    !filter_var($email, FILTER_VALIDATE_EMAIL)              => 'Enter a valid email address.',
    !preg_match('/^\+?[0-9 ]{9,15}$/', $phone)              => 'Enter a valid phone number, e.g. 071 234 5678.',
    strlen($password) < 8 || strlen($password) > 72         => 'Password must be 8 to 72 characters.',
    $password !== ($in['confirm_password'] ?? '')           => 'Passwords do not match.',
    empty($in['agree_terms'])                               => 'Please accept the terms to continue.',
    mr_user_find_by_email($email) !== null                  => 'An account with this email already exists. Sign in instead.',
    default                                                 => null,
  };
  [$error, $extra] = $error ? [$error, []] : mr_sign_up_extra($role, $in);
  if ($error) {
    return mr_error($error);
  }

  try {
    $id = mr_account_create([
      'first_name'    => $first,
      'last_name'     => $last,
      'email'         => $email,
      'phone'         => $phone,
      'password_hash' => password_hash($password, PASSWORD_DEFAULT),
      'role'          => $role,
      'status'        => $role === 'patient' ? 'active' : 'pending',
    ], $extra);
  } catch (mysqli_sql_exception $e) {
    if ($e->getCode() !== 1062) { // duplicate key
      throw $e;
    }
    return mr_error($role === 'pharmacist' ? 'A pharmacy with this licence number is already registered.' : 'An account with this NIC number already exists.');
  }
  mr_otp_start(['user_id' => $id, 'email' => $email, 'first_name' => $first], $email, 'verify_email');
  mr_redirect('verify-email.php');
}

function mr_handle_verify_email(array $in): ?array
{
  if (!mr_csrf_ok($in)) {
    return mr_error('Your session expired. Please try again.');
  }
  $user  = mr_otp_user($_SESSION['otp_email'] ?? '');
  $error = $user ? mr_otp_check((int) $user['user_id'], 'verify_email', trim($in['code'] ?? '')) : 'Start again from sign in.';
  if ($error) {
    return mr_error($error);
  }
  mr_user_mark_verified((int) $user['user_id']);
  if ($user['status'] === 'pending') {
    unset($_SESSION['otp_email']);
    mr_flash('success', 'Email verified. ' . MR_PENDING_APPROVAL);
    mr_redirect('sign-in.php');
  }
  mr_log_in($user);
}

// Always moves on to the code page so the form never reveals which emails have accounts.
function mr_handle_reset_request(array $in): ?array
{
  if (!mr_csrf_ok($in)) {
    return mr_error('Your session expired. Please try again.');
  }
  $email = strtolower(trim($in['email'] ?? ''));
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return mr_error('Enter a valid email address.');
  }
  mr_otp_start(mr_otp_user($email), $email, 'reset_password');
  mr_redirect('new-password.php');
}

function mr_handle_new_password(array $in): ?array
{
  if (!mr_csrf_ok($in)) {
    return mr_error('Your session expired. Please try again.');
  }
  $password = $in['password'] ?? '';
  if (strlen($password) < 8 || strlen($password) > 72) {
    return mr_error('Password must be 8 to 72 characters.');
  }
  if ($password !== ($in['confirm_password'] ?? '')) {
    return mr_error('Passwords do not match.');
  }

  $user  = mr_otp_user($_SESSION['otp_email'] ?? '');
  $error = $user ? mr_otp_check((int) $user['user_id'], 'reset_password', trim($in['code'] ?? '')) : 'That code is incorrect.';
  if ($error) {
    return mr_error($error);
  }
  mr_user_set_password((int) $user['user_id'], password_hash($password, PASSWORD_DEFAULT));
  mr_user_mark_verified((int) $user['user_id']); // the code proved they own the inbox
  unset($_SESSION['otp_email']);
  mr_flash('success', 'Password updated. Sign in with your new password.');
  mr_redirect('sign-in.php');
}
