<?php
require_once __DIR__ . '/../data/auth/UserData.php';

const MR_EMAIL_PATTERN = '[A-Za-z0-9._%+\-]+@[A-Za-z0-9\-]+(\.[A-Za-z0-9\-]+)*\.[A-Za-z]{2,}';
const MR_NAME_PATTERN  = "[\p{L} .'\-]+";
const MR_PHONE_PATTERN = '\+?[0-9 ]{9,15}';

const MR_ROLE_HOME = [
  'patient'    => 'patient-dashboard.php',
  'pharmacist' => 'pharmacy-dashboard.php',
  'delivery'   => 'delivery-dashboard.php',
  'admin'      => 'admin-dashboard.php',
];

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

function mr_valid_email(string $email): bool
{
  return strlen($email) <= 255 && preg_match('/^' . MR_EMAIL_PATTERN . '$/', $email) && filter_var($email, FILTER_VALIDATE_EMAIL);
}

function mr_valid_name(string $name): bool
{
  return mb_strlen($name) <= 50 && preg_match('/^' . MR_NAME_PATTERN . '$/u', $name) && preg_match('/\p{L}/u', $name);
}

function mr_valid_phone(string $phone): bool
{
  return (bool) preg_match('/^' . MR_PHONE_PATTERN . '$/', $phone);
}

function mr_form(callable $handle): ?array
{
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    return mr_flash();
  }
  if (!hash_equals(mr_csrf_token(), (string) ($_POST['csrf'] ?? ''))) {
    return mr_error('Your session expired. Please try again.');
  }
  return $handle($_POST);
}

function mr_require_role(string $role): void
{
  mr_session();
  $current = $_SESSION['role'] ?? null;
  $user = $current === null ? null : mr_user_find((int) $_SESSION['user_id']);
  if (!$user || $user['status'] !== 'active' || $user['role'] !== $current) {
    $_SESSION = [];
    mr_redirect('sign-in.php');
  }
  if ($current !== $role) {
    mr_redirect(MR_ROLE_HOME[$current]);
  }
}

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
