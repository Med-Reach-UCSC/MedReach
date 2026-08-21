<?php
// MedReach - Sign in page (presentation tier: HTML output only)
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign In — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body class="mr-auth-body">

  <div class="mr-auth">
    <div class="mr-auth-card">

      <div class="mr-auth-card__form">
        <a class="mr-auth__logo" href="index.php">
          <img src="presentation/assets/images/logo.png" alt="MedReach Logo">
        </a>
        <h1>Welcome back</h1>

        <div class="mr-auth-tabs" role="tablist" aria-label="Sign in as">
          <button type="button" class="mr-auth-tabs__btn is-active" role="tab" aria-selected="true" data-role="patient">Patient | Guardian</button>
          <button type="button" class="mr-auth-tabs__btn" role="tab" aria-selected="false" data-role="pharmacist">Pharmacist</button>
          <button type="button" class="mr-auth-tabs__btn" role="tab" aria-selected="false" data-role="delivery">Delivery</button>
        </div>

        <form class="mr-auth-form" method="post" action="">
          <input type="hidden" name="role" value="patient">

          <div class="mr-field">
            <label for="email">Email address</label>
            <div class="mr-field__input">
              <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/new-post.png" alt="">
              <input type="email" id="email" name="email" placeholder="name@example.com" required>
            </div>
          </div>

          <div class="mr-field">
            <div class="mr-field__label-row">
              <label for="password">Password</label>
              <a class="mr-link mr-link--sm" href="reset-password.php">Forgot password?</a>
            </div>
            <div class="mr-field__input">
              <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/lock--v1.png" alt="">
              <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>
          </div>

          <button type="submit" class="mr-btn mr-btn--primary mr-auth-form__submit">Sign in</button>
        </form>

        <p class="mr-auth__footer-text">New here? <a class="mr-link mr-link--strong" href="sign-up.php">Create an account</a></p>
      </div>

      <div class="mr-auth-card__brand">
        <div class="mr-auth-card__brand-text">
          <h2>Pickup.<br>Deliver.<br>Care.</h2>
          <p>Connecting patients, pharmacies, and trusted delivery partners in one seamless ecosystem.</p>
        </div>

        <div class="mr-auth-community">
          <div class="mr-auth-community__avatars">
            <img src="https://placehold.co/32x32?text=1" alt="">
            <img src="https://placehold.co/32x32?text=2" alt="">
            <img src="https://placehold.co/32x32?text=3" alt="">
          </div>
          <div>
            <strong>Trusted Community</strong>
            <span>Growing daily</span>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
