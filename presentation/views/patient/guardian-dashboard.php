<?php
$title = 'Family Dashboard — MedReach';
$active = 'family';
?>
  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <div>
          <h1>Good morning, Nimal</h1>
          <p class="mr-eyebrow">Managing 2 family members</p>
        </div>

        <div class="mr-dash-header__actions">
          <label class="mr-roster-filter">
            <img src="presentation/assets/images/icons/filled/454655/filter.png" alt="">
            <select data-row-filter="mr-guardian-table" aria-label="Filter by patient">
              <option value="">All patients</option>
              <option value="amma">Amma</option>
              <option value="seeya">Seeya</option>
            </select>
          </label>
          <a class="mr-btn mr-btn--dark mr-btn--sm" href="patient-order.php">New request</a>

          <a class="mr-notif-btn mr-notif-btn--header" href="notifications.php" aria-label="Notifications">
            <img src="presentation/assets/images/icons/filled/1a1b24/appointment-reminders.png" alt="">
            <span class="mr-notif-btn__dot" aria-hidden="true"></span>
          </a>
        </div>
      </header>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Active logistics</h2>
              <span class="mr-badge mr-badge--info">3 active</span>
            </div>

            <div class="mr-pay-table-wrap">
              <table class="mr-pay-table" id="mr-guardian-table">
                <thead>
                  <tr>
                    <th>Patient</th>
                    <th>Tracking ID</th>
                    <th>Prescription</th>
                    <th class="mr-pay-table__amount">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr data-filter-value="amma">
                    <td>
                      <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span class="mr-avatar">A</span>
                        <strong>Amma</strong>
                      </div>
                    </td>
                    <td class="mr-eyebrow mr-eyebrow--mono"><a class="mr-link" href="track-order-status.php">TRK-892A</a></td>
                    <td>
                      Lisinopril 10mg<br>
                      <span class="mr-eyebrow">90-day supply</span>
                    </td>
                    <td class="mr-pay-table__amount">
                      <span class="mr-badge mr-badge--accent mr-badge--case-normal">Out for delivery</span>
                    </td>
                  </tr>
                  <tr data-filter-value="seeya">
                    <td>
                      <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span class="mr-avatar">S</span>
                        <strong>Seeya</strong>
                      </div>
                    </td>
                    <td class="mr-eyebrow mr-eyebrow--mono"><a class="mr-link" href="track-order-status.php">TRK-441B</a></td>
                    <td>
                      Salbutamol Inhaler<br>
                      <span class="mr-eyebrow">Refill 2 of 3</span>
                    </td>
                    <td class="mr-pay-table__amount">
                      <span class="mr-badge mr-badge--success mr-badge--case-normal">Arriving today</span>
                    </td>
                  </tr>
                  <tr data-filter-value="amma">
                    <td>
                      <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span class="mr-avatar">A</span>
                        <strong>Amma</strong>
                      </div>
                    </td>
                    <td class="mr-eyebrow mr-eyebrow--mono"><a class="mr-link" href="track-order-status.php">TRK-112C</a></td>
                    <td>
                      Atorvastatin 20mg<br>
                      <span class="mr-eyebrow">Awaiting pharmacy</span>
                    </td>
                    <td class="mr-pay-table__amount">
                      <span class="mr-badge mr-badge--pill mr-badge--case-normal">Processing</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <p style="text-align: center; margin-top: 1rem;">
              <a class="mr-link mr-link--strong" href="order-history.php">View full history</a>
            </p>
          </section>

          <div class="mr-guardian-grid-2">
            <section class="mr-card mr-help-card mr-help-card--alert">
              <span class="mr-icon-badge mr-icon-badge--danger">
                <img src="presentation/assets/images/icons/filled/d6534a/error.png" alt="">
              </span>
              <div>
                <strong>Action required</strong>
                <p>Seeya's inhaler prescription has expired. Upload a new one so the refill can be routed.</p>
                <a class="mr-btn mr-btn--ghost mr-btn--sm" href="patient-order.php" style="margin-top: 0.75rem;">Upload new Rx</a>
              </div>
            </section>

            <section class="mr-card mr-dash-card">
              <span class="mr-eyebrow mr-eyebrow--mono">Adherence score</span>
              <div style="display: flex; align-items: flex-end; gap: 0.75rem; margin-top: 0.5rem;">
                <strong class="mr-dash-stat__value mr-dash-stat__value--active" style="font-size: 1.75rem;">98%</strong>
                <span class="mr-badge mr-badge--success mr-badge--case-normal">
                  <img src="presentation/assets/images/icons/filled/1f9d6b/positive-dynamic.png" alt="">
                  +2%
                </span>
              </div>
              <div class="mr-med-stats__bar" style="margin-top: 1rem;">
                <div class="mr-med-stats__fill" style="width: 98%; background-color: var(--mr-color-primary);"></div>
              </div>
            </section>
          </div>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-med-stats">
            <div class="mr-dash-card__head">
              <h2>Patient roster</h2>
              <a href="manage-patients.php">+ Add</a>
            </div>

            <div class="mr-pharmacy-row" style="align-items: center;">
              <div style="flex-direction: row; align-items: center; gap: 0.5rem;">
                <span class="mr-avatar">A</span>
                <span>
                  <strong>Amma</strong>
                  <span class="mr-eyebrow mr-eyebrow--mono" style="display: block;">Stable</span>
                </span>
              </div>
            </div>
            <div class="mr-pharmacy-row" style="align-items: center;">
              <div style="flex-direction: row; align-items: center; gap: 0.5rem;">
                <span class="mr-avatar">S</span>
                <span>
                  <strong>Seeya</strong>
                  <span class="mr-eyebrow mr-eyebrow--mono" style="display: block;">Monitoring</span>
                </span>
              </div>
            </div>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Upcoming refills</h2>
            </div>
            <div class="mr-refill">
              <strong>Amma · Lisinopril 10mg</strong>
              <span class="mr-refill__line"></span>
              <span class="mr-eyebrow mr-eyebrow--mono">Oct 12</span>
            </div>
            <div class="mr-refill">
              <strong>Seeya · Salbutamol Inhaler</strong>
              <span class="mr-refill__line"></span>
              <span class="mr-eyebrow mr-eyebrow--mono">Oct 18</span>
            </div>
          </section>

        </div>
      </div>
    </main>
  </div>
