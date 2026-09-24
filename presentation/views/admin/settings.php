<?php
// MedReach - Admin system settings (presentation tier: HTML output only)
$active = 'settings';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>System Settings — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body class="mr-page-settings">

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-admin.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <div>
          <h1>System Settings</h1>
          <p class="mr-eyebrow">Configure global routing and technical telemetry parameters</p>
        </div>

        <div class="mr-dash-header__actions">
          <label class="mr-pharm-search">
            <img src="https://img.icons8.com/ios-filled/50/454655/search.png" alt="">
            <input type="search" id="mr-settings-search" placeholder="Search settings..." aria-label="Search settings">
          </label>

          <a class="mr-notif-btn mr-notif-btn--header" href="notifications.php" aria-label="Notifications">
            <img src="https://img.icons8.com/ios-filled/50/1a1b24/appointment-reminders.png" alt="">
            <span class="mr-notif-btn__dot" aria-hidden="true"></span>
          </a>

          <button type="submit" form="mr-settings-form" class="mr-btn mr-btn--primary mr-btn--sm">
            <img src="https://img.icons8.com/ios-filled/50/ffffff/save.png" alt="" style="width:14px;height:14px;vertical-align:-2px;margin-right:0.35rem;">
            Save changes
          </button>
        </div>
      </header>

      <form id="mr-settings-form" class="mr-dash-content">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head" style="align-items: flex-start;">
              <div>
                <h2 style="display: flex; align-items: center; gap: 0.5rem;">
                  <span class="mr-icon-badge mr-icon-badge--info">
                    <img src="https://img.icons8.com/ios-filled/50/2d3fd7/broadcasting.png" alt="">
                  </span>
                  Broadcast Routing Engine
                </h2>
                <span class="mr-eyebrow">Adjust signal dispersion and radius tolerances</span>
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
                <label class="mr-eyebrow mr-eyebrow--mono" style="display: block; margin-bottom: 0.5rem;">Signal Decay Rate</label>
                <div class="mr-stepper" data-step="0.001">
                  <button type="button" class="mr-stepper__btn" data-stepper-action="dec" aria-label="Decrease signal decay rate">
                    <img src="https://img.icons8.com/ios-filled/50/454655/minus.png" alt="">
                  </button>
                  <span class="mr-stepper__value">0.024</span>
                  <button type="button" class="mr-stepper__btn" data-stepper-action="inc" aria-label="Increase signal decay rate">
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
                Telemetry Sensors
              </h2>
            </div>

            <div class="mr-pharmacy-row">
              <div>
                <strong>Verbose Error Logging</strong>
                <span class="mr-pharmacy-row__muted">Capture complete stack traces in central DB</span>
              </div>
              <label class="mr-switch">
                <input type="checkbox" checked>
                <span class="mr-switch__track"></span>
              </label>
            </div>
            <div class="mr-pharmacy-row">
              <div>
                <strong>Background Sync Ping</strong>
                <span class="mr-pharmacy-row__muted">Maintain websocket connection to mobile fleet</span>
              </div>
              <label class="mr-switch">
                <input type="checkbox" checked>
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
                <input type="checkbox" checked>
                <span class="mr-switch__track"></span>
              </label>
            </div>
            <div class="mr-pharmacy-row">
              <div>
                <strong>Provider Status Updates</strong>
                <span class="mr-pharmacy-row__muted">Daily digest email</span>
              </div>
              <label class="mr-switch">
                <input type="checkbox">
                <span class="mr-switch__track"></span>
              </label>
            </div>
            <div class="mr-pharmacy-row">
              <div>
                <strong>Routing Optimization Sync</strong>
                <span class="mr-pharmacy-row__muted">In-app alerts only</span>
              </div>
              <label class="mr-switch">
                <input type="checkbox">
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
                <span class="mr-eyebrow">Adjust algorithm constraints for automated dispatch</span>
              </div>
              <span class="mr-badge mr-badge--pill mr-badge--case-normal">Config v2.4</span>
            </div>

            <div class="mr-stat-grid-3" style="grid-template-columns: 1fr 1fr;">
              <div style="text-align: center;">
                <div class="mr-spend-ring">
                  <canvas id="mr-radius-gauge-chart" role="img" aria-label="Max dispatch radius: 45 miles"></canvas>
                  <div class="mr-spend-ring__inner">
                    <span>Radius</span>
                    <strong>45 mi</strong>
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
            <p style="color: rgba(255,255,255,0.8); margin: 0 0 1rem;">Live configuration mapping</p>

            <div class="mr-manifest">
              <div class="mr-manifest__row">
                <span>NODE_ID</span>
                <span class="mr-manifest__leader"></span>
                <strong>MR-US-EAST-1</strong>
              </div>
              <div class="mr-manifest__row">
                <span>KEEPALIVE</span>
                <span class="mr-manifest__leader"></span>
                <strong>300ms</strong>
              </div>
              <div class="mr-manifest__row">
                <span>TLS_VER</span>
                <span class="mr-manifest__leader"></span>
                <strong>1.3</strong>
              </div>
              <div class="mr-manifest__row">
                <span>QOS_LEVEL</span>
                <span class="mr-manifest__leader"></span>
                <strong>CRITICAL</strong>
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
                  <input type="text" value="Dr. Sarah Jenkins">
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
                  <input type="email" value="admin@medreach.sys">
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
            <p style="color: rgba(255,255,255,0.8); margin: 0 0 1rem;">Applied on next deploy</p>

            <div class="mr-manifest">
              <div class="mr-manifest__row">
                <span>Algorithm</span>
                <span class="mr-manifest__leader"></span>
                <strong>A-Star v4</strong>
              </div>
              <div class="mr-manifest__row">
                <span>Base Radius</span>
                <span class="mr-manifest__leader"></span>
                <strong>45mi</strong>
              </div>
              <div class="mr-manifest__row">
                <span>Timeout</span>
                <span class="mr-manifest__leader"></span>
                <strong>120s</strong>
              </div>
              <div class="mr-manifest__row">
                <span>Load Balancer</span>
                <span class="mr-manifest__leader"></span>
                <strong>Active</strong>
              </div>
              <div class="mr-manifest__row">
                <span>Geo-Fence</span>
                <span class="mr-manifest__leader"></span>
                <strong>Strict</strong>
              </div>
              <div class="mr-manifest__row">
                <span>Priority</span>
                <span class="mr-manifest__leader"></span>
                <strong>Dynamic</strong>
              </div>
            </div>

            <p style="font-size: 0.8rem; color: rgba(255,255,255,0.75); margin: 0 0 1rem;">
              Applying these changes will immediately impact active dispatch algorithms. Proceed with caution.
            </p>

            <button type="submit" form="mr-settings-form" class="mr-btn mr-btn--dark mr-btn--block">Apply changes</button>
          </section>

      </form>
    </main>
  </div>

  <script src="presentation/assets/js/vendor/chart.umd.min.js"></script>
  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
