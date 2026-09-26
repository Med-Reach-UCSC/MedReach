<?php
$title = 'Sign In — MedReach';
$bodyClass = 'mr-auth-body';
?>
  <div class="mr-auth">
    <div class="mr-auth-card">

      <div class="mr-auth-card__form">
        <a class="mr-auth__logo" href="index.php">
          <img src="presentation/assets/images/logo.png" alt="MedReach Logo">
        </a>
        <h1>Welcome back</h1>

        <?php $mr_tabs_label = 'Sign in as'; require __DIR__ . '/partials/auth-tabs.php'; ?>

        <?php require __DIR__ . '/partials/auth-flash.php'; ?>

        <form class="mr-auth-form" method="post" action="sign-in.php">
          <input type="hidden" name="csrf" value="<?= mr_csrf_token() ?>">
          <input type="hidden" name="role" value="<?= $mr_role ?>">

          <div class="mr-field">
            <label for="email">Email address</label>
            <div class="mr-field__input">
              <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/new-post.png" alt="">
              <input type="email" id="email" name="email" placeholder="name@example.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" autocomplete="email" required>
            </div>
          </div>

          <div class="mr-field">
            <div class="mr-field__label-row">
              <label for="password">Password</label>
              <a class="mr-link mr-link--sm" href="reset-password.php">Forgot password?</a>
            </div>
            <div class="mr-field__input">
              <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/lock--v1.png" alt="">
              <input type="password" id="password" name="password" placeholder="••••••••" autocomplete="current-password" required>
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
