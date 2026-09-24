<?php
// MedReach - Pharmacist dashboard (presentation tier: HTML output only)
// Converted from docs/pharmacy-dashboard.php (Tailwind mockup) onto the same
// mr- component system as the patient module — no new CSS classes needed.
//
// Defects fixed vs the mockup: dropped the Inventory nav item and Low Stock
// Alerts widget (MedReach has no MEDICINE/INVENTORY table per CLAUDE.md — out
// of scope), replaced with the real UC-18 substitution-approval workflow.
$active = 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pharmacist Dashboard — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body>

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-pharmacy.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <div>
          <h1>Good afternoon, CityHealth Pharmacy</h1>
          <p class="mr-eyebrow">Order queue synced 2 min ago</p>
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

          <label class="mr-switch" title="Accepting orders" data-duty-toggle>
            <input type="checkbox" checked>
            <span class="mr-switch__track"></span>
          </label>

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
              <h2>Incoming requests</h2>
              <span class="mr-badge mr-badge--accent" data-request-count>2 new</span>
            </div>

            <div class="mr-guardian-grid-2" data-request-list>
              <div class="mr-card mr-request-card">
                <div class="mr-request-card__head">
                  <span class="mr-icon-badge mr-icon-badge--accent">
                    <img src="https://img.icons8.com/ios-filled/50/dd8e1c/pill.png" alt="">
                  </span>
                  <div>
                    <span class="mr-eyebrow mr-eyebrow--accent">Expires in 03:42 &middot; 1.2 mi</span>
                    <h4><a href="prescription-request.php">Amoxicillin 500mg &times; 30</a></h4>
                  </div>
                </div>
                <p class="mr-eyebrow mr-eyebrow--mono">Eleanor Vance &middot; 124 Maple Street, Apt 4B</p>
                <div class="mr-request-card__actions">
                  <button type="button" class="mr-btn mr-btn--muted mr-btn--sm" data-request-action="decline">Decline</button>
                  <button type="button" class="mr-btn mr-btn--dark mr-btn--sm" data-request-action="accept">Accept</button>
                </div>
              </div>

              <div class="mr-card mr-request-card">
                <div class="mr-request-card__head">
                  <span class="mr-icon-badge mr-icon-badge--danger">
                    <img src="https://img.icons8.com/ios-filled/50/d6534a/pill.png" alt="">
                  </span>
                  <div>
                    <span class="mr-eyebrow mr-eyebrow--accent">Expires in 01:15 &middot; 3.4 mi</span>
                    <h4>Lisinopril 10mg &times; 90</h4>
                  </div>
                </div>
                <p class="mr-eyebrow mr-eyebrow--mono">David Miller &middot; 890 Oak Lane, North Clinic</p>
                <div class="mr-request-card__actions">
                  <button type="button" class="mr-btn mr-btn--muted mr-btn--sm" data-request-action="decline">Decline</button>
                  <button type="button" class="mr-btn mr-btn--dark mr-btn--sm" data-request-action="accept">Accept</button>
                </div>
              </div>
            </div>

            <p class="mr-resp-grid__empty" data-request-empty hidden style="text-align: center; margin-top: 1rem;">
              No pending requests right now.
            </p>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Orders in progress</h2>
              <a href="orders.php">View all</a>
            </div>

            <article class="mr-order">
              <div class="mr-order__head">
                <div class="mr-order__id">
                  <span class="mr-icon-badge mr-icon-badge--info">
                    <img src="https://img.icons8.com/ios-filled/50/2d3fd7/delivery.png" alt="">
                  </span>
                  <div>
                    <span class="mr-eyebrow mr-eyebrow--mono">#ORD-9921</span>
                    <strong>Albuterol Inhaler &times;2</strong>
                  </div>
                </div>
                <div class="mr-order__tags">
                  <span class="mr-badge mr-badge--info">450 West Ave</span>
                  <span class="mr-badge mr-badge--pill mr-badge--case-normal">ETA 15 min</span>
                </div>
              </div>

              <ol class="mr-order-progress">
                <li class="is-done"><span></span>Accepted</li>
                <li class="is-done"><span></span>Prepared</li>
                <li class="is-current"><span></span>With courier</li>
              </ol>
            </article>

            <article class="mr-order">
              <div class="mr-order__head">
                <div class="mr-order__id">
                  <span class="mr-icon-badge mr-icon-badge--accent">
                    <img src="https://img.icons8.com/ios-filled/50/dd8e1c/pill.png" alt="">
                  </span>
                  <div>
                    <span class="mr-eyebrow mr-eyebrow--mono">#ORD-9925</span>
                    <strong>Metformin 500mg, Atorvastatin 20mg</strong>
                  </div>
                </div>
                <div class="mr-order__tags">
                  <span class="mr-badge mr-badge--pill">Main Campus</span>
                  <span class="mr-badge mr-badge--accent mr-badge--case-normal">Preparing</span>
                </div>
              </div>

              <ol class="mr-order-progress">
                <li class="is-done"><span></span>Accepted</li>
                <li class="is-current"><span></span>Prepared</li>
                <li><span></span>With courier</li>
              </ol>
            </article>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Today's earnings</h2>
              <span class="mr-eyebrow mr-eyebrow--mono">Rs. 34,250.00</span>
            </div>
            <canvas id="mr-earnings-chart" height="180" role="img" aria-label="Hourly earnings for today"></canvas>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Today at a glance</h2>
            </div>
            <div class="mr-pharmacy-row">
              <span>Completed</span>
              <strong>24</strong>
            </div>
            <div class="mr-pharmacy-row">
              <span>Avg. prep time</span>
              <strong>4.2m</strong>
            </div>
            <div class="mr-pharmacy-row">
              <span>Courier rating</span>
              <strong>
                4.9
                <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="" style="width: 14px; height: 14px; vertical-align: -1px;">
              </strong>
            </div>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Substitution requests</h2>
              <span class="mr-badge mr-badge--info">1 pending</span>
            </div>
            <p>Patient or guardian approves your suggested swap with a single tap — no substitution ships until then.</p>
            <div class="mr-swap-demo">
              <span class="mr-swap-demo__old">Panadol 500mg</span>
              <span class="mr-swap-demo__new">Paracetamol (Generic) <em>Awaiting approval</em></span>
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
