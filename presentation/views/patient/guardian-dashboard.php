<?php
// MedReach - Guardian control tower dashboard (presentation tier: HTML output only)
// Guardian is a Patient with is_guardian = true, not a separate role — reuses the
// same sidebar/dashboard shell as presentation/views/patient/dashboard.php.
$active = 'family';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Family Dashboard — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body>

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-patient.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <div>
          <h1>Good morning, Sanduni</h1>
          <p class="mr-eyebrow">Family health control tower active</p>
        </div>

        <div class="mr-dash-header__actions">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm">
            <img src="https://img.icons8.com/ios-filled/50/454655/filter.png" alt="">
            Filter view
          </button>
          <button type="button" class="mr-btn mr-btn--dark mr-btn--sm">New request</button>

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
              <h2>Active logistics</h2>
              <span class="mr-badge mr-badge--info">4 in transit</span>
            </div>

            <div class="mr-pay-table-wrap">
              <table class="mr-pay-table">
                <thead>
                  <tr>
                    <th>Patient</th>
                    <th>Tracking ID</th>
                    <th>Prescription</th>
                    <th class="mr-pay-table__amount">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span class="mr-avatar">AP</span>
                        <strong>Arthur Pendelton</strong>
                      </div>
                    </td>
                    <td class="mr-eyebrow mr-eyebrow--mono">TRK-892A</td>
                    <td>
                      Lisinopril 10mg<br>
                      <span class="mr-eyebrow">90-day supply</span>
                    </td>
                    <td class="mr-pay-table__amount">
                      <span class="mr-badge mr-badge--accent mr-badge--case-normal">Out for delivery</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span class="mr-avatar">MS</span>
                        <strong>Maya Silva</strong>
                      </div>
                    </td>
                    <td class="mr-eyebrow mr-eyebrow--mono">TRK-441B</td>
                    <td>
                      Albuterol Inhaler<br>
                      <span class="mr-eyebrow">Refill 2 of 3</span>
                    </td>
                    <td class="mr-pay-table__amount">
                      <span class="mr-badge mr-badge--success mr-badge--case-normal">Arriving today</span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span class="mr-avatar">AP</span>
                        <strong>Arthur Pendelton</strong>
                      </div>
                    </td>
                    <td class="mr-eyebrow mr-eyebrow--mono">PKG-112C</td>
                    <td>
                      Atorvastatin 20mg<br>
                      <span class="mr-eyebrow">Standard shipping</span>
                    </td>
                    <td class="mr-pay-table__amount">
                      <span class="mr-badge mr-badge--pill mr-badge--case-normal">Processing</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <p style="text-align: center; margin-top: 1rem;">
              <a class="mr-link mr-link--strong" href="order-history.php">View full history</a>
            </p>
          </section>

          <div class="mr-guardian-grid-2">
            <section class="mr-card mr-help-card mr-help-card--alert">
              <span class="mr-icon-badge mr-icon-badge--danger">
                <img src="https://img.icons8.com/ios-filled/50/d6534a/error.png" alt="">
              </span>
              <div>
                <strong>Action required</strong>
                <p>Maya's seasonal allergy medication needs a new prescription from Dr. Chen.</p>
                <a class="mr-btn mr-btn--ghost mr-btn--sm" href="#" style="margin-top: 0.75rem;">Contact doctor</a>
              </div>
            </section>

            <section class="mr-card mr-dash-card">
              <span class="mr-eyebrow mr-eyebrow--mono">Adherence score</span>
              <div style="display: flex; align-items: flex-end; gap: 0.75rem; margin-top: 0.5rem;">
                <strong class="mr-dash-stat__value mr-dash-stat__value--active" style="font-size: 1.75rem;">98%</strong>
                <span class="mr-badge mr-badge--success mr-badge--case-normal">
                  <img src="https://img.icons8.com/ios-filled/50/1f9d6b/positive-dynamic.png" alt="">
                  +2%
                </span>
              </div>
              <div class="mr-med-stats__bar" style="margin-top: 1rem;">
                <div class="mr-med-stats__fill" style="width: 98%; background-color: var(--mr-color-primary);"></div>
              </div>
            </section>
          </div>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-med-stats">
            <div class="mr-dash-card__head">
              <h2>Patient roster</h2>
              <a href="manage-patients.php">+ Add</a>
            </div>

            <div class="mr-pharmacy-row" style="align-items: center;">
              <div style="flex-direction: row; align-items: center; gap: 0.5rem;">
                <span class="mr-avatar">AP</span>
                <span>
                  <strong>Arthur P.</strong>
                  <span class="mr-eyebrow mr-eyebrow--mono" style="display: block;">Stable</span>
                </span>
              </div>
            </div>
            <div class="mr-pharmacy-row" style="align-items: center;">
              <div style="flex-direction: row; align-items: center; gap: 0.5rem;">
                <span class="mr-avatar">MS</span>
                <span>
                  <strong>Maya S.</strong>
                  <span class="mr-eyebrow mr-eyebrow--mono" style="display: block;">Monitoring</span>
                </span>
              </div>
            </div>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>System telemetry</h2>
            </div>

            <div class="mr-pharmacy-row">
              <div>
                <strong>Smart dispenser sync</strong>
                <span class="mr-eyebrow mr-eyebrow--mono">Last: 2 mins ago</span>
              </div>
              <span class="mr-icon-badge mr-icon-badge--success">
                <img src="https://img.icons8.com/ios-filled/50/1f9d6b/checkmark.png" alt="">
              </span>
            </div>
            <div class="mr-pharmacy-row">
              <div>
                <strong>Pharmacy API status</strong>
                <span class="mr-eyebrow mr-eyebrow--mono">Latency: 42ms</span>
              </div>
              <span class="mr-icon-badge mr-icon-badge--success">
                <img src="https://img.icons8.com/ios-filled/50/1f9d6b/cloud.png" alt="">
              </span>
            </div>
            <div class="mr-pharmacy-row">
              <div>
                <strong>Courier network</strong>
                <span class="mr-eyebrow mr-eyebrow--mono">Route optimized</span>
              </div>
              <span class="mr-icon-badge mr-icon-badge--info">
                <img src="https://img.icons8.com/ios-filled/50/2d3fd7/route.png" alt="">
              </span>
            </div>
          </section>

        </div>
      </div>
    </main>
  </div>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
