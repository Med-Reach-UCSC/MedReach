<?php
// MedReach - Patient order confirmation page (presentation tier: HTML output only)
$active = 'orders';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Order Confirmed — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body class="mr-page-confirm">

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-patient.php'; ?>

    <main class="mr-dash-main">
      <section class="mr-confirm-hero">
        <span class="mr-icon-badge mr-icon-badge--success mr-icon-badge--lg">
          <img src="https://img.icons8.com/ios-filled/50/1f9d6b/checkmark.png" alt="">
        </span>
        <h1>Order Confirmed</h1>
        <p>Your prescription is being processed. We've sent a confirmation email with all the details.</p>
      </section>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-confirm-ref">
            <div>
              <span class="mr-eyebrow mr-eyebrow--mono">Order Reference</span>
              <strong class="mr-confirm-ref__value">#ORD-8472</strong>
            </div>
            <div class="mr-confirm-ref__eta">
              <span class="mr-eyebrow mr-eyebrow--mono">Estimated Arrival</span>
              <strong>Today, 2:00 PM – 4:00 PM</strong>
            </div>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>
                <img class="mr-heading-icon" src="https://img.icons8.com/ios-filled/50/757687/delivery.png" alt="">
                Delivery Method Confirmed
              </h2>
            </div>

            <div class="mr-confirm-methods">
              <div class="mr-confirm-method is-selected">
                <img src="https://img.icons8.com/ios-filled/50/ffffff/speed.png" alt="">
                <div>
                  <strong>Express Delivery</strong>
                  <small>To 123 Healthcare Blvd, Apt 4B</small>
                </div>
              </div>
              <div class="mr-confirm-method">
                <img src="https://img.icons8.com/ios-filled/50/454655/shop.png" alt="">
                <div>
                  <strong>Pharmacy Pickup</strong>
                  <small>Not selected for this order</small>
                </div>
              </div>
            </div>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>
                <img class="mr-heading-icon" src="https://img.icons8.com/ios-filled/50/757687/pill.png" alt="">
                Prescription Summary
              </h2>
              <span class="mr-eyebrow mr-eyebrow--mono">2 Items</span>
            </div>

            <div class="mr-order-lines">
              <div class="mr-order-lines__items">
                <div class="mr-order-lines__row">
                  <span>Amoxicillin 500mg <small>Capsules · 30 Day Supply</small></span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 12.50</strong>
                </div>
                <div class="mr-order-lines__row">
                  <span>Albuterol Sulfate Inhaler <small>90mcg · 1 Unit</small></span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 45.00</strong>
                </div>
              </div>
              <div class="mr-order-lines__summary">
                <div class="mr-order-lines__row">
                  <span>Subtotal</span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 57.50</strong>
                </div>
                <div class="mr-order-lines__row mr-order-lines__row--success">
                  <span>Delivery Fee</span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>Free</strong>
                </div>
                <div class="mr-order-lines__row mr-order-lines__row--total">
                  <span>Total (Cash)</span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 57.50</strong>
                </div>
              </div>
            </div>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-courier-card mr-payment-card">
            <span class="mr-payment-card__label">
              <img src="https://img.icons8.com/ios-filled/50/ffffff/cash.png" alt="">
              Payment Status
            </span>
            <h2>Cash on Delivery</h2>
            <p>Your payment method is confirmed. Please prepare exact change if possible for our delivery partner to ensure a smooth handoff.</p>
            <div class="mr-payment-card__due">
              <span>Amount Due</span>
              <strong>LKR 57.50</strong>
            </div>
          </section>

          <div class="mr-confirm-actions">
            <a href="track-order-status.php" class="mr-btn mr-btn--primary mr-btn--block">
              <img src="https://img.icons8.com/ios-filled/50/ffffff/delivery.png" alt="">
              Track Order
            </a>
            <a href="patient-dashboard.php" class="mr-btn mr-btn--light mr-btn--block">Return to Dashboard</a>
          </div>

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
