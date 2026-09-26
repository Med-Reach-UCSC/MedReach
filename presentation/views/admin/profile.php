<?php
$title = 'Profile — MedReach';
$bodyClass = 'mr-page-profile';
$active = 'profile';
?>
  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <div>
          <h1>Profile</h1>
          <p class="mr-eyebrow">Manage your admin account</p>
        </div>
      </header>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card mr-profile-card">
            <div class="mr-profile-card__head">
              <div class="mr-profile-card__identity">
                <?php $initials = 'A'; require __DIR__ . '/../partials/avatar-upload.php'; ?>
                <div>
                  <h2>Admin</h2>
                  <span class="mr-eyebrow">System administrator</span>
                </div>
              </div>
            </div>

            <form class="mr-auth-form mr-auth-form--grid" data-toast="Profile saved.">
              <label class="mr-field">
                <span>First Name</span>
                <div class="mr-field__input">
                  <input type="text" value="Admin" required>
                </div>
              </label>
              <label class="mr-field">
                <span>Last Name</span>
                <div class="mr-field__input">
                  <input type="text" value="MedReach" required>
                </div>
              </label>
              <label class="mr-field">
                <span>Email Address</span>
                <div class="mr-field__input">
                  <img class="mr-field__icon" src="presentation/assets/images/icons/filled/757687/lock--v1.png" alt="">
                  <input type="email" value="admin@medreach.test" readonly>
                </div>
              </label>
              <label class="mr-field">
                <span>Phone Number</span>
                <div class="mr-field__input">
                  <img class="mr-field__icon" src="presentation/assets/images/icons/filled/757687/phone.png" alt="">
                  <input type="tel" value="+94 11 234 5678" required>
                </div>
              </label>

              <div class="mr-modal__actions mr-field--span2">
                <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Save changes</button>
              </div>
            </form>
          </section>

        </div>

        <div class="mr-dash-col">
          <?php require __DIR__ . '/../partials/change-password.php'; ?>
        </div>
      </div>
    </main>
  </div>
