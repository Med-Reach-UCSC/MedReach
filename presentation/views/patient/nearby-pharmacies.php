<?php
// MedReach - Patient directory of nearby registered pharmacies (presentation tier: HTML output only)
$active = 'pharmacies';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nearby Pharmacies — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body class="mr-page-nearby">

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-patient.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <h1>Nearby Pharmacies</h1>

        <div class="mr-dash-header__actions">
          <span class="mr-badge mr-badge--pill mr-badge--case-normal">
            <img src="https://img.icons8.com/ios-filled/50/454655/marker.png" alt="">
            Colombo 03
          </span>
          <span class="mr-badge mr-badge--primary mr-badge--case-normal">4 Nearby</span>

          <a class="mr-notif-btn mr-notif-btn--header" href="notifications.php" aria-label="Notifications">
            <img src="https://img.icons8.com/ios-filled/50/1a1b24/appointment-reminders.png" alt="">
            <span class="mr-notif-btn__dot" aria-hidden="true"></span>
          </a>
        </div>
      </header>

      <div class="mr-dash-content mr-pharm-content">
        <div class="mr-dash-col mr-pharm-list-col">
          <div class="mr-pharm-toolbar">
            <label class="mr-pharm-search">
              <img src="https://img.icons8.com/ios-filled/50/454655/search.png" alt="">
              <input type="search" placeholder="Search pharmacies nearby..." aria-label="Search pharmacies">
            </label>
            <div class="mr-pharm-filters" role="group" aria-label="Filter pharmacies">
              <button type="button" class="mr-pharm-filters__btn mr-pharm-filters__btn--open" data-filter="open">Open Now</button>
              <button type="button" class="mr-pharm-filters__btn mr-pharm-filters__btn--closing" data-filter="closing">Closing Soon</button>
              <button type="button" class="mr-pharm-filters__btn mr-pharm-filters__btn--closed" data-filter="closed">Closed</button>
            </div>
          </div>

          <div class="mr-pharm-list">

          <article class="mr-card mr-pharm-card is-selected" data-name="Walgreens" data-addr="123 Main St, Seattle" data-wait="10 min" data-status="open" tabindex="0">
            <div class="mr-pharm-card__head">
              <div class="mr-pharm-card__info">
                <span class="mr-eyebrow mr-pharm-card__category">Pharmacy</span>
                <h2>Walgreens</h2>
                <p class="mr-pharm-card__addr">123 Main St, Seattle</p>
                <p class="mr-pharm-card__phone">070 633 0224</p>
              </div>
              <div class="mr-pharm-card__side">
                <span class="mr-badge mr-badge--info mr-badge--case-normal">1.3 km</span>
                <span class="mr-pharm-rating">
                  <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="">
                  4.8
                </span>
                <span class="mr-badge mr-badge--success mr-badge--case-normal">Open Now</span>
                <span class="mr-pharm-card__hours">Closes 9:00 PM</span>
              </div>
            </div>
            <p class="mr-pharm-card__tags">Delivery · Cash on Delivery</p>
          </article>

          <article class="mr-card mr-pharm-card" data-name="CVS Pharmacy" data-addr="456 Pine Ave, Seattle" data-wait="15 min" data-status="closing" tabindex="0">
            <div class="mr-pharm-card__head">
              <div class="mr-pharm-card__info">
                <span class="mr-eyebrow mr-pharm-card__category">Pharmacy</span>
                <h2>CVS Pharmacy</h2>
                <p class="mr-pharm-card__addr">456 Pine Ave, Seattle</p>
                <p class="mr-pharm-card__phone">070 214 8890</p>
              </div>
              <div class="mr-pharm-card__side">
                <span class="mr-badge mr-badge--info mr-badge--case-normal">1.9 km</span>
                <span class="mr-pharm-rating">
                  <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="">
                  4.5
                </span>
                <span class="mr-badge mr-badge--accent mr-badge--case-normal">Closing Soon</span>
                <span class="mr-pharm-card__hours">Closes 6:30 PM</span>
              </div>
            </div>
            <p class="mr-pharm-card__tags">Delivery · Cash on Delivery</p>
          </article>

          <article class="mr-card mr-pharm-card" data-name="Bartell Drugs" data-addr="789 Broadway, Seattle" data-wait="8 min" data-status="open" tabindex="0">
            <div class="mr-pharm-card__head">
              <div class="mr-pharm-card__info">
                <span class="mr-eyebrow mr-pharm-card__category">Pharmacy</span>
                <h2>Bartell Drugs</h2>
                <p class="mr-pharm-card__addr">789 Broadway, Seattle</p>
                <p class="mr-pharm-card__phone">071 402 5567</p>
              </div>
              <div class="mr-pharm-card__side">
                <span class="mr-badge mr-badge--info mr-badge--case-normal">4.0 km</span>
                <span class="mr-pharm-rating">
                  <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="">
                  4.9
                </span>
                <span class="mr-badge mr-badge--success mr-badge--case-normal">Open Now</span>
                <span class="mr-pharm-card__hours">Closes 10:00 PM</span>
              </div>
            </div>
            <p class="mr-pharm-card__tags">Delivery · Cash on Delivery</p>
          </article>

          <article class="mr-card mr-pharm-card" data-name="Rite Aid" data-addr="101 Olive Way, Seattle" data-wait="—" data-status="closed" tabindex="0">
            <div class="mr-pharm-card__head">
              <div class="mr-pharm-card__info">
                <span class="mr-eyebrow mr-pharm-card__category">Pharmacy</span>
                <h2>Rite Aid</h2>
                <p class="mr-pharm-card__addr">101 Olive Way, Seattle</p>
                <p class="mr-pharm-card__phone">077 815 9902</p>
              </div>
              <div class="mr-pharm-card__side">
                <span class="mr-badge mr-badge--info mr-badge--case-normal">5.0 km</span>
                <span class="mr-pharm-rating">
                  <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="">
                  4.2
                </span>
                <span class="mr-badge mr-badge--danger mr-badge--case-normal">Closed</span>
                <span class="mr-pharm-card__hours">Opens 8:00 AM</span>
              </div>
            </div>
            <p class="mr-pharm-card__tags">Delivery · Cash on Delivery</p>
          </article>

          </div>
        </div>

        <div class="mr-dash-col mr-pharm-info">

          <button type="button" class="mr-pharm-info__close" aria-label="Close">
            <img src="https://img.icons8.com/ios-filled/50/1a1b24/multiply.png" alt="">
          </button>

          <section class="mr-card mr-dash-card mr-pharm-detail">
            <div class="mr-dash-card__head">
              <h2 class="mr-pharm-detail__name">Walgreens</h2>
            </div>
            <p class="mr-resp-meta mr-pharm-detail__addr">
              <img src="https://img.icons8.com/ios-filled/50/454655/marker.png" alt="">
              123 Main St, Seattle
            </p>

            <div class="mr-pharm-detail__stats">
              <div>
                <span class="mr-eyebrow mr-eyebrow--mono">Estimated Wait</span>
                <strong class="mr-price mr-pharm-detail__wait">10 min</strong>
              </div>
            </div>

            <a href="patient-order.php" class="mr-btn mr-btn--dark mr-btn--block">
              Start an order
              <img src="https://img.icons8.com/ios-filled/50/ffffff/paper-plane.png" alt="">
            </a>
          </section>

          <section class="mr-card mr-mini-stat">
            <div>
              <span class="mr-eyebrow mr-eyebrow--mono">Avg. Wait Nearby</span>
              <strong>11 min</strong>
            </div>
            <span class="mr-icon-badge mr-icon-badge--info mr-icon-badge--lg">
              <img src="https://img.icons8.com/ios-filled/50/2d3fd7/clock.png" alt="">
            </span>
          </section>

          <section class="mr-card mr-pharm-map" aria-label="Pharmacy locations">
            <span class="mr-pharm-map__pin mr-pharm-map__pin--active" style="left: 40%; top: 32%;" data-name="Walgreens" aria-label="Walgreens"></span>
            <span class="mr-pharm-map__pin" style="left: 62%; top: 22%;" data-name="CVS Pharmacy" aria-label="CVS Pharmacy"></span>
            <span class="mr-pharm-map__pin" style="left: 25%; top: 60%;" data-name="Bartell Drugs" aria-label="Bartell Drugs"></span>
            <span class="mr-pharm-map__pin mr-pharm-map__pin--closed" style="left: 75%; top: 68%;" data-name="Rite Aid" aria-label="Rite Aid"></span>
          </section>

        </div>
      </div>
    </main>

    <div class="mr-modal-backdrop mr-pharm-backdrop"></div>
  </div>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
