<?php
// MedReach - Delivery rider dashboard (presentation tier: HTML output only)
// Converted from docs/delivery-dahsboard.php (Tailwind mockup) onto the same
// mr- component system as the patient/pharmacy modules — no new markup
// patterns invented, only 3 small CSS additions (grid-3 row, a mini-stat
// accent border, a taller map-preview) layered onto existing components.
//
// Defects fixed vs the mockup: dropped the Tailwind CDN/Google Fonts/inline
// theme config for the project's own --mr- token system; dropped the
// standalone glass side-nav and hotlinked avatar for the shared
// sidebar-delivery.php partial, matching every other role's dashboard;
// replaced the live embedded map screenshot with the project's existing
// static .mr-map-preview placeholder — no mapping engine/GPS wired in yet
// (OpenStreetMap routing is planned for a later pass, once the UI is done);
// reused .mr-order-row for the manifest queue instead of one-off markup;
// reused .mr-courier-card/.mr-payment-card's gradient for the cold-chain
// alert and .mr-med-stats for the weekly metrics, instead of the mockup's
// hand-rolled progress bars.
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
          <h1>Good afternoon, Marcus</h1>
          <p class="mr-eyebrow">Route synced 2 min ago</p>
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

          <label class="mr-switch" title="Available for deliveries" data-duty-toggle>
            <input type="checkbox" checked>
            <span class="mr-switch__track"></span>
          </label>

          <a class="mr-notif-btn mr-notif-btn--header" href="notifications.php" aria-label="Notifications">
            <img src="https://img.icons8.com/ios-filled/50/1a1b24/appointment-reminders.png" alt="">
            <span class="mr-notif-btn__dot" aria-hidden="true"></span>
          </a>
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
              <h2>Route overview</h2>
              <span class="mr-badge mr-badge--success"><span class="mr-badge__dot"></span>Live Tracking</span>
            </div>
            <div class="mr-map-preview mr-map-preview--lg">
              <span class="mr-map-preview__pin" aria-hidden="true"></span>
              <span class="mr-map-preview__label">Next stop: 450 West Ave &middot; 2.4 km</span>
            </div>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Manifest queue</h2>
              <span class="mr-badge mr-badge--pill mr-badge--case-normal">2 stops</span>
            </div>

            <a class="mr-order-row" href="#">
              <span class="mr-icon-badge mr-icon-badge--muted">
                <img src="https://img.icons8.com/ios-filled/50/454655/hospital-3.png" alt="">
              </span>
              <span class="mr-order-row__info">
                <span>General Hospital Pharmacy</span>
                <span class="mr-eyebrow mr-eyebrow--mono">#ORD-993-A &middot; 2.4 km</span>
              </span>
              <span class="mr-badge mr-badge--accent mr-badge--case-normal">Pending</span>
            </a>

            <a class="mr-order-row" href="#">
              <span class="mr-icon-badge mr-icon-badge--muted">
                <img src="https://img.icons8.com/ios-filled/50/454655/pill.png" alt="">
              </span>
              <span class="mr-order-row__info">
                <span>Dr. Silva Clinic</span>
                <span class="mr-eyebrow mr-eyebrow--mono">#ORD-994-B &middot; 5.1 km</span>
              </span>
              <span class="mr-badge mr-badge--pill mr-badge--case-normal">Queued</span>
            </a>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-courier-card mr-payment-card">
            <span class="mr-payment-card__label">
              <img src="https://img.icons8.com/ios-filled/50/ffffff/warning-shield.png" alt="">
              Cold Chain Alert
            </span>
            <h2>Temperature-Sensitive Cargo</h2>
            <p>Insulin shipment on board. Keep the cargo box sealed and under 4&deg;C until drop-off.</p>
            <div class="mr-payment-card__due">
              <span>Cargo Temp</span>
              <strong>2.1&deg;C</strong>
            </div>
            <div class="mr-med-stats__bar" style="margin-top: 0.75rem;">
              <div class="mr-med-stats__fill" style="width: 33%;"></div>
            </div>
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

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>Fuel Efficiency</span>
                <strong>14.2 km/l</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 60%; opacity: .6;"></div></div>
            </div>

            <div class="mr-pharmacy-row" style="margin-top: 1.1rem; padding-top: 1.1rem; border-top: 1px solid rgba(255, 255, 255, 0.4);">
              <span>Total Distance</span>
              <strong>428 km</strong>
            </div>
          </section>

        </div>
      </div>
    </main>
  </div>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
