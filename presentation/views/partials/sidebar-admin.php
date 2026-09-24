<?php
// MedReach - Admin dashboard sidebar (presentation tier: HTML output only)
$active = $active ?? 'dashboard';

$mr_sidebar_links = [
  'dashboard'     => ['label' => 'Dashboard',     'icon' => 'home',          'href' => 'admin-dashboard.php'],
  'orders'        => ['label' => 'Orders',        'icon' => 'delivery',      'href' => '#'],
  'prescriptions' => ['label' => 'Prescriptions', 'icon' => 'pill',          'href' => '#'],
  'pharmacies'    => ['label' => 'Pharmacies',    'icon' => 'shop',          'href' => 'manage-pharmacies.php'],
  'users'         => ['label' => 'Users',         'icon' => 'conference-call', 'href' => 'manage-users.php'],
  'settings'      => ['label' => 'Settings',      'icon' => 'settings',      'href' => 'admin-settings.php'],
];
?>
<aside class="mr-sidebar" aria-label="Admin navigation">
  <div class="mr-sidebar__top">
    <a class="mr-sidebar__brand" href="admin-dashboard.php" aria-label="MedReach">
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

  <a class="mr-notif-btn mr-notif-btn--sidebar" href="notifications.php" aria-label="Notifications">
    <img src="https://img.icons8.com/ios-filled/50/1a1b24/appointment-reminders.png" alt="">
    <span class="mr-notif-btn__dot" aria-hidden="true"></span>
  </a>

  <button type="button" class="mr-sidebar__toggle" aria-label="Toggle menu" aria-expanded="false" aria-controls="mr-sidebar-menu">
    <img class="mr-sidebar__toggle-icon mr-sidebar__toggle-icon--open" src="https://img.icons8.com/ios-filled/50/1a1b24/menu.png" alt="">
    <img class="mr-sidebar__toggle-icon mr-sidebar__toggle-icon--close" src="https://img.icons8.com/ios-filled/50/1a1b24/multiply.png" alt="">
  </button>

  <div class="mr-sidebar__menu" id="mr-sidebar-menu">
    <nav class="mr-sidebar__nav">
      <?php foreach ($mr_sidebar_links as $key => $link): ?>
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
      <a
        class="mr-sidebar__link mr-sidebar__link--profile<?= $active === 'profile' ? ' is-active' : '' ?>"
        href="#"
        title="Admin"
        aria-label="Profile"
        <?= $active === 'profile' ? 'aria-current="page"' : '' ?>
      >
        <span class="mr-avatar mr-avatar--dash">A</span>
        <span class="mr-sidebar__label">Profile</span>
      </a>
      <a class="mr-sidebar__link mr-sidebar__link--danger" href="sign-in.php" title="Log out" aria-label="Log out">
        <span class="mr-sidebar__icon-box">
          <img src="https://img.icons8.com/ios-filled/50/ff0000/export.png" alt="">
        </span>
        <span class="mr-sidebar__label">Log out</span>
      </a>
    </div>
  </div>
</aside>

<div class="mr-modal-backdrop mr-sidebar-backdrop"></div>
