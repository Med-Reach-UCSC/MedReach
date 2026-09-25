<?php
// MedReach - Admin pharmacy management (presentation tier: HTML output only)
$active = 'pharmacies';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pharmacy Management — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body>

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-admin.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <h1>Pharmacy Management</h1>

        <div class="mr-dash-header__actions">
          <label class="mr-pharm-search">
            <img src="https://img.icons8.com/ios-filled/50/454655/search.png" alt="">
            <input type="search" id="mr-pharmacy-search" placeholder="Search pharmacies..." aria-label="Search pharmacies">
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
            <span class="mr-eyebrow mr-eyebrow--mono">Active Network</span>
            <strong>1,248</strong>
          </div>
          <span class="mr-icon-badge mr-icon-badge--success mr-icon-badge--lg">
            <img src="https://img.icons8.com/ios-filled/50/1f9d6b/checkmark.png" alt="">
          </span>
        </section>

        <section class="mr-card mr-mini-stat mr-mini-stat--accent">
          <div>
            <span class="mr-eyebrow mr-eyebrow--mono">Pending Approval</span>
            <strong>34</strong>
          </div>
          <span class="mr-icon-badge mr-icon-badge--accent mr-icon-badge--lg">
            <img src="https://img.icons8.com/ios-filled/50/dd8e1c/hourglass.png" alt="">
          </span>
        </section>

        <section class="mr-card mr-mini-stat">
          <div>
            <span class="mr-eyebrow mr-eyebrow--mono">Weekly Dispatches</span>
            <strong>8.4k</strong>
          </div>
          <span class="mr-icon-badge mr-icon-badge--info mr-icon-badge--lg">
            <img src="https://img.icons8.com/ios-filled/50/2d3fd7/shipped.png" alt="">
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
                  <select id="mr-pharmacy-status-filter" aria-label="Filter by status">
                    <option value="">Filtered: All</option>
                    <option value="active">Filtered: Active</option>
                    <option value="pending">Filtered: Pending</option>
                  </select>
                </label>
                <span class="mr-badge mr-badge--pill mr-badge--case-normal">Total: 3</span>
              </div>

              <button type="button" class="mr-btn mr-btn--primary mr-btn--sm" data-modal-open="mr-pharmacy-form-modal">
                <img src="https://img.icons8.com/ios-filled/50/ffffff/plus.png" alt="">
                Add Pharmacy
              </button>
            </div>

            <div class="mr-pay-table-wrap">
              <table class="mr-pay-table" id="mr-pharmacy-table">
                <thead>
                  <tr>
                    <th data-sort="name">Pharmacy Name</th>
                    <th data-sort="location">Location</th>
                    <th data-sort="status">Status</th>
                    <th class="mr-pay-table__amount">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr data-name="apex care pharmacy" data-location="colombo 07" data-status="active">
                    <td>
                      <span class="mr-eyebrow mr-eyebrow--mono">RX-4029</span>
                      <strong>Apex Care Pharmacy</strong>
                    </td>
                    <td>Colombo 07</td>
                    <td><span class="mr-badge mr-badge--success"><span class="mr-badge__dot"></span>Active</span></td>
                    <td class="mr-pay-table__amount">
                      <button type="button" class="mr-table-menu-btn" aria-label="Actions for Apex Care Pharmacy">
                        <img src="https://img.icons8.com/ios-filled/50/454655/more.png" alt="">
                      </button>
                      <div class="mr-row-menu" hidden>
                        <button type="button" data-modal-open="mr-pharmacy-view-modal" data-subject="Apex Care Pharmacy">View details</button>
                        <button type="button" data-modal-open="mr-pharmacy-form-modal" data-subject="Edit Apex Care Pharmacy">Edit details</button>
                        <button type="button" class="mr-row-menu__danger" data-modal-open="mr-pharmacy-deactivate-modal" data-subject="Apex Care Pharmacy">Deactivate</button>
                      </div>
                    </td>
                  </tr>
                  <tr data-name="northside meds" data-location="kandy" data-status="pending">
                    <td>
                      <span class="mr-eyebrow mr-eyebrow--mono">RX-8812</span>
                      <strong>Northside Meds</strong>
                    </td>
                    <td>Kandy</td>
                    <td><span class="mr-badge mr-badge--accent"><span class="mr-badge__dot"></span>Pending</span></td>
                    <td class="mr-pay-table__amount">
                      <button type="button" class="mr-btn mr-btn--primary mr-btn--sm" data-modal-open="mr-pharmacy-review-modal">Review</button>
                    </td>
                  </tr>
                  <tr data-name="valley health rx" data-location="galle" data-status="active">
                    <td>
                      <span class="mr-eyebrow mr-eyebrow--mono">RX-1104</span>
                      <strong>Valley Health Rx</strong>
                    </td>
                    <td>Galle</td>
                    <td><span class="mr-badge mr-badge--success"><span class="mr-badge__dot"></span>Active</span></td>
                    <td class="mr-pay-table__amount">
                      <button type="button" class="mr-table-menu-btn" aria-label="Actions for Valley Health Rx">
                        <img src="https://img.icons8.com/ios-filled/50/454655/more.png" alt="">
                      </button>
                      <div class="mr-row-menu" hidden>
                        <button type="button" data-modal-open="mr-pharmacy-view-modal" data-subject="Valley Health Rx">View details</button>
                        <button type="button" data-modal-open="mr-pharmacy-form-modal" data-subject="Edit Valley Health Rx">Edit details</button>
                        <button type="button" class="mr-row-menu__danger" data-modal-open="mr-pharmacy-deactivate-modal" data-subject="Valley Health Rx">Deactivate</button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <p class="mr-roster-empty" hidden>No pharmacies match this search or filter.</p>

            <div class="mr-pagination">
              <span class="mr-pagination__count" id="mr-pharmacy-count">Showing 1-3 of 3</span>
              <nav class="mr-pagination__nav" aria-label="Pharmacy pages">
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

          <div class="mr-map-preview mr-map-preview--lg">
            <span class="mr-map-preview__pin" aria-hidden="true"></span>
            <span class="mr-map-preview__label">84% coverage &middot; Western Province</span>
          </div>

          <section class="mr-card mr-dash-card">
            <h2>Quick Actions</h2>
            <div class="mr-activity-list">
              <button type="button" class="mr-btn mr-btn--ghost" style="width: 100%; justify-content: space-between;" data-toast="Compliance report generated — check your email.">
                Generate Compliance Report
                <img src="https://img.icons8.com/ios-filled/50/454655/forward-arrow.png" alt="">
              </button>
              <button type="button" class="mr-btn mr-btn--ghost" style="width: 100%; justify-content: space-between; margin-top: 0.5rem;" data-modal-open="mr-pharmacy-review-modal">
                Verify Licensing
                <img src="https://img.icons8.com/ios-filled/50/454655/forward-arrow.png" alt="">
              </button>
            </div>
          </section>

        </div>
      </div>
    </main>
  </div>

  <div class="mr-modal" id="mr-pharmacy-form-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2><span data-subject-slot="Register a pharmacy"></span></h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="https://img.icons8.com/ios-filled/50/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <form class="mr-auth-form mr-auth-form--grid mr-modal__form" data-toast="Pharmacy saved.">
        <label class="mr-field mr-field--span2">
          <span>Pharmacy name</span>
          <div class="mr-field__input">
            <input type="text" placeholder="e.g. CityHealth Pharmacy" required>
          </div>
        </label>
        <label class="mr-field">
          <span>NMRA licence no.</span>
          <div class="mr-field__input">
            <input type="text" placeholder="e.g. PH-2026-0418" required>
          </div>
        </label>
        <label class="mr-field">
          <span>Phone</span>
          <div class="mr-field__input">
            <input type="tel" placeholder="+94 11 234 5678" required>
          </div>
        </label>
        <label class="mr-field mr-field--span2">
          <span>Address</span>
          <div class="mr-field__input">
            <input type="text" placeholder="Street, city" required>
          </div>
        </label>
        <label class="mr-field mr-field--span2">
          <span>Pharmacist email</span>
          <div class="mr-field__input">
            <input type="email" placeholder="pharmacist@example.lk" required>
          </div>
        </label>

        <div class="mr-modal__actions mr-field--span2">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Save</button>
        </div>
      </form>
    </div>
  </div>

  <div class="mr-modal" id="mr-pharmacy-view-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2><span data-subject-slot="Pharmacy"></span></h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="https://img.icons8.com/ios-filled/50/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <dl class="mr-modal__list">
        <div><dt>Status</dt><dd>Active</dd></div>
        <div><dt>NMRA licence</dt><dd>PH-2024-0192</dd></div>
        <div><dt>Registered</dt><dd>Mar 12, 2026</dd></div>
        <div><dt>Orders this month</dt><dd>312</dd></div>
        <div><dt>Acceptance rate</dt><dd>94%</dd></div>
      </dl>

      <div class="mr-modal__actions">
        <button type="button" class="mr-btn mr-btn--primary mr-btn--sm" data-modal-close>Close</button>
      </div>
    </div>
  </div>

  <div class="mr-modal" id="mr-pharmacy-deactivate-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Deactivate <span data-subject-slot="pharmacy"></span>?</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="https://img.icons8.com/ios-filled/50/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <p class="mr-modal__text">New prescriptions will stop routing to this pharmacy. Orders already in progress will still complete.</p>

      <form class="mr-auth-form mr-modal__form" data-toast="Pharmacy deactivated.">
        <label class="mr-field">
          <span>Reason</span>
          <textarea rows="2" placeholder="Visible to the pharmacy..." required></textarea>
        </label>

        <div class="mr-modal__actions">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--danger-outline mr-btn--sm">Deactivate</button>
        </div>
      </form>
    </div>
  </div>

  <div class="mr-modal" id="mr-pharmacy-review-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Review Northside Meds</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="https://img.icons8.com/ios-filled/50/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <p class="mr-modal__text">Check the licence against the NMRA register before approving. Approved pharmacies start receiving nearby prescriptions straight away.</p>

      <dl class="mr-modal__list">
        <div><dt>NMRA licence</dt><dd>PH-2026-0418</dd></div>
        <div><dt>Pharmacist</dt><dd>R. Perera (SLMC-5520)</dd></div>
        <div><dt>Address</dt><dd>22 Peradeniya Rd, Kandy</dd></div>
        <div><dt>Applied</dt><dd>Sep 21, 2026</dd></div>
      </dl>

      <div class="mr-modal__actions">
        <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close data-toast="Application rejected — the pharmacy has been emailed.">Reject</button>
        <button type="button" class="mr-btn mr-btn--primary mr-btn--sm" data-modal-close data-toast="Northside Meds approved and added to the network.">Approve</button>
      </div>
    </div>
  </div>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
