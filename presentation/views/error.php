<?php
[$mr_heading, $mr_text] = [
  404 => ['Page not found', 'The page you\'re looking for doesn\'t exist or has moved.'],
  500 => ['Something went wrong', 'We couldn\'t complete your request. Please try again in a moment.'],
][$code];
$title = "$mr_heading — MedReach";
$bodyClass = 'mr-auth-body';
$flash = ['type' => 'error', 'text' => "Error $code"];
?>
  <div class="mr-auth">
    <div class="mr-auth-card mr-auth-card--solo">
      <div class="mr-auth-card__form">
        <a class="mr-auth__logo" href="index.php">
          <img src="presentation/assets/images/logo.png" alt="MedReach Logo">
        </a>
        <h1><?= $mr_heading ?></h1>
        <p class="mr-auth__subtitle"><?= $mr_text ?></p>

        <?php require __DIR__ . '/partials/auth-flash.php'; ?>

        <a class="mr-btn mr-btn--primary mr-auth-form__submit" href="index.php">Back to home</a>
      </div>
    </div>
  </div>
