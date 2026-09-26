<?php
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
  if ($current === null) {
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
