<?php
// MedReach - Sign in page entry point
require __DIR__ . '/core/Auth.php';
mr_redirect_if_signed_in();
$flash = $_SERVER['REQUEST_METHOD'] === 'POST' ? mr_handle_sign_in($_POST) : mr_flash();
require __DIR__ . '/presentation/views/sign-in.php';
