<?php
$title = 'Verify Email — MedReach';
$bodyClass = 'mr-auth-body';
?>
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
              <img class="mr-field__icon" src="presentation/assets/images/icons/filled/757687/password.png" alt="">
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
