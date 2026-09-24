<?php
// MedReach - Shared site navigation (presentation tier: HTML output only)
?>
<div class="mr-nav">
  <a class="mr-nav__logo" href="index.php">
    <img src="presentation/assets/images/logo.png" alt="MedReach Logo"/>
  </a>

  <button type="button" class="mr-nav__toggle" aria-label="Toggle menu" aria-expanded="false" aria-controls="mr-nav-menu">
    <img class="mr-nav__toggle-icon mr-nav__toggle-icon--open" src="https://img.icons8.com/ios-filled/50/1a1b24/menu.png" alt="">
    <img class="mr-nav__toggle-icon mr-nav__toggle-icon--close" src="https://img.icons8.com/ios-filled/50/1a1b24/multiply.png" alt="">
  </button>

  <div class="mr-nav__menu" id="mr-nav-menu">
    <nav class="mr-nav__links">
      <a href="index.php#solutions">Solutions</a>
      <a href="index.php#platform">Platform</a>
      <a href="how-it-works.php">How it works</a>
      <a href="index.php#network">Network</a>
      <a href="index.php#site-footer">Careers</a>
    </nav>
    <div class="mr-nav__actions">
      <a class="mr-link" href="sign-in.php">Login</a>
      <button type="button" class="mr-btn mr-btn--dark mr-btn--sm">Sign Up</button>
    </div>
  </div>
</div>
