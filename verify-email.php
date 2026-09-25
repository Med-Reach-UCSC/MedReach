<?php
// MedReach - Email verification code entry point
require __DIR__ . '/core/Auth.php';
mr_session();
if (!isset($_SESSION['otp_email'])) {
  mr_redirect('sign-in.php');
}
$flash = mr_flash();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $flash = isset($_POST['resend']) ? mr_otp_resend('verify_email', $_POST) : mr_handle_verify_email($_POST);
}
require __DIR__ . '/presentation/views/verify-email.php';
