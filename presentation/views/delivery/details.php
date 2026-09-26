<?php
$title = 'Order #ORD-9921 — MedReach';
$active = 'manifest';
?>
  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <div>
          <div class="mr-track-title">
            <h1>Order #ORD-9921</h1>
            <span class="mr-badge mr-badge--primary mr-badge--case-normal">
              <img src="presentation/assets/images/icons/filled/ffffff/delivery.png" alt="">
              In Transit
            </span>
          </div>
          <div class="mr-order__tags">
            <span class="mr-badge mr-badge--pill mr-badge--case-normal">
              <img src="presentation/assets/images/icons/filled/454655/shop.png" alt="">
              General Hospital Pharmacy
            </span>
            <span class="mr-badge mr-badge--pill mr-badge--case-normal">
              <img src="presentation/assets/images/icons/filled/454655/route.png" alt="">
              2.4 km to drop-off
            </span>
            <span class="mr-badge mr-badge--pill mr-badge--case-normal">
              <img src="presentation/assets/images/icons/filled/dd8e1c/cash.png" alt="">
              Cash on delivery
            </span>
          </div>
        </div>

        <div class="mr-dash-header__actions">
          <a href="tel:+94771234567" class="mr-btn mr-btn--light mr-btn--sm">
            <img src="presentation/assets/images/icons/filled/2d3fd7/phone.png" alt="">
            Call Recipient
          </a>
        </div>
      </header>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-tracking-card">
            <div class="mr-tracking-card__head">
              <h3>Delivery Route</h3>
              <span class="mr-eyebrow mr-eyebrow--mono">RT-992</span>
            </div>

            <ol class="mr-timeline">
              <li class="mr-timeline__step">
                <strong>Picked Up</strong>
                <small>General Hospital Pharmacy, Sector 7</small>
                <span class="mr-timeline__time">08:14 AM</span>
              </li>
              <li class="mr-timeline__step mr-timeline__step--active">
                <strong>In Transit</strong>
                <small>Approaching destination via 45 Baseline Rd</small>
                <span class="mr-timeline__time">09:32 AM</span>
              </li>
              <li class="mr-timeline__step mr-timeline__step--pending">
                <strong>Delivered</strong>
                <small>Nimal Perera &middot; 142 Galle Road, Colombo 03</small>
                <span class="mr-timeline__time">ETA 09:45 AM</span>
              </li>
            </ol>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>
                <img class="mr-heading-icon" src="presentation/assets/images/icons/filled/757687/cash.png" alt="">
                Payment to Collect
              </h2>
              <span class="mr-eyebrow mr-eyebrow--mono">COD</span>
            </div>

            <div class="mr-order-lines__summary">
              <div class="mr-order-lines__row">
                <span>Medicine Total</span>
                <i class="mr-order-lines__rule"></i>
                <strong>LKR 4,200.00</strong>
              </div>
              <div class="mr-order-lines__row">
                <span>Delivery Fee</span>
                <i class="mr-order-lines__rule"></i>
                <strong>LKR 300.00</strong>
              </div>
              <div class="mr-order-lines__row mr-order-lines__row--total">
                <span>Total to Collect</span>
                <i class="mr-order-lines__rule"></i>
                <strong>LKR 4,500.00</strong>
              </div>
            </div>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-courier-card mr-payment-card">
            <span class="mr-payment-card__label">
              <img src="presentation/assets/images/icons/filled/ffffff/delivery.png" alt="">
              Delivery In Progress
            </span>
            <h2>2.4 km to Drop-off</h2>
            <p>Confirm handover once the package is delivered and cash payment is collected from the recipient.</p>
            <div class="mr-payment-card__due">
              <span>Cash to Collect</span>
              <strong>LKR 4,500.00</strong>
            </div>
          </section>

          <div class="mr-confirm-actions">
            <button type="button" class="mr-btn mr-btn--primary mr-btn--block" data-modal-open="mr-handover-modal">
              <img src="presentation/assets/images/icons/filled/ffffff/checkmark.png" alt="">
              Confirm Handover
            </button>
            <button type="button" class="mr-btn mr-btn--ghost mr-btn--block" data-modal-open="mr-issue-form-modal">Report an issue</button>
          </div>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Reported issues</h2>
              <span class="mr-badge mr-badge--accent">1 open</span>
            </div>

            <div class="mr-order-row">
              <span class="mr-icon-badge mr-icon-badge--accent">
                <img src="presentation/assets/images/icons/filled/dd8e1c/error--v1.png" alt="">
              </span>
              <div class="mr-order-row__info">
                <strong>Recipient not reachable</strong>
                <span class="mr-eyebrow">09:20 AM &middot; Called twice, no answer.</span>
              </div>
            </div>

            <div class="mr-request-card__actions">
              <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-open="mr-issue-form-modal" data-subject="Edit issue">Edit</button>
              <button type="button" class="mr-btn mr-btn--danger-outline mr-btn--sm" data-modal-open="mr-issue-withdraw-modal">Withdraw</button>
            </div>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>
                <img class="mr-heading-icon" src="presentation/assets/images/icons/filled/757687/box.png" alt="">
                Package Details
              </h2>
              <span class="mr-eyebrow mr-eyebrow--mono">3 items</span>
            </div>

            <div class="mr-profile-details">
              <div class="mr-profile-details__item">
                <span class="mr-eyebrow">Weight</span>
                <strong>0.6 kg</strong>
              </div>
              <div class="mr-profile-details__item">
                <span class="mr-eyebrow">Handling</span>
                <strong>Standard</strong>
              </div>
              <div class="mr-profile-details__item">
                <span class="mr-eyebrow">Payment Method</span>
                <strong>Cash on Delivery</strong>
              </div>
              <div class="mr-profile-details__item">
                <span class="mr-eyebrow">Recipient</span>
                <strong>Nimal Perera</strong>
              </div>
            </div>
          </section>

        </div>
      </div>
    </main>
  </div>

  <div class="mr-modal" id="mr-issue-form-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2><span data-subject-slot="Report an issue"></span></h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <p class="mr-modal__text">The pharmacy and the patient are notified so they can help sort it out.</p>

      <form class="mr-auth-form mr-modal__form" data-toast="Issue saved — the pharmacy and patient have been notified.">
        <label class="mr-field">
          <span>What happened?</span>
          <div class="mr-field__input">
            <select required>
              <option value="" disabled selected>Select...</option>
              <option>Recipient not reachable</option>
              <option>Wrong or incomplete address</option>
              <option>Package damaged</option>
              <option>Recipient refused the order</option>
              <option>Something else</option>
            </select>
          </div>
        </label>
        <label class="mr-field">
          <span>Note</span>
          <textarea rows="3" placeholder="e.g. Called twice, no answer..." required></textarea>
        </label>

        <div class="mr-modal__actions">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Save</button>
        </div>
      </form>
    </div>
  </div>

  <div class="mr-modal" id="mr-issue-withdraw-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Withdraw this issue?</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <p class="mr-modal__text">Use this once the problem is sorted — for example, the recipient called back.</p>

      <div class="mr-modal__actions">
        <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
        <button type="button" class="mr-btn mr-btn--danger-outline mr-btn--sm" data-modal-close data-toast="Issue withdrawn.">Withdraw</button>
      </div>
    </div>
  </div>

  <div class="mr-modal" id="mr-handover-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Confirm Handover</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <form class="mr-modal__form" id="mr-handover-form" data-toast="Delivery confirmed — cash collection recorded.">
        <p>Confirm delivery of order <strong>#ORD-9921</strong> to <strong>Nimal Perera</strong> and collection of <strong>LKR 4,500.00</strong> cash on delivery.</p>

        <label class="mr-auth-terms">
          <input type="checkbox" required>
          I confirm the package was handed over and payment was collected.
        </label>

        <div class="mr-modal__actions">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Confirm</button>
        </div>
      </form>
    </div>
  </div>
