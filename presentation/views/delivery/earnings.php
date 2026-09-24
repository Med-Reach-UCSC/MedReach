<?php
// MedReach - Delivery rider earnings & payouts (presentation tier: HTML output only)
// Converted from docs/delivery-earnings.php (Tailwind mockup) onto the same
// mr- component system as pharmacy/earnings.php — reuses mr-dash-stats
// (header capsules), mr-pay-table + mr-pagination, mr-spend-ring (the same
// Chart.js canvas ids pharmacy/earnings.php already wires up in main.js),
// mr-med-stats bars, and mr-pharmacy-row (dashboard.php's "Total Distance"
// row) for the leader-line metrics. No new CSS, no new JS.
//
// Defects fixed vs the mockup: dropped the Tailwind CDN/Google Fonts/inline
// theme config for the project's own --mr- token system; dropped the
// standalone glass side-nav and hotlinked avatar for the shared
// sidebar-delivery.php partial; replaced the hand-coded inline-SVG progress
// ring and CSS bar-placeholder chart with the project's existing Chart.js
// spend-ring/trend patterns (same canvas ids pharmacy/earnings.php uses, so
// no new chart config is needed); replaced the fabricated order-id/pharmacy
// pairings with ones consistent with dashboard.php's manifest queue.
$active = 'earnings';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Earnings — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body>

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-delivery.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <div>
          <h1>Earnings</h1>
          <p class="mr-eyebrow">Payout ledger synced 2 min ago</p>
        </div>

        <div class="mr-dash-header__actions">
          <div class="mr-dash-stats">
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--active">Rs. 2,150</strong>
              <span>Today</span>
            </div>
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--pending">Rs. 11,600</strong>
              <span>Week</span>
            </div>
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--delivered">Rs. 43,900</strong>
              <span>Month</span>
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

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Completed deliveries</h2>
              <span class="mr-badge mr-badge--pill mr-badge--case-normal">
                <img src="https://img.icons8.com/ios-filled/50/454655/filter.png" alt="">
                Filter
              </span>
            </div>

            <div class="mr-pay-table-wrap">
              <table class="mr-pay-table">
                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Pharmacy</th>
                    <th class="mr-pay-table__amount">Fee</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="mr-eyebrow mr-eyebrow--mono">#MR-8832</td>
                    <td>Today, 14:30</td>
                    <td>CarePlus Pharma</td>
                    <td class="mr-pay-table__amount">Rs. 450.00</td>
                    <td><span class="mr-badge mr-badge--success mr-badge--case-normal">Delivered</span></td>
                  </tr>
                  <tr>
                    <td class="mr-eyebrow mr-eyebrow--mono">#MR-8831</td>
                    <td>Today, 11:15</td>
                    <td>MediTrust LK</td>
                    <td class="mr-pay-table__amount">Rs. 600.00</td>
                    <td><span class="mr-badge mr-badge--success mr-badge--case-normal">Delivered</span></td>
                  </tr>
                  <tr>
                    <td class="mr-eyebrow mr-eyebrow--mono">#MR-8829</td>
                    <td>Today, 09:40</td>
                    <td>City Health Pharmacy</td>
                    <td class="mr-pay-table__amount">Rs. 350.00</td>
                    <td><span class="mr-badge mr-badge--success mr-badge--case-normal">Delivered</span></td>
                  </tr>
                  <tr>
                    <td class="mr-eyebrow mr-eyebrow--mono">#MR-8790</td>
                    <td>Yesterday</td>
                    <td>CarePlus Pharma</td>
                    <td class="mr-pay-table__amount">Rs. 750.00</td>
                    <td><span class="mr-badge mr-badge--success mr-badge--case-normal">Delivered</span></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="mr-pagination">
              <span class="mr-pagination__count">Showing 1 to 4 of 28 entries</span>
              <nav class="mr-pagination__nav" aria-label="Ledger pages">
                <a href="#" class="mr-pagination__btn" aria-disabled="true">
                  <img src="https://img.icons8.com/ios-filled/50/454655/back.png" alt="Previous">
                </a>
                <a href="#" class="mr-pagination__btn is-active">1</a>
                <a href="#" class="mr-pagination__btn">2</a>
                <a href="#" class="mr-pagination__btn">3</a>
                <a href="#" class="mr-pagination__btn">
                  <img src="https://img.icons8.com/ios-filled/50/1a1b24/forward.png" alt="Next">
                </a>
              </nav>
            </div>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Revenue trend</h2>
              <span class="mr-eyebrow mr-eyebrow--mono">Rs. 43,900 this month</span>
            </div>
            <canvas id="mr-earnings-trend-chart" height="220" role="img" aria-label="Weekly revenue trend"></canvas>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Weekly target</h2>
            </div>

            <div class="mr-spend-ring">
              <canvas id="mr-earnings-target-chart" width="128" height="128" role="img" aria-label="Weekly target: 74% reached"></canvas>
              <div class="mr-spend-ring__inner">
                <span>Reached</span>
                <strong>74%</strong>
              </div>
            </div>

            <div class="mr-spend-row">
              <span class="mr-spend-row__label">
                <i class="mr-spend-dot mr-spend-dot--primary"></i>
                Earned
              </span>
              <strong>Rs. 11,600</strong>
            </div>
            <div class="mr-spend-row">
              <span class="mr-spend-row__label">
                <i class="mr-spend-dot mr-spend-dot--light"></i>
                Remaining to target
              </span>
              <strong>Rs. 3,400</strong>
            </div>

            <a href="#" class="mr-btn mr-btn--dark mr-btn--sm">Cash out summary</a>
          </section>

          <section class="mr-card mr-med-stats">
            <h2>Top pharmacies serviced</h2>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>CarePlus Pharma</span>
                <strong>Rs. 4,850</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 85%;"></div></div>
            </div>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>MediTrust LK</span>
                <strong>Rs. 3,220</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 62%; opacity: .8;"></div></div>
            </div>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>City Health Pharmacy</span>
                <strong>Rs. 2,150</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 42%; opacity: .6;"></div></div>
            </div>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Delivery metrics</h2>
            </div>

            <div class="mr-pharmacy-row">
              <span>Best day</span>
              <strong>Thu (Rs. 4,200)</strong>
            </div>
            <div class="mr-pharmacy-row">
              <span>Average per delivery</span>
              <strong>Rs. 464</strong>
            </div>
            <div class="mr-pharmacy-row">
              <span>Active time</span>
              <strong>24h 15m</strong>
            </div>
          </section>

        </div>
      </div>
    </main>
  </div>

  <script src="presentation/assets/js/vendor/chart.umd.min.js"></script>
  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
