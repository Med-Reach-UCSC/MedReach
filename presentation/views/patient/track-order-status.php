<?php
// MedReach - Patient order delivery tracking page (presentation tier: HTML output only)
$active = 'orders';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Order RX-1042 — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body class="mr-page-track">

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-patient.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <div>
          <div class="mr-track-title">
            <h1>Order RX-1042</h1>
            <span class="mr-badge mr-badge--primary mr-badge--case-normal">
              <img src="https://img.icons8.com/ios-filled/50/ffffff/delivery.png" alt="">
              Out for Delivery
            </span>
          </div>
          <div class="mr-order__tags">
            <span class="mr-badge mr-badge--pill mr-badge--case-normal">
              <img src="https://img.icons8.com/ios-filled/50/454655/shop.png" alt="">
              City Care Pharmacy
            </span>
            <span class="mr-badge mr-badge--pill mr-badge--case-normal">
              <img src="https://img.icons8.com/ios-filled/50/454655/pill.png" alt="">
              6 items
            </span>
            <span class="mr-badge mr-badge--pill mr-badge--case-normal">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/cash.png" alt="">
              Cash on delivery
            </span>
          </div>
        </div>

        <div class="mr-dash-header__actions">
          <a href="#" class="mr-btn mr-btn--light mr-btn--sm">
            <img src="https://img.icons8.com/ios-filled/50/2d3fd7/document.png" alt="">
            View Invoice
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
              <h3>Delivery Status</h3>
            </div>

            <ol class="mr-timeline">
              <li class="mr-timeline__step">
                <strong>Prescription Uploaded</strong>
                <small>Verified by automated system.</small>
                <span class="mr-timeline__time">09:41 AM</span>
              </li>
              <li class="mr-timeline__step">
                <strong>Pharmacy Accepted</strong>
                <small>City Care Pharmacy is reviewing your order.</small>
                <span class="mr-timeline__time">09:45 AM</span>
              </li>
              <li class="mr-timeline__step">
                <strong>Order Confirmed</strong>
                <small>Stock verified and total calculated.</small>
                <span class="mr-timeline__time">09:50 AM</span>
              </li>
              <li class="mr-timeline__step">
                <strong>Preparing Medicines</strong>
                <small>Pharmacist is packing your order.</small>
                <span class="mr-timeline__time">10:05 AM</span>
              </li>
              <li class="mr-timeline__step">
                <strong>Ready for Pickup</strong>
                <small>Waiting for courier assignment.</small>
                <span class="mr-timeline__time">10:15 AM</span>
              </li>
              <li class="mr-timeline__step mr-timeline__step--active">
                <strong>Out for Delivery</strong>
                <small>Courier has picked up your order and is on the way to your location.</small>
                <span class="mr-timeline__time">10:32 AM</span>
              </li>
              <li class="mr-timeline__step mr-timeline__step--pending">
                <strong>Delivered</strong>
                <small>Estimated arrival by 11:00 AM.</small>
                <span class="mr-timeline__time">--:--</span>
              </li>
            </ol>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-courier-card">
            <div class="mr-courier-card__top">
              <div class="mr-courier-card__profile">
                <span class="mr-avatar mr-courier-card__avatar">M</span>
                <div>
                  <span class="mr-courier-card__label">Your Courier</span>
                  <strong class="mr-courier-card__name">Marcus T.</strong>
                  <span class="mr-courier-card__rating">
                    <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="">
                    4.9 (120+ deliveries)
                  </span>
                </div>
              </div>
              <div class="mr-courier-card__eta">
                <span>12 min</span>
                <small>away</small>
              </div>
            </div>

            <div class="mr-courier-card__actions">
              <a href="#" class="mr-btn mr-btn--light">
                <img src="https://img.icons8.com/ios-filled/50/2d3fd7/phone.png" alt="">
                Call
              </a>
              <button type="button" class="mr-btn mr-btn--dark">
                <img src="https://img.icons8.com/ios-filled/50/ffffff/speech-bubble.png" alt="">
                Message
              </button>
            </div>
          </section>

          <section class="mr-card mr-dash-card mr-order-details-card">
            <div class="mr-dash-card__head">
              <h2>
                <img class="mr-heading-icon" src="https://img.icons8.com/ios-filled/50/757687/list.png" alt="">
                Order Details
              </h2>
              <span class="mr-eyebrow mr-eyebrow--mono">6 items</span>
            </div>

            <div class="mr-order-lines">
              <div class="mr-order-lines__items">
                <div class="mr-order-lines__row">
                  <span>Amoxicillin 500mg <small>x2</small></span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 24.00</strong>
                </div>
                <div class="mr-order-lines__row">
                  <span>Ibuprofen 400mg <small>x1</small></span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 8.50</strong>
                </div>
                <div class="mr-order-lines__row">
                  <span>Vitamin D3 Drops <small>x1</small></span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 12.00</strong>
                </div>
                <div class="mr-order-lines__row">
                  <span>Paracetamol 500mg <small>x2</small></span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 6.00</strong>
                </div>
                <div class="mr-order-lines__row">
                  <span>Cetirizine 10mg <small>x1</small></span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 9.50</strong>
                </div>
                <div class="mr-order-lines__row">
                  <span>Omeprazole 20mg <small>x1</small></span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 15.00</strong>
                </div>
              </div>
              <div class="mr-order-lines__summary">
                <div class="mr-order-lines__row">
                  <span>Subtotal</span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 75.00</strong>
                </div>
                <div class="mr-order-lines__row">
                  <span>Delivery Fee</span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 4.99</strong>
                </div>
                <div class="mr-order-lines__row mr-order-lines__row--success">
                  <span>Promo (FIRST10)</span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>-LKR 7.50</strong>
                </div>
                <div class="mr-order-lines__row mr-order-lines__row--total">
                  <span>Total (Cash)</span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 72.49</strong>
                </div>
              </div>
            </div>
          </section>

          <section class="mr-card mr-help-card">
            <span class="mr-icon-badge mr-icon-badge--info">
              <img src="https://img.icons8.com/ios-filled/50/2d3fd7/help.png" alt="">
            </span>
            <div>
              <strong>Need assistance?</strong>
              <p>Contact support about this order.</p>
            </div>
            <a class="mr-btn mr-btn--ghost mr-btn--sm" href="#">Contact support</a>
          </section>

        </div>
      </div>
    </main>
  </div>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
