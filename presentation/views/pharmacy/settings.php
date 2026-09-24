<?php
// MedReach - Pharmacy profile & settings (presentation tier: HTML output only)
// Converted from docs/pharmacist-setting.php (Tailwind mockup) onto the mr-
// component system — this is the pharmacist's equivalent of
// patient/profile.php, so it reuses that page's exact components: mr-field
// / mr-auth-form--grid (profile fields), mr-switch (notification toggles),
// mr-auth-form (password fields), mr-policy-card (earnings.php's policy
// widget, repurposed as a support card). No new CSS.
//
// Defects fixed vs the mockup: dropped the Tailwind CDN/Google Fonts/inline
// theme config (external library, not project CSS per CLAUDE.md) for the
// project's own --mr- token system; dropped the standalone glass side-nav
// and hotlinked avatar for the shared sidebar-pharmacy.php partial, wired
// to the footer "Profile" link exactly like sidebar-patient.php does for
// profile.php (was a dead "#" link); dropped the decorative gradient
// "Need assistance?" promo card rather than invent a one-off CSS component
// for it — replaced with the project's existing mr-policy-card treatment
// (same one earnings.php uses) so support info reuses a real component;
// moved the license-number lock icon to the left of the field to match
// every other icon-field in the project (profile.php's password fields)
// instead of the mockup's one-off right-side icon; added a Confirm New
// Password field to match profile.php's password form exactly instead of
// the mockup's unconfirmed 2-field version.
//
// Follow-up pass (defects flagged after first render): the field grid was
// still capped at the modal's 431px width inside a much wider dash card,
// leaving a dead gap and truncating values — widened via a scoped
// .mr-dash-card .mr-auth-form--grid CSS rule instead of resizing the
// shared modal grid; folded the pharmacist identity (avatar/name/pharmacy)
// into the profile card head via the existing mr-profile-card__identity
// pattern from patient/profile.php, since this page is the sidebar's
// "Profile" destination but previously showed no name anywhere; added the
// same order-fulfillment stat capsules orders.php uses in its header;
// added a Danger Zone card (mr-danger-card, same component as
// patient/profile.php's) and a Recent Login Activity card (mr-notif-list,
// same data pattern as patient/profile.php's) — both existed on the
// patient profile page but were missing here.
$active = 'profile';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Settings — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body class="mr-page-profile">

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-pharmacy.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <div>
          <h1>Settings</h1>
          <p class="mr-eyebrow">Manage your pharmacy profile and preferences</p>
        </div>

        <div class="mr-dash-header__actions">
          <div class="mr-dash-stats">
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--active">12</strong>
              <span>Orders today</span>
            </div>
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--delivered">98%</strong>
              <span>Fulfillment</span>
            </div>
          </div>

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
                <span class="mr-avatar mr-avatar--profile">H</span>
                <div>
                  <h2>Dr. Hayes</h2>
                  <span class="mr-eyebrow">Pharmacist-in-charge &middot; Oakwood City Pharmacy</span>
                </div>
              </div>
            </div>

            <form class="mr-auth-form mr-auth-form--grid">
              <label class="mr-field">
                <span>Pharmacy Name</span>
                <div class="mr-field__input">
                  <input type="text" value="Oakwood City Pharmacy">
                </div>
              </label>
              <label class="mr-field">
                <span>License Number</span>
                <div class="mr-field__input">
                  <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/lock--v1.png" alt="">
                  <input type="text" value="#LIC-992-PX" readonly>
                </div>
              </label>
              <label class="mr-field mr-field--span2">
                <span>Primary Address</span>
                <div class="mr-field__input">
                  <input type="text" value="1428 Elm Street, Medical District, Colombo 03">
                </div>
              </label>
              <label class="mr-field">
                <span>Phone Number</span>
                <div class="mr-field__input">
                  <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/phone.png" alt="">
                  <input type="tel" value="+94 11 234 5678">
                </div>
              </label>
              <label class="mr-field">
                <span>Email Address</span>
                <div class="mr-field__input">
                  <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/mail.png" alt="">
                  <input type="email" value="contact@oakwoodpharmacy.lk">
                </div>
              </label>
              <label class="mr-field">
                <span>Opening Time</span>
                <div class="mr-field__input">
                  <input type="time" value="08:00">
                </div>
              </label>
              <label class="mr-field">
                <span>Closing Time</span>
                <div class="mr-field__input">
                  <input type="time" value="20:00">
                </div>
              </label>

              <div class="mr-modal__actions mr-field--span2">
                <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Save changes</button>
              </div>
            </form>
          </section>

          <section class="mr-card mr-policy-card mr-policy-card--wide">
            <div class="mr-policy-card__body">
              <div class="mr-policy-card__head">
                <span class="mr-icon-badge mr-icon-badge--info">
                  <img src="https://img.icons8.com/ios-filled/50/0a7fb5/customer-support.png" alt="">
                </span>
                <h2>Need assistance with MedReach?</h2>
              </div>
              <p>Our support team is available to help you with delivery workflows, substitution approvals, and payout questions.</p>
            </div>
            <a href="#" class="mr-btn mr-btn--dark mr-btn--sm">Contact Support</a>
          </section>

          <section class="mr-card mr-dash-card mr-danger-card">
            <h2>Danger Zone</h2>
            <p>Deactivating your pharmacy listing stops new prescriptions from being routed to you until you reactivate. This does not affect orders already in progress.</p>
            <button type="button" class="mr-btn mr-btn--danger-outline mr-btn--sm">Deactivate pharmacy listing</button>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Notification Preferences</h2>
            </div>

            <div class="mr-pharmacy-row">
              <strong>Order Alerts</strong>
              <label class="mr-switch">
                <input type="checkbox" checked>
                <span class="mr-switch__track"></span>
              </label>
            </div>
            <div class="mr-pharmacy-row">
              <strong>Stock Updates</strong>
              <label class="mr-switch">
                <input type="checkbox" checked>
                <span class="mr-switch__track"></span>
              </label>
            </div>
            <div class="mr-pharmacy-row">
              <strong>Delivery Exceptions</strong>
              <label class="mr-switch">
                <input type="checkbox">
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

          <section class="mr-card mr-notif-list">
            <div class="mr-notif-list__section">
              <span class="mr-eyebrow">Recent Login Activity</span>
            </div>

            <div class="mr-notif-item">
              <span class="mr-icon-badge mr-icon-badge--success">
                <img src="https://img.icons8.com/ios-filled/50/1f9d6b/checkmark.png" alt="">
              </span>
              <span class="mr-notif-item__info">
                <span class="mr-notif-item__title">Chrome on Windows &middot; Colombo, LK</span>
              </span>
              <span class="mr-badge mr-badge--success mr-badge--case-normal">This device</span>
            </div>

            <div class="mr-notif-item">
              <span class="mr-icon-badge mr-icon-badge--muted">
                <img src="https://img.icons8.com/ios-filled/50/454655/document.png" alt="">
              </span>
              <span class="mr-notif-item__info">
                <span class="mr-notif-item__title">Safari on iPhone &middot; Colombo, LK</span>
              </span>
              <span class="mr-notif-item__time">Yesterday</span>
            </div>
          </section>

        </div>
      </div>
    </main>
  </div>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
