<?php
// MedReach - Patient view of pharmacy responses to a broadcast prescription (presentation tier: HTML output only)
$active = 'orders';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Prescription RX-1042 — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body class="mr-page-responses">

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-patient.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <h1>Prescription RX-1042</h1>

        <div class="mr-dash-header__actions">
          <span class="mr-badge mr-badge--primary mr-badge--case-normal">Broadcasting</span>
          <span class="mr-badge mr-badge--pill mr-badge--case-normal">
            <img src="https://img.icons8.com/ios-filled/50/454655/clock.png" alt="">
            Auto-forwards in 08:42
          </span>

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
              <h2>
                <img class="mr-heading-icon" src="https://img.icons8.com/ios-filled/50/2d3fd7/document.png" alt="">
                Original Prescription
              </h2>
              <span class="mr-eyebrow mr-eyebrow--mono">Uploaded Aug 9, 2026</span>
            </div>

            <div class="mr-resp-rx">
              <span class="mr-resp-rx__thumb">
                <img src="https://img.icons8.com/ios-filled/50/2d3fd7/image.png" alt="Prescription scan">
              </span>
              <div class="mr-resp-rx__body">
                <p class="mr-resp-rx__meta">Patient: Nimal Perera · Dr. S. Weerasinghe · GMC-4471</p>
                <ul class="mr-resp-rx__items">
                  <li><strong>Lisinopril 10mg</strong><span>× 30</span></li>
                  <li><strong>Atorvastatin 20mg</strong><span>× 60</span></li>
                </ul>
              </div>
            </div>
          </section>

          <div class="mr-resp-filters" role="group" aria-label="Filter items by status">
            <button type="button" class="mr-resp-filters__btn mr-resp-filters__btn--available" data-filter="available">Approved</button>
            <button type="button" class="mr-resp-filters__btn mr-resp-filters__btn--unavailable" data-filter="unavailable">Not Available</button>
            <button type="button" class="mr-resp-filters__btn mr-resp-filters__btn--suggestion" data-filter="suggestion">Suggestions</button>
          </div>

          <div class="mr-resp-grid">

            <section class="mr-card mr-dash-card" data-status="available">
              <div class="mr-dash-card__head">
                <div>
                  <h2>Lisinopril 10mg</h2>
                  <span class="mr-badge mr-badge--pill mr-badge--case-normal">Qty: 30</span>
                </div>
                <div class="mr-resp-price">
                  <strong class="mr-price">LKR 1,450</strong>
                  <span class="mr-badge mr-badge--success mr-badge--case-normal">Available</span>
                </div>
              </div>

              <p class="mr-resp-meta">
                <img src="https://img.icons8.com/ios-filled/50/454655/shop.png" alt="">
                CVS Health
                <span class="mr-resp-meta__dot" aria-hidden="true"></span>
                1.2 km
              </p>

              <div class="mr-resp-actions">
                <button type="button" class="mr-btn mr-btn--ghost">Decline</button>
                <button type="button" class="mr-btn mr-btn--primary">Accept</button>
              </div>
            </section>

            <section class="mr-card mr-dash-card" data-status="suggestion">
              <div class="mr-dash-card__head">
                <div>
                  <h2 class="mr-swap-demo__old">Atorvastatin 20mg</h2>
                  <span class="mr-badge mr-badge--pill mr-badge--case-normal">Qty: 60</span>
                </div>
                <div class="mr-resp-price">
                  <strong class="mr-price mr-price--was">LKR 2,800</strong>
                  <span class="mr-badge mr-badge--success mr-badge--case-normal">−LKR 420</span>
                  <strong class="mr-price">LKR 2,380</strong>
                </div>
              </div>

              <p class="mr-resp-meta">
                <img src="https://img.icons8.com/ios-filled/50/454655/shop.png" alt="">
                GreenCross Pharmacy
                <span class="mr-resp-meta__dot" aria-hidden="true"></span>
                2.4 km
              </p>

              <div class="mr-resp-suggestion">
                <div class="mr-resp-suggestion__label">
                  <img src="https://img.icons8.com/ios-filled/50/dd8e1c/idea.png" alt="">
                  Suggested Alternative
                </div>
                <div class="mr-resp-suggestion__name">Rosuvastatin 10mg</div>
                <p>"Same therapeutic class, 15% cheaper."</p>
              </div>

              <div class="mr-resp-actions">
                <button type="button" class="mr-btn mr-btn--ghost">Reject</button>
                <button type="button" class="mr-btn mr-btn--dark">Approve</button>
              </div>
            </section>

            <p class="mr-resp-grid__empty" hidden>No items match this filter.</p>

          </div>

        </div>

        <div class="mr-dash-col">

          <section class="mr-resp-summary">
            <h2>Request Summary</h2>
            <div class="mr-resp-summary__row">
              <span>Items</span>
              <i class="mr-resp-summary__rule"></i>
              <strong>2</strong>
            </div>
            <div class="mr-resp-summary__row">
              <span>Est. Total</span>
              <i class="mr-resp-summary__rule"></i>
              <strong>LKR 3,830</strong>
            </div>
            <a href="finalize-order.php" class="mr-btn mr-btn--dark mr-btn--block">
              Confirm all accepted
              <img src="https://img.icons8.com/ios-filled/50/ffffff/checkmark.png" alt="">
            </a>
          </section>

          <section class="mr-card mr-dash-card">
            <h2>
              <img class="mr-heading-icon" src="https://img.icons8.com/ios-filled/50/2d3fd7/link.png" alt="">
              Auto-forwarding logic
            </h2>
            <p class="mr-dash-card__lede">Declined or timed-out items automatically forward to the next nearest eligible pharmacy to ensure fulfillment.</p>

            <div class="mr-resp-forward">
              <div class="mr-resp-forward__node">
                <span class="mr-resp-forward__icon">
                  <img src="https://img.icons8.com/ios-filled/50/ffffff/shop.png" alt="">
                </span>
                <small>CVS (1.2k)</small>
              </div>
              <div class="mr-resp-forward__track">
                <span class="mr-resp-forward__clock">
                  <img src="https://img.icons8.com/ios-filled/50/dd8e1c/clock.png" alt="">
                </span>
              </div>
              <div class="mr-resp-forward__node mr-resp-forward__node--next">
                <span class="mr-resp-forward__icon">
                  <img src="https://img.icons8.com/ios-filled/50/454655/shop.png" alt="">
                </span>
                <small>Walgreens (2.4k)</small>
              </div>
            </div>
          </section>

          <section class="mr-card mr-mini-stat">
            <div>
              <span class="mr-eyebrow mr-eyebrow--mono">Est. Delivery</span>
              <strong>45 min</strong>
            </div>
            <span class="mr-icon-badge mr-icon-badge--info mr-icon-badge--lg">
              <img src="https://img.icons8.com/ios-filled/50/2d3fd7/delivery.png" alt="">
            </span>
          </section>

        </div>
      </div>
    </main>
  </div>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
