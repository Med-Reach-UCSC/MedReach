<?php
$mr_id   = mr_valid_delivery_id($_GET['id'] ?? null);
$mr_task = $mr_id ? mr_delivery_task_for_view($mr_id) : null;
if (!$mr_task) {
  mr_error_page(404);
}

$title  = 'Delivery #' . $mr_task['delivery_id'] . ' — MedReach';
$active = 'manifest';

$mr_csrf   = '<input type="hidden" name="csrf" value="' . mr_csrf_token() . '">';
$mr_hidden = $mr_csrf . '<input type="hidden" name="delivery_id" value="' . (int) $mr_task['delivery_id'] . '">';

$mr_steps    = ['assigned', 'picked_up', 'delivered'];
$mr_step_pos = array_search($mr_task['status'], $mr_steps, true);
$mr_step_pos = $mr_step_pos === false ? -1 : $mr_step_pos;

$mr_status_badge = [
  'assigned'  => 'mr-badge--accent',
  'picked_up' => 'mr-badge--primary',
  'delivered' => 'mr-badge--success',
][$mr_task['status']] ?? 'mr-badge--pill';

$mr_next_label = [
  'assigned'  => 'Mark as Picked Up',
  'picked_up' => 'Mark as Delivered',
][$mr_task['status']] ?? null;
?>
  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <div>
          <div class="mr-track-title">
            <h1>Delivery #<?= $mr_task['delivery_id'] ?></h1>
            <span class="mr-badge <?= $mr_status_badge ?> mr-badge--case-normal">
              <img src="presentation/assets/images/icons/filled/ffffff/delivery.png" alt="">
              <?= $mr_task['status_label'] ?>
            </span>
          </div>
          <div class="mr-order__tags">
            <span class="mr-badge mr-badge--pill mr-badge--case-normal">
              <img src="presentation/assets/images/icons/filled/454655/shop.png" alt="">
              <?= htmlspecialchars($mr_task['pharmacy_name']) ?>
            </span>
            <span class="mr-badge mr-badge--pill mr-badge--case-normal">
              <img src="presentation/assets/images/icons/filled/454655/hospital-3.png" alt="">
              <?= htmlspecialchars($mr_task['pharmacy_city']) ?>
            </span>
            <span class="mr-badge mr-badge--pill mr-badge--case-normal">
              <img src="presentation/assets/images/icons/filled/dd8e1c/cash.png" alt="">
              Cash on delivery
            </span>
          </div>
        </div>

        <div class="mr-dash-header__actions">
          <a href="delivery-dashboard.php" class="mr-btn mr-btn--light mr-btn--sm">Back to dashboard</a>
        </div>
      </header>

      <?php if ($flash): ?>
        <span hidden data-flash-toast="<?= htmlspecialchars($flash['text']) ?>" data-flash-error="<?= $flash['type'] === 'error' ? 'true' : 'false' ?>"></span>
      <?php endif; ?>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-tracking-card">
            <div class="mr-tracking-card__head">
              <h3>Delivery Progress</h3>
              <span class="mr-eyebrow mr-eyebrow--mono">#<?= $mr_task['delivery_id'] ?></span>
            </div>

            <ol class="mr-timeline">
              <?php foreach ($mr_steps as $mr_i => $mr_step): ?>
              <li class="mr-timeline__step<?= $mr_i < $mr_step_pos ? '' : ($mr_i === $mr_step_pos ? ' mr-timeline__step--active' : ' mr-timeline__step--pending') ?>">
                <strong><?= MR_DELIVERY_STATUS_LABELS[$mr_step] ?></strong>
                <?php if ($mr_step === 'assigned'): ?>
                  <small><?= htmlspecialchars($mr_task['pharmacy_name']) ?>, <?= htmlspecialchars($mr_task['pharmacy_city']) ?></small>
                <?php else: ?>
                  <small><?= htmlspecialchars($mr_task['dropoff_address']) ?></small>
                <?php endif; ?>
              </li>
              <?php endforeach; ?>
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
              <div class="mr-order-lines__row mr-order-lines__row--total">
                <span>Total to Collect</span>
                <i class="mr-order-lines__rule"></i>
                <strong>LKR <?= $mr_task['cod_display'] ?></strong>
              </div>
            </div>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>
                <img class="mr-heading-icon" src="presentation/assets/images/icons/filled/757687/box.png" alt="">
                Drop-off Details
              </h2>
            </div>
            <div class="mr-profile-details">
              <div class="mr-profile-details__item">
                <span class="mr-eyebrow">Drop-off address</span>
                <strong><?= htmlspecialchars($mr_task['dropoff_address']) ?></strong>
              </div>
              <div class="mr-profile-details__item">
                <span class="mr-eyebrow">Pharmacy</span>
                <strong><?= htmlspecialchars($mr_task['pharmacy_name']) ?>, <?= htmlspecialchars($mr_task['pharmacy_address']) ?></strong>
              </div>
              <div class="mr-profile-details__item">
                <span class="mr-eyebrow">Payment Method</span>
                <strong>Cash on Delivery</strong>
              </div>
            </div>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-courier-card mr-payment-card">
            <span class="mr-payment-card__label">
              <img src="presentation/assets/images/icons/filled/ffffff/delivery.png" alt="">
              <?= $mr_task['status_label'] ?>
            </span>
            <h2>LKR <?= $mr_task['cod_display'] ?></h2>
            <p>
              <?php if ($mr_task['status'] === 'delivered'): ?>
                This task is complete. Cash was collected and handed over.
              <?php else: ?>
                Confirm each step as you go. Only mark it delivered once the package is handed over and payment is collected.
              <?php endif; ?>
            </p>
          </section>

          <?php if ($mr_next_label): ?>
          <form method="post" action="delivery-details.php?id=<?= $mr_task['delivery_id'] ?>">
            <?= $mr_hidden ?>
            <button type="submit" name="action" value="advance" class="mr-btn mr-btn--primary mr-btn--block">
              <img src="presentation/assets/images/icons/filled/ffffff/checkmark.png" alt="">
              <?= $mr_next_label ?>
            </button>
          </form>
          <?php endif; ?>

          <?php if ($mr_task['status'] === 'assigned'): ?>
          <form method="post" action="delivery-details.php?id=<?= $mr_task['delivery_id'] ?>">
            <?= $mr_hidden ?>
            <button type="submit" name="action" value="release" class="mr-btn mr-btn--danger-outline mr-btn--block"
              data-confirm="Release this task?"
              data-confirm-text="It goes back to the available list for any rider to accept. You can't undo this."
              data-confirm-label="Release task">
              Release task
            </button>
          </form>
          <?php endif; ?>

        </div>
      </div>
    </main>
  </div>
  