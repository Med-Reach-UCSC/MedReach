<?php
// MedReach - Patient finalize-order / checkout page (presentation tier: HTML output only)
$active = 'orders';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Finalize Order — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body class="mr-page-finalize">

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-patient.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <h1>Finalize Your Order</h1>

        <div class="mr-dash-header__actions">
          <span class="mr-badge mr-badge--pill mr-badge--case-normal">Prescription RX-1042</span>

          <a class="mr-notif-btn mr-notif-btn--header" href="notifications.php" aria-label="Notifications">
            <img src="https://img.icons8.com/ios-filled/50/1a1b24/appointment-reminders.png" alt="">
            <span class="mr-notif-btn__dot" aria-hidden="true"></span>
          </a>
        </div>
      </header>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>
                <img class="mr-heading-icon" src="https://img.icons8.com/ios-filled/50/2d3fd7/delivery.png" alt="">
                Fulfillment Method
              </h2>
              <span class="mr-badge mr-badge--pill mr-badge--case-normal">2 Items · Split Order</span>
            </div>

            <div class="mr-confirm-methods" data-fulfillment>
              <div class="mr-confirm-method is-selected" data-method="courier" data-fee="300" tabindex="0" role="button" aria-pressed="true">
                <img src="https://img.icons8.com/ios-filled/50/ffffff/delivery.png" alt="">
                <div>
                  <strong>Courier Delivery</strong>
                  <small>ETA: 45–60 mins · 124 Maple Rd, Colombo 05</small>
                  <small>Delivery Fee: LKR 300.00</small>
                </div>
              </div>
              <div class="mr-confirm-method" data-method="pickup" data-fee="0" tabindex="0" role="button" aria-pressed="false">
                <img src="https://img.icons8.com/ios-filled/50/454655/shop.png" alt="">
                <div>
                  <strong>Pharmacy Pickup</strong>
                  <small>Ready in 15–30 mins</small>
                  <small>Free — collect from each pharmacy</small>
                </div>
              </div>
            </div>

            <p class="mr-dash-card__lede">Courier delivery consolidates pickup from both pharmacies and delivers everything to your address in one trip.</p>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Delivery Instructions (Optional)</h2>
            </div>
            <div class="mr-field">
              <label for="mr-delivery-instructions">Notes for the courier</label>
              <textarea id="mr-delivery-instructions" name="delivery_instructions" rows="3" placeholder="e.g., Leave at the front desk, call on arrival"></textarea>
            </div>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>
                <img class="mr-heading-icon" src="https://img.icons8.com/ios-filled/50/757687/pill.png" alt="">
                Order Summary
              </h2>
              <span class="mr-eyebrow mr-eyebrow--mono">2 Items</span>
            </div>

            <div class="mr-order-lines">
              <div class="mr-order-lines__items">
                <div class="mr-order-lines__row">
                  <span>Lisinopril 10mg <small>CVS Health · Qty 30</small></span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 1,450.00</strong>
                </div>
                <div class="mr-order-lines__row">
                  <span>Rosuvastatin 10mg <small>GreenCross Pharmacy · Qty 60 · Substitute</small></span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 2,380.00</strong>
                </div>
              </div>
              <div class="mr-order-lines__summary">
                <div class="mr-order-lines__row">
                  <span>Subtotal</span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 3,830.00</strong>
                </div>
                <div class="mr-order-lines__row">
                  <span>Delivery Fee</span>
                  <i class="mr-order-lines__rule"></i>
                  <strong data-fee-value>LKR 300.00</strong>
                </div>
                <div class="mr-order-lines__row">
                  <span>Payment Method</span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>Cash on Delivery</strong>
                </div>
                <div class="mr-order-lines__row mr-order-lines__row--total">
                  <span>Total (Cash)</span>
                  <i class="mr-order-lines__rule"></i>
                  <strong data-total-value>LKR 4,130.00</strong>
                </div>
              </div>
            </div>

            <a href="order-confirmation.php" class="mr-btn mr-btn--primary mr-btn--block">Confirm Order</a>
            <p class="mr-dash-card__lede">By confirming, you agree to pay via Cash on Delivery upon arrival.</p>
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
