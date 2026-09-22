<?php
// MedReach - Admin user management (presentation tier: HTML output only)
// Converted from docs/manage-users.php (Tailwind mockup) onto the same
// mr- component system as the rest of the admin/patient/pharmacy modules —
// reused patterns only, plus one small CSS addition (mr-stat-grid-4) for
// the 4-card KPI row the mockup uses (vs. the 3-card mr-stat-grid-3
// everywhere else).
//
// Defects fixed vs the mockup: dropped the Tailwind CDN/Google Fonts/inline
// theme config for the project's own --mr- token system; dropped the
// hotlinked AI stock-photo admin avatar (the sidebar already has a profile
// link via mr-avatar, so no header avatar was re-added); dropped the
// decorative dark-mode toggle (project has no dark theme anywhere, so a
// button that does nothing was left out rather than shipped for looks);
// dropped the mockup's Overview/User List/Permissions header tab strip
// (redundant with the sidebar nav — Overview/Permissions had nowhere real
// to go); reused mr-stat-grid-3/mr-mini-stat icon-badge pattern (widened to 4 via
// the new mr-stat-grid-4) instead of the mockup's one-off gradient hero
// card, and dropped the mockup's fabricated trend chips (no existing
// mini-stat in this codebase carries a delta sub-line); reused the
// mr-roster-toolbar + mr-pay-table + mr-pagination roster pattern
// (manage-pharmacies.php) instead of the mockup's hand-rolled "Node ID"
// table, translated onto real USER fields matching the schema's role enum
// (patient/pharmacist/delivery/admin); reused mr-icon-btn (request-detail
// page's round icon button) for the ledger's export action instead of the
// mockup's one-off toolbar buttons, and dropped its redundant filter icon
// since the roster's own filter dropdown already covers that; reused the
// mr-spend-ring Chart.js doughnut (patient payments' "Monthly Spend"
// pattern) for Role Distribution instead of the mockup's hand-rolled
// inline-SVG ring, whose dash offsets didn't actually match its own
// legend's 65/25/10 split; reused mr-notif-list/mr-notif-item
// (notifications.php's alert-row pattern) for the account-activity feed
// instead of the mockup's one-off "System Anomalies" alert cards.
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

      <div class="mr-stat-grid-4">
        <section class="mr-card mr-mini-stat">
          <div>
            <span class="mr-eyebrow mr-eyebrow--mono">Active Sessions</span>
            <strong>1,248</strong>
          </div>
          <span class="mr-icon-badge mr-icon-badge--success mr-icon-badge--lg">
            <img src="https://img.icons8.com/ios-filled/50/1f9d6b/speed.png" alt="">
          </span>
        </section>

        <section class="mr-card mr-mini-stat">
          <div>
            <span class="mr-eyebrow mr-eyebrow--mono">Auth Failures</span>
            <strong>0.04%</strong>
          </div>
          <span class="mr-icon-badge mr-icon-badge--danger mr-icon-badge--lg">
            <img src="https://img.icons8.com/ios-filled/50/de4a4f/warning-shield.png" alt="">
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
            <span class="mr-eyebrow mr-eyebrow--mono">Total Users</span>
            <strong>1,412</strong>
          </div>
          <span class="mr-icon-badge mr-icon-badge--info mr-icon-badge--lg">
            <img src="https://img.icons8.com/ios-filled/50/2d3fd7/conference-call.png" alt="">
          </span>
        </section>
      </div>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>User Ledger</h2>
              <button type="button" class="mr-icon-btn" aria-label="Export user ledger">
                <img src="https://img.icons8.com/ios-filled/50/454655/export.png" alt="">
              </button>
            </div>

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
                    <th data-sort="id">User ID</th>
                    <th data-sort="name">User</th>
                    <th data-sort="role">Role</th>
                    <th data-sort="status">Status</th>
                    <th data-sort="active">Last Active</th>
                    <th class="mr-pay-table__amount">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr data-id="u-001" data-name="dr. jane doe" data-role="admin" data-status="active" data-active="0">
                    <td><span class="mr-eyebrow mr-eyebrow--mono">U-001</span></td>
                    <td>
                      <div style="display: flex; align-items: center; gap: 0.6rem;">
                        <span class="mr-avatar mr-avatar--dash">JD</span>
                        <strong>Dr. Jane Doe</strong>
                      </div>
                    </td>
                    <td>Admin</td>
                    <td><span class="mr-badge mr-badge--success"><span class="mr-badge__dot"></span>Active</span></td>
                    <td>2 min ago</td>
                    <td class="mr-pay-table__amount">
                      <button type="button" class="mr-table-menu-btn" aria-label="Actions for Dr. Jane Doe">
                        <img src="https://img.icons8.com/ios-filled/50/454655/more.png" alt="">
                      </button>
                    </td>
                  </tr>
                  <tr data-id="u-042" data-name="alex smith" data-role="pharmacist" data-status="active" data-active="1">
                    <td><span class="mr-eyebrow mr-eyebrow--mono">U-042</span></td>
                    <td>
                      <div style="display: flex; align-items: center; gap: 0.6rem;">
                        <span class="mr-avatar mr-avatar--dash">AS</span>
                        <strong>Alex Smith</strong>
                      </div>
                    </td>
                    <td>Pharmacist</td>
                    <td><span class="mr-badge mr-badge--success"><span class="mr-badge__dot"></span>Active</span></td>
                    <td>15 min ago</td>
                    <td class="mr-pay-table__amount">
                      <button type="button" class="mr-table-menu-btn" aria-label="Actions for Alex Smith">
                        <img src="https://img.icons8.com/ios-filled/50/454655/more.png" alt="">
                      </button>
                    </td>
                  </tr>
                  <tr data-id="u-118" data-name="bob jones" data-role="delivery" data-status="suspended" data-active="3">
                    <td><span class="mr-eyebrow mr-eyebrow--mono">U-118</span></td>
                    <td>
                      <div style="display: flex; align-items: center; gap: 0.6rem;">
                        <span class="mr-avatar mr-avatar--dash">BJ</span>
                        <strong>Bob Jones</strong>
                      </div>
                    </td>
                    <td>Delivery</td>
                    <td><span class="mr-badge mr-badge--danger"><span class="mr-badge__dot"></span>Suspended</span></td>
                    <td>&gt;5 hrs ago</td>
                    <td class="mr-pay-table__amount">
                      <button type="button" class="mr-btn mr-btn--primary mr-btn--sm">Review</button>
                    </td>
                  </tr>
                  <tr data-id="u-201" data-name="carol white" data-role="patient" data-status="pending" data-active="2">
                    <td><span class="mr-eyebrow mr-eyebrow--mono">U-201</span></td>
                    <td>
                      <div style="display: flex; align-items: center; gap: 0.6rem;">
                        <span class="mr-avatar mr-avatar--dash">CW</span>
                        <strong>Carol White</strong>
                      </div>
                    </td>
                    <td>Patient</td>
                    <td><span class="mr-badge mr-badge--accent"><span class="mr-badge__dot"></span>Pending</span></td>
                    <td>2 hrs ago</td>
                    <td class="mr-pay-table__amount">
                      <button type="button" class="mr-table-menu-btn" aria-label="Actions for Carol White">
                        <img src="https://img.icons8.com/ios-filled/50/454655/more.png" alt="">
                      </button>
                    </td>
                  </tr>
                  <tr data-id="u-205" data-name="dan miller" data-role="pharmacist" data-status="inactive" data-active="4">
                    <td><span class="mr-eyebrow mr-eyebrow--mono">U-205</span></td>
                    <td>
                      <div style="display: flex; align-items: center; gap: 0.6rem;">
                        <span class="mr-avatar mr-avatar--dash">DM</span>
                        <strong>Dan Miller</strong>
                      </div>
                    </td>
                    <td>Pharmacist</td>
                    <td><span class="mr-badge mr-badge--pill mr-badge--case-normal"><span class="mr-badge__dot"></span>Inactive</span></td>
                    <td>1 day ago</td>
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

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Role Distribution</h2>
            </div>

            <div class="mr-spend-ring">
              <canvas id="mr-role-chart" width="128" height="128" role="img" aria-label="Role distribution: 65% patients, 18% pharmacists, 12% delivery, 5% admins"></canvas>
              <div class="mr-spend-ring__inner">
                <span>Roles</span>
                <strong>4</strong>
              </div>
            </div>

            <div class="mr-spend-row">
              <span class="mr-spend-row__label">
                <i class="mr-spend-dot mr-spend-dot--primary"></i>
                Patients
              </span>
              <strong>65%</strong>
            </div>
            <div class="mr-spend-row">
              <span class="mr-spend-row__label">
                <i class="mr-spend-dot mr-spend-dot--light"></i>
                Pharmacists
              </span>
              <strong>18%</strong>
            </div>
            <div class="mr-spend-row">
              <span class="mr-spend-row__label">
                <i class="mr-spend-dot" style="background-color: var(--mr-color-accent);"></i>
                Delivery
              </span>
              <strong>12%</strong>
            </div>
            <div class="mr-spend-row">
              <span class="mr-spend-row__label">
                <i class="mr-spend-dot" style="background-color: var(--mr-color-text-muted);"></i>
                Admins
              </span>
              <strong>5%</strong>
            </div>
          </section>

          <section class="mr-card mr-notif-list">
            <div class="mr-notif-list__section">
              <span class="mr-eyebrow">Account Activity</span>

              <div class="mr-notif-item is-unread" data-read="false">
                <span class="mr-icon-badge mr-icon-badge--danger">
                  <img src="https://img.icons8.com/ios-filled/50/de4a4f/error.png" alt="">
                </span>
                <span class="mr-notif-item__info">
                  <span class="mr-notif-item__title">Bob Jones account suspended — suspicious login attempts</span>
                </span>
                <span class="mr-notif-item__time">Just now</span>
                <span class="mr-notif-item__dot" aria-hidden="true"></span>
              </div>

              <div class="mr-notif-item is-unread" data-read="false">
                <span class="mr-icon-badge mr-icon-badge--accent">
                  <img src="https://img.icons8.com/ios-filled/50/dd8e1c/hourglass.png" alt="">
                </span>
                <span class="mr-notif-item__info">
                  <span class="mr-notif-item__title">Carol White awaiting identity verification</span>
                </span>
                <span class="mr-notif-item__time">15 min ago</span>
                <span class="mr-notif-item__dot" aria-hidden="true"></span>
              </div>

              <div class="mr-notif-item" data-read="true">
                <span class="mr-icon-badge mr-icon-badge--info">
                  <img src="https://img.icons8.com/ios-filled/50/2d3fd7/conference-call.png" alt="">
                </span>
                <span class="mr-notif-item__info">
                  <span class="mr-notif-item__title">New pharmacist account created by Admin: Jane</span>
                </span>
                <span class="mr-notif-item__time">1 hr ago</span>
              </div>

              <div class="mr-notif-item" data-read="true">
                <span class="mr-icon-badge mr-icon-badge--success">
                  <img src="https://img.icons8.com/ios-filled/50/1f9d6b/checkmark.png" alt="">
                </span>
                <span class="mr-notif-item__info">
                  <span class="mr-notif-item__title">Bulk role audit completed (Batch_992)</span>
                </span>
                <span class="mr-notif-item__time">3 hrs ago</span>
              </div>
            </div>
          </section>

        </div>
      </div>
    </main>
  </div>

  <script src="presentation/assets/js/vendor/chart.umd.min.js"></script>
  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
