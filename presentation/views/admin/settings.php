<?php
$title = 'System Settings — MedReach';
$bodyClass = 'mr-page-settings';
$charts = true;
$active = 'settings';
?>
  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <div>
          <h1>System Settings</h1>
          <p class="mr-eyebrow">Configure prescription routing and system preferences</p>
        </div>

        <div class="mr-dash-header__actions">
          <label class="mr-pharm-search">
            <img src="https://img.icons8.com/ios-filled/50/454655/search.png" alt="">
            <input type="search" id="mr-settings-search" placeholder="Search settings..." aria-label="Search settings">
          </label>

          <button type="submit" form="mr-settings-form" class="mr-btn mr-btn--primary mr-btn--sm">
            <img src="https://img.icons8.com/ios-filled/50/ffffff/save.png" alt="" style="width:14px;height:14px;vertical-align:-2px;margin-right:0.35rem;">
            Save changes
          </button>
        </div>
      </header>

      <form id="mr-settings-form" class="mr-dash-content" data-toast="Settings saved.">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head" style="align-items: flex-start;">
              <div>
                <h2 style="display: flex; align-items: center; gap: 0.5rem;">
                  <span class="mr-icon-badge mr-icon-badge--info">
                    <img src="https://img.icons8.com/ios-filled/50/2d3fd7/broadcasting.png" alt="">
                  </span>
                  Broadcast Routing Engine
                </h2>
                <span class="mr-eyebrow">Search radius and forwarding limits for each prescription item</span>
              </div>
              <span class="mr-badge mr-badge--success mr-badge--case-normal">
                <span class="mr-badge__dot"></span>
                Engine online
              </span>
            </div>

            <div style="display: flex; gap: 2.5rem; flex-wrap: wrap;">
              <div>
                <label class="mr-eyebrow mr-eyebrow--mono" style="display: block; margin-bottom: 0.5rem;">Base Radius (km)</label>
                <div class="mr-stepper" data-step="1">
                  <button type="button" class="mr-stepper__btn" data-stepper-action="dec" aria-label="Decrease base radius">
                    <img src="https://img.icons8.com/ios-filled/50/454655/minus.png" alt="">
                  </button>
                  <span class="mr-stepper__value">45</span>
                  <button type="button" class="mr-stepper__btn" data-stepper-action="inc" aria-label="Increase base radius">
                    <img src="https://img.icons8.com/ios-filled/50/454655/plus.png" alt="">
                  </button>
                </div>
              </div>

              <div>
                <label class="mr-eyebrow mr-eyebrow--mono" style="display: block; margin-bottom: 0.5rem;">Max Forwards per Item</label>
                <div class="mr-stepper" data-step="1">
                  <button type="button" class="mr-stepper__btn" data-stepper-action="dec" aria-label="Decrease max forwards">
                    <img src="https://img.icons8.com/ios-filled/50/454655/minus.png" alt="">
                  </button>
                  <span class="mr-stepper__value">5</span>
                  <button type="button" class="mr-stepper__btn" data-stepper-action="inc" aria-label="Increase max forwards">
                    <img src="https://img.icons8.com/ios-filled/50/454655/plus.png" alt="">
                  </button>
                </div>
              </div>
            </div>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2 style="display: flex; align-items: center; gap: 0.5rem;">
                <span class="mr-icon-badge mr-icon-badge--info">
                  <img src="https://img.icons8.com/ios-filled/50/2d3fd7/speed.png" alt="">
                </span>
                Routing Behaviour
              </h2>
            </div>

            <div class="mr-pharmacy-row">
              <div>
                <strong>Auto-forward on Timeout</strong>
                <span class="mr-pharmacy-row__muted">Send an item to the next-closest pharmacy when no one responds</span>
              </div>
              <label class="mr-switch">
                <input type="checkbox" aria-label="Auto-forward on timeout" checked>
                <span class="mr-switch__track"></span>
              </label>
            </div>
            <div class="mr-pharmacy-row">
              <div>
                <strong>Split Multi-item Prescriptions</strong>
                <span class="mr-pharmacy-row__muted">Route each item to its own nearest pharmacy</span>
              </div>
              <label class="mr-switch">
                <input type="checkbox" aria-label="Split multi-item prescriptions" checked>
                <span class="mr-switch__track"></span>
              </label>
            </div>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2 style="display: flex; align-items: center; gap: 0.5rem;">
                <span class="mr-icon-badge mr-icon-badge--accent">
                  <img src="https://img.icons8.com/ios-filled/50/dd8e1c/high-priority.png" alt="">
                </span>
                Alert Preferences
              </h2>
            </div>

            <div class="mr-pharmacy-row">
              <div>
                <strong>Critical System Errors</strong>
                <span class="mr-pharmacy-row__muted">Immediate push notifications</span>
              </div>
              <label class="mr-switch">
                <input type="checkbox" aria-label="Critical System Errors" checked>
                <span class="mr-switch__track"></span>
              </label>
            </div>
            <div class="mr-pharmacy-row">
              <div>
                <strong>Provider Status Updates</strong>
                <span class="mr-pharmacy-row__muted">Daily digest email</span>
              </div>
              <label class="mr-switch">
                <input type="checkbox" aria-label="Provider Status Updates">
                <span class="mr-switch__track"></span>
              </label>
            </div>
            <div class="mr-pharmacy-row">
              <div>
                <strong>Unfilled Prescription Alerts</strong>
                <span class="mr-pharmacy-row__muted">When an item runs out of pharmacies to try</span>
              </div>
              <label class="mr-switch">
                <input type="checkbox" aria-label="Unfilled prescription alerts">
                <span class="mr-switch__track"></span>
              </label>
            </div>
          </section>

          <section class="mr-card mr-dash-card mr-span-2">
            <div class="mr-dash-card__head" style="align-items: flex-start;">
              <div>
                <h2 style="display: flex; align-items: center; gap: 0.5rem;">
                  <span class="mr-icon-badge mr-icon-badge--info">
                    <img src="https://img.icons8.com/ios-filled/50/2d3fd7/route.png" alt="">
                  </span>
                  Global Routing Parameters
                </h2>
                <span class="mr-eyebrow">Limits applied when broadcasting new prescriptions</span>
              </div>
              <span class="mr-badge mr-badge--pill mr-badge--case-normal">Config v2.4</span>
            </div>

            <div class="mr-stat-grid-3" style="grid-template-columns: 1fr 1fr;">
              <div style="text-align: center;">
                <div class="mr-spend-ring">
                  <canvas id="mr-radius-gauge-chart" role="img" aria-label="Max dispatch radius: 45 km"></canvas>
                  <div class="mr-spend-ring__inner">
                    <span>Radius</span>
                    <strong>45 km</strong>
                  </div>
                </div>
                <label class="mr-eyebrow mr-eyebrow--mono" for="mr-radius-slider" style="display: block; margin-bottom: 0.5rem;">Max Dispatch Radius</label>
                <input type="range" id="mr-radius-slider" class="mr-range" min="0" max="100" value="45">
              </div>

              <div style="text-align: center;">
                <div class="mr-spend-ring">
                  <canvas id="mr-timeout-gauge-chart" role="img" aria-label="Response timeout: 120 seconds"></canvas>
                  <div class="mr-spend-ring__inner">
                    <span>Timeout</span>
                    <strong>120s</strong>
                  </div>
                </div>
                <label class="mr-eyebrow mr-eyebrow--mono" for="mr-timeout-slider" style="display: block; margin-bottom: 0.5rem;">Response Timeout</label>
                <input type="range" id="mr-timeout-slider" class="mr-range" min="0" max="180" value="120">
              </div>
            </div>
          </section>

          <section class="mr-card mr-courier-card">
            <h2 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem;">
              <img src="https://img.icons8.com/ios-filled/50/ffffff/clipboard.png" alt="" style="width:18px;height:18px;">
              System Manifest
            </h2>
            <p style="color: rgba(255,255,255,0.8); margin: 0 0 1rem;">Current configuration</p>

            <div class="mr-manifest">
              <div class="mr-manifest__row">
                <span>Routing</span>
                <span class="mr-manifest__leader"></span>
                <strong>Per item</strong>
              </div>
              <div class="mr-manifest__row">
                <span>Forward on timeout</span>
                <span class="mr-manifest__leader"></span>
                <strong>On</strong>
              </div>
              <div class="mr-manifest__row">
                <span>Max forwards</span>
                <span class="mr-manifest__leader"></span>
                <strong>5</strong>
              </div>
              <div class="mr-manifest__row">
                <span>Payments</span>
                <span class="mr-manifest__leader"></span>
                <strong>Card + COD</strong>
              </div>
            </div>

            <button type="submit" form="mr-settings-form" class="mr-btn mr-btn--dark mr-btn--block">Apply changes</button>
          </section>

          <section class="mr-card mr-dash-card mr-span-2">
            <div class="mr-dash-card__head">
              <h2 style="display: flex; align-items: center; gap: 0.5rem;">
                <span class="mr-icon-badge mr-icon-badge--info">
                  <img src="https://img.icons8.com/ios-filled/50/2d3fd7/user.png" alt="">
                </span>
                Admin Profile
              </h2>
            </div>

            <div class="mr-auth-form mr-auth-form--grid">
              <label class="mr-field">
                <span>Full Name</span>
                <div class="mr-field__input">
                  <input type="text" value="Dilani Perera">
                </div>
              </label>
              <label class="mr-field">
                <span>Admin Designation</span>
                <div class="mr-field__input">
                  <input type="text" value="System Operator 01">
                </div>
              </label>
              <label class="mr-field">
                <span>Contact Email</span>
                <div class="mr-field__input">
                  <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/mail.png" alt="">
                  <input type="email" value="admin@medreach.lk">
                </div>
              </label>
              <label class="mr-field">
                <span>Department</span>
                <div class="mr-field__input">
                  <select>
                    <option selected>Logistics &amp; Routing</option>
                    <option>System Administration</option>
                    <option>Security &amp; Compliance</option>
                    <option>Provider Relations</option>
                  </select>
                </div>
              </label>
              <label class="mr-field mr-field--span2">
                <span>Auth Token Expiry</span>
                <div class="mr-field__input">
                  <img class="mr-field__icon" src="https://img.icons8.com/ios-filled/50/757687/lock--v1.png" alt="">
                  <input type="text" value="90 Days (Enforced)" readonly>
                </div>
              </label>
            </div>
          </section>

          <section class="mr-card mr-courier-card">
            <h2 style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem;">
              <img src="https://img.icons8.com/ios-filled/50/ffffff/flow-chart.png" alt="" style="width:18px;height:18px;">
              Routing Summary
            </h2>
            <p style="color: rgba(255,255,255,0.8); margin: 0 0 1rem;">Applies to new requests</p>

            <div class="mr-manifest">
              <div class="mr-manifest__row">
                <span>Order</span>
                <span class="mr-manifest__leader"></span>
                <strong>Nearest first</strong>
              </div>
              <div class="mr-manifest__row">
                <span>Base Radius</span>
                <span class="mr-manifest__leader"></span>
                <strong>45 km</strong>
              </div>
              <div class="mr-manifest__row">
                <span>Timeout</span>
                <span class="mr-manifest__leader"></span>
                <strong>120s</strong>
              </div>
              <div class="mr-manifest__row">
                <span>On decline</span>
                <span class="mr-manifest__leader"></span>
                <strong>Next-closest</strong>
              </div>
              <div class="mr-manifest__row">
                <span>Split items</span>
                <span class="mr-manifest__leader"></span>
                <strong>Yes</strong>
              </div>
            </div>

            <p style="font-size: 0.8rem; color: rgba(255,255,255,0.75); margin: 0 0 1rem;">
              Changes apply to new prescription requests only. Orders already in progress keep their current routing.
            </p>

            <button type="submit" form="mr-settings-form" class="mr-btn mr-btn--dark mr-btn--block">Apply changes</button>
          </section>

      </form>
    </main>
  </div>
