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
          <p class="mr-eyebrow">Manage your rider details and vehicle</p>
        </div>

        <div class="mr-dash-header__actions">
          <div class="mr-dash-stats">
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--active">142</strong>
              <span>Deliveries</span>
            </div>
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--delivered">4.9</strong>
              <span>Rating</span>
            </div>
          </div>
        </div>
      </header>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card mr-profile-card">
            <div class="mr-profile-card__head">
              <div class="mr-profile-card__identity">
                <?php $initials = 'KP'; require __DIR__ . '/../partials/avatar-upload.php'; ?>
                <div>
                  <h2>Kasun Perera</h2>
                  <span class="mr-eyebrow">Delivery partner &middot; Motorbike</span>
                </div>
              </div>
            </div>

            <form class="mr-auth-form mr-auth-form--grid" data-toast="Profile saved.">
              <label class="mr-field">
                <span>First Name</span>
                <div class="mr-field__input">
                  <input type="text" value="Kasun" required>
                </div>
              </label>
              <label class="mr-field">
                <span>Last Name</span>
                <div class="mr-field__input">
                  <input type="text" value="Perera" required>
                </div>
              </label>
              <label class="mr-field">
                <span>Phone Number</span>
                <div class="mr-field__input">
                  <img class="mr-field__icon" src="presentation/assets/images/icons/filled/757687/phone.png" alt="">
                  <input type="tel" value="+94 77 123 4567" required>
                </div>
              </label>
              <label class="mr-field">
                <span>NIC Number</span>
                <div class="mr-field__input">
                  <img class="mr-field__icon" src="presentation/assets/images/icons/filled/757687/lock--v1.png" alt="">
                  <input type="text" value="199512345678" readonly>
                </div>
              </label>
              <label class="mr-field">
                <span>Vehicle Type</span>
                <div class="mr-field__input">
                  <select required>
                    <option value="motorbike" selected>Motorbike</option>
                    <option value="three_wheeler">Three-wheeler</option>
                    <option value="car">Car</option>
                    <option value="van">Van</option>
                  </select>
                </div>
              </label>
              <label class="mr-field">
                <span>Vehicle Number</span>
                <div class="mr-field__input">
                  <input type="text" value="WP BCD-4521" required>
                </div>
              </label>

              <div class="mr-modal__actions mr-field--span2">
                <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Save changes</button>
              </div>
            </form>
          </section>

          <section class="mr-card mr-dash-card mr-danger-card">
            <h2>Danger Zone</h2>
            <p>Deactivating your account stops new delivery requests and signs you out. Finish any delivery in progress first.</p>
            <button type="button" class="mr-btn mr-btn--danger-outline mr-btn--sm" data-modal-open="mr-deactivate-modal">Deactivate account</button>
          </section>

        </div>

        <div class="mr-dash-col">

          <?php require __DIR__ . '/../partials/change-password.php'; ?>

        </div>
      </div>
    </main>
  </div>

  <div class="mr-modal" id="mr-deactivate-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Deactivate account?</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <p class="mr-modal__text">You'll stop receiving delivery requests. An admin can reactivate your account if you come back.</p>

      <form class="mr-auth-form mr-modal__form" data-toast="Deactivation request received.">
        <label class="mr-auth-terms">
          <input type="checkbox" required>
          <span>I have no deliveries in progress.</span>
        </label>

        <div class="mr-modal__actions">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--danger-outline mr-btn--sm">Deactivate</button>
        </div>
      </form>
    </div>
  </div>
