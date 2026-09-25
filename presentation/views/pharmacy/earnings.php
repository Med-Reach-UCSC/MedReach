<?php
// MedReach - Pharmacist earnings & settlements (presentation tier: HTML output only)
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
          <p class="mr-eyebrow">Cash on delivery settlements this month</p>
        </div>

        <div class="mr-dash-header__actions">
          <div class="mr-dash-stats">
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--active">LKR 12,450.80</strong>
              <span>This period</span>
            </div>
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--pending">LKR 2,150.00</strong>
              <span>Pending settlement</span>
            </div>
          </div>
        </div>
      </header>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Settlement ledger</h2>
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
                    <td class="mr-eyebrow mr-eyebrow--mono">#ORD-8942</td>
                    <td>Today, 14:32</td>
                    <td><span class="mr-badge mr-badge--success mr-badge--case-normal">Paid</span></td>
                    <td class="mr-pay-table__amount">LKR 4,250.00</td>
                  </tr>
                  <tr>
                    <td class="mr-eyebrow mr-eyebrow--mono">#ORD-8941</td>
                    <td>Yesterday, 09:15</td>
                    <td><span class="mr-badge mr-badge--success mr-badge--case-normal">Paid</span></td>
                    <td class="mr-pay-table__amount">LKR 1,120.50</td>
                  </tr>
                  <tr>
                    <td class="mr-eyebrow mr-eyebrow--mono">#ORD-8939</td>
                    <td>Oct 12, 16:45</td>
                    <td><span class="mr-badge mr-badge--success mr-badge--case-normal">Paid</span></td>
                    <td class="mr-pay-table__amount">LKR 8,400.25</td>
                  </tr>
                  <tr>
                    <td class="mr-eyebrow mr-eyebrow--mono">#ORD-8935</td>
                    <td>Oct 8, 11:20</td>
                    <td><span class="mr-badge mr-badge--accent mr-badge--case-normal">Pending</span></td>
                    <td class="mr-pay-table__amount">LKR 2,150.00</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="mr-pagination">
              <span class="mr-pagination__count">Showing 1 to 4 of 4 entries</span>
              <nav class="mr-pagination__nav" aria-label="Ledger pages">
                <button type="button" class="mr-pagination__btn" aria-disabled="true">
                  <img src="https://img.icons8.com/ios-filled/50/454655/back.png" alt="Previous">
                </button>
                <span class="mr-pagination__btn is-active" aria-current="page">1</span>
                <button type="button" class="mr-pagination__btn" aria-disabled="true">
                  <img src="https://img.icons8.com/ios-filled/50/454655/forward.png" alt="Next">
                </button>
              </nav>
            </div>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Revenue (30 days)</h2>
              <span class="mr-eyebrow mr-eyebrow--mono">LKR 45,880 total</span>
            </div>
            <canvas id="mr-earnings-trend-chart" data-values="9600,11200,12450,12630" height="220" role="img" aria-label="Weekly revenue over the last 30 days"></canvas>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Monthly target</h2>
            </div>

            <div class="mr-spend-ring">
              <canvas id="mr-earnings-target-chart" data-percent="83" width="128" height="128" role="img" aria-label="Monthly target: 83% reached"></canvas>
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
              <strong>LKR 12,450</strong>
            </div>
            <div class="mr-spend-row">
              <span class="mr-spend-row__label">
                <i class="mr-spend-dot mr-spend-dot--light"></i>
                Remaining to target
              </span>
              <strong>LKR 2,550</strong>
            </div>
          </section>

          <section class="mr-card mr-med-stats">
            <h2>Top earning medicines</h2>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>Amoxicillin 500mg</span>
                <strong>LKR 8,400</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 85%;"></div></div>
            </div>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>Lisinopril 10mg</span>
                <strong>LKR 6,120</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 62%; opacity: .8;"></div></div>
            </div>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>Atorvastatin 20mg</span>
                <strong>LKR 4,850</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 48%; opacity: .6;"></div></div>
            </div>
          </section>

          <section class="mr-card mr-policy-card">
            <div class="mr-policy-card__head">
              <span class="mr-icon-badge mr-icon-badge--info">
                <img src="https://img.icons8.com/ios-filled/50/0a7fb5/security-checked.png" alt="">
              </span>
              <h2>Settlement Policy</h2>
            </div>
            <p>Cash-on-delivery (COD) collections must be reconciled within 24 hours of successful delivery.</p>

            <ul class="mr-policy-card__list">
              <li>
                <img src="https://img.icons8.com/ios-filled/50/0a7fb5/checkmark.png" alt="">
                Drivers collect cash at patient drop-off.
              </li>
              <li>
                <img src="https://img.icons8.com/ios-filled/50/0a7fb5/checkmark.png" alt="">
                Riders hand collected cash over to the pharmacy against each order ID.
              </li>
            </ul>

            <a href="policies.php#terms" class="mr-btn mr-btn--dark mr-btn--sm">View Full Policy</a>
          </section>

        </div>
      </div>
    </main>
  </div>

  <script src="presentation/assets/js/vendor/chart.umd.min.js"></script>
  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
