<?php
// MedReach - New password (reset code) entry point
require __DIR__ . '/core/Auth.php';
mr_session();
if (!isset($_SESSION['otp_email'])) {
  mr_redirect('reset-password.php');
}
$flash = mr_flash();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $flash = isset($_POST['resend']) ? mr_otp_resend('reset_password', $_POST) : mr_handle_new_password($_POST);
}
require __DIR__ . '/presentation/views/new-password.php';
