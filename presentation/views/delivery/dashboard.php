<?php
// MedReach - Delivery rider dashboard (presentation tier: HTML output only)
$active = 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Delivery Dashboard — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body>

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-delivery.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <div>
          <h1>Good afternoon, Kasun</h1>
          <p class="mr-eyebrow">2 stops assigned today</p>
        </div>

        <div class="mr-dash-header__actions">
          <div class="mr-dash-stats">
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--active">8</strong>
              <span>Deliveries today</span>
            </div>
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--delivered">96%</strong>
              <span>On-time rate</span>
            </div>
          </div>

          <label class="mr-switch" title="Available for deliveries" data-duty-toggle data-on-text="You're available — new delivery requests will reach you." data-off-text="Off duty — you won't receive new delivery requests.">
            <input type="checkbox" aria-label="Available for deliveries" checked>
            <span class="mr-switch__track"></span>
          </label>
        </div>
      </header>

      <div class="mr-stat-grid-3">
        <section class="mr-card mr-mini-stat">
          <div>
            <span class="mr-eyebrow mr-eyebrow--mono">Active Delivery</span>
            <strong>#ORD-9921</strong>
          </div>
          <span class="mr-icon-badge mr-icon-badge--info mr-icon-badge--lg">
            <img src="https://img.icons8.com/ios-filled/50/2d3fd7/delivery.png" alt="">
          </span>
        </section>

        <section class="mr-card mr-mini-stat">
          <div>
            <span class="mr-eyebrow mr-eyebrow--mono">Est. Arrival</span>
            <strong>14:22</strong>
          </div>
          <span class="mr-icon-badge mr-icon-badge--success mr-icon-badge--lg">
            <img src="https://img.icons8.com/ios-filled/50/1f9d6b/clock.png" alt="">
          </span>
        </section>

        <section class="mr-card mr-mini-stat mr-mini-stat--accent">
          <div>
            <span class="mr-eyebrow mr-eyebrow--mono">Cash to Collect</span>
            <strong>LKR 4,500</strong>
          </div>
          <span class="mr-icon-badge mr-icon-badge--accent mr-icon-badge--lg">
            <img src="https://img.icons8.com/ios-filled/50/dd8e1c/cash.png" alt="">
          </span>
        </section>
      </div>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Delivery requests</h2>
              <span class="mr-badge mr-badge--accent" data-request-count>1 new</span>
            </div>

            <div data-request-list>
              <div class="mr-card mr-request-card">
                <div class="mr-request-card__head">
                  <span class="mr-icon-badge mr-icon-badge--accent">
                    <img src="https://img.icons8.com/ios-filled/50/dd8e1c/delivery.png" alt="">
                  </span>
                  <div>
                    <span class="mr-eyebrow mr-eyebrow--accent">#ORD-9947 &middot; 3.2 km</span>
                    <h4>CityHealth Pharmacy &rarr; Nugegoda</h4>
                  </div>
                </div>
                <p class="mr-eyebrow mr-eyebrow--mono">Pickup ready &middot; Collect LKR 2,150 cash</p>
                <div class="mr-request-card__actions">
                  <button type="button" class="mr-btn mr-btn--muted mr-btn--sm" data-request-action="decline" data-toast="Declined — the task will be reassigned to another courier.">Decline</button>
                  <button type="button" class="mr-btn mr-btn--dark mr-btn--sm" data-request-action="accept" data-toast="Accepted — #ORD-9947 added to your manifest.">Accept</button>
                </div>
              </div>
            </div>

            <p class="mr-resp-grid__empty" data-request-empty hidden style="text-align: center; margin-top: 1rem;">
              No new delivery requests.
            </p>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Manifest queue</h2>
              <span class="mr-badge mr-badge--pill mr-badge--case-normal">2 stops</span>
            </div>

            <a class="mr-order-row" href="delivery-details.php">
              <span class="mr-icon-badge mr-icon-badge--muted">
                <img src="https://img.icons8.com/ios-filled/50/454655/hospital-3.png" alt="">
              </span>
              <span class="mr-order-row__info">
                <span>General Hospital Pharmacy</span>
                <span class="mr-eyebrow mr-eyebrow--mono">#ORD-9934 &middot; 2.4 km</span>
              </span>
              <span class="mr-badge mr-badge--accent mr-badge--case-normal">Pending</span>
            </a>

            <a class="mr-order-row" href="delivery-details.php">
              <span class="mr-icon-badge mr-icon-badge--muted">
                <img src="https://img.icons8.com/ios-filled/50/454655/pill.png" alt="">
              </span>
              <span class="mr-order-row__info">
                <span>Dr. Silva Clinic</span>
                <span class="mr-eyebrow mr-eyebrow--mono">#ORD-9941 &middot; 5.1 km</span>
              </span>
              <span class="mr-badge mr-badge--pill mr-badge--case-normal">Queued</span>
            </a>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-courier-card mr-payment-card">
            <span class="mr-payment-card__label">
              <img src="https://img.icons8.com/ios-filled/50/ffffff/warning-shield.png" alt="">
              Handling Note
            </span>
            <h2>Temperature-Sensitive Cargo</h2>
            <p>Insulin shipment on board. Keep the cargo box sealed and refrigerated until drop-off.</p>
          </section>

          <section class="mr-card mr-med-stats">
            <h2>This week's performance</h2>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>Completion Rate</span>
                <strong>98.4%</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 98.4%;"></div></div>
            </div>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>On-Time Delivery</span>
                <strong>92.1%</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 92.1%; opacity: .8;"></div></div>
            </div>

          </section>

        </div>
      </div>
    </main>
  </div>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
