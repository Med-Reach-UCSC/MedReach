<?php
$active = $active ?? 'dashboard';

$mr_nav = [
  'patient' => [
    'label'   => 'Patient',
    'profile' => ['profile.php', 'Nimal Perera', 'N', 'Profile'],
    'links'   => [
      'dashboard'  => ['label' => 'Dashboard',  'icon' => 'home',   'href' => 'patient-dashboard.php'],
      'family'     => ['label' => 'Family',     'icon' => 'family', 'href' => 'guardian-dashboard.php'],
      'orders'     => ['label' => 'Orders',     'icon' => 'list',   'href' => 'patient-order.php'],
      'pharmacies' => ['label' => 'Pharmacies', 'icon' => 'shop',   'href' => 'nearby-pharmacies.php'],
      'payments'   => ['label' => 'Payments',   'icon' => 'cash',   'href' => 'payments.php'],
    ],
  ],
  'pharmacist' => [
    'label'   => 'Pharmacy',
    'profile' => ['pharmacy-settings.php', 'Dr. Herath', 'H', 'Profile'],
    'links'   => [
      'dashboard' => ['label' => 'Dashboard', 'icon' => 'home',      'href' => 'pharmacy-dashboard.php'],
      'requests'  => ['label' => 'Orders',    'icon' => 'checklist', 'href' => 'orders.php'],
      'earnings'  => ['label' => 'Earnings',  'icon' => 'cash',      'href' => 'pharmacy-earnings.php'],
    ],
  ],
  'delivery' => [
    'label'   => 'Delivery',
    'profile' => [null, 'Kasun Perera', 'KP', 'Kasun Perera'],
    'links'   => [
      'dashboard' => ['label' => 'Dashboard',  'icon' => 'home',     'href' => 'delivery-dashboard.php'],
      'manifest'  => ['label' => 'Deliveries', 'icon' => 'delivery', 'href' => 'delivery-details.php'],
      'earnings'  => ['label' => 'Earnings',   'icon' => 'cash',     'href' => 'delivery-earnings.php'],
    ],
  ],
  'admin' => [
    'label'   => 'Admin',
    'profile' => ['admin-settings.php', 'Admin', 'A', 'Profile'],
    'links'   => [
      'dashboard'  => ['label' => 'Dashboard',  'icon' => 'home',            'href' => 'admin-dashboard.php'],
      'pharmacies' => ['label' => 'Pharmacies', 'icon' => 'shop',            'href' => 'manage-pharmacies.php'],
      'users'      => ['label' => 'Users',      'icon' => 'conference-call', 'href' => 'manage-users.php'],
      'support'    => ['label' => 'Support',    'icon' => 'support',         'href' => 'admin-support.php'],
      'ratings'    => ['label' => 'Ratings',    'icon' => 'star',            'href' => 'admin-ratings.php'],
      'settings'   => ['label' => 'Settings',   'icon' => 'settings',        'href' => 'admin-settings.php'],
    ],
  ],
][$role];
?>
<aside class="mr-sidebar" aria-label="<?= $mr_nav['label'] ?> navigation">
  <div class="mr-sidebar__top">
    <a class="mr-sidebar__brand" href="<?= $mr_nav['links']['dashboard']['href'] ?>" aria-label="MedReach">
      <span class="mr-sidebar__brand-icon">
        <img src="presentation/assets/images/logo-symbol.png" alt="">
      </span>
      <span class="mr-sidebar__brand-text">MedReach</span>
    </a>
    <button type="button" class="mr-sidebar__collapse" aria-label="Collapse menu" aria-pressed="false">
      <img class="mr-sidebar__collapse-icon mr-sidebar__collapse-icon--collapse" src="https://img.icons8.com/ios-filled/50/454655/chevron-left.png" alt="">
      <img class="mr-sidebar__collapse-icon mr-sidebar__collapse-icon--expand" src="https://img.icons8.com/ios-filled/50/454655/chevron-right.png" alt="">
    </button>
  </div>

  <?php if ($role === 'patient'): ?>
  <a class="mr-notif-btn mr-notif-btn--sidebar" href="notifications.php" aria-label="Notifications">
    <img src="https://img.icons8.com/ios-filled/50/1a1b24/appointment-reminders.png" alt="">
    <span class="mr-notif-btn__dot" aria-hidden="true"></span>
  </a>
  <?php endif; ?>

  <button type="button" class="mr-sidebar__toggle" aria-label="Toggle menu" aria-expanded="false" aria-controls="mr-sidebar-menu">
    <img class="mr-sidebar__toggle-icon mr-sidebar__toggle-icon--open" src="https://img.icons8.com/ios-filled/50/1a1b24/menu.png" alt="">
    <img class="mr-sidebar__toggle-icon mr-sidebar__toggle-icon--close" src="https://img.icons8.com/ios-filled/50/1a1b24/multiply.png" alt="">
  </button>

  <div class="mr-sidebar__menu" id="mr-sidebar-menu">
    <nav class="mr-sidebar__nav">
      <?php foreach ($mr_nav['links'] as $key => $link): ?>
        <a
          class="mr-sidebar__link<?= $key === $active ? ' is-active' : '' ?>"
          href="<?= htmlspecialchars($link['href']) ?>"
          title="<?= htmlspecialchars($link['label']) ?>"
          aria-label="<?= htmlspecialchars($link['label']) ?>"
          <?= $key === $active ? 'aria-current="page"' : '' ?>
        >
          <img src="https://img.icons8.com/ios-filled/50/<?= $key === $active ? 'ffffff' : '454655' ?>/<?= $link['icon'] ?>.png" alt="">
          <span class="mr-sidebar__label"><?= htmlspecialchars($link['label']) ?></span>
        </a>
      <?php endforeach; ?>
    </nav>

    <div class="mr-sidebar__footer">
      <?php [$mr_href, $mr_name, $mr_initials, $mr_label] = $mr_nav['profile']; ?>
      <?php if ($mr_href === null): ?>
      <div class="mr-sidebar__link mr-sidebar__link--profile" title="<?= $mr_name ?>">
        <span class="mr-avatar mr-avatar--dash"><?= $mr_initials ?></span>
        <span class="mr-sidebar__label"><?= $mr_label ?></span>
      </div>
      <?php else: ?>
      <a
        class="mr-sidebar__link mr-sidebar__link--profile<?= $active === 'profile' ? ' is-active' : '' ?>"
        href="<?= $mr_href ?>"
        title="<?= $mr_name ?>"
        aria-label="Profile"
        <?= $active === 'profile' ? 'aria-current="page"' : '' ?>
      >
        <span class="mr-avatar mr-avatar--dash"><?= $mr_initials ?></span>
        <span class="mr-sidebar__label"><?= $mr_label ?></span>
      </a>
      <?php endif; ?>
      <a class="mr-sidebar__link mr-sidebar__link--danger" href="sign-out.php" title="Log out" aria-label="Log out">
        <span class="mr-sidebar__icon-box">
          <img src="https://img.icons8.com/ios-filled/50/ff0000/export.png" alt="">
        </span>
        <span class="mr-sidebar__label">Log out</span>
      </a>
    </div>
  </div>
</aside>

<div class="mr-modal-backdrop mr-sidebar-backdrop"></div>
