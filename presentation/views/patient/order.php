<?php
// MedReach - Patient new-order / upload prescription page (presentation tier: HTML output only)
$active = 'orders';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>New Order — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body class="mr-page-order">

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-patient.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <h1>Upload Prescription</h1>

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
              <h2>New Order</h2>
              <span class="mr-badge mr-badge--primary mr-badge--case-normal">
                <span class="mr-badge__dot" aria-hidden="true"></span>
                System Ready
              </span>
            </div>
            <p class="mr-dash-card__lede">Drag and drop prescription files or capture via camera.</p>

            <div class="mr-dropzone">
              <span class="mr-icon-badge mr-icon-badge--white mr-icon-badge--lg">
                <img src="https://img.icons8.com/ios-filled/50/2d3fd7/upload-to-cloud.png" alt="">
              </span>
              <h3>Drag &amp; Drop files here</h3>
              <p>Supported formats: PDF, JPG, PNG (Max 10MB)</p>
              <div class="mr-dropzone__actions">
                <button type="button" class="mr-btn mr-btn--primary">Browse Files</button>
                <button type="button" class="mr-btn mr-btn--ghost">
                  <img src="https://img.icons8.com/ios-filled/50/1a1b24/camera.png" alt="">
                  Camera
                </button>
              </div>
            </div>

            <div class="mr-next-steps">
              <div class="mr-dash-card__head">
                <h2>What happens next</h2>
                <span class="mr-badge mr-badge--accent mr-badge--case-normal">
                  <img src="https://img.icons8.com/ios-filled/50/dd8e1c/clock.png" alt="">
                  Est. Process Time: ~15 mins
                </span>
              </div>

              <ol class="mr-timeline">
                <li class="mr-timeline__step mr-timeline__step--active">
                  <strong>Upload &amp; Verify</strong>
                  <small>System securely encrypts and verifies document integrity.</small>
                </li>
                <li class="mr-timeline__step">
                  <strong>Pharmacy Matching</strong>
                  <small>AI matches order with nearest available stock.</small>
                </li>
                <li class="mr-timeline__step">
                  <strong>Confirmation</strong>
                  <small>Patient receives SMS link for copay and delivery.</small>
                </li>
              </ol>
            </div>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>
                <img class="mr-heading-icon" src="https://img.icons8.com/ios-filled/50/757687/marker.png" alt="">
                Delivery Context
              </h2>
              <a href="#">Edit</a>
            </div>
            <div class="mr-order">
              <strong>Current Patient Location</strong>
              <p>Determined by default clinic location. Will be updated if patient overrides.</p>
            </div>
            <div class="mr-map-preview">
              <span class="mr-map-preview__pin" aria-hidden="true"></span>
              <span class="mr-map-preview__label">Confirm Pharmacy Location</span>
            </div>
          </section>

          <section class="mr-card mr-mini-stat">
            <div>
              <span class="mr-eyebrow mr-eyebrow--mono">Today's Uploads</span>
              <strong>24</strong>
            </div>
            <span class="mr-icon-badge mr-icon-badge--success mr-icon-badge--lg">
              <img src="https://img.icons8.com/ios-filled/50/1f9d6b/positive-dynamic.png" alt="">
            </span>
          </section>

          <footer class="mr-card mr-order-footer">
            <span class="mr-order-footer__copy">© 2024 MedReach Systems</span>
            <a href="pharmacy-responses.php" class="mr-btn mr-btn--primary mr-btn--sm">Broadcast to nearby pharmacies</a>
            <div class="mr-order-footer__links">
              <a class="mr-btn mr-btn--ghost mr-btn--sm" href="#">Privacy Policy</a>
              <a class="mr-btn mr-btn--ghost mr-btn--sm" href="#">Contact Support</a>
            </div>
          </footer>

        </div>
      </div>
    </main>
  </div>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
