<?php
// MedReach - Delivery dashboard sidebar (presentation tier: HTML output only)
$active = $active ?? 'dashboard';

$mr_sidebar_links = [
  'dashboard'  => ['label' => 'Dashboard', 'icon' => 'home',          'href' => 'delivery-dashboard.php'],
  'manifest'   => ['label' => 'Deliveries', 'icon' => 'delivery',      'href' => 'delivery-details.php'],
  'earnings'   => ['label' => 'Earnings',   'icon' => 'cash',          'href' => 'delivery-earnings.php'],
];
?>
<aside class="mr-sidebar" aria-label="Delivery navigation">
  <div class="mr-sidebar__top">
    <a class="mr-sidebar__brand" href="delivery-dashboard.php" aria-label="MedReach">
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
      <div class="mr-sidebar__link mr-sidebar__link--profile" title="Kasun Perera">
        <span class="mr-avatar mr-avatar--dash">KP</span>
        <span class="mr-sidebar__label">Kasun Perera</span>
      </div>
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
