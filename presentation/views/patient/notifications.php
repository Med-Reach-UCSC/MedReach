<?php
$title = 'Notifications — MedReach';
$bodyClass = 'mr-page-notifications';
$active = 'notifications';
?>
  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <h1>Notifications</h1>

        <div class="mr-dash-header__actions">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" id="mr-notif-mark-all">
            <img src="presentation/assets/images/icons/filled/2d3fd7/checkmark.png" alt="">
            Mark all as read
          </button>
        </div>
      </header>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-notif-list">
            <div class="mr-notif-list__section">
              <span class="mr-eyebrow">Today</span>
            </div>

            <a class="mr-notif-item is-unread" data-read="false" href="track-order-status.php">
              <span class="mr-icon-badge mr-icon-badge--success">
                <img src="presentation/assets/images/icons/filled/1f9d6b/checkmark.png" alt="">
              </span>
              <span class="mr-notif-item__info">
                <span class="mr-notif-item__title">City Health Pharmacy accepted your order #ORD-8924</span>
              </span>
              <span class="mr-notif-item__time">09:42 AM</span>
              <span class="mr-notif-item__dot" aria-hidden="true"></span>
            </a>

            <a class="mr-notif-item is-unread" data-read="false" href="track-order-status.php">
              <span class="mr-icon-badge mr-icon-badge--info">
                <img src="presentation/assets/images/icons/filled/2d3fd7/delivery.png" alt="">
              </span>
              <span class="mr-notif-item__info">
                <span class="mr-notif-item__title">Courier assigned. Order #ORD-8924 is out for delivery.</span>
              </span>
              <span class="mr-notif-item__time">08:15 AM</span>
              <span class="mr-notif-item__dot" aria-hidden="true"></span>
            </a>

            <a class="mr-notif-item" data-read="true" href="pharmacy-responses.php">
              <span class="mr-icon-badge mr-icon-badge--accent">
                <img src="presentation/assets/images/icons/filled/dd8e1c/pill.png" alt="">
              </span>
              <span class="mr-notif-item__info">
                <span class="mr-notif-item__title">Substitution suggested for Order #ORD-8920 (Aspirin 81mg)</span>
              </span>
              <span class="mr-notif-item__time">07:30 AM</span>
            </a>

            <div class="mr-notif-list__section">
              <span class="mr-eyebrow">Earlier</span>
            </div>

            <a class="mr-notif-item" data-read="true" href="order-history.php">
              <span class="mr-icon-badge mr-icon-badge--success">
                <img src="presentation/assets/images/icons/filled/1f9d6b/box.png" alt="">
              </span>
              <span class="mr-notif-item__info">
                <span class="mr-notif-item__title">Order #ORD-8890 delivered — rate CityHealth Pharmacy</span>
              </span>
              <span class="mr-notif-item__time">Yesterday</span>
            </a>

            <a class="mr-notif-item" data-read="true" href="track-order-status.php">
              <span class="mr-icon-badge mr-icon-badge--danger">
                <img src="presentation/assets/images/icons/filled/d6534a/redo.png" alt="">
              </span>
              <span class="mr-notif-item__info">
                <span class="mr-notif-item__title">Order #ORD-8915 declined by Sunrise Pharmacy — forwarded to MediCare Plus</span>
              </span>
              <span class="mr-notif-item__time">Yesterday</span>
            </a>

            <a class="mr-notif-item" data-read="true" href="order-history.php">
              <span class="mr-icon-badge mr-icon-badge--muted">
                <img src="presentation/assets/images/icons/filled/454655/document.png" alt="">
              </span>
              <span class="mr-notif-item__info">
                <span class="mr-notif-item__title">Your monthly order summary is ready to view.</span>
              </span>
              <span class="mr-notif-item__time">Oct 24</span>
            </a>
          </section>

        </div>

        <div class="mr-dash-col">

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
              <strong>Delivery Tracking</strong>
              <label class="mr-switch">
                <input type="checkbox" aria-label="Delivery Tracking" checked>
                <span class="mr-switch__track"></span>
              </label>
            </div>
            <div class="mr-pharmacy-row">
              <strong>System Alerts</strong>
              <label class="mr-switch">
                <input type="checkbox" aria-label="System Alerts">
                <span class="mr-switch__track"></span>
              </label>
            </div>
          </section>

          <section class="mr-card mr-upload-card">
            <span class="mr-icon-badge mr-icon-badge--white mr-icon-badge--lg">
              <img src="presentation/assets/images/icons/filled/757687/appointment-reminders.png" alt="">
            </span>
            <h2>No new alerts</h2>
            <p>You're all caught up for now.</p>
          </section>

        </div>
      </div>
    </main>
  </div>
