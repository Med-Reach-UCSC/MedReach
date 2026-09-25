<?php
// MedReach - Sign up page entry point
require __DIR__ . '/core/Auth.php';
mr_redirect_if_signed_in();
$flash = $_SERVER['REQUEST_METHOD'] === 'POST' ? mr_handle_sign_up($_POST) : null;
require __DIR__ . '/presentation/views/sign-up.php';
