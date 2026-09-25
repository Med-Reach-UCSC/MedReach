<?php
// MedReach - Patient payments history (presentation tier: HTML output only)
$active = 'payments';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Payments — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body class="mr-page-payments">

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-patient.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <h1>Payments</h1>

        <div class="mr-dash-header__actions">
          <div class="mr-dash-stats">
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value">LKR 4,850</strong>
              <span>This month</span>
            </div>
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--pending">LKR 1,200</strong>
              <span>Pending</span>
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
              <h2>Recent Transactions</h2>
              <label class="mr-roster-filter">
                <img src="https://img.icons8.com/ios-filled/50/454655/filter.png" alt="">
                <select data-row-filter="mr-payments-table" aria-label="Filter by payment method">
                  <option value="">All methods</option>
                  <option value="cod">COD</option>
                  <option value="card">Card</option>
                </select>
              </label>
            </div>

            <div class="mr-pay-table-wrap">
              <table class="mr-pay-table" id="mr-payments-table">
                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Pharmacy</th>
                    <th>Date</th>
                    <th class="mr-pay-table__amount">Amount</th>
                    <th>Method</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr data-filter-value="cod">
                    <td class="mr-eyebrow mr-eyebrow--mono">#ORD-8402</td>
                    <td>City Health Pharmacy</td>
                    <td>Today, 10:42 AM</td>
                    <td class="mr-pay-table__amount">LKR 450</td>
                    <td>
                      <span class="mr-badge mr-badge--pill mr-badge--case-normal">
                        <img src="https://img.icons8.com/ios-filled/50/62646d/cash.png" alt="">
                        COD
                      </span>
                    </td>
                    <td>
                      <span class="mr-badge mr-badge--accent mr-badge--case-normal">Pending</span>
                    </td>
                  </tr>
                  <tr data-filter-value="card">
                    <td class="mr-eyebrow mr-eyebrow--mono">#ORD-8399</td>
                    <td>MediCare Plus Colombo</td>
                    <td>Yesterday, 14:15</td>
                    <td class="mr-pay-table__amount">LKR 1,200</td>
                    <td>
                      <span class="mr-badge mr-badge--pill mr-badge--case-normal">
                        <img src="https://img.icons8.com/ios-filled/50/62646d/bank-card-back-side.png" alt="">
                        Card
                      </span>
                    </td>
                    <td>
                      <span class="mr-badge mr-badge--success mr-badge--case-normal">Paid</span>
                    </td>
                  </tr>
                  <tr data-filter-value="card">
                    <td class="mr-eyebrow mr-eyebrow--mono">#ORD-8395</td>
                    <td>Union Chemists</td>
                    <td>Oct 24, 09:30 AM</td>
                    <td class="mr-pay-table__amount">LKR 850</td>
                    <td>
                      <span class="mr-badge mr-badge--pill mr-badge--case-normal">
                        <img src="https://img.icons8.com/ios-filled/50/62646d/bank-card-back-side.png" alt="">
                        Card
                      </span>
                    </td>
                    <td>
                      <span class="mr-badge mr-badge--success mr-badge--case-normal">Paid</span>
                    </td>
                  </tr>
                  <tr data-filter-value="cod">
                    <td class="mr-eyebrow mr-eyebrow--mono">#ORD-8380</td>
                    <td>HealthGuard Kandy</td>
                    <td>Oct 22, 16:20</td>
                    <td class="mr-pay-table__amount">LKR 2,350</td>
                    <td>
                      <span class="mr-badge mr-badge--pill mr-badge--case-normal">
                        <img src="https://img.icons8.com/ios-filled/50/62646d/cash.png" alt="">
                        COD
                      </span>
                    </td>
                    <td>
                      <span class="mr-badge mr-badge--success mr-badge--case-normal">Paid</span>
                    </td>
                  </tr>
                  <tr data-filter-value="cod">
                    <td class="mr-eyebrow mr-eyebrow--mono">#ORD-8375</td>
                    <td>Nawaloka Pharmacy</td>
                    <td>Oct 21, 11:10 AM</td>
                    <td class="mr-pay-table__amount">LKR 750</td>
                    <td>
                      <span class="mr-badge mr-badge--pill mr-badge--case-normal">
                        <img src="https://img.icons8.com/ios-filled/50/62646d/cash.png" alt="">
                        COD
                      </span>
                    </td>
                    <td>
                      <span class="mr-badge mr-badge--success mr-badge--case-normal">Paid</span>
                    </td>
                  </tr>
                  <tr data-filter-value="card">
                    <td class="mr-eyebrow mr-eyebrow--mono">#ORD-8360</td>
                    <td>Asiri Dispensary</td>
                    <td>Oct 20, 08:45 AM</td>
                    <td class="mr-pay-table__amount">LKR 1,500</td>
                    <td>
                      <span class="mr-badge mr-badge--pill mr-badge--case-normal">
                        <img src="https://img.icons8.com/ios-filled/50/62646d/bank-card-back-side.png" alt="">
                        Card
                      </span>
                    </td>
                    <td>
                      <span class="mr-badge mr-badge--success mr-badge--case-normal">Paid</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="mr-pagination">
              <span class="mr-pagination__count">Showing 1 to 6 of 6 entries</span>
              <nav class="mr-pagination__nav" aria-label="Transaction pages">
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

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Monthly Spend</h2>
            </div>

            <div class="mr-spend-ring">
              <canvas id="mr-spend-chart" width="128" height="128" role="img" aria-label="Monthly spend: 75% completed, 25% pending"></canvas>
              <div class="mr-spend-ring__inner">
                <span>Total</span>
                <strong>75%</strong>
              </div>
            </div>

            <div class="mr-spend-row">
              <span class="mr-spend-row__label">
                <i class="mr-spend-dot mr-spend-dot--primary"></i>
                Completed
              </span>
              <strong>LKR 3,650</strong>
            </div>
            <div class="mr-spend-row">
              <span class="mr-spend-row__label">
                <i class="mr-spend-dot mr-spend-dot--light"></i>
                Pending
              </span>
              <strong>LKR 1,200</strong>
            </div>
          </section>

          <section class="mr-card mr-policy-card">
            <div class="mr-policy-card__head">
              <span class="mr-icon-badge mr-icon-badge--info">
                <img src="https://img.icons8.com/ios-filled/50/0a7fb5/security-checked.png" alt="">
              </span>
              <h2>Payment Policy</h2>
            </div>
            <p>Pay by card when you confirm your order, or in cash to the rider when it arrives.</p>

            <ul class="mr-policy-card__list">
              <li>
                <img src="https://img.icons8.com/ios-filled/50/0a7fb5/checkmark.png" alt="">
                For cash on delivery, keep the exact amount ready if you can.
              </li>
              <li>
                <img src="https://img.icons8.com/ios-filled/50/0a7fb5/checkmark.png" alt="">
                Ask the rider for a receipt with your order ID.
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
