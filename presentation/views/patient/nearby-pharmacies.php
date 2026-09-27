<?php
$title = 'Nearby Pharmacies — MedReach';
$bodyClass = 'mr-page-nearby';
$active = 'pharmacies';

$mr_status_labels = ['open' => 'Open now', 'closing' => 'Closing soon', 'closed' => 'Closed'];
$mr_pharmacies = [
    ['name' => 'Osu Sala', 'addr' => '123 Galle Rd, Colombo 03', 'phone' => '070 633 0224', 'km' => '1.3', 'rating' => '4.8', 'status' => 'open', 'hours' => 'Closes 9:00 PM', 'wait' => '10 min'],
    ['name' => 'Healthguard Pharmacy', 'addr' => '45 Havelock Rd, Colombo 05', 'phone' => '070 214 8890', 'km' => '1.9', 'rating' => '4.5', 'status' => 'closing', 'hours' => 'Closes 6:30 PM', 'wait' => '15 min'],
    ['name' => 'Union Chemists', 'addr' => '78 High Level Rd, Nugegoda', 'phone' => '071 402 5567', 'km' => '4.0', 'rating' => '4.9', 'status' => 'open', 'hours' => 'Closes 10:00 PM', 'wait' => '8 min'],
    ['name' => 'Lanka Pharmacy', 'addr' => '10 Duplication Rd, Colombo 04', 'phone' => '077 815 9902', 'km' => '5.0', 'rating' => '4.2', 'status' => 'closed', 'hours' => 'Opens 8:00 AM', 'wait' => '—'],
];
?>
  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <h1>Nearby Pharmacies</h1>

        <div class="mr-dash-header__actions">
          <span class="mr-badge mr-badge--pill mr-badge--case-normal">
            <img src="presentation/assets/images/icons/filled/454655/marker.png" alt="">
            Colombo 03
          </span>
          <span class="mr-badge mr-badge--primary mr-badge--case-normal">4 Nearby</span>

          <a class="mr-notif-btn mr-notif-btn--header" href="notifications.php" aria-label="Notifications">
            <img src="presentation/assets/images/icons/filled/1a1b24/appointment-reminders.png" alt="">
            <span class="mr-notif-btn__dot" aria-hidden="true"></span>
          </a>
        </div>
      </header>

      <div class="mr-dash-content mr-pharm-content">
        <div class="mr-dash-col mr-pharm-list-col">
          <div class="mr-pharm-toolbar">
            <label class="mr-pharm-search">
              <img src="presentation/assets/images/icons/filled/454655/search.png" alt="">
              <input type="search" placeholder="Search pharmacies nearby..." aria-label="Search pharmacies">
            </label>
            <div class="mr-pharm-filters" role="group" aria-label="Filter pharmacies">
              <button type="button" class="mr-pharm-filters__btn mr-pharm-filters__btn--open" data-filter="open">Open Now</button>
              <button type="button" class="mr-pharm-filters__btn mr-pharm-filters__btn--closing" data-filter="closing">Closing Soon</button>
              <button type="button" class="mr-pharm-filters__btn mr-pharm-filters__btn--closed" data-filter="closed">Closed</button>
            </div>
          </div>

          <div class="mr-pharm-list">

          <?php foreach ($mr_pharmacies as $i => $p): ?>
          <article class="mr-card mr-pharm-card<?= $i === 0 ? ' is-selected' : '' ?>" data-name="<?= $p['name'] ?>" data-addr="<?= $p['addr'] ?>" data-wait="<?= $p['wait'] ?>" data-status="<?= $p['status'] ?>" tabindex="0">
            <div class="mr-pharm-card__head">
              <h2><?= $p['name'] ?></h2>
              <span class="mr-pharm-status"><?= $mr_status_labels[$p['status']] ?></span>
            </div>
            <p class="mr-pharm-card__addr"><?= $p['addr'] ?> <span aria-hidden="true">·</span> <span class="mr-pharm-card__phone"><?= $p['phone'] ?></span></p>
            <ul class="mr-pharm-card__meta">
              <li class="mr-pharm-card__distance">
                <img src="presentation/assets/images/icons/filled/454655/marker.png" alt="">
                <?= $p['km'] ?> km
              </li>
              <li>
                <img src="presentation/assets/images/icons/filled/dd8e1c/star.png" alt="">
                <?= $p['rating'] ?>
              </li>
              <li>
                <img src="presentation/assets/images/icons/filled/454655/clock.png" alt="">
                <?= $p['hours'] ?>
              </li>
              <li class="mr-pharm-card__tags">
                <img src="presentation/assets/images/icons/filled/454655/delivery.png" alt="">
                Delivery · Cash on delivery
              </li>
            </ul>
          </article>
          <?php endforeach; ?>

          </div>
        </div>

        <div class="mr-dash-col mr-pharm-info">

          <button type="button" class="mr-pharm-info__close" aria-label="Close">
            <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
          </button>

          <section class="mr-card mr-dash-card mr-pharm-detail" data-status="<?= $mr_pharmacies[0]['status'] ?>">
            <div class="mr-dash-card__head">
              <h2 class="mr-pharm-detail__name">Osu Sala</h2>
            </div>
            <p class="mr-resp-meta mr-pharm-detail__addr">
              <img src="presentation/assets/images/icons/filled/454655/marker.png" alt="">
              123 Galle Rd, Colombo 03
            </p>

            <div class="mr-pharm-detail__stats">
              <div>
                <span class="mr-eyebrow mr-eyebrow--mono">Estimated Wait</span>
                <strong class="mr-price mr-pharm-detail__wait">10 min</strong>
              </div>
            </div>

            <a href="patient-order.php" class="mr-btn mr-btn--dark mr-btn--block">
              Start an order
              <img src="presentation/assets/images/icons/filled/ffffff/paper-plane.png" alt="">
            </a>
          </section>

          <section class="mr-card mr-mini-stat">
            <div>
              <span class="mr-eyebrow mr-eyebrow--mono">Avg. Wait Nearby</span>
              <strong>11 min</strong>
            </div>
            <span class="mr-icon-badge mr-icon-badge--info mr-icon-badge--lg">
              <img src="presentation/assets/images/icons/filled/2d3fd7/clock.png" alt="">
            </span>
          </section>

        </div>
      </div>
    </main>

    <div class="mr-modal-backdrop mr-pharm-backdrop"></div>
  </div>
