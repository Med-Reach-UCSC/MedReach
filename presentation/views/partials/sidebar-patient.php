<?php
// MedReach - Patient dashboard sidebar (presentation tier: HTML output only)
// Independent of the public partials/nav.php — this is the signed-in nav.
// Set $active before including this file to highlight the current page.
$active = $active ?? 'dashboard';

$mr_sidebar_links = [
  'dashboard'     => ['label' => 'Dashboard',     'icon' => 'home',        'href' => 'patient-dashboard.php'],
  'prescriptions' => ['label' => 'Prescriptions',  'icon' => 'clipboard', 'href' => '#'],
  'orders'        => ['label' => 'Orders',         'icon' => 'list',        'href' => 'patient-order.php'],
  'pharmacies'    => ['label' => 'Pharmacies',     'icon' => 'shop',        'href' => 'nearby-pharmacies.php'],
];
?>
<aside class="mr-sidebar" aria-label="Patient navigation">
  <a class="mr-sidebar__brand" href="patient-dashboard.php" aria-label="MedReach">
    <img src="presentation/assets/images/logo-symbol.png" alt="">
  </a>

  <button type="button" class="mr-notif-btn mr-notif-btn--sidebar" aria-label="Notifications">
    <img src="https://img.icons8.com/ios-filled/50/1a1b24/appointment-reminders.png" alt="">
    <span class="mr-notif-btn__dot" aria-hidden="true"></span>
  </button>

  <button type="button" class="mr-sidebar__toggle" aria-label="Toggle menu" aria-expanded="false" aria-controls="mr-sidebar-menu">
    <img class="mr-sidebar__toggle-icon mr-sidebar__toggle-icon--open" src="https://img.icons8.com/ios-filled/50/1a1b24/menu.png" alt="">
    <img class="mr-sidebar__toggle-icon mr-sidebar__toggle-icon--close" src="https://img.icons8.com/ios-filled/50/1a1b24/multiply.png" alt="">
  </button>

  <div class="mr-sidebar__menu" id="mr-sidebar-menu">
    <nav class="mr-sidebar__nav">
      <?php foreach ($mr_sidebar_links as $key => $link): ?>
        
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
      <a class="mr-sidebar__link mr-sidebar__link--profile" href="#" title="Nimal Perera" aria-label="Profile">
        <span class="mr-avatar mr-avatar--dash">N</span>
        <span class="mr-sidebar__label">Profile</span>
      </a>
      <a class="mr-sidebar__link" href="sign-in.php" title="Log out" aria-label="Log out">
        <img src="https://img.icons8.com/ios-filled/50/454655/export.png" alt="">
        <span class="mr-sidebar__label">Log out</span>
      </a>
    </div>
  </div>
</aside>

<div class="mr-modal-backdrop mr-sidebar-backdrop"></div>