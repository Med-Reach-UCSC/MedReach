<?php
// MedReach - Verify email page (presentation tier: HTML output only)
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Verify Email — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body class="mr-auth-body">

  <div class="mr-auth">
    <div class="mr-auth-card mr-auth-card--solo">
      <div class="mr-auth-card__form">
        <a class="mr-auth__logo" href="index.php">
          <img src="presentation/assets/images/logo.png" alt="MedReach Logo">
        </a>
        <h1>Check your email</h1>
        <p class="mr-auth__subtitle">We sent a 6-digit code to <strong><?= htmlspecialchars($_SESSION['otp_email']) ?></strong>. Enter it below to activate your account.</p>

        <?php require __DIR__ . '/partials/auth-flash.php'; ?>

        <form class="mr-auth-form" method="post" action="verify-email.php">
          <input type="hidden" name="csrf" value="<?= mr_csrf_token() ?>">

          <div class="mr-field">
            <label for="code">Verification code</label>
            <div class="mr-field__input">
              <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/password.png" alt="">
              <input class="mr-otp-input" type="text" id="code" name="code" placeholder="000000" inputmode="numeric" pattern="[0-9]{6}" maxlength="6" autocomplete="one-time-code" required autofocus>
            </div>
          </div>

          <button type="submit" class="mr-btn mr-btn--primary mr-auth-form__submit">Verify email</button>
        </form>

        <form class="mr-auth-resend" method="post" action="verify-email.php">
          <input type="hidden" name="csrf" value="<?= mr_csrf_token() ?>">
          Didn't get it? <button type="submit" name="resend" value="1">Resend code</button>
        </form>

        <a class="mr-link mr-link--strong mr-auth__back" href="sign-in.php">&larr; Back to sign in</a>
      </div>
    </div>
  </div>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
