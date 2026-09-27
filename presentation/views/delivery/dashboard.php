<?php
$title  = 'Delivery Dashboard — MedReach';
$active = 'dashboard';

$mr_available = mr_delivery_available_tasks();
$mr_mine      = mr_delivery_my_tasks();
$mr_cash      = array_sum(array_column($mr_mine, 'cod_amount'));
$mr_csrf      = '<input type="hidden" name="csrf" value="' . mr_csrf_token() . '">';

$mr_mine_badge = [
  'assigned'  => 'mr-badge--accent',
  'picked_up' => 'mr-badge--primary',
];
?>
  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <div>
          <h1>Good Day, <?= htmlspecialchars($_SESSION['name'] ?? 'Rider') ?></h1>
          <p class="mr-eyebrow"><?= count($mr_mine) ?> active in your manifest &middot; <?= count($mr_available) ?> waiting to be accepted</p>
        </div>
      </header>

      <?php if ($flash): ?>
        <span hidden data-flash-toast="<?= htmlspecialchars($flash['text']) ?>" data-flash-error="<?= $flash['type'] === 'error' ? 'true' : 'false' ?>"></span>
      <?php endif; ?>

      <div class="mr-stat-grid-3">
        <section class="mr-card mr-mini-stat">
          <div>
            <span class="mr-eyebrow mr-eyebrow--mono">Available Tasks</span>
            <strong><?= count($mr_available) ?></strong>
          </div>
          <span class="mr-icon-badge mr-icon-badge--info mr-icon-badge--lg">
            <img src="presentation/assets/images/icons/filled/2d3fd7/delivery.png" alt="">
          </span>
        </section>

        <section class="mr-card mr-mini-stat">
          <div>
            <span class="mr-eyebrow mr-eyebrow--mono">My Active Tasks</span>
            <strong><?= count($mr_mine) ?></strong>
          </div>
          <span class="mr-icon-badge mr-icon-badge--success mr-icon-badge--lg">
            <img src="presentation/assets/images/icons/filled/1f9d6b/checklist.png" alt="">
          </span>
        </section>

        <section class="mr-card mr-mini-stat mr-mini-stat--accent">
          <div>
            <span class="mr-eyebrow mr-eyebrow--mono">Cash to Collect</span>
            <strong>LKR <?= number_format($mr_cash, 2) ?></strong>
          </div>
          <span class="mr-icon-badge mr-icon-badge--accent mr-icon-badge--lg">
            <img src="presentation/assets/images/icons/filled/dd8e1c/cash.png" alt="">
          </span>
        </section>
      </div>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Available deliveries</h2>
              <span class="mr-badge mr-badge--pill mr-badge--case-normal">Total: <?= count($mr_available) ?></span>
            </div>

            <div class="mr-pay-table-wrap">
              <table class="mr-pay-table">
                <thead>
                  <tr>
                    <th>Pharmacy</th>
                    <th>City</th>
                    <th>Drop-off address</th>
                    <th class="mr-pay-table__amount">COD</th>
                    <th class="mr-pay-table__amount">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($mr_available as $t): ?>
                  <tr>
                    <td><strong><?= htmlspecialchars($t['pharmacy_name']) ?></strong></td>
                    <td><?= htmlspecialchars($t['pharmacy_city']) ?></td>
                    <td><?= htmlspecialchars($t['dropoff_address']) ?></td>
                    <td class="mr-pay-table__amount">LKR <?= $t['cod_display'] ?></td>
                    <td class="mr-pay-table__amount">
                      <form method="post" action="delivery-dashboard.php">
                        <?= $mr_csrf ?>
                        <input type="hidden" name="delivery_id" value="<?= (int) $t['delivery_id'] ?>">
                        <button type="submit" name="action" value="accept" class="mr-btn mr-btn--dark mr-btn--sm">Accept</button>
                      </form>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>

            <p class="mr-roster-empty"<?= $mr_available ? ' hidden' : '' ?>>No available deliveries right now. Check back soon.</p>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>My deliveries</h2>
              <span class="mr-badge mr-badge--pill mr-badge--case-normal">Total: <?= count($mr_mine) ?></span>
            </div>

            <div class="mr-pay-table-wrap">
              <table class="mr-pay-table">
                <thead>
                  <tr>
                    <th>Pharmacy</th>
                    <th>Drop-off address</th>
                    <th class="mr-pay-table__amount">COD</th>
                    <th>Status</th>
                    <th class="mr-pay-table__amount">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($mr_mine as $t): $mr_badge = $mr_mine_badge[$t['status']] ?? 'mr-badge--pill'; ?>
                  <tr>
                    <td><strong><?= htmlspecialchars($t['pharmacy_name']) ?></strong></td>
                    <td><?= htmlspecialchars($t['dropoff_address']) ?></td>
                    <td class="mr-pay-table__amount">LKR <?= $t['cod_display'] ?></td>
                    <td><span class="mr-badge <?= $mr_badge ?>"><span class="mr-badge__dot"></span><?= $t['status_label'] ?></span></td>
                    <td class="mr-pay-table__amount">
                      <a class="mr-btn mr-btn--light mr-btn--sm" href="delivery-details.php?id=<?= (int) $t['delivery_id'] ?>">View</a>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>

            <p class="mr-roster-empty"<?= $mr_mine ? ' hidden' : '' ?>>You have no active deliveries. Accept one from the list above.</p>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-courier-card mr-payment-card">
            <span class="mr-payment-card__label">
              <img src="presentation/assets/images/icons/filled/ffffff/checklist.png" alt="">
              How it works
            </span>
            <h2>Accept &rarr; Pick up &rarr; Deliver</h2>
            <p>Accept a task to add it to your manifest. Open it to mark it picked up and, once handed over with cash collected, delivered. You can still release a task back to the pool before you pick it up.</p>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Status guide</h2>
            </div>
            <div class="mr-profile-details">
              <div class="mr-profile-details__item">
                <span class="mr-eyebrow">Assigned</span>
                <strong>Accepted, not yet picked up</strong>
              </div>
              <div class="mr-profile-details__item">
                <span class="mr-eyebrow">Picked Up</span>
                <strong>On the way to drop-off</strong>
              </div>
              <div class="mr-profile-details__item">
                <span class="mr-eyebrow">Delivered</span>
                <strong>Cash collected, task complete</strong>
              </div>
            </div>
          </section>

        </div>
      </div>
    </main>
  </div>
