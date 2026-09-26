<?php
$title = 'Order RX-1042 — MedReach';
$bodyClass = 'mr-page-track';
$active = 'orders';
?>
  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <div>
          <div class="mr-track-title">
            <h1>Order RX-1042</h1>
            <span class="mr-badge mr-badge--primary mr-badge--case-normal">
              <img src="presentation/assets/images/icons/filled/ffffff/delivery.png" alt="">
              Out for Delivery
            </span>
          </div>
          <div class="mr-order__tags">
            <span class="mr-badge mr-badge--pill mr-badge--case-normal">
              <img src="presentation/assets/images/icons/filled/454655/shop.png" alt="">
              City Care Pharmacy
            </span>
            <span class="mr-badge mr-badge--pill mr-badge--case-normal">
              <img src="presentation/assets/images/icons/filled/454655/pill.png" alt="">
              6 items
            </span>
            <span class="mr-badge mr-badge--pill mr-badge--case-normal">
              <img src="presentation/assets/images/icons/filled/dd8e1c/cash.png" alt="">
              Cash on delivery
            </span>
          </div>
        </div>

        <div class="mr-dash-header__actions">
          <button type="button" class="mr-btn mr-btn--light mr-btn--sm" data-modal-open="mr-invoice-modal">
            <img src="presentation/assets/images/icons/filled/2d3fd7/document.png" alt="">
            View Invoice
          </button>
          <a class="mr-notif-btn mr-notif-btn--header" href="notifications.php" aria-label="Notifications">
            <img src="presentation/assets/images/icons/filled/1a1b24/appointment-reminders.png" alt="">
            <span class="mr-notif-btn__dot" aria-hidden="true"></span>
          </a>
        </div>
      </header>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-tracking-card">
            <div class="mr-tracking-card__head">
              <h3>Delivery Status</h3>
            </div>

            <ol class="mr-timeline">
              <li class="mr-timeline__step">
                <strong>Prescription Uploaded</strong>
                <small>Verified by automated system.</small>
                <span class="mr-timeline__time">09:41 AM</span>
              </li>
              <li class="mr-timeline__step">
                <strong>Pharmacy Accepted</strong>
                <small>City Care Pharmacy is reviewing your order.</small>
                <span class="mr-timeline__time">09:45 AM</span>
              </li>
              <li class="mr-timeline__step">
                <strong>Order Confirmed</strong>
                <small>Pharmacy confirmed items and price.</small>
                <span class="mr-timeline__time">09:50 AM</span>
              </li>
              <li class="mr-timeline__step">
                <strong>Preparing Medicines</strong>
                <small>Pharmacist is packing your order.</small>
                <span class="mr-timeline__time">10:05 AM</span>
              </li>
              <li class="mr-timeline__step">
                <strong>Ready for Pickup</strong>
                <small>Waiting for courier assignment.</small>
                <span class="mr-timeline__time">10:15 AM</span>
              </li>
              <li class="mr-timeline__step mr-timeline__step--active">
                <strong>Out for Delivery</strong>
                <small>Courier has picked up your order and is on the way to your location.</small>
                <span class="mr-timeline__time">10:32 AM</span>
              </li>
              <li class="mr-timeline__step mr-timeline__step--pending">
                <strong>Delivered</strong>
                <small>Estimated arrival by 11:00 AM.</small>
                <span class="mr-timeline__time">--:--</span>
              </li>
            </ol>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-courier-card">
            <div class="mr-courier-card__top">
              <div class="mr-courier-card__profile">
                <span class="mr-avatar mr-courier-card__avatar">K</span>
                <div>
                  <span class="mr-courier-card__label">Your Courier</span>
                  <strong class="mr-courier-card__name">Kasun P.</strong>
                  <span class="mr-courier-card__rating">
                    <img src="presentation/assets/images/icons/filled/dd8e1c/star.png" alt="">
                    4.9 (120+ deliveries)
                  </span>
                </div>
              </div>
              <div class="mr-courier-card__eta">
                <span>11:00 AM</span>
                <small>est. arrival</small>
              </div>
            </div>

            <div class="mr-courier-card__actions">
              <a href="tel:+94771234567" class="mr-btn mr-btn--light">
                <img src="presentation/assets/images/icons/filled/2d3fd7/phone.png" alt="">
                Call
              </a>
              <button type="button" class="mr-btn mr-btn--dark" data-modal-open="mr-courier-message-modal">
                <img src="presentation/assets/images/icons/filled/ffffff/speech-bubble.png" alt="">
                Message
              </button>
            </div>
          </section>

          <section class="mr-card mr-dash-card mr-order-details-card">
            <div class="mr-dash-card__head">
              <h2>
                <img class="mr-heading-icon" src="presentation/assets/images/icons/filled/757687/list.png" alt="">
                Order Details
              </h2>
              <span class="mr-eyebrow mr-eyebrow--mono">6 items</span>
            </div>

            <div class="mr-order-lines">
              <div class="mr-order-lines__items">
                <div class="mr-order-lines__row">
                  <span>Amoxicillin 500mg <small>x2</small></span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 1,200.00</strong>
                </div>
                <div class="mr-order-lines__row">
                  <span>Ibuprofen 400mg <small>x1</small></span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 425.00</strong>
                </div>
                <div class="mr-order-lines__row">
                  <span>Vitamin D3 Drops <small>x1</small></span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 600.00</strong>
                </div>
                <div class="mr-order-lines__row">
                  <span>Paracetamol 500mg <small>x2</small></span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 300.00</strong>
                </div>
                <div class="mr-order-lines__row">
                  <span>Cetirizine 10mg <small>x1</small></span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 475.00</strong>
                </div>
                <div class="mr-order-lines__row">
                  <span>Omeprazole 20mg <small>x1</small></span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 750.00</strong>
                </div>
              </div>
              <div class="mr-order-lines__summary">
                <div class="mr-order-lines__row">
                  <span>Subtotal</span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 3,750.00</strong>
                </div>
                <div class="mr-order-lines__row">
                  <span>Delivery Fee</span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 300.00</strong>
                </div>
                <div class="mr-order-lines__row mr-order-lines__row--total">
                  <span>Total (Cash)</span>
                  <i class="mr-order-lines__rule"></i>
                  <strong>LKR 4,050.00</strong>
                </div>
              </div>
            </div>
          </section>

          <section class="mr-card mr-help-card">
            <span class="mr-icon-badge mr-icon-badge--info">
              <img src="presentation/assets/images/icons/filled/2d3fd7/help.png" alt="">
            </span>
            <div>
              <strong>Need assistance?</strong>
              <p>Contact support about this order.</p>
            </div>
            <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-open="mr-support-modal">Contact support</button>
          </section>

        </div>
      </div>
    </main>
  </div>

  <div class="mr-modal" id="mr-invoice-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Invoice — RX-1042</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <dl class="mr-modal__list">
        <div><dt>Pharmacy</dt><dd>City Care Pharmacy</dd></div>
        <div><dt>Items</dt><dd>6</dd></div>
        <div><dt>Subtotal</dt><dd>LKR 3,750.00</dd></div>
        <div><dt>Delivery fee</dt><dd>LKR 300.00</dd></div>
        <div><dt>Payment</dt><dd>Cash on delivery</dd></div>
        <div class="mr-modal__list-total"><dt>Total</dt><dd>LKR 4,050.00</dd></div>
      </dl>

      <div class="mr-modal__actions">
        <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Close</button>
        <button type="button" class="mr-btn mr-btn--primary mr-btn--sm" onclick="window.print()">Print</button>
      </div>
    </div>
  </div>

  <div class="mr-modal" id="mr-courier-message-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Message Kasun P.</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <form class="mr-auth-form mr-modal__form" data-toast="Message sent to your courier.">
        <label class="mr-field">
          <span>Message</span>
          <textarea rows="3" placeholder="e.g. Please leave it with the security guard" required></textarea>
        </label>

        <div class="mr-modal__actions">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Send</button>
        </div>
      </form>
    </div>
  </div>

  <?php require __DIR__ . '/../partials/modal-support.php'; ?>
