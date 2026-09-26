<?php
$title = 'New Order — MedReach';
$bodyClass = 'mr-page-order';
$active = 'orders';
?>
  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

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
            <img src="presentation/assets/images/icons/filled/1a1b24/appointment-reminders.png" alt="">
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
                <img src="presentation/assets/images/icons/filled/2d3fd7/upload-to-cloud.png" alt="">
              </span>
              <h3>Drag &amp; Drop files here</h3>
              <p>Supported formats: PDF, JPG, PNG (Max 10MB)</p>
              <div class="mr-dropzone__actions">
                <button type="button" class="mr-btn mr-btn--primary" data-file-trigger="mr-rx-file">Browse Files</button>
                <button type="button" class="mr-btn mr-btn--ghost" data-file-trigger="mr-rx-camera">
                  <img src="presentation/assets/images/icons/filled/1a1b24/camera.png" alt="">
                  Camera
                </button>
              </div>
              <input type="file" id="mr-rx-file" accept=".pdf,.jpg,.jpeg,.png" hidden>
              <input type="file" id="mr-rx-camera" accept="image/*" capture="environment" hidden>
              <p class="mr-eyebrow mr-eyebrow--mono" data-file-name hidden></p>
            </div>

            <form class="mr-auth-form mr-auth-form--grid" id="mr-order-form" action="pharmacy-responses.php" method="get">
              <label class="mr-field">
                <span>Ordering for</span>
                <div class="mr-field__input">
                  <select>
                    <option>Myself</option>
                    <option>Amma (PT-9824-A)</option>
                    <option>Seeya (PT-3319-X)</option>
                  </select>
                </div>
              </label>
              <label class="mr-field">
                <span>Prescription expiry date</span>
                <div class="mr-field__input">
                  <input type="date" min="<?= date('Y-m-d') ?>" required>
                </div>
              </label>
              <label class="mr-field mr-field--span2">
                <span>Note for the pharmacist (optional)</span>
                <textarea rows="3" placeholder="e.g. Prefer Panadol over generic paracetamol, or no sugar-coated tablets"></textarea>
              </label>
            </form>

            <div class="mr-next-steps">
              <div class="mr-dash-card__head">
                <h2>What happens next</h2>
                <span class="mr-badge mr-badge--accent mr-badge--case-normal">
                  <img src="presentation/assets/images/icons/filled/dd8e1c/clock.png" alt="">
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
                  <small>Each item is sent to the nearest registered pharmacy; if declined or timed out, it moves to the next closest.</small>
                </li>
                <li class="mr-timeline__step">
                  <strong>Confirmation</strong>
                  <small>You review pharmacy responses and confirm. Pay by card or cash on delivery.</small>
                </li>
              </ol>
            </div>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>
                <img class="mr-heading-icon" src="presentation/assets/images/icons/filled/757687/marker.png" alt="">
                Delivery Context
              </h2>
              <button type="button" class="mr-link-btn" data-modal-open="mr-delivery-context-modal">Edit</button>
            </div>
            <div class="mr-order">
              <strong>12 Galle Road, Colombo 03</strong>
              <p>Your saved delivery address. Pharmacies are matched by distance from here.</p>
            </div>
          </section>

          <section class="mr-card mr-mini-stat">
            <div>
              <span class="mr-eyebrow mr-eyebrow--mono">Today's Uploads</span>
              <strong>24</strong>
            </div>
            <span class="mr-icon-badge mr-icon-badge--success mr-icon-badge--lg">
              <img src="presentation/assets/images/icons/filled/1f9d6b/positive-dynamic.png" alt="">
            </span>
          </section>

          <footer class="mr-card mr-order-footer">
            <span class="mr-order-footer__copy">© 2026 MedReach Systems</span>
            <button type="submit" form="mr-order-form" class="mr-btn mr-btn--primary mr-btn--sm">Broadcast to nearby pharmacies</button>
            <div class="mr-order-footer__links">
              <a class="mr-btn mr-btn--ghost mr-btn--sm" href="policies.php#privacy">Privacy Policy</a>
              <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-open="mr-support-modal">Contact Support</button>
            </div>
          </footer>

        </div>
      </div>
    </main>
  </div>

  <div class="mr-modal" id="mr-delivery-context-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Delivery address</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <form class="mr-auth-form mr-modal__form" data-toast="Delivery address updated for this order.">
        <label class="mr-field">
          <span>Address</span>
          <textarea rows="3" required>12 Galle Road, Colombo 03</textarea>
        </label>
        <label class="mr-field">
          <span>Contact number</span>
          <div class="mr-field__input">
            <input type="tel" value="+94 77 123 4567">
          </div>
        </label>

        <div class="mr-modal__actions">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Save address</button>
        </div>
      </form>
    </div>
  </div>

  <?php require __DIR__ . '/../partials/modal-support.php'; ?>
