<?php
$id         = (int) ($_GET['id'] ?? 0);
$mr_request = mr_prescription_detail($id);
if (!$mr_request) {
  mr_error_page(404);
}

$title     = 'Prescription #' . $mr_request['prescription_id'] . ' — MedReach';
$bodyClass = 'mr-page-request';
$active    = 'requests';

$mr_error  = $flash && $flash['type'] === 'error' ? $flash : null;
$mr_modal  = $mr_error['modal'] ?? null;
$mr_old_in = fn (string $modal) => fn (string $key) => htmlspecialchars($mr_modal === $modal ? (string) ($_POST[$key] ?? '') : '');
$mr_csrf   = '<input type="hidden" name="csrf" value="' . mr_csrf_token() . '">';
$mr_action = 'prescription-request.php?id=' . $mr_request['prescription_id'];
$mr_file_url = 'pharmacy-prescription-file.php?id=' . $mr_request['prescription_id'];
?>
  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <div>
          <a class="mr-link mr-link--sm" href="orders.php">&larr; Back to orders</a>
          <h1>Prescription #<?= $mr_request['prescription_id'] ?></h1>
        </div>

        <div class="mr-dash-header__actions">
          <span class="mr-badge mr-badge--pill mr-badge--case-normal">
            <img src="presentation/assets/images/icons/filled/454655/user.png" alt="">
            <?= htmlspecialchars($mr_request['patient_first_name']) ?>
          </span>
          <span class="mr-badge mr-badge--pill mr-badge--case-normal">
            <img src="presentation/assets/images/icons/filled/dd8e1c/clock.png" alt="">
            <?= date('j M, g:i A', strtotime($mr_request['created_at'])) ?>
          </span>
          <button type="button" class="mr-icon-btn" aria-label="Print request" onclick="window.print()">
            <img src="presentation/assets/images/icons/filled/454655/print.png" alt="">
          </button>
        </div>
      </header>

      <?php if ($flash && !$mr_modal): ?>
        <span hidden data-flash-toast="<?= htmlspecialchars($flash['text']) ?>" data-flash-error="<?= $mr_error ? 'true' : 'false' ?>"></span>
      <?php endif; ?>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>
                <img class="mr-heading-icon" src="presentation/assets/images/icons/filled/2d3fd7/document.png" alt="">
                Original Document
              </h2>
            </div>
            <div class="mr-resp-rx">
              <?php if (!str_ends_with($mr_request['image_path'], '.pdf')): ?>
              <a class="mr-resp-rx__thumb mr-resp-rx__thumb--scan" href="<?= $mr_file_url ?>" target="_blank" rel="noopener">
                <img src="<?= $mr_file_url ?>" alt="Prescription scan" onerror="this.closest('.mr-resp-rx__thumb').style.display='none'">
              </a>
              <?php endif; ?>
              <div class="mr-resp-rx__body">
                <p class="mr-resp-rx__meta">Patient: <?= htmlspecialchars($mr_request['patient_first_name']) ?></p>
                <a class="mr-btn mr-btn--ghost mr-btn--sm" href="<?= $mr_file_url ?>" target="_blank" rel="noopener">View file</a>
              </div>
            </div>
          </section>

          <?php if ($mr_request['note']): ?>
          <section class="mr-card mr-help-card mr-help-card--alert">
            <span class="mr-icon-badge mr-icon-badge--info">
              <img src="presentation/assets/images/icons/filled/2d3fd7/chat.png" alt="">
            </span>
            <div>
              <strong class="mr-eyebrow mr-eyebrow--mono">Patient Note</strong>
              <p><?= htmlspecialchars($mr_request['note']) ?></p>
            </div>
          </section>
          <?php endif; ?>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Your Quote</h2>
            </div>

            <?php if ($mr_request['is_quoted']): ?>

              <div class="mr-order-row">
                <span class="mr-icon-badge mr-icon-badge--success">
                  <img src="presentation/assets/images/icons/filled/1f9d6b/checkmark.png" alt="">
                </span>
                <div class="mr-order-row__info">
                  <strong>Quote sent</strong>
                  <span class="mr-eyebrow mr-eyebrow--mono">LKR <?= $mr_request['quoted_total_fmt'] ?></span>
                </div>
              </div>
              <p style="white-space: pre-line;"><?= nl2br(htmlspecialchars($mr_request['quoted_items'])) ?></p>

              <div class="mr-request-card__actions">
                <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-open="mr-quote-edit-modal" data-fill="<?= htmlspecialchars(json_encode(['quoted_items' => $mr_request['quoted_items'], 'quoted_total' => $mr_request['quoted_total']])) ?>">Edit quote</button>
                <form method="post" action="<?= $mr_action ?>">
                  <?= $mr_csrf ?>
                  <input type="hidden" name="prescription_id" value="<?= $mr_request['prescription_id'] ?>">
                  <button type="submit" name="action" value="withdraw" class="mr-btn mr-btn--danger-outline mr-btn--sm" data-confirm="Withdraw this quote?" data-confirm-text="The patient will no longer see your quote. You can send a new one any time before they choose a pharmacy." data-confirm-label="Withdraw">Withdraw</button>
                </form>
              </div>

            <?php else: ?>

              <?php if ($mr_modal === 'mr-quote-create-form') { $flash = $mr_error; require __DIR__ . '/../partials/auth-flash.php'; } ?>
              <?php $mr_old = $mr_old_in('mr-quote-create-form'); ?>

              <form class="mr-auth-form" method="post" action="<?= $mr_action ?>">
                <?= $mr_csrf ?>
                <input type="hidden" name="prescription_id" value="<?= $mr_request['prescription_id'] ?>">
                <input type="hidden" name="action" value="send">
                <label class="mr-field">
                  <span>Medicines &amp; prices (one per line)</span>
                  <div class="mr-field__input">
                    <textarea name="quoted_items" rows="6" maxlength="2000" required placeholder="Amoxicillin 500mg x30 - LKR 850.00&#10;Atorvastatin 20mg x30 - LKR 1200.00"><?= $mr_old('quoted_items') ?></textarea>
                  </div>
                </label>
                <label class="mr-field">
                  <span>Total price</span>
                  <div class="mr-price-field mr-price-field--block">
                    <span class="mr-price-field__prefix">LKR</span>
                    <input type="text" name="quoted_total" inputmode="decimal" pattern="\d{1,7}(\.\d{1,2})?" maxlength="10" required placeholder="0.00" value="<?= $mr_old('quoted_total') ?>">
                  </div>
                </label>
                <div class="mr-field--span2">
                  <button type="submit" class="mr-btn mr-btn--dark mr-btn--sm">Send quote</button>
                </div>
              </form>

            <?php endif; ?>
          </section>

        </div>
      </div>
    </main>
  </div>

  <div class="mr-modal<?= $mr_modal === 'mr-quote-edit-modal' ? ' is-open' : '' ?>" id="mr-quote-edit-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Edit your quote</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <?php if ($mr_modal === 'mr-quote-edit-modal') { $flash = $mr_error; require __DIR__ . '/../partials/auth-flash.php'; } ?>

      <form class="mr-auth-form mr-modal__form" method="post" action="<?= $mr_action ?>">
        <?= $mr_csrf ?>
        <input type="hidden" name="prescription_id" value="<?= $mr_request['prescription_id'] ?>">
        <input type="hidden" name="action" value="update">
        <?php $mr_old = $mr_old_in('mr-quote-edit-modal'); ?>
        <label class="mr-field">
          <span>Medicines &amp; prices (one per line)</span>
          <div class="mr-field__input">
            <textarea name="quoted_items" rows="6" maxlength="2000" required><?= $mr_old('quoted_items') ?></textarea>
          </div>
        </label>
        <label class="mr-field">
          <span>Total price</span>
          <div class="mr-price-field mr-price-field--block">
            <span class="mr-price-field__prefix">LKR</span>
            <input type="text" name="quoted_total" inputmode="decimal" pattern="\d{1,7}(\.\d{1,2})?" maxlength="10" required value="<?= $mr_old('quoted_total') ?>">
          </div>
        </label>

        <div class="mr-modal__actions">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Save changes</button>
        </div>
      </form>
    </div>
  </div>
