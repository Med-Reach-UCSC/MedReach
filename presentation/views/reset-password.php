<?php
// MedReach - Reset password page (presentation tier: HTML output only)
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reset Password — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body class="mr-auth-body">

  <div class="mr-auth">
    <div class="mr-auth-card mr-auth-card--solo">
      <div class="mr-auth-card__form">
        <a class="mr-auth__logo" href="index.php">
          <img src="presentation/assets/images/logo.png" alt="MedReach Logo">
        </a>
        <h1>Reset your password</h1>
        <p class="mr-auth__subtitle">Enter the email associated with your account and we'll send a link to reset your password.</p>

        <form class="mr-auth-form mr-reset-form" method="post" action="">
          <div class="mr-field">
            <label for="email">Email address</label>
            <div class="mr-field__input">
              <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/new-post.png" alt="">
              <input type="email" id="email" name="email" placeholder="name@example.com" required>
            </div>
          </div>

          <button type="submit" class="mr-btn mr-btn--primary mr-auth-form__submit">Send reset link</button>
        </form>

        <div class="mr-auth-notice" hidden>
          <img src="https://img.icons8.com/ios-filled/50/1f9d6b/checkmark.png" alt="">
          <span>Reset link sent. Check your inbox.</span>
        </div>

        <a class="mr-link mr-link--strong mr-auth__back" href="sign-in.php">&larr; Back to sign in</a>
      </div>
    </div>
  </div>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
