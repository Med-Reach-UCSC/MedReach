<?php
$title = 'User Management — MedReach';
$charts = true;
$active = 'users';

$mr_users  = mr_admin_users();
$mr_count  = fn (string $key, string $value) => count(array_filter($mr_users, fn ($u) => $u[$key] === $value));
$mr_total  = max(count($mr_users), 1);
$mr_roles  = ['patient' => 'Patients', 'pharmacist' => 'Pharmacists', 'delivery' => 'Delivery', 'admin' => 'Admins'];
$mr_dots   = ['patient' => 'mr-spend-dot--primary', 'pharmacist' => 'mr-spend-dot--light', 'delivery' => 'mr-spend-dot--accent', 'admin' => 'mr-spend-dot--muted'];
$mr_badges = ['active' => 'mr-badge--success', 'pending' => 'mr-badge--accent', 'deactivated' => 'mr-badge--pill'];
$mr_error  = $flash && $flash['type'] === 'error' ? $flash : null;
$mr_modal  = $mr_error['modal'] ?? null;
$mr_old_in = fn (string $modal) => fn (string $key) => htmlspecialchars($mr_modal === $modal ? ($_POST[$key] ?? '') : '');
$mr_role   = $mr_modal === 'mr-user-create-modal' ? ($_POST['role'] ?? 'patient') : 'patient';
$mr_csrf   = '<input type="hidden" name="csrf" value="' . mr_csrf_token() . '">';
?>
  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <h1>User Management</h1>

        <div class="mr-dash-header__actions">
          <label class="mr-pharm-search">
            <img src="presentation/assets/images/icons/filled/454655/search.png" alt="">
            <input type="search" id="mr-user-search" placeholder="Search users..." aria-label="Search users">
          </label>
        </div>
      </header>

      <?php if ($flash && !$mr_modal): ?>
        <span hidden data-flash-toast="<?= htmlspecialchars($flash['text']) ?>" data-flash-error="<?= $mr_error ? 'true' : 'false' ?>"></span>
      <?php endif; ?>

      <div class="mr-stat-grid-4">
        <?php foreach ([
          ['Total Users', count($mr_users), 'info', '2d3fd7/conference-call'],
          ['Active', $mr_count('status', 'active'), 'success', '1f9d6b/checkmark'],
          ['Pending Approval', $mr_count('status', 'pending'), 'accent', 'dd8e1c/hourglass'],
          ['Suspended', $mr_count('status', 'deactivated'), 'danger', 'de4a4f/warning-shield'],
        ] as [$mr_label, $mr_value, $mr_tone, $mr_icon]): ?>
        <section class="mr-card mr-mini-stat<?= $mr_tone === 'accent' ? ' mr-mini-stat--accent' : '' ?>">
          <div>
            <span class="mr-eyebrow mr-eyebrow--mono"><?= $mr_label ?></span>
            <strong><?= $mr_value ?></strong>
          </div>
          <span class="mr-icon-badge mr-icon-badge--<?= $mr_tone ?> mr-icon-badge--lg">
            <img src="presentation/assets/images/icons/filled/<?= $mr_icon ?>.png" alt="">
          </span>
        </section>
        <?php endforeach; ?>
      </div>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>User Ledger</h2>
            </div>

            <div class="mr-roster-toolbar">
              <div class="mr-roster-toolbar__chips">
                <label class="mr-roster-filter">
                  <img src="presentation/assets/images/icons/filled/454655/filter.png" alt="">
                  <select id="mr-user-role-filter" aria-label="Filter by role">
                    <option value="">Filtered: All</option>
                    <?php foreach (MR_ROLE_LABELS as $mr_key => $mr_label): ?>
                      <option value="<?= $mr_key ?>">Filtered: <?= $mr_label ?></option>
                    <?php endforeach; ?>
                  </select>
                </label>
                <span class="mr-badge mr-badge--pill mr-badge--case-normal">Total: <?= count($mr_users) ?></span>
              </div>

              <button type="button" class="mr-btn mr-btn--primary mr-btn--sm" data-modal-open="mr-user-create-modal">
                <img src="presentation/assets/images/icons/filled/ffffff/plus.png" alt="">
                Create User
              </button>
            </div>

            <div class="mr-pay-table-wrap">
              <table class="mr-pay-table" id="mr-user-table">
                <thead>
                  <tr>
                    <th data-sort="id">User ID</th>
                    <th data-sort="name">User</th>
                    <th data-sort="role">Role</th>
                    <th data-sort="status">Status</th>
                    <th data-sort="joined">Joined</th>
                    <th class="mr-pay-table__amount">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($mr_users as $u): $mr_name = htmlspecialchars($u['name']); ?>
                  <tr data-id="<?= sprintf('%06d', $u['user_id']) ?>" data-name="<?= htmlspecialchars(mb_strtolower("{$u['code']} {$u['name']} {$u['email']}")) ?>" data-role="<?= $u['role'] ?>" data-status="<?= $u['status'] ?>" data-joined="<?= $u['created_at'] ?>">
                    <td><span class="mr-eyebrow mr-eyebrow--mono"><?= $u['code'] ?></span></td>
                    <td>
                      <div class="mr-user-cell">
                        <span class="mr-avatar mr-avatar--dash"><?= htmlspecialchars($u['initials']) ?></span>
                        <span>
                          <strong><?= $mr_name ?></strong>
                          <small class="mr-user-cell__email"><?= htmlspecialchars($u['email']) ?></small>
                        </span>
                      </div>
                    </td>
                    <td><?= MR_ROLE_LABELS[$u['role']] ?></td>
                    <td><span class="mr-badge <?= $mr_badges[$u['status']] ?>"><span class="mr-badge__dot"></span><?= MR_STATUS_LABELS[$u['status']] ?></span></td>
                    <td><?= date('j M Y', strtotime($u['created_at'])) ?></td>
                    <td class="mr-pay-table__amount">
                      <button type="button" class="mr-table-menu-btn" aria-label="Actions for <?= $mr_name ?>">
                        <img src="presentation/assets/images/icons/filled/454655/more.png" alt="">
                      </button>
                      <div class="mr-row-menu" hidden>
                        <button type="button" data-modal-open="mr-user-edit-modal" data-subject="<?= $mr_name ?>" data-fill="<?= htmlspecialchars(json_encode(['user_id' => $u['user_id'], 'first_name' => $u['first_name'], 'last_name' => $u['last_name'], 'email' => $u['email'], 'phone' => $u['phone']])) ?>">Edit details</button>
                        <?php if (!$u['is_self']): ?>
                        <form method="post" action="manage-users.php">
                          <?= $mr_csrf ?>
                          <input type="hidden" name="user_id" value="<?= $u['user_id'] ?>">
                          <?php if ($u['status'] === 'pending'): ?>
                            <button type="submit" name="action" value="approve">Approve account</button>
                          <?php elseif ($u['status'] === 'deactivated'): ?>
                            <button type="submit" name="action" value="reactivate">Reactivate</button>
                          <?php else: ?>
                            <button type="submit" name="action" value="suspend" class="mr-row-menu__danger" data-confirm="Suspend <?= $mr_name ?>?" data-confirm-text="They'll be signed out and can't sign in until an admin reactivates the account." data-confirm-label="Suspend">Suspend</button>
                          <?php endif; ?>
                          <button type="submit" name="action" value="delete" class="mr-row-menu__danger" data-confirm="Delete <?= $mr_name ?>?" data-confirm-text="The account and its profile are removed for good. Suspend it instead if they may need access again." data-confirm-label="Delete">Delete</button>
                        </form>
                        <?php endif; ?>
                      </div>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>

            <p class="mr-roster-empty"<?= $mr_users ? ' hidden' : '' ?>>No users match this search or filter.</p>

            <div class="mr-pagination">
              <span class="mr-pagination__count" id="mr-user-count">Showing <?= $mr_users ? '1-' . count($mr_users) : '0' ?> of <?= count($mr_users) ?></span>
            </div>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Role Distribution</h2>
            </div>

            <div class="mr-spend-ring">
              <canvas id="mr-role-chart" width="128" height="128" role="img" data-values="<?= implode(',', array_map(fn ($r) => $mr_count('role', $r), array_keys($mr_roles))) ?>" aria-label="Role distribution: <?= implode(', ', array_map(fn ($r, $l) => $mr_count('role', $r) . " $l", array_keys($mr_roles), $mr_roles)) ?>"></canvas>
              <div class="mr-spend-ring__inner">
                <span>Roles</span>
                <strong>4</strong>
              </div>
            </div>

            <?php foreach ($mr_roles as $mr_key => $mr_label): ?>
            <div class="mr-spend-row">
              <span class="mr-spend-row__label">
                <i class="mr-spend-dot <?= $mr_dots[$mr_key] ?>"></i>
                <?= $mr_label ?>
              </span>
              <strong><?= round($mr_count('role', $mr_key) * 100 / $mr_total) ?>%</strong>
            </div>
            <?php endforeach; ?>
          </section>

          <section class="mr-card mr-notif-list">
            <div class="mr-notif-list__section">
              <span class="mr-eyebrow">Newest Accounts</span>

              <?php foreach (array_slice($mr_users, 0, 4) as $u): ?>
              <div class="mr-notif-item">
                <span class="mr-icon-badge mr-icon-badge--<?= $u['status'] === 'pending' ? 'accent' : 'info' ?>">
                  <img src="presentation/assets/images/icons/filled/<?= $u['status'] === 'pending' ? 'dd8e1c/hourglass' : '2d3fd7/conference-call' ?>.png" alt="">
                </span>
                <span class="mr-notif-item__info">
                  <span class="mr-notif-item__title"><?= htmlspecialchars($u['name']) ?> joined as <?= MR_ROLE_LABELS[$u['role']] ?><?= $u['status'] === 'pending' ? ' — awaiting approval' : '' ?></span>
                </span>
                <span class="mr-notif-item__time"><?= date('j M', strtotime($u['created_at'])) ?></span>
              </div>
              <?php endforeach; ?>
            </div>
          </section>

        </div>
      </div>
    </main>
  </div>

  <div class="mr-modal<?= $mr_modal === 'mr-user-create-modal' ? ' is-open' : '' ?>" id="mr-user-create-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Create user</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <?php if ($mr_modal === 'mr-user-create-modal') { $flash = $mr_error; require __DIR__ . '/../partials/auth-flash.php'; } ?>

      <form class="mr-auth-form mr-auth-form--grid mr-modal__form" method="post" action="manage-users.php">
        <?= $mr_csrf ?>
        <input type="hidden" name="action" value="create">
        <?php $mr_old = $mr_old_in('mr-user-create-modal'); ?>
        <?php $mr_prefix = 'create'; require __DIR__ . '/../partials/user-fields.php'; ?>
        <div class="mr-field mr-field--span2">
          <label for="create-role">Role</label>
          <div class="mr-field__input">
            <select id="create-role" name="role" data-role-select required>
              <?php foreach (MR_ROLE_LABELS as $mr_key => $mr_label): ?>
                <option value="<?= $mr_key ?>"<?= $mr_key === $mr_role ? ' selected' : '' ?>><?= $mr_label ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <?php require __DIR__ . '/../partials/role-fields.php'; ?>

        <p class="mr-auth-approval mr-field--span2">The account is active straight away. We email the user to set their password with "Forgot password".</p>

        <div class="mr-modal__actions mr-field--span2">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Create user</button>
        </div>
      </form>
    </div>
  </div>

  <div class="mr-modal<?= $mr_modal === 'mr-user-edit-modal' ? ' is-open' : '' ?>" id="mr-user-edit-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Edit <span data-subject-slot="account"></span></h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <?php if ($mr_modal === 'mr-user-edit-modal') { $flash = $mr_error; require __DIR__ . '/../partials/auth-flash.php'; } ?>

      <form class="mr-auth-form mr-auth-form--grid mr-modal__form" method="post" action="manage-users.php">
        <?= $mr_csrf ?>
        <input type="hidden" name="action" value="update">
        <?php $mr_old = $mr_old_in('mr-user-edit-modal'); ?>
        <input type="hidden" name="user_id" value="<?= $mr_old('user_id') ?>">
        <?php $mr_prefix = 'edit'; require __DIR__ . '/../partials/user-fields.php'; ?>

        <div class="mr-modal__actions mr-field--span2">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Save changes</button>
        </div>
      </form>
    </div>
  </div>
