<?php
$title = 'Order History — MedReach';
$bodyClass = 'mr-page-history';
$active = 'orders';

$mr_requests = mr_patient_prescriptions();
$mr_error    = $flash && $flash['type'] === 'error' ? $flash : null;
$mr_modal    = $mr_error['modal'] ?? null;
$mr_old_in   = fn (string $modal) => fn (string $key) => htmlspecialchars($mr_modal === $modal ? ($_POST[$key] ?? '') : '');
$mr_csrf     = '<input type="hidden" name="csrf" value="' . mr_csrf_token() . '">';
?>
  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <h1>Order History</h1>

        <div class="mr-dash-header__actions">
          <div class="mr-dash-stats">
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--active">34</strong>
              <span>Total orders</span>
            </div>
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--active">4.8</strong>
              <span>Avg rating</span>
            </div>
          </div>

          <a class="mr-notif-btn mr-notif-btn--header" href="notifications.php" aria-label="Notifications">
            <img src="presentation/assets/images/icons/filled/1a1b24/appointment-reminders.png" alt="">
            <span class="mr-notif-btn__dot" aria-hidden="true"></span>
          </a>
        </div>
      </header>

      <?php if ($flash && !$mr_modal): ?>
        <span hidden data-flash-toast="<?= htmlspecialchars($flash['text']) ?>" data-flash-error="<?= $mr_error ? 'true' : 'false' ?>"></span>
      <?php endif; ?>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Prescription Requests</h2>
            </div>

            <?php if ($mr_requests): foreach ($mr_requests as $rx): ?>
              <article class="mr-card mr-order mr-history-card" data-status="<?= $rx['status'] ?>">
                <div class="mr-order__head">
                  <div class="mr-order__id">
                    <span class="mr-eyebrow mr-eyebrow--mono">RX-<?= sprintf('%04d', $rx['prescription_id']) ?></span>
                    <div>
                      <strong><?= htmlspecialchars($rx['owner_label']) ?></strong>
                      <span class="mr-eyebrow"><?= date('j M Y, g:i A', strtotime($rx['created_at'])) ?></span>
                    </div>
                  </div>
                  <div class="mr-order__tags">
                    <a class="mr-btn mr-btn--ghost mr-btn--sm" href="prescription-file.php?id=<?= $rx['prescription_id'] ?>" target="_blank" rel="noopener">View file</a>
                    <span class="mr-badge <?= $rx['status'] === 'pending' ? 'mr-badge--accent' : 'mr-badge--danger' ?> mr-badge--case-normal"><?= $rx['status'] === 'pending' ? 'Pending' : 'Cancelled' ?></span>
                    <?php if ($rx['status'] === 'pending'): ?>
                      <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-open="mr-edit-note-modal" data-subject="RX-<?= sprintf('%04d', $rx['prescription_id']) ?>" data-fill="<?= htmlspecialchars(json_encode(['prescription_id' => $rx['prescription_id'], 'note' => $rx['note']])) ?>">Edit note</button>
                      <button type="button" class="mr-btn mr-btn--danger-outline mr-btn--sm" data-modal-open="mr-cancel-order-modal" data-subject="RX-<?= sprintf('%04d', $rx['prescription_id']) ?>" data-fill="<?= htmlspecialchars(json_encode(['prescription_id' => $rx['prescription_id']])) ?>">Cancel request</button>
                    <?php endif; ?>
                  </div>
                </div>
                <?php if ($rx['note']): ?><p><?= nl2br(htmlspecialchars($rx['note'])) ?></p><?php endif; ?>
              </article>
            <?php endforeach; else: ?>
              <p class="mr-roster-empty">No prescription requests yet.</p>
            <?php endif; ?>
          </section>

          <div class="mr-history-toolbar">
            <label class="mr-pharm-search">
              <img src="presentation/assets/images/icons/filled/454655/search.png" alt="">
              <input type="search" placeholder="Search orders..." aria-label="Search orders">
            </label>
            <div class="mr-history-filters" role="group" aria-label="Filter orders by status">
              <button type="button" class="mr-history-filters__btn mr-history-filters__btn--delivered" data-filter="delivered">Delivered</button>
              <button type="button" class="mr-history-filters__btn mr-history-filters__btn--processing" data-filter="processing">Processing</button>
              <button type="button" class="mr-history-filters__btn mr-history-filters__btn--canceled" data-filter="canceled">Canceled</button>
            </div>
          </div>

          <div class="mr-history-list">

            <article class="mr-card mr-order mr-history-card" data-status="processing" data-name="ORD-8925 MediCare Plus">
              <div class="mr-order__head">
                <div class="mr-order__id">
                  <span class="mr-eyebrow mr-eyebrow--mono">#ORD-8925</span>
                  <div>
                    <strong>MediCare Plus</strong>
                    <span class="mr-eyebrow">Today &bull; 2 items</span>
                  </div>
                </div>
                <div class="mr-order__tags">
                  <span class="mr-badge mr-badge--accent mr-badge--case-normal">Awaiting pharmacy</span>
                  <button type="button" class="mr-btn mr-btn--danger-outline mr-btn--sm" data-modal-open="mr-cancel-order-modal" data-subject="#ORD-8925">Cancel order</button>
                </div>
              </div>
            </article>

            <article class="mr-card mr-order mr-history-card is-open" data-status="delivered" data-name="ORD-7392 CityHealth Pharmacy">
              <button type="button" class="mr-order__head mr-history-card__toggle">
                <span class="mr-order__id">
                  <span class="mr-eyebrow mr-eyebrow--mono">#ORD-7392</span>
                  <span>
                    <strong>CityHealth Pharmacy</strong>
                    <span class="mr-eyebrow">Oct 24, 2023 &bull; 3 items</span>
                  </span>
                </span>
                <span class="mr-order__tags">
                  <strong class="mr-history-card__price">LKR 4,520.00</strong>
                  <span class="mr-badge mr-badge--success mr-badge--case-normal">Delivered</span>
                  <span class="mr-history-card__chevron" aria-hidden="true">
                    <img src="presentation/assets/images/icons/filled/2d3fd7/expand-arrow.png" alt="">
                  </span>
                </span>
              </button>

              <div class="mr-history-card__body">
                <div class="mr-history-card__details">
                  <h3>Items</h3>
                  <div class="mr-history-card__items">
                    <div class="mr-order-lines__row">
                      <strong>Amoxicillin 500mg (20 caps)</strong>
                      <i class="mr-order-lines__rule"></i>
                      <span>LKR 2,020.00</span>
                    </div>
                    <div class="mr-order-lines__row">
                      <strong>Ibuprofen 400mg (30 tabs)</strong>
                      <i class="mr-order-lines__rule"></i>
                      <span>LKR 1,500.00</span>
                    </div>
                    <div class="mr-order-lines__row">
                      <strong>Cetirizine 10mg (10 tabs)</strong>
                      <i class="mr-order-lines__rule"></i>
                      <span>LKR 1,000.00</span>
                    </div>
                  </div>
                  <div class="mr-history-card__actions">
                    <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-open="mr-invoice-modal" data-subject="#ORD-7392">View Invoice</button>
                    <button type="button" class="mr-btn mr-btn--primary mr-btn--sm" data-modal-open="mr-reorder-modal" data-subject="#ORD-7392">Reorder All</button>
                  </div>
                </div>

                <div class="mr-history-card__rate">
                  <h3>Rate this pharmacy</h3>
                  <div class="mr-star-rating" data-rating="0">
                    <button type="button" class="mr-star-rating__btn" data-value="1" aria-label="1 star">
                      <img src="presentation/assets/images/icons/outline/c5c5d8/star.png" alt="">
                    </button>
                    <button type="button" class="mr-star-rating__btn" data-value="2" aria-label="2 stars">
                      <img src="presentation/assets/images/icons/outline/c5c5d8/star.png" alt="">
                    </button>
                    <button type="button" class="mr-star-rating__btn" data-value="3" aria-label="3 stars">
                      <img src="presentation/assets/images/icons/outline/c5c5d8/star.png" alt="">
                    </button>
                    <button type="button" class="mr-star-rating__btn" data-value="4" aria-label="4 stars">
                      <img src="presentation/assets/images/icons/outline/c5c5d8/star.png" alt="">
                    </button>
                    <button type="button" class="mr-star-rating__btn" data-value="5" aria-label="5 stars">
                      <img src="presentation/assets/images/icons/outline/c5c5d8/star.png" alt="">
                    </button>
                  </div>
                  <label class="mr-field">
                    <textarea rows="2" aria-label="Order comment" placeholder="Leave a comment (optional)..."></textarea>
                  </label>
                  <button type="button" class="mr-btn mr-btn--primary mr-btn--sm mr-history-card__submit">Submit</button>
                </div>
              </div>
            </article>

            <article class="mr-card mr-order mr-history-card" data-status="delivered" data-name="ORD-7391 MediCare Plus">
              <button type="button" class="mr-order__head mr-history-card__toggle">
                <span class="mr-order__id">
                  <span class="mr-eyebrow mr-eyebrow--mono">#ORD-7391</span>
                  <span>
                    <strong>MediCare Plus</strong>
                    <span class="mr-eyebrow">Oct 12, 2023 &bull; 2 items</span>
                  </span>
                </span>
                <span class="mr-order__tags">
                  <strong class="mr-history-card__price">LKR 11,250.00</strong>
                  <span class="mr-badge mr-badge--success mr-badge--case-normal">Delivered</span>
                  <span class="mr-history-card__chevron" aria-hidden="true">
                    <img src="presentation/assets/images/icons/filled/2d3fd7/expand-arrow.png" alt="">
                  </span>
                </span>
              </button>

              <div class="mr-history-card__body">
                <div class="mr-history-card__details">
                  <h3>Items</h3>
                  <div class="mr-history-card__items">
                    <div class="mr-order-lines__row">
                      <strong>Lisinopril 10mg (30 tabs)</strong>
                      <i class="mr-order-lines__rule"></i>
                      <span>LKR 1,500.00</span>
                    </div>
                    <div class="mr-order-lines__row">
                      <strong>Atorvastatin 20mg (90 tabs)</strong>
                      <i class="mr-order-lines__rule"></i>
                      <span>LKR 9,750.00</span>
                    </div>
                  </div>
                  <div class="mr-history-card__actions">
                    <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-open="mr-invoice-modal" data-subject="#ORD-7391">View Invoice</button>
                    <button type="button" class="mr-btn mr-btn--primary mr-btn--sm" data-modal-open="mr-reorder-expired-modal" data-subject="#ORD-7391">Reorder All</button>
                  </div>
                </div>

                <div class="mr-history-card__rate">
                  <h3>Rate this pharmacy</h3>
                  <div class="mr-star-rating" data-rating="0">
                    <button type="button" class="mr-star-rating__btn" data-value="1" aria-label="1 star">
                      <img src="presentation/assets/images/icons/outline/c5c5d8/star.png" alt="">
                    </button>
                    <button type="button" class="mr-star-rating__btn" data-value="2" aria-label="2 stars">
                      <img src="presentation/assets/images/icons/outline/c5c5d8/star.png" alt="">
                    </button>
                    <button type="button" class="mr-star-rating__btn" data-value="3" aria-label="3 stars">
                      <img src="presentation/assets/images/icons/outline/c5c5d8/star.png" alt="">
                    </button>
                    <button type="button" class="mr-star-rating__btn" data-value="4" aria-label="4 stars">
                      <img src="presentation/assets/images/icons/outline/c5c5d8/star.png" alt="">
                    </button>
                    <button type="button" class="mr-star-rating__btn" data-value="5" aria-label="5 stars">
                      <img src="presentation/assets/images/icons/outline/c5c5d8/star.png" alt="">
                    </button>
                  </div>
                  <label class="mr-field">
                    <textarea rows="2" aria-label="Order comment" placeholder="Leave a comment (optional)..."></textarea>
                  </label>
                  <button type="button" class="mr-btn mr-btn--primary mr-btn--sm mr-history-card__submit">Submit</button>
                </div>
              </div>
            </article>

            <article class="mr-card mr-order mr-history-card mr-history-card--canceled" data-status="canceled" data-name="ORD-7204 HealthMart Local">
              <div class="mr-order__head">
                <div class="mr-order__id">
                  <span class="mr-eyebrow mr-eyebrow--mono">#ORD-7204</span>
                  <div>
                    <strong>HealthMart Local</strong>
                    <span class="mr-eyebrow">Sep 05, 2023 &bull; 1 item</span>
                  </div>
                </div>
                <div class="mr-order__tags">
                  <strong class="mr-history-card__price">LKR 2,200.00</strong>
                  <span class="mr-badge mr-badge--danger mr-badge--case-normal">Canceled</span>
                  <span class="mr-history-card__no-rating">No rating</span>
                </div>
              </div>
            </article>

            <p class="mr-history-list__empty" hidden>No orders match this filter.</p>
          </div>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-med-stats">
            <h2>Most ordered medicines</h2>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>Lisinopril</span>
                <strong>12 orders</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 85%;"></div></div>
            </div>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>Metformin</span>
                <strong>8 orders</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 60%; opacity: .8;"></div></div>
            </div>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>Amlodipine</span>
                <strong>5 orders</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 35%; opacity: .6;"></div></div>
            </div>
          </section>

          <div class="mr-dropzone mr-history-empty" hidden>
            <span class="mr-icon-badge mr-icon-badge--white mr-icon-badge--lg">
              <img src="presentation/assets/images/icons/filled/5c5e67/box.png" alt="">
            </span>
            <h3>No orders yet</h3>
            <p>When you place an order with a pharmacy, it will appear here.</p>
            <a href="nearby-pharmacies.php" class="mr-link--sm">Browse Pharmacies</a>
          </div>

        </div>
      </div>
    </main>
  </div>

  <div class="mr-modal<?= $mr_modal === 'mr-cancel-order-modal' ? ' is-open' : '' ?>" id="mr-cancel-order-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Cancel <span data-subject-slot="request"></span>?</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <?php if ($mr_modal === 'mr-cancel-order-modal') { $flash = $mr_error; require __DIR__ . '/../partials/auth-flash.php'; } ?>

      <p class="mr-modal__text">You can cancel while the request is still pending. Your prescription file stays on record.</p>

      <form class="mr-auth-form mr-modal__form" method="post" action="order-history.php">
        <?= $mr_csrf ?>
        <input type="hidden" name="action" value="cancel">
        <?php $mr_old = $mr_old_in('mr-cancel-order-modal'); ?>
        <input type="hidden" name="prescription_id" value="<?= $mr_old('prescription_id') ?>">

        <div class="mr-modal__actions">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Keep request</button>
          <button type="submit" class="mr-btn mr-btn--danger-outline mr-btn--sm">Cancel request</button>
        </div>
      </form>
    </div>
  </div>

  <div class="mr-modal<?= $mr_modal === 'mr-edit-note-modal' ? ' is-open' : '' ?>" id="mr-edit-note-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Edit note — <span data-subject-slot="request"></span></h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <?php if ($mr_modal === 'mr-edit-note-modal') { $flash = $mr_error; require __DIR__ . '/../partials/auth-flash.php'; } ?>

      <form class="mr-auth-form mr-modal__form" method="post" action="order-history.php">
        <?= $mr_csrf ?>
        <input type="hidden" name="action" value="update_note">
        <?php $mr_old = $mr_old_in('mr-edit-note-modal'); ?>
        <input type="hidden" name="prescription_id" value="<?= $mr_old('prescription_id') ?>">
        <label class="mr-field">
          <span>Note for the pharmacist</span>
          <textarea name="note" rows="3" maxlength="500"><?= $mr_old('note') ?></textarea>
        </label>

        <div class="mr-modal__actions">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Save changes</button>
        </div>
      </form>
    </div>
  </div>

  <div class="mr-modal" id="mr-invoice-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Invoice <span data-subject-slot="order"></span></h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <p class="mr-modal__text">The invoice lists every item, the pharmacy that filled it, the delivery fee and how you paid. Print it or save it as a PDF from the print dialog.</p>

      <div class="mr-modal__actions">
        <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Close</button>
        <button type="button" class="mr-btn mr-btn--primary mr-btn--sm" onclick="window.print()">Print / Save PDF</button>
      </div>
    </div>
  </div>

  <div class="mr-modal" id="mr-reorder-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Reorder <span data-subject-slot="order"></span></h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <p class="mr-modal__text">The original prescription is valid until Mar 14, 2027, so the same items can be sent to nearby pharmacies again. You'll confirm the price before anything is prepared.</p>

      <div class="mr-modal__actions">
        <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
        <a class="mr-btn mr-btn--primary mr-btn--sm" href="pharmacy-responses.php">Reorder</a>
      </div>
    </div>
  </div>

  <div class="mr-modal" id="mr-reorder-expired-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Prescription expired</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <p class="mr-modal__text">The prescription for <span data-subject-slot="this order"></span> expired on Aug 30, 2026, so it can't be reordered. Upload a new prescription to place the order again.</p>

      <div class="mr-modal__actions">
        <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
        <a class="mr-btn mr-btn--primary mr-btn--sm" href="patient-order.php">Upload new Rx</a>
      </div>
    </div>
  </div>
