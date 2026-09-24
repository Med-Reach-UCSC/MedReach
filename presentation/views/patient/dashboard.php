<?php
// MedReach - Patient dashboard (presentation tier: HTML output only)
$active = 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body>

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-patient.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <h1>Good morning, Nimal</h1>

        <div class="mr-dash-header__actions">
          <div class="mr-dash-stats">
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--active">2</strong>
              <span>Active</span>
            </div>
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--pending">1</strong>
              <span>Pending</span>
            </div>
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--delivered">12</strong>
              <span>Delivered</span>
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
              <h2>Active orders</h2>
              <a href="order-history.php">View all</a>
            </div>

            <article class="mr-order">
              <div class="mr-order__head">
                <div class="mr-order__id">
                  <span class="mr-icon-badge mr-icon-badge--info">
                    <img src="https://img.icons8.com/ios-filled/50/2d3fd7/pill.png" alt="">
                  </span>
                  <div>
                    <span class="mr-eyebrow mr-eyebrow--mono">#ORD-8924</span>
                    <strong>CityHealth Pharmacy</strong>
                  </div>
                </div>
                <div class="mr-order__tags">
                  <span class="mr-badge mr-badge--pill">3 items</span>
                  <span class="mr-badge mr-badge--info">1.2 mi</span>
                  <a class="mr-badge mr-badge--pill mr-badge--case-normal" href="track-order-status.php">Track order</a>
                </div>
              </div>

              <ol class="mr-order-progress">
                <li class="is-done"><span></span>Received</li>
                <li class="is-current"><span></span>Preparing</li>
                <li><span></span>Out for delivery</li>
              </ol>
            </article>

            <a class="mr-order-row" href="#">
              <span class="mr-icon-badge mr-icon-badge--accent">
                <img src="https://img.icons8.com/ios-filled/50/dd8e1c/clipboard.png" alt="">
              </span>
              <span class="mr-order-row__info">
                <span class="mr-eyebrow mr-eyebrow--mono">#ORD-8925</span>
                <span>MediCare Plus</span>
              </span>
              <span class="mr-badge mr-badge--accent">Awaiting Pharmacy</span>
            </a>

            <a class="mr-order-row" href="#">
              <span class="mr-icon-badge mr-icon-badge--info">
                <img src="https://img.icons8.com/ios-filled/50/2d3fd7/broadcasting.png" alt="">
              </span>
              <span class="mr-order-row__info">
                <span class="mr-eyebrow mr-eyebrow--mono">#ORD-8926</span>
                <span>GreenCross Rx</span>
              </span>
              <span class="mr-badge mr-badge--pill">Broadcasting</span>
            </a>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Upcoming refills</h2>
            </div>
            <div class="mr-refill">
              <strong>Lisinopril 10mg</strong>
              <span class="mr-refill__line"></span>
              <span class="mr-eyebrow mr-eyebrow--mono">Oct 12</span>
            </div>
            <div class="mr-refill">
              <strong>Atorvastatin 20mg</strong>
              <span class="mr-refill__line"></span>
              <span class="mr-eyebrow mr-eyebrow--mono">Oct 15</span>
            </div>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Recent activity</h2>
            </div>
            <ul class="mr-activity">
              <li>
                <span class="mr-icon-badge mr-icon-badge--success">
                  <img src="https://img.icons8.com/ios-filled/50/1f9d6b/checkmark.png" alt="">
                </span>
                <span class="mr-activity__info">
                  <span>Order #ORD-8890 delivered</span>
                  <span class="mr-eyebrow mr-eyebrow--mono">10/05/2023 - 14:30</span>
                </span>
              </li>
              <li>
                <span class="mr-icon-badge mr-icon-badge--info">
                  <img src="https://img.icons8.com/ios-filled/50/0a7fb5/upload.png" alt="">
                </span>
                <span class="mr-activity__info">
                  <span>New Rx uploaded by Dr. Smith</span>
                  <span class="mr-eyebrow mr-eyebrow--mono">10/04/2023 - 09:15</span>
                </span>
              </li>
            </ul>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-upload-card">
            <span class="mr-icon-badge mr-icon-badge--info mr-icon-badge--lg">
              <img src="https://img.icons8.com/ios-filled/50/2d3fd7/clipboard.png" alt="">
            </span>
            <h2>New Prescription?</h2>
            <p>Snap a photo or upload a file to get started.</p>
            <a class="mr-btn mr-btn--dark mr-upload-card__btn" href="patient-order.php">Upload Rx</a>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Nearest pharmacies</h2>
            </div>
            <div class="mr-pharmacy-row">
              <div>
                <strong>CityHealth Rx</strong>
                <span class="mr-eyebrow mr-eyebrow--mono">1.2 mi away</span>
              </div>
              <span class="mr-badge mr-badge--success">Open</span>
            </div>
            <div class="mr-pharmacy-row">
              <div>
                <strong>MediCare Plus</strong>
                <span class="mr-eyebrow mr-eyebrow--mono">2.5 mi away</span>
              </div>
              <span class="mr-badge mr-badge--success">Open</span>
            </div>
            <div class="mr-pharmacy-row">
              <div>
                <strong class="mr-pharmacy-row__muted">GreenCross</strong>
                <span class="mr-eyebrow mr-eyebrow--mono">3.1 mi away</span>
              </div>
              <span class="mr-badge mr-badge--pill">Closed</span>
            </div>
          </section>

          <section class="mr-card mr-help-card">
            <span class="mr-icon-badge mr-icon-badge--info">
              <img src="https://img.icons8.com/ios-filled/50/2d3fd7/help.png" alt="">
            </span>
            <div>
              <strong>Need help?</strong>
              <p>Reach out if an order looks off or a delivery is delayed.</p>
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
