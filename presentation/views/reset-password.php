<?php
$title = 'Reset Password — MedReach';
$bodyClass = 'mr-auth-body';
?>
  <div class="mr-auth">
    <div class="mr-auth-card mr-auth-card--solo">
      <div class="mr-auth-card__form">
        <a class="mr-auth__logo" href="index.php">
          <img src="presentation/assets/images/logo.png" alt="MedReach Logo">
        </a>
        <h1>Reset your password</h1>
        <p class="mr-auth__subtitle">Enter the email associated with your account and we'll send you a 6-digit code to reset your password.</p>

        <?php require __DIR__ . '/partials/auth-flash.php'; ?>

        <form class="mr-auth-form" method="post" action="reset-password.php">
          <input type="hidden" name="csrf" value="<?= mr_csrf_token() ?>">

          <div class="mr-field">
            <label for="email">Email address</label>
            <div class="mr-field__input">
              <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/new-post.png" alt="">
              <input type="email" id="email" name="email" placeholder="name@example.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" autocomplete="email" required>
            </div>
          </div>

          <button type="submit" class="mr-btn mr-btn--primary mr-auth-form__submit">Send code</button>
        </form>

        <a class="mr-link mr-link--strong mr-auth__back" href="sign-in.php">&larr; Back to sign in</a>
      </div>
    </div>
  </div>
