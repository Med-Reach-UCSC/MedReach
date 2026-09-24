<?php
// MedReach - Delivery task details page (presentation tier: HTML output only)
$active = 'manifest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Order #ORD-9921 — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body>

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-delivery.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <div>
          <div class="mr-track-title">
            <h1>Order #ORD-9921</h1>
            <span class="mr-badge mr-badge--primary mr-badge--case-normal">
              <img src="https://img.icons8.com/ios-filled/50/ffffff/delivery.png" alt="">
              In Transit
            </span>
          </div>
          <div class="mr-order__tags">
            <span class="mr-badge mr-badge--pill mr-badge--case-normal">
              <img src="https://img.icons8.com/ios-filled/50/454655/shop.png" alt="">
              General Hospital Pharmacy
            </span>
            <span class="mr-badge mr-badge--pill mr-badge--case-normal">
              <img src="https://img.icons8.com/ios-filled/50/454655/route.png" alt="">
              2.4 km to drop-off
            </span>
            <span class="mr-badge mr-badge--pill mr-badge--case-normal">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/cash.png" alt="">
              Cash on delivery
            </span>
          </div>
        </div>

        <div class="mr-dash-header__actions">
          <a href="tel:+94771234567" class="mr-btn mr-btn--light mr-btn--sm">
            <img src="https://img.icons8.com/ios-filled/50/2d3fd7/phone.png" alt="">
            Call Recipient
          </a>
          <a class="mr-notif-btn mr-notif-btn--header" href="notifications.php" aria-label="Notifications">
            <img src="https://img.icons8.com/ios-filled/50/1a1b24/appointment-reminders.png" alt="">
            <span class="mr-notif-btn__dot" aria-hidden="true"></span>
          </a>
        </div>
      </header>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-tracking-card">
            <div class="mr-tracking-card__head">
              <h3>Delivery Route</h3>
              <span class="mr-eyebrow mr-eyebrow--mono">RT-992</span>
            </div>

            <ol class="mr-timeline">
              <li class="mr-timeline__step">
                <strong>Picked Up</strong>
                <small>General Hospital Pharmacy, Sector 7</small>
                <span class="mr-timeline__time">08:14 AM</span>
              </li>
              <li class="mr-timeline__step mr-timeline__step--active">
                <strong>In Transit</strong>
                <small>Approaching destination via 450 West Ave</small>
                <span class="mr-timeline__time">09:32 AM</span>
              </li>
              <li class="mr-timeline__step mr-timeline__step--pending">
                <strong>Delivered</strong>
                <small>Nimal Perera &middot; 142 Galle Road, Colombo 03</small>
                <span class="mr-timeline__time">ETA 09:45 AM</span>
              </li>
            </ol>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>
                <img class="mr-heading-icon" src="https://img.icons8.com/ios-filled/50/757687/cash.png" alt="">
                Payment to Collect
              </h2>
              <span class="mr-eyebrow mr-eyebrow--mono">COD</span>
            </div>

            <div class="mr-order-lines__summary">
              <div class="mr-order-lines__row">
                <span>Medicine Total</span>
                <i class="mr-order-lines__rule"></i>
                <strong>LKR 4,200.00</strong>
              </div>
              <div class="mr-order-lines__row">
                <span>Delivery Fee</span>
                <i class="mr-order-lines__rule"></i>
                <strong>LKR 300.00</strong>
              </div>
              <div class="mr-order-lines__row mr-order-lines__row--total">
                <span>Total to Collect</span>
                <i class="mr-order-lines__rule"></i>
                <strong>LKR 4,500.00</strong>
              </div>
            </div>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-courier-card mr-payment-card">
            <span class="mr-payment-card__label">
              <img src="https://img.icons8.com/ios-filled/50/ffffff/delivery.png" alt="">
              Delivery In Progress
            </span>
            <h2>2.4 km to Drop-off</h2>
            <p>Confirm handover once the package is delivered and cash payment is collected from the recipient.</p>
            <div class="mr-payment-card__due">
              <span>Cash to Collect</span>
              <strong>LKR 4,500.00</strong>
            </div>
          </section>

          <div class="mr-confirm-actions">
            <button type="button" class="mr-btn mr-btn--primary mr-btn--block" data-modal-open="mr-handover-modal">
              <img src="https://img.icons8.com/ios-filled/50/ffffff/checkmark.png" alt="">
              Confirm Handover
            </button>
          </div>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>
                <img class="mr-heading-icon" src="https://img.icons8.com/ios-filled/50/757687/box.png" alt="">
                Package Details
              </h2>
              <span class="mr-eyebrow mr-eyebrow--mono">3 items</span>
            </div>

            <div class="mr-profile-details">
              <div class="mr-profile-details__item">
                <span class="mr-eyebrow">Weight</span>
                <strong>0.6 kg</strong>
              </div>
              <div class="mr-profile-details__item">
                <span class="mr-eyebrow">Handling</span>
                <strong>Standard</strong>
              </div>
              <div class="mr-profile-details__item">
                <span class="mr-eyebrow">Payment Method</span>
                <strong>Cash on Delivery</strong>
              </div>
              <div class="mr-profile-details__item">
                <span class="mr-eyebrow">Recipient</span>
                <strong>Nimal Perera</strong>
              </div>
            </div>
          </section>

        </div>
      </div>
    </main>
  </div>

  <div class="mr-modal" id="mr-handover-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Confirm Handover</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="https://img.icons8.com/ios-filled/50/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <form class="mr-modal__form" id="mr-handover-form">
        <p>Confirm delivery of order <strong>#ORD-9921</strong> to <strong>Nimal Perera</strong> and collection of <strong>LKR 4,500.00</strong> cash on delivery.</p>

        <label class="mr-auth-terms">
          <input type="checkbox" required>
          I confirm the package was handed over and payment was collected.
        </label>

        <div class="mr-modal__actions">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Confirm</button>
        </div>
      </form>
    </div>
  </div>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
