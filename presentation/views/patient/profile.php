<?php
// MedReach - Patient profile & settings (presentation tier: HTML output only)
$active = 'profile';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile & Settings — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body class="mr-page-profile">

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-patient.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <h1>Profile &amp; Settings</h1>

        <div class="mr-dash-header__actions">
          <button type="button" class="mr-btn mr-btn--primary mr-btn--sm" data-modal-open="mr-edit-profile-modal">
            <img src="https://img.icons8.com/ios-filled/50/ffffff/edit.png" alt="">
            Edit Details
          </button>

          <a class="mr-notif-btn mr-notif-btn--header" href="notifications.php" aria-label="Notifications">
            <img src="https://img.icons8.com/ios-filled/50/1a1b24/appointment-reminders.png" alt="">
            <span class="mr-notif-btn__dot" aria-hidden="true"></span>
          </a>
        </div>
      </header>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card mr-profile-card">
            <div class="mr-profile-card__head">
              <div class="mr-profile-card__identity">
                <span class="mr-avatar mr-avatar--profile">NP</span>
                <div>
                  <h2>Nimal Perera</h2>
                  <span class="mr-eyebrow">Patient ID: <span class="mr-eyebrow--mono">#PT-88421</span></span>
                </div>
              </div>
              <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-open="mr-edit-profile-modal">
                <img src="https://img.icons8.com/ios-filled/50/1a1b24/edit.png" alt="">
                Edit Details
              </button>
            </div>

            <div class="mr-profile-details">
              <div class="mr-profile-details__item">
                <span class="mr-eyebrow">First Name</span>
                <strong>Nimal</strong>
              </div>
              <div class="mr-profile-details__item">
                <span class="mr-eyebrow">Last Name</span>
                <strong>Perera</strong>
              </div>
              <div class="mr-profile-details__item">
                <span class="mr-eyebrow">Email Address</span>
                <strong>nimal.perera@example.com</strong>
              </div>
              <div class="mr-profile-details__item">
                <span class="mr-eyebrow">Phone Number</span>
                <strong>+94 77 123 4567</strong>
              </div>
              <div class="mr-profile-details__item">
                <span class="mr-eyebrow">Date of Birth</span>
                <strong>14 Mar 1988</strong>
              </div>
              <div class="mr-profile-details__item mr-profile-details__item--span2">
                <span class="mr-eyebrow">Shipping Address</span>
                <strong>142 Galle Road, Colombo 03</strong>
              </div>
            </div>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Notification Preferences</h2>
            </div>

            <div class="mr-pharmacy-row">
              <strong>Order Updates</strong>
              <label class="mr-switch">
                <input type="checkbox" aria-label="Order Updates" checked>
                <span class="mr-switch__track"></span>
              </label>
            </div>
            <div class="mr-pharmacy-row">
              <strong>Substitution Alerts</strong>
              <label class="mr-switch">
                <input type="checkbox" aria-label="Substitution Alerts" checked>
                <span class="mr-switch__track"></span>
              </label>
            </div>
            <div class="mr-pharmacy-row">
              <strong>Delivery Updates</strong>
              <label class="mr-switch">
                <input type="checkbox" aria-label="Delivery Updates" checked>
                <span class="mr-switch__track"></span>
              </label>
            </div>
            <div class="mr-pharmacy-row">
              <strong>Promotional Offers</strong>
              <label class="mr-switch">
                <input type="checkbox" aria-label="Promotional Offers">
                <span class="mr-switch__track"></span>
              </label>
            </div>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Change Password</h2>
            </div>

            <form class="mr-auth-form">
              <label class="mr-field">
                <span>Current Password</span>
                <div class="mr-field__input">
                  <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/lock--v1.png" alt="">
                  <input type="password" placeholder="Enter current password">
                </div>
              </label>
              <label class="mr-field">
                <span>New Password</span>
                <div class="mr-field__input">
                  <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/lock--v1.png" alt="">
                  <input type="password" placeholder="Enter new password">
                </div>
              </label>
              <label class="mr-field">
                <span>Confirm New Password</span>
                <div class="mr-field__input">
                  <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/lock--v1.png" alt="">
                  <input type="password" placeholder="Re-enter new password">
                </div>
              </label>
              <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Update Password</button>
            </form>
          </section>

          <section class="mr-card mr-dash-card mr-danger-card">
            <h2>Danger Zone</h2>
            <p>Once you deactivate your account, you will lose access to your order history and saved details.</p>
            <button type="button" class="mr-btn mr-btn--danger-outline mr-btn--sm">Deactivate account</button>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-policy-card mr-profile-status">
            <div class="mr-policy-card__head">
              <span class="mr-icon-badge mr-icon-badge--info">
                <img src="https://img.icons8.com/ios-filled/50/0a7fb5/user-male-circle.png" alt="">
              </span>
              <h2>Complete Your Profile</h2>
            </div>
            <p>Add a secondary contact so a family member can be reached if you're unavailable to receive a delivery.</p>
            <button type="button" class="mr-btn mr-btn--dark mr-btn--sm" data-modal-open="mr-edit-profile-modal">Add Details</button>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Managed Profiles</h2>
            </div>

            <div class="mr-pharmacy-row">
              <div>
                <strong>Amara Silva</strong>
                <span class="mr-eyebrow mr-eyebrow--mono">Daughter · Age 9</span>
              </div>
              <a href="manage-patients.php" class="mr-btn mr-btn--ghost mr-btn--sm">View</a>
            </div>
            <div class="mr-pharmacy-row">
              <div>
                <strong>Sunil Perera</strong>
                <span class="mr-eyebrow mr-eyebrow--mono">Father · Age 71</span>
              </div>
              <a href="manage-patients.php" class="mr-btn mr-btn--ghost mr-btn--sm">View</a>
            </div>
            <a href="manage-patients.php" class="mr-btn mr-btn--light mr-btn--sm mr-btn--block">+ Add Dependent</a>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Default Fulfillment Method</h2>
            </div>
            <p class="mr-dash-card__lede">Used to pre-select your preferred option when a new order is ready to confirm.</p>

            <div class="mr-auth-tabs mr-pref-toggle">
              <button type="button" class="mr-auth-tabs__btn is-active" data-pref-toggle="courier">Courier Delivery</button>
              <button type="button" class="mr-auth-tabs__btn" data-pref-toggle="pickup">Pharmacy Pickup</button>
            </div>
          </section>

          <section class="mr-card mr-notif-list">
            <div class="mr-notif-list__section">
              <span class="mr-eyebrow">Recent Login Activity</span>
            </div>

            <div class="mr-notif-item">
              <span class="mr-icon-badge mr-icon-badge--success">
                <img src="https://img.icons8.com/ios-filled/50/1f9d6b/checkmark.png" alt="">
              </span>
              <span class="mr-notif-item__info">
                <span class="mr-notif-item__title">Chrome on Windows · Colombo, LK</span>
              </span>
              <span class="mr-badge mr-badge--success mr-badge--case-normal">This device</span>
            </div>

            <div class="mr-notif-item">
              <span class="mr-icon-badge mr-icon-badge--muted">
                <img src="https://img.icons8.com/ios-filled/50/454655/document.png" alt="">
              </span>
              <span class="mr-notif-item__info">
                <span class="mr-notif-item__title">Safari on iPhone · Colombo, LK</span>
              </span>
              <span class="mr-notif-item__time">Yesterday</span>
            </div>

            <div class="mr-notif-item">
              <span class="mr-icon-badge mr-icon-badge--muted">
                <img src="https://img.icons8.com/ios-filled/50/454655/document.png" alt="">
              </span>
              <span class="mr-notif-item__info">
                <span class="mr-notif-item__title">Chrome on Windows · Kandy, LK</span>
              </span>
              <span class="mr-notif-item__time">Oct 24</span>
            </div>
          </section>

        </div>
      </div>

    </main>
  </div>

  <div class="mr-modal" id="mr-edit-profile-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Edit Profile Details</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="https://img.icons8.com/ios-filled/50/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <form class="mr-auth-form mr-auth-form--grid mr-modal__form">
        <label class="mr-field">
          <span>First Name</span>
          <div class="mr-field__input">
            <input type="text" value="Nimal">
          </div>
        </label>
        <label class="mr-field">
          <span>Last Name</span>
          <div class="mr-field__input">
            <input type="text" value="Perera">
          </div>
        </label>
        <label class="mr-field mr-field--span2">
          <span>Email Address</span>
          <div class="mr-field__input">
            <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/mail.png" alt="">
            <input type="email" value="nimal.perera@example.com">
          </div>
        </label>
        <label class="mr-field mr-field--span2">
          <span>Phone Number</span>
          <div class="mr-field__input">
            <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/phone.png" alt="">
            <input type="tel" value="+94 77 123 4567">
          </div>
        </label>
        <label class="mr-field mr-field--span2">
          <span>Date of Birth</span>
          <div class="mr-field__input">
            <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/calendar--v1.png" alt="">
            <input type="date" value="1988-03-14">
          </div>
        </label>
        <label class="mr-field mr-field--span2">
          <span>Shipping Address</span>
          <textarea rows="2">142 Galle Road, Colombo 03</textarea>
        </label>

        <div class="mr-modal__actions mr-field--span2">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Save changes</button>
        </div>
      </form>
    </div>
  </div>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
