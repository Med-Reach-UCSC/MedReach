<?php
// MedReach - Pharmacist order queue (presentation tier: HTML output only)
$active = 'requests';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Orders — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body>

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-pharmacy.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <div>
          <h1>Orders</h1>
          <p class="mr-eyebrow">Queue synced 2 min ago</p>
        </div>

        <div class="mr-dash-header__actions">
          <div class="mr-dash-stats">
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--active">12</strong>
              <span>Orders today</span>
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

      <div class="mr-auth-tabs" role="tablist" aria-label="Order stage">
        <button type="button" class="mr-auth-tabs__btn" role="tab" aria-selected="false">New &middot; 12</button>
        <button type="button" class="mr-auth-tabs__btn" role="tab" aria-selected="false">Triaging &middot; 5</button>
        <button type="button" class="mr-auth-tabs__btn is-active" role="tab" aria-selected="true">Preparing &middot; 8</button>
        <button type="button" class="mr-auth-tabs__btn" role="tab" aria-selected="false">Ready &middot; 3</button>
        <button type="button" class="mr-auth-tabs__btn" role="tab" aria-selected="false">Completed</button>
      </div>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Preparing</h2>
              <span class="mr-eyebrow mr-eyebrow--mono">8 orders</span>
            </div>

            <div class="mr-dash-col">

              <article class="mr-order">
                <div class="mr-order__head">
                  <div class="mr-order__id">
                    <span class="mr-avatar">NF</span>
                    <div>
                      <strong>Nimali Fernando</strong>
                      <span class="mr-eyebrow mr-eyebrow--mono">ID: #ORD-9921</span>
                    </div>
                  </div>
                  <div class="mr-order__tags">
                    <span class="mr-eyebrow mr-eyebrow--accent">Due in 45m</span>
                    <span class="mr-badge mr-badge--pill mr-badge--case-normal">Delivery: Standard</span>
                  </div>
                </div>

                <div class="mr-order-row">
                  <span class="mr-icon-badge mr-icon-badge--accent">
                    <img src="https://img.icons8.com/ios-filled/50/dd8e1c/pill.png" alt="">
                  </span>
                  <div class="mr-order-row__info">
                    <strong>Amoxicillin 500mg</strong>
                    <span class="mr-eyebrow mr-eyebrow--mono">Capsules &middot; Qty: 21 &middot; Take 1 cap 3x daily</span>
                  </div>
                  <button type="button" class="mr-btn mr-btn--muted mr-btn--sm">Mark prepared</button>
                </div>

                <div class="mr-order-row">
                  <span class="mr-icon-badge mr-icon-badge--success">
                    <img src="https://img.icons8.com/ios-filled/50/1f9d6b/checkmark.png" alt="">
                  </span>
                  <div class="mr-order-row__info">
                    <strong>Fluticasone Propionate</strong>
                    <span class="mr-eyebrow mr-eyebrow--mono">Nasal Spray &middot; Qty: 1 &middot; 2 sprays per nostril</span>
                  </div>
                  <span class="mr-badge mr-badge--success mr-badge--case-normal">Prepared</span>
                </div>

                <ol class="mr-order-progress">
                  <li class="is-done"><span></span>Accepted</li>
                  <li class="is-current"><span></span>Preparing</li>
                  <li><span></span>With courier</li>
                </ol>

                <div class="mr-request-card__actions">
                  <button type="button" class="mr-btn mr-btn--muted mr-btn--sm">Hold issue</button>
                  <button type="button" class="mr-btn mr-btn--dark mr-btn--sm">Complete preparation</button>
                </div>
              </article>

              <article class="mr-order">
                <div class="mr-order__head">
                  <div class="mr-order__id">
                    <span class="mr-avatar">KP</span>
                    <div>
                      <strong>Kasun Perera</strong>
                      <span class="mr-eyebrow mr-eyebrow--mono">ID: #ORD-9924</span>
                    </div>
                  </div>
                  <div class="mr-order__tags">
                    <span class="mr-eyebrow mr-eyebrow--mono">3 items</span>
                    <span class="mr-badge mr-badge--info mr-badge--case-normal">Courier wait</span>
                    <button type="button" class="mr-btn mr-btn--dark mr-btn--sm">Start preparing</button>
                  </div>
                </div>
              </article>

            </div>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-courier-card">
            <div class="mr-courier-card__top">
              <div class="mr-courier-card__profile">
                <span class="mr-avatar mr-courier-card__avatar">SC</span>
                <div>
                  <span class="mr-courier-card__label">Next Arrival</span>
                  <strong class="mr-courier-card__name">SwiftCare Courier</strong>
                  <span class="mr-courier-card__rating">Picking up 4 orders</span>
                </div>
              </div>
              <div class="mr-courier-card__eta">
                <span>11:00 AM</span>
                <small>est. pickup</small>
              </div>
            </div>

            <div class="mr-courier-card__actions">
              <a href="#" class="mr-btn mr-btn--light">View schedule</a>
            </div>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Operational pulse</h2>
            </div>
            <div class="mr-pharmacy-row">
              <span>Daily volume</span>
              <strong>142 / 180 orders</strong>
            </div>
            <div class="mr-pharmacy-row">
              <span>Accuracy rate</span>
              <strong>92% &middot; last 7 days</strong>
            </div>
          </section>

        </div>
      </div>
    </main>
  </div>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
