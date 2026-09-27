<?php
$title = 'Manage Patients — MedReach';
$active = 'family';

$mr_patients = mr_dependents();
$mr_pending  = count(array_filter($mr_patients, fn ($p) => $p['pending_count'] > 0));
$mr_error    = $flash && $flash['type'] === 'error' ? $flash : null;
$mr_modal    = $mr_error['modal'] ?? null;
$mr_old_in   = fn (string $modal) => fn (string $key) => htmlspecialchars($mr_modal === $modal ? ($_POST[$key] ?? '') : '');
$mr_csrf     = '<input type="hidden" name="csrf" value="' . mr_csrf_token() . '">';
?>
  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <h1>Manage Patients</h1>

        <div class="mr-dash-header__actions">
          <label class="mr-pharm-search">
            <img src="presentation/assets/images/icons/filled/454655/search.png" alt="">
            <input type="search" id="mr-patient-search" placeholder="Search ID or name..." aria-label="Search ID or name">
          </label>

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
        <div class="mr-roster-toolbar">
          <div class="mr-roster-toolbar__chips">
            <label class="mr-roster-filter">
              <img src="presentation/assets/images/icons/filled/454655/filter.png" alt="">
              <select id="mr-patient-status-filter" aria-label="Filter by status">
                <option value="">Filtered: All</option>
                <option value="pending">Filtered: Pending prescription</option>
                <option value="clear">Filtered: No active orders</option>
              </select>
            </label>
            <span class="mr-badge mr-badge--pill mr-badge--case-normal">Total: <?= count($mr_patients) ?></span>
          </div>

          <button type="button" class="mr-btn mr-btn--primary mr-btn--sm" data-modal-open="mr-patient-create-modal">
            <img src="presentation/assets/images/icons/filled/ffffff/plus.png" alt="">
            Add Patient
          </button>
        </div>

        <div class="mr-pay-table-wrap">
          <table class="mr-pay-table" id="mr-patient-table">
            <thead>
              <tr>
                <th data-sort="name">Patient ID / Name</th>
                <th data-sort="age">Age</th>
                <th data-sort="status">Status</th>
                <th data-sort="added">Added</th>
                <th class="mr-pay-table__amount">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($mr_patients as $p): $mr_name = htmlspecialchars($p['name']); $mr_busy = $p['pending_count'] > 0; ?>
              <tr data-name="<?= htmlspecialchars(mb_strtolower("{$p['code']} {$p['name']} {$p['email']}")) ?>" data-age="<?= $p['age'] ?? -1 ?>" data-status="<?= $mr_busy ? 'pending' : 'clear' ?>" data-added="<?= $p['created_at'] ?>">
                <td>
                  <div class="mr-user-cell">
                    <span class="mr-avatar mr-avatar--dash"><?= htmlspecialchars($p['initials']) ?></span>
                    <span>
                      <span class="mr-patient-id"><?= $p['code'] ?></span>
                      <strong><?= $mr_name ?></strong>
                      <small class="mr-user-cell__email"><?= htmlspecialchars($p['email']) ?></small>
                    </span>
                  </div>
                </td>
                <td><span class="mr-eyebrow"><?= $p['age'] === null ? '—' : "{$p['age']} yrs" ?></span></td>
                <td>
                  <?php if ($mr_busy): ?>
                    <span class="mr-badge mr-badge--accent"><span class="mr-badge__dot"></span>Pending prescription</span>
                  <?php else: ?>
                    <span class="mr-badge mr-badge--success"><span class="mr-badge__dot"></span>No active orders</span>
                  <?php endif; ?>
                </td>
                <td><span class="mr-eyebrow mr-eyebrow--mono"><?= date('j M Y', strtotime($p['created_at'])) ?></span></td>
                <td class="mr-pay-table__amount">
                  <button type="button" class="mr-table-menu-btn" aria-label="Actions for <?= $mr_name ?>">
                    <img src="presentation/assets/images/icons/filled/454655/more.png" alt="">
                  </button>
                  <div class="mr-row-menu" hidden>
                    <a href="order-history.php">View orders</a>
                    <button type="button" data-modal-open="mr-patient-edit-modal" data-subject="<?= $mr_name ?>" data-fill="<?= htmlspecialchars(json_encode(['patient_id' => $p['patient_id'], 'first_name' => $p['first_name'], 'last_name' => $p['last_name'], 'email' => $p['email'], 'phone' => $p['phone'], 'date_of_birth' => $p['date_of_birth'] ?? '', 'address' => $p['address'] ?? ''])) ?>">Edit details</button>
                    <?php if ($mr_busy): ?>
                      <button type="button" class="mr-row-menu__danger" data-modal-open="mr-remove-blocked-modal" data-subject="<?= $mr_name ?>">Remove patient</button>
                    <?php else: ?>
                      <form method="post" action="manage-patients.php">
                        <?= $mr_csrf ?>
                        <input type="hidden" name="patient_id" value="<?= $p['patient_id'] ?>">
                        <button type="submit" name="action" value="delete" class="mr-row-menu__danger" data-confirm="Remove <?= $mr_name ?>?" data-confirm-text="Their profile is removed from your family list for good." data-confirm-label="Remove patient">Remove patient</button>
                      </form>
                    <?php endif; ?>
                  </div>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <p class="mr-roster-empty"<?= $mr_patients ? ' hidden' : '' ?>><?= $mr_patients ? 'No patients match this search or filter.' : 'No family members yet. Use "Add Patient" to manage someone\'s prescriptions.' ?></p>

        <div class="mr-pagination">
          <span class="mr-pagination__count" id="mr-patient-count">Showing <?= $mr_patients ? '1-' . count($mr_patients) : '0' ?> of <?= count($mr_patients) ?></span>
        </div>
      </section>

      </div>

      <div class="mr-dash-col">

        <section class="mr-resp-summary">
          <span class="mr-eyebrow" style="color: var(--mr-color-primary-dark);">Your Family</span>
          <h2>Managed Patients</h2>
          <div class="mr-fleet-card__stat">
            <strong><?= count($mr_patients) ?></strong>
            <span class="mr-badge mr-badge--<?= $mr_pending ? 'accent' : 'success' ?> mr-badge--case-normal"><?= $mr_pending ?> pending</span>
          </div>
          <p class="mr-fleet-card__caption">Family members whose prescriptions you upload and track.</p>
        </section>

        <section class="mr-card mr-help-card">
          <span class="mr-icon-badge mr-icon-badge--info">
            <img src="presentation/assets/images/icons/filled/2d3fd7/conference-call.png" alt="">
          </span>
          <div>
            <strong>How family accounts work</strong>
            <p>Each family member gets their own MedReach profile, linked to you. They can take over their account later with "Forgot password" on the sign-in page.</p>
            <p>You can't remove someone while they have a pending prescription.</p>
          </div>
        </section>

      </div>
      </div>
    </main>
  </div>

  <?php foreach ([
    'mr-patient-create-modal' => ['Add Patient', 'create', 'Save patient'],
    'mr-patient-edit-modal'   => ['Edit <span data-subject-slot="patient"></span>', 'update', 'Save changes'],
  ] as $mr_id => [$mr_heading, $mr_action, $mr_submit]): $mr_old = $mr_old_in($mr_id); $mr_prefix = $mr_action; ?>
  <div class="mr-modal<?= $mr_modal === $mr_id ? ' is-open' : '' ?>" id="<?= $mr_id ?>">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2><?= $mr_heading ?></h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <?php if ($mr_modal === $mr_id) { $flash = $mr_error; require __DIR__ . '/../partials/auth-flash.php'; } ?>

      <form class="mr-auth-form mr-auth-form--grid mr-modal__form" method="post" action="manage-patients.php">
        <?= $mr_csrf ?>
        <input type="hidden" name="action" value="<?= $mr_action ?>">
        <?php if ($mr_action === 'update'): ?>
          <input type="hidden" name="patient_id" value="<?= $mr_old('patient_id') ?>">
        <?php endif; ?>
        <?php require __DIR__ . '/../partials/user-fields.php'; ?>

        <div class="mr-field">
          <label for="<?= $mr_prefix ?>-date_of_birth">Date of birth <span class="mr-field__optional">(optional)</span></label>
          <div class="mr-field__input">
            <input type="date" id="<?= $mr_prefix ?>-date_of_birth" name="date_of_birth" max="<?= date('Y-m-d') ?>" value="<?= $mr_old('date_of_birth') ?>">
          </div>
        </div>

        <div class="mr-field mr-field--span2">
          <label for="<?= $mr_prefix ?>-address">Delivery address <span class="mr-field__optional">(optional)</span></label>
          <div class="mr-field__input">
            <input type="text" id="<?= $mr_prefix ?>-address" name="address" placeholder="12 Galle Road, Colombo 03" maxlength="255" value="<?= $mr_old('address') ?>" autocomplete="street-address">
          </div>
        </div>

        <div class="mr-modal__actions mr-field--span2">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm"><?= $mr_submit ?></button>
        </div>
      </form>
    </div>
  </div>
  <?php endforeach; ?>

  <div class="mr-modal" id="mr-remove-blocked-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Can't remove <span data-subject-slot="patient"></span></h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <p class="mr-modal__text">This patient has a pending prescription. You can remove them once it is fulfilled or cancelled.</p>

      <div class="mr-modal__actions">
        <a class="mr-btn mr-btn--ghost mr-btn--sm" href="order-history.php">View orders</a>
        <button type="button" class="mr-btn mr-btn--primary mr-btn--sm" data-modal-close>OK</button>
      </div>
    </div>
  </div>
