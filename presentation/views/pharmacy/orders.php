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
        </div>
      </header>

      <div class="mr-auth-tabs" role="tablist" aria-label="Order stage">
        <button type="button" class="mr-auth-tabs__btn" role="tab" aria-selected="false" data-stage-tab="new">New</button>
        <button type="button" class="mr-auth-tabs__btn is-active" role="tab" aria-selected="true" data-stage-tab="preparing">Preparing</button>
        <button type="button" class="mr-auth-tabs__btn" role="tab" aria-selected="false" data-stage-tab="ready">Ready</button>
        <button type="button" class="mr-auth-tabs__btn" role="tab" aria-selected="false" data-stage-tab="completed">Completed</button>
      </div>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2 data-stage-title>Preparing</h2>
              <span class="mr-eyebrow mr-eyebrow--mono" data-stage-count>2 orders</span>
            </div>

            <div class="mr-dash-col" data-stage-list>

              <article class="mr-order" data-stage="new" hidden>
                <div class="mr-order__head">
                  <div class="mr-order__id">
                    <span class="mr-avatar">KJ</span>
                    <div>
                      <strong>Kasun Jayasinghe</strong>
                      <span class="mr-eyebrow mr-eyebrow--mono">ID: #ORD-9930</span>
                    </div>
                  </div>
                  <div class="mr-order__tags">
                    <span class="mr-eyebrow mr-eyebrow--accent">Expires in 01:15</span>
                    <a class="mr-btn mr-btn--dark mr-btn--sm" href="prescription-request.php">Review request</a>
                  </div>
                </div>
              </article>

              <article class="mr-order" data-stage="ready" hidden>
                <div class="mr-order__head">
                  <div class="mr-order__id">
                    <span class="mr-avatar">SW</span>
                    <div>
                      <strong>Sachini Wijesinghe</strong>
                      <span class="mr-eyebrow mr-eyebrow--mono">ID: #ORD-9918</span>
                    </div>
                  </div>
                  <div class="mr-order__tags">
                    <span class="mr-eyebrow mr-eyebrow--mono">2 items</span>
                    <span class="mr-badge mr-badge--info mr-badge--case-normal">Awaiting courier</span>
                  </div>
                </div>
              </article>

              <article class="mr-order" data-stage="completed" hidden>
                <div class="mr-order__head">
                  <div class="mr-order__id">
                    <span class="mr-avatar">RD</span>
                    <div>
                      <strong>Ruwan Dissanayake</strong>
                      <span class="mr-eyebrow mr-eyebrow--mono">ID: #ORD-9902</span>
                    </div>
                  </div>
                  <div class="mr-order__tags">
                    <span class="mr-eyebrow mr-eyebrow--mono">Today, 09:10 AM</span>
                    <span class="mr-badge mr-badge--success mr-badge--case-normal">Delivered</span>
                  </div>
                </div>
              </article>

              <p class="mr-resp-grid__empty" data-stage-empty hidden>No orders in this stage.</p>

              <article class="mr-order" data-stage="preparing">
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
                  <button type="button" class="mr-btn mr-btn--muted mr-btn--sm" data-once="Prepared">Mark prepared</button>
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
                  <button type="button" class="mr-btn mr-btn--muted mr-btn--sm" data-modal-open="mr-hold-modal" data-subject="#ORD-9921">Hold issue</button>
                  <button type="button" class="mr-btn mr-btn--dark mr-btn--sm" data-stage-move="ready" data-toast="#ORD-9921 is ready — a courier will be assigned.">Complete preparation</button>
                </div>
              </article>

              <article class="mr-order" data-stage="preparing">
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
                    <button type="button" class="mr-btn mr-btn--dark mr-btn--sm" data-once="Preparing" data-toast="Started preparing #ORD-9924.">Start preparing</button>
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
              <button type="button" class="mr-btn mr-btn--light" data-modal-open="mr-schedule-modal">View schedule</button>
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

  <div class="mr-modal" id="mr-hold-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Hold <span data-subject-slot="order"></span></h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="https://img.icons8.com/ios-filled/50/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <form class="mr-auth-form mr-modal__form" data-toast="Order on hold — the patient has been notified.">
        <label class="mr-field">
          <span>Issue</span>
          <div class="mr-field__input">
            <select required>
              <option value="" disabled selected>Select...</option>
              <option>Prescription unclear</option>
              <option>Dosage needs confirmation</option>
              <option>Item can't be filled today</option>
              <option>Other</option>
            </select>
          </div>
        </label>
        <label class="mr-field">
          <span>Note to patient</span>
          <textarea rows="3" placeholder="Explain what's needed to continue..."></textarea>
        </label>

        <div class="mr-modal__actions">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--dark mr-btn--sm">Put on hold</button>
        </div>
      </form>
    </div>
  </div>

  <div class="mr-modal" id="mr-schedule-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Courier pickups today</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="https://img.icons8.com/ios-filled/50/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <dl class="mr-modal__list">
        <div><dt>11:00 AM · SwiftCare Courier</dt><dd>4 orders</dd></div>
        <div><dt>01:30 PM · Ruwan K.</dt><dd>2 orders</dd></div>
        <div><dt>04:00 PM · Kasun P.</dt><dd>3 orders</dd></div>
      </dl>

      <div class="mr-modal__actions">
        <button type="button" class="mr-btn mr-btn--primary mr-btn--sm" data-modal-close>Close</button>
      </div>
    </div>
  </div>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
