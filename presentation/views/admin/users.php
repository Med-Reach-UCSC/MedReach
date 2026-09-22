<?php
// MedReach - Admin user management (presentation tier: HTML output only)
// Converted from docs/manage-users.php (Tailwind mockup) onto the same
// mr- component system as the rest of the admin/patient/pharmacy modules —
// no new CSS or JS classes added, only reused patterns.
//
// Defects fixed vs the mockup: dropped the Tailwind CDN/Google Fonts/inline
// theme config for the project's own --mr- token system; dropped the
// hotlinked AI stock-photo admin avatar (replaced with the initials
// mr-avatar component already used everywhere else); reused
// mr-stat-grid-3 + mr-mini-stat (pharmacy management's pattern) instead of
// the mockup's one-off KPI cluster; reused the mr-roster-toolbar +
// mr-pay-table + mr-pagination roster pattern (manage-pharmacies.php)
// instead of the mockup's hand-rolled "Node ID" table, which also drops the
// mockup's fake system-telemetry framing (Node ID/Last Ping/Sys Load) that
// doesn't match a user-management screen and replaces it with actual
// USER fields (role, status, joined date) matching the real role enum
// (patient/pharmacist/delivery/admin per schema — never "guardian", per
// project's locked domain decisions); reused mr-med-stats bars (admin
// dashboard's Outcome Status pattern) instead of the mockup's hand-rolled
// inline-SVG donut ring, which had no legend-to-slice mapping (the ring's
// dash offsets didn't match the legend's 65/25/10 split); reused mr-timeline
// (admin dashboard's System Activity pattern) instead of the mockup's
// one-off "System Anomalies" alert cards.
$active = 'users';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Management — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body>

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-admin.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <h1>User Management</h1>

        <div class="mr-dash-header__actions">
          <label class="mr-pharm-search">
            <img src="https://img.icons8.com/ios-filled/50/454655/search.png" alt="">
            <input type="search" id="mr-user-search" placeholder="Search users..." aria-label="Search users">
          </label>

          <a class="mr-notif-btn mr-notif-btn--header" href="notifications.php" aria-label="Notifications">
            <img src="https://img.icons8.com/ios-filled/50/1a1b24/appointment-reminders.png" alt="">
            <span class="mr-notif-btn__dot" aria-hidden="true"></span>
          </a>
        </div>
      </header>

      <div class="mr-stat-grid-3">
        <section class="mr-card mr-mini-stat">
          <div>
            <span class="mr-eyebrow mr-eyebrow--mono">Total Users</span>
            <strong>1,248</strong>
          </div>
          <span class="mr-icon-badge mr-icon-badge--success mr-icon-badge--lg">
            <img src="https://img.icons8.com/ios-filled/50/1f9d6b/group.png" alt="">
          </span>
        </section>

        <section class="mr-card mr-mini-stat mr-mini-stat--accent">
          <div>
            <span class="mr-eyebrow mr-eyebrow--mono">Pending Verification</span>
            <strong>34</strong>
          </div>
          <span class="mr-icon-badge mr-icon-badge--accent mr-icon-badge--lg">
            <img src="https://img.icons8.com/ios-filled/50/dd8e1c/hourglass.png" alt="">
          </span>
        </section>

        <section class="mr-card mr-mini-stat">
          <div>
            <span class="mr-eyebrow mr-eyebrow--mono">Suspended Accounts</span>
            <strong>6</strong>
          </div>
          <span class="mr-icon-badge mr-icon-badge--danger mr-icon-badge--lg">
            <img src="https://img.icons8.com/ios-filled/50/de4a4f/cancel.png" alt="">
          </span>
        </section>
      </div>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-roster-toolbar">
              <div class="mr-roster-toolbar__chips">
                <label class="mr-roster-filter">
                  <img src="https://img.icons8.com/ios-filled/50/454655/filter.png" alt="">
                  <select id="mr-user-role-filter" aria-label="Filter by role">
                    <option value="">Filtered: All</option>
                    <option value="patient">Filtered: Patient</option>
                    <option value="pharmacist">Filtered: Pharmacist</option>
                    <option value="delivery">Filtered: Delivery</option>
                    <option value="admin">Filtered: Admin</option>
                  </select>
                </label>
                <span class="mr-badge mr-badge--pill mr-badge--case-normal">Total: 5</span>
              </div>

              <button type="button" class="mr-btn mr-btn--primary mr-btn--sm">
                <img src="https://img.icons8.com/ios-filled/50/ffffff/plus.png" alt="">
                Create User
              </button>
            </div>

            <div class="mr-pay-table-wrap">
              <table class="mr-pay-table" id="mr-user-table">
                <thead>
                  <tr>
                    <th data-sort="name">User</th>
                    <th data-sort="role">Role</th>
                    <th data-sort="status">Status</th>
                    <th data-sort="joined">Joined</th>
                    <th class="mr-pay-table__amount">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr data-name="dr. jane doe" data-role="admin" data-status="active" data-joined="2024-01-12">
                    <td>
                      <div style="display: flex; align-items: center; gap: 0.6rem;">
                        <span class="mr-avatar mr-avatar--dash">JD</span>
                        <strong>Dr. Jane Doe</strong>
                      </div>
                    </td>
                    <td>Admin</td>
                    <td><span class="mr-badge mr-badge--success"><span class="mr-badge__dot"></span>Active</span></td>
                    <td>Jan 12, 2024</td>
                    <td class="mr-pay-table__amount">
                      <button type="button" class="mr-table-menu-btn" aria-label="Actions for Dr. Jane Doe">
                        <img src="https://img.icons8.com/ios-filled/50/454655/more.png" alt="">
                      </button>
                    </td>
                  </tr>
                  <tr data-name="alex smith" data-role="pharmacist" data-status="active" data-joined="2024-03-04">
                    <td>
                      <div style="display: flex; align-items: center; gap: 0.6rem;">
                        <span class="mr-avatar mr-avatar--dash">AS</span>
                        <strong>Alex Smith</strong>
                      </div>
                    </td>
                    <td>Pharmacist</td>
                    <td><span class="mr-badge mr-badge--success"><span class="mr-badge__dot"></span>Active</span></td>
                    <td>Mar 4, 2024</td>
                    <td class="mr-pay-table__amount">
                      <button type="button" class="mr-table-menu-btn" aria-label="Actions for Alex Smith">
                        <img src="https://img.icons8.com/ios-filled/50/454655/more.png" alt="">
                      </button>
                    </td>
                  </tr>
                  <tr data-name="bob jones" data-role="delivery" data-status="suspended" data-joined="2024-05-20">
                    <td>
                      <div style="display: flex; align-items: center; gap: 0.6rem;">
                        <span class="mr-avatar mr-avatar--dash">BJ</span>
                        <strong>Bob Jones</strong>
                      </div>
                    </td>
                    <td>Delivery</td>
                    <td><span class="mr-badge mr-badge--danger"><span class="mr-badge__dot"></span>Suspended</span></td>
                    <td>May 20, 2024</td>
                    <td class="mr-pay-table__amount">
                      <button type="button" class="mr-btn mr-btn--primary mr-btn--sm">Review</button>
                    </td>
                  </tr>
                  <tr data-name="carol white" data-role="patient" data-status="pending" data-joined="2024-08-02">
                    <td>
                      <div style="display: flex; align-items: center; gap: 0.6rem;">
                        <span class="mr-avatar mr-avatar--dash">CW</span>
                        <strong>Carol White</strong>
                      </div>
                    </td>
                    <td>Patient</td>
                    <td><span class="mr-badge mr-badge--accent"><span class="mr-badge__dot"></span>Pending</span></td>
                    <td>Aug 2, 2024</td>
                    <td class="mr-pay-table__amount">
                      <button type="button" class="mr-table-menu-btn" aria-label="Actions for Carol White">
                        <img src="https://img.icons8.com/ios-filled/50/454655/more.png" alt="">
                      </button>
                    </td>
                  </tr>
                  <tr data-name="dan miller" data-role="pharmacist" data-status="active" data-joined="2024-09-15">
                    <td>
                      <div style="display: flex; align-items: center; gap: 0.6rem;">
                        <span class="mr-avatar mr-avatar--dash">DM</span>
                        <strong>Dan Miller</strong>
                      </div>
                    </td>
                    <td>Pharmacist</td>
                    <td><span class="mr-badge mr-badge--success"><span class="mr-badge__dot"></span>Active</span></td>
                    <td>Sep 15, 2024</td>
                    <td class="mr-pay-table__amount">
                      <button type="button" class="mr-table-menu-btn" aria-label="Actions for Dan Miller">
                        <img src="https://img.icons8.com/ios-filled/50/454655/more.png" alt="">
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <p class="mr-roster-empty" hidden>No users match this search or filter.</p>

            <div class="mr-pagination">
              <span class="mr-pagination__count" id="mr-user-count">Showing 1-5 of 5</span>
              <nav class="mr-pagination__nav" aria-label="User pages">
                <button type="button" class="mr-pagination__btn" aria-disabled="true">
                  <img src="https://img.icons8.com/ios-filled/50/454655/back.png" alt="Previous">
                </button>
                <button type="button" class="mr-pagination__btn" aria-disabled="true">
                  <img src="https://img.icons8.com/ios-filled/50/1a1b24/forward.png" alt="Next">
                </button>
              </nav>
            </div>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-med-stats">
            <h2>Role Distribution</h2>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>Patients</span>
                <strong>65%</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 65%;"></div></div>
            </div>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>Pharmacists</span>
                <strong>18%</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 18%; opacity: .8;"></div></div>
            </div>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>Delivery</span>
                <strong>12%</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 12%; opacity: .6;"></div></div>
            </div>

            <div class="mr-med-stats__row">
              <div class="mr-med-stats__label">
                <span>Admins</span>
                <strong>5%</strong>
              </div>
              <div class="mr-med-stats__bar"><div class="mr-med-stats__fill" style="width: 5%; opacity: .4;"></div></div>
            </div>
          </section>

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Account Activity</h2>
            </div>
            <ol class="mr-timeline">
              <li class="mr-timeline__step mr-timeline__step--active">
                <strong>Bob Jones account suspended</strong>
                <small>Admin: Jane</small>
                <span class="mr-timeline__time">Just now</span>
              </li>
              <li class="mr-timeline__step">
                <strong>Carol White pending verification</strong>
                <small>Auto-sys</small>
                <span class="mr-timeline__time">15 min ago</span>
              </li>
              <li class="mr-timeline__step">
                <strong>New pharmacist account created</strong>
                <small>Admin: Jane</small>
                <span class="mr-timeline__time">1 hr ago</span>
              </li>
              <li class="mr-timeline__step">
                <strong>Bulk role audit completed</strong>
                <small>System</small>
                <span class="mr-timeline__time">3 hrs ago</span>
              </li>
            </ol>
          </section>

        </div>
      </div>
    </main>
  </div>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
