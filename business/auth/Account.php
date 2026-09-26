<?php
require_once __DIR__ . '/../../data/auth/UserData.php';
require_once __DIR__ . '/../../core/Mailer.php';

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
const MR_MAIL_FAILED      = 'We couldn\'t send the email right now. Try "Resend code" in a moment.';

const MR_OTP_TTL       = 600;
const MR_OTP_COOLDOWN  = 60;
const MR_OTP_MAX_TRIES = 5;

function mr_page_sign_in(): ?array
{
  mr_redirect_if_signed_in();
  return mr_form('mr_handle_sign_in');
}

function mr_page_sign_up(): ?array
{
  mr_redirect_if_signed_in();
  return mr_form('mr_handle_sign_up');
}

function mr_page_reset_password(): ?array
{
  mr_redirect_if_signed_in();
  return mr_form('mr_handle_reset_request');
}

function mr_page_verify_email(): ?array
{
  mr_require_otp_email('sign-in.php');
  return mr_form(fn (array $in) => isset($in['resend']) ? mr_otp_resend('verify_email') : mr_handle_verify_email($in));
}

function mr_page_new_password(): ?array
{
  mr_require_otp_email('reset-password.php');
  return mr_form(fn (array $in) => isset($in['resend']) ? mr_otp_resend('reset_password') : mr_handle_new_password($in));
}

function mr_require_otp_email(string $fallback): void
{
  mr_session();
  if (!isset($_SESSION['otp_email'])) {
    mr_redirect($fallback);
  }
}

function mr_otp_user(string $email): ?array
{
  $user = mr_user_find_by_email($email);
  return $user && $user['status'] !== 'deactivated' ? $user : null;
}

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

function mr_otp_start(?array $user, string $email, string $purpose): void
{
  $_SESSION['otp_email'] = $email;
  if ($user && !mr_otp_send($user, $purpose)) {
    mr_flash('error', MR_MAIL_FAILED);
  }
}

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

function mr_otp_resend(string $purpose): array
{
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

function mr_password_error(array $in): ?string
{
  $password = $in['password'] ?? '';
  return match (true) {
    strlen($password) < 8 || strlen($password) > 72 => 'Password must be 8 to 72 characters.',
    $password !== ($in['confirm_password'] ?? '')    => 'Passwords do not match.',
    default                                          => null,
  };
}

function mr_handle_sign_in(array $in): ?array
{
  $email = strtolower(trim($in['email'] ?? ''));
  $user  = mr_user_find_by_email($email);

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
  $first = trim($in['first_name'] ?? '');
  $last  = trim($in['last_name'] ?? '');
  $email = strtolower(trim($in['email'] ?? ''));
  $phone = trim($in['phone'] ?? '');
  $role  = $in['role'] ?? '';

  $error = match (true) {
    !isset(MR_PUBLIC_ROLES[$role])              => 'Choose an account type.',
    $first === '' || mb_strlen($first) > 50     => 'Enter your first name.',
    $last === '' || mb_strlen($last) > 50       => 'Enter your last name.',
    !filter_var($email, FILTER_VALIDATE_EMAIL)  => 'Enter a valid email address.',
    !preg_match('/^\+?[0-9 ]{9,15}$/', $phone)  => 'Enter a valid phone number, e.g. 071 234 5678.',
    ($passwordError = mr_password_error($in)) !== null => $passwordError,
    empty($in['agree_terms'])                   => 'Please accept the terms to continue.',
    mr_user_find_by_email($email) !== null      => 'An account with this email already exists. Sign in instead.',
    default                                     => null,
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
      'password_hash' => password_hash($in['password'], PASSWORD_DEFAULT),
      'role'          => $role,
      'status'        => $role === 'patient' ? 'active' : 'pending',
    ], $extra);
  } catch (mysqli_sql_exception $e) {
    if ($e->getCode() !== 1062) {
      throw $e;
    }
    return mr_error($role === 'pharmacist' ? 'A pharmacy with this licence number is already registered.' : 'An account with this NIC number already exists.');
  }
  mr_otp_start(['user_id' => $id, 'email' => $email, 'first_name' => $first], $email, 'verify_email');
  mr_redirect('verify-email.php');
}

function mr_handle_verify_email(array $in): ?array
{
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

function mr_handle_reset_request(array $in): ?array
{
  $email = strtolower(trim($in['email'] ?? ''));
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return mr_error('Enter a valid email address.');
  }
  mr_otp_start(mr_otp_user($email), $email, 'reset_password');
  mr_redirect('new-password.php');
}

function mr_handle_new_password(array $in): ?array
{
  if ($error = mr_password_error($in)) {
    return mr_error($error);
  }
  $user  = mr_otp_user($_SESSION['otp_email'] ?? '');
  $error = $user ? mr_otp_check((int) $user['user_id'], 'reset_password', trim($in['code'] ?? '')) : 'That code is incorrect.';
  if ($error) {
    return mr_error($error);
  }
  mr_user_set_password((int) $user['user_id'], password_hash($in['password'], PASSWORD_DEFAULT));
  mr_user_mark_verified((int) $user['user_id']);
  unset($_SESSION['otp_email']);
  mr_flash('success', 'Password updated. Sign in with your new password.');
  mr_redirect('sign-in.php');
}
