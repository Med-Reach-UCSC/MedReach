<?php
$title = 'New Password — MedReach';
$bodyClass = 'mr-auth-body';
?>
  <div class="mr-auth">
    <div class="mr-auth-card mr-auth-card--solo">
      <div class="mr-auth-card__form">
        <a class="mr-auth__logo" href="index.php">
          <img src="presentation/assets/images/logo.png" alt="MedReach Logo">
        </a>
        <h1>Choose a new password</h1>
        <p class="mr-auth__subtitle">If an account exists for <strong><?= htmlspecialchars($_SESSION['otp_email']) ?></strong>, we sent it a 6-digit code. Enter it with your new password.</p>

        <?php require __DIR__ . '/partials/auth-flash.php'; ?>

        <form class="mr-auth-form" method="post" action="new-password.php">
          <input type="hidden" name="csrf" value="<?= mr_csrf_token() ?>">

          <div class="mr-field">
            <label for="code">Reset code</label>
            <div class="mr-field__input">
              <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/password.png" alt="">
              <input class="mr-otp-input" type="text" id="code" name="code" placeholder="000000" inputmode="numeric" pattern="[0-9]{6}" maxlength="6" autocomplete="one-time-code" required autofocus>
            </div>
          </div>

          <div class="mr-field">
            <label for="password">New password</label>
            <div class="mr-field__input">
              <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/lock--v1.png" alt="">
              <input type="password" id="password" name="password" placeholder="••••••••" minlength="8" maxlength="72" autocomplete="new-password" required>
            </div>
          </div>

          <div class="mr-field">
            <label for="confirm_password">Confirm new password</label>
            <div class="mr-field__input">
              <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/lock--v1.png" alt="">
              <input type="password" id="confirm_password" name="confirm_password" placeholder="••••••••" minlength="8" maxlength="72" autocomplete="new-password" required>
            </div>
          </div>

          <button type="submit" class="mr-btn mr-btn--primary mr-auth-form__submit">Update password</button>
        </form>

        <form class="mr-auth-resend" method="post" action="new-password.php">
          <input type="hidden" name="csrf" value="<?= mr_csrf_token() ?>">
          Didn't get it? <button type="submit" name="resend" value="1">Resend code</button>
        </form>

        <a class="mr-link mr-link--strong mr-auth__back" href="reset-password.php">&larr; Use a different email</a>
      </div>
    </div>
  </div>
