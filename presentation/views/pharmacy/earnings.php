<?php
// MedReach - Pharmacist earnings & payouts (presentation tier: HTML output only)
// Converted from docs/pharmacy-earnings.php (Tailwind mockup) onto the mr-
// component system — reuses mr-dash-stats (header capsules), mr-pay-table +
// mr-pagination (payments.php), mr-spend-ring (payments.php doughnut), and
// mr-med-stats bars (order-history.php "most ordered" widget). No new CSS.
//
// Defects fixed vs the mockup: dropped the Tailwind CDN/Google Fonts/inline
// theme config (external library, not project CSS per CLAUDE.md) for the
// project's own --mr- token system; dropped the standalone glass side-nav
// and hotlinked avatar for the shared sidebar-pharmacy.php partial (added an
// "Earnings" entry) so every pharmacist page uses one nav component; dropped
// the Inventory nav item, same reasoning as dashboard.php/orders.php (no
// MEDICINE/INVENTORY table); reworked "Top Yield Meds" from stock-margin %
// framing to revenue-by-medicine (aggregated from free-text ORDER_ITEM
// names, not a catalog); replaced the fabricated TXN-XXXX id format with the
// #MR-XXXX order id convention payments.php already uses; replaced the
// hand-coded inline-SVG line chart with the project's existing Chart.js
// bar-chart pattern (matches the dashboard's earnings chart).
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
    <?php require __DIR__ . '/../partials/sidebar-pharmacy.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <div>
          <h1>Earnings</h1>
          <p class="mr-eyebrow">Payout ledger synced 2 min ago</p>
        </div>

        <div class="mr-dash-header__actions">
          <div class="mr-dash-stats">
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--active">Rs. 12,450.80</strong>
              <span>This period</span>
            </div>
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--pending">Rs. 2,150.00</strong>
              <span>Pending payout</span>
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
              <h2>Payout ledger</h2>
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
                    <th>Status</th>
                    <th class="mr-pay-table__amount">Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="mr-eyebrow mr-eyebrow--mono">#MR-8942</td>
                    <td>Today, 14:32</td>
                    <td><span class="mr-badge mr-badge--success mr-badge--case-normal">Paid</span></td>
                    <td class="mr-pay-table__amount">Rs. 4,250.00</td>
                  </tr>
                  <tr>
                    <td class="mr-eyebrow mr-eyebrow--mono">#MR-8941</td>
                    <td>Yesterday, 09:15</td>
                    <td><span class="mr-badge mr-badge--success mr-badge--case-normal">Paid</span></td>
                    <td class="mr-pay-table__amount">Rs. 1,120.50</td>
                  </tr>
                  <tr>
                    <td class="mr-eyebrow mr-eyebrow--mono">#MR-8939</td>
                    <td>Oct 12, 16:45</td>
                    <td><span class="mr-badge mr-badge--success mr-badge--case-normal">Paid</span></td>
                    <td class="mr-pay-table__amount">Rs. 8,400.25</td>
                  </tr>
                  <tr>
                    <td class="mr-eyebrow mr-eyebrow--mono">#MR-8935</td>
                    <td>Oct 8, 11:20</td>
                    <td><span class="mr-badge mr-badge--accent mr-badge--case-normal">Pending</span></td>
                    <td class="mr-pay-table__amount">Rs. 2,150.00</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="mr-pagination">
              <span class="mr-pagination__count">Showing 1 to 4 of 46 entries</span>
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
              <h2>Revenue (30 days)</h2>
              <span class="mr-eyebrow mr-eyebrow--mono">Rs. 45,880 total</span>
            </div>
            <canvas id="mr-earnings-trend-chart" height="220" role="img" aria-label="Weekly revenue over the last 30 days"></canvas>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Monthly target</h2>
            </div>

            <div class="mr-spend-ring">
              <canvas id="mr-earnings-target-chart" width="128" height="128" role="img" aria-label="Monthly target: 83% reached"></canvas>
              <div class="mr-spend-ring__inner">
                <span>Reached</span>
                <strong>83%</strong>
              </div>
            </div>

            <div class="mr-spend-row">
              <span class="mr-spend-row__label">
                <i class="mr-spend-dot mr-spend-dot--primary"></i>
                Earned
              </span>
              <strong>Rs. 12,450</strong>
            </div>
            <div class="mr-spend-row">
              <span class="mr-spend-row__label">
                <i class="mr-spend-dot mr-spend-dot--light"></i>
                Remaining to target
              </span>
              <strong>Rs. 2,550</strong>
            </div>
          </section>

          <section class="mr-card mr-med-stats">
            <h2>Top earning medicines</h2>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>Amoxicillin 500mg</span>
                <strong>Rs. 8,400</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 85%;"></div></div>
            </div>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>Lisinopril 10mg</span>
                <strong>Rs. 6,120</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 62%; opacity: .8;"></div></div>
            </div>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>Atorvastatin 20mg</span>
                <strong>Rs. 4,850</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 48%; opacity: .6;"></div></div>
            </div>
          </section>

          <section class="mr-card mr-policy-card">
            <div class="mr-policy-card__head">
              <span class="mr-icon-badge mr-icon-badge--info">
                <img src="https://img.icons8.com/ios-filled/50/0a7fb5/security-checked.png" alt="">
              </span>
              <h2>Payout Policy</h2>
            </div>
            <p>Cash-on-delivery (COD) collections must be reconciled within 24 hours of successful delivery.</p>

            <ul class="mr-policy-card__list">
              <li>
                <img src="https://img.icons8.com/ios-filled/50/0a7fb5/checkmark.png" alt="">
                Drivers collect cash at patient drop-off.
              </li>
              <li>
                <img src="https://img.icons8.com/ios-filled/50/0a7fb5/checkmark.png" alt="">
                Pharmacy payments settle bi-weekly via bank transfer.
              </li>
            </ul>

            <a href="#" class="mr-btn mr-btn--dark mr-btn--sm">View Full Policy</a>
          </section>

        </div>
      </div>
    </main>
  </div>

  <script src="presentation/assets/js/vendor/chart.umd.min.js"></script>
  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
