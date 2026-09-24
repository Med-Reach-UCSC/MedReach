<?php
// MedReach - Admin dashboard (presentation tier: HTML output only)
$active = 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body>

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-admin.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <div>
          <h1>Good afternoon, Admin</h1>
          <p class="mr-eyebrow">System nominal &middot; synced 2 min ago</p>
        </div>

        <div class="mr-dash-header__actions">
          <div class="mr-dash-stats">
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--active">8,249</strong>
              <span>Active prescriptions</span>
            </div>
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--delivered">98%</strong>
              <span>Fulfillment</span>
            </div>
          </div>

          <a class="mr-notif-btn mr-notif-btn--header" href="notifications.php" aria-label="Notifications">
            <img src="https://img.icons8.com/ios-filled/50/1a1b24/appointment-reminders.png" alt="">
            <span class="mr-notif-btn__dot" aria-hidden="true"></span>
          </a>
        </div>
      </header>

      <div class="mr-stat-grid-3">
        <section class="mr-card mr-mini-stat mr-mini-stat--accent">
          <div>
            <span class="mr-eyebrow mr-eyebrow--mono">Pending Approvals</span>
            <strong>14</strong>
          </div>
          <span class="mr-icon-badge mr-icon-badge--accent mr-icon-badge--lg">
            <img src="https://img.icons8.com/ios-filled/50/dd8e1c/checklist.png" alt="">
          </span>
        </section>

        <section class="mr-card mr-mini-stat">
          <div>
            <span class="mr-eyebrow mr-eyebrow--mono">Active Prescriptions</span>
            <strong>8,249</strong>
          </div>
          <span class="mr-icon-badge mr-icon-badge--info mr-icon-badge--lg">
            <img src="https://img.icons8.com/ios-filled/50/2d3fd7/pill.png" alt="">
          </span>
        </section>

        <section class="mr-card mr-mini-stat">
          <div>
            <span class="mr-eyebrow mr-eyebrow--mono">Active Pharmacies</span>
            <strong>342</strong>
          </div>
          <span class="mr-icon-badge mr-icon-badge--success mr-icon-badge--lg">
            <img src="https://img.icons8.com/ios-filled/50/1f9d6b/pharmacy-shop.png" alt="">
          </span>
        </section>
      </div>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-med-stats">
            <h2>Top Performers</h2>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span style="display: flex; align-items: center; gap: 0.5rem;">
                  <span class="mr-avatar mr-avatar--dash">AH</span>
                  Apex Health Plaza
                </span>
                <strong>99.8% SLA</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 99.8%;"></div></div>
            </div>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span style="display: flex; align-items: center; gap: 0.5rem;">
                  <span class="mr-avatar mr-avatar--dash">CC</span>
                  Central City Meds
                </span>
                <strong>96.5% SLA</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 96.5%; opacity: .8;"></div></div>
            </div>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span style="display: flex; align-items: center; gap: 0.5rem;">
                  <span class="mr-avatar mr-avatar--dash">OV</span>
                  Oak Valley Scripts
                </span>
                <strong>94.2% SLA</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 94.2%; opacity: .6;"></div></div>
            </div>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Network Growth</h2>
              <span class="mr-eyebrow mr-eyebrow--mono">Pharmacies onboarded per quarter</span>
            </div>
            <canvas id="mr-network-chart" height="160" role="img" aria-label="Partner pharmacies onboarded by quarter: 60 in Q1, 140 in Q2, 190 in Q3, 240 in Q4"></canvas>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-med-stats">
            <h2>Outcome Status</h2>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>Delivered</span>
                <strong>68%</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 68%; background-color: var(--mr-color-success);"></div></div>
            </div>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>In Transit</span>
                <strong>22%</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 22%;"></div></div>
            </div>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>Exceptions</span>
                <strong>8%</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 8%; background-color: var(--mr-color-accent);"></div></div>
            </div>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>Failed</span>
                <strong>2%</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 2%; background-color: var(--mr-color-danger);"></div></div>
            </div>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>System Activity</h2>
            </div>
            <ol class="mr-timeline">
              <li class="mr-timeline__step mr-timeline__step--active">
                <strong>Batch processing completed</strong>
                <small>Auto-sys</small>
                <span class="mr-timeline__time">Just now</span>
              </li>
              <li class="mr-timeline__step">
                <strong>API rate limit warning</strong>
                <small>Gateway</small>
                <span class="mr-timeline__time">12 min ago</span>
              </li>
              <li class="mr-timeline__step">
                <strong>New pharmacy onboarded</strong>
                <small>Admin: Sarah</small>
                <span class="mr-timeline__time">1 hr ago</span>
              </li>
              <li class="mr-timeline__step">
                <strong>Weekly report generated</strong>
                <small>System</small>
                <span class="mr-timeline__time">3 hrs ago</span>
              </li>
            </ol>
          </section>

        </div>
      </div>
    </main>
  </div>

  <script src="presentation/assets/js/vendor/chart.umd.min.js"></script>
  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
