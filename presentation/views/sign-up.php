<?php
// MedReach - Sign up page (presentation tier: HTML output only)
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign Up — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body class="mr-auth-body">

  <div class="mr-auth">
    <div class="mr-auth-card">

      <div class="mr-auth-card__brand">
        <div class="mr-auth-card__brand-text">
          <h2>Join 240+<br>pharmacies and<br>thousands of<br>patients</h2>
        </div>

        <ul class="mr-auth-features">
          <li><img src="https://img.icons8.com/ios-filled/50/ffffff/checkmark.png" alt=""> Fast delivery</li>
          <li><img src="https://img.icons8.com/ios-filled/50/ffffff/checkmark.png" alt=""> Trusted pharmacists</li>
          <li><img src="https://img.icons8.com/ios-filled/50/ffffff/checkmark.png" alt=""> Easy prescription uploads</li>
        </ul>

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

      <div class="mr-auth-card__form">
        <a class="mr-auth__logo" href="index.php">
          <img src="presentation/assets/images/logo.png" alt="MedReach Logo">
        </a>
        <h1>Create your account</h1>

        <div class="mr-auth-tabs" role="tablist" aria-label="Sign up as">
          <button type="button" class="mr-auth-tabs__btn is-active" role="tab" aria-selected="true" data-role="patient">Patient | Guardian</button>
          <button type="button" class="mr-auth-tabs__btn" role="tab" aria-selected="false" data-role="pharmacist">Pharmacist</button>
          <button type="button" class="mr-auth-tabs__btn" role="tab" aria-selected="false" data-role="delivery">Delivery</button>
        </div>

        <form class="mr-auth-form mr-auth-form--grid" method="post" action="">
          <input type="hidden" name="role" value="patient">

          <div class="mr-field mr-field--span2">
            <label for="fullname">Full name</label>
            <div class="mr-field__input">
              <input type="text" id="fullname" name="fullname" placeholder="Jane Doe" required>
            </div>
          </div>

          <div class="mr-field mr-field--span2">
            <label for="email">Email address</label>
            <div class="mr-field__input">
              <input type="email" id="email" name="email" placeholder="jane.doe@example.com" required>
            </div>
          </div>

          <div class="mr-field mr-field--span2">
            <label for="phone">Phone number</label>
            <div class="mr-field__input">
              <input type="tel" id="phone" name="phone" placeholder="(555) 000-0000" required>
            </div>
          </div>

          <div class="mr-field">
            <label for="password">Password</label>
            <div class="mr-field__input">
              <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>
          </div>

          <div class="mr-field">
            <label for="confirm_password">Confirm password</label>
            <div class="mr-field__input">
              <input type="password" id="confirm_password" name="confirm_password" placeholder="••••••••" required>
            </div>
          </div>

          <label class="mr-auth-terms mr-field--span2">
            <input type="checkbox" name="agree_terms" required>
            I agree to the <a class="mr-link" href="#">Terms of Service</a> and <a class="mr-link" href="#">Privacy Policy</a>.
          </label>

          <button type="submit" class="mr-btn mr-btn--primary mr-auth-form__submit mr-field--span2">Create account</button>
        </form>

        <p class="mr-auth__footer-text">Already registered? <a class="mr-link mr-link--strong" href="sign-in.php">Sign in</a></p>
      </div>

    </div>
  </div>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
