<?php
$title = 'Manage Patients — MedReach';
$charts = true;
$active = 'family';
?>
  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <h1>Manage Patients</h1>

        <div class="mr-dash-header__actions">
          <label class="mr-pharm-search">
            <img src="presentation/assets/images/icons/filled/454655/search.png" alt="">
            <input type="search" id="mr-patient-search" placeholder="Search ID or name..." aria-label="Search ID or name">
          </label>

          <a class="mr-notif-btn mr-notif-btn--header" href="notifications.php" aria-label="Notifications">
            <img src="presentation/assets/images/icons/filled/1a1b24/appointment-reminders.png" alt="">
            <span class="mr-notif-btn__dot" aria-hidden="true"></span>
          </a>
        </div>
      </header>

      <div class="mr-dash-content">
      <div class="mr-dash-col">

      <section class="mr-card mr-dash-card">
        <div class="mr-roster-toolbar">
          <div class="mr-roster-toolbar__chips">
            <label class="mr-roster-filter">
              <img src="presentation/assets/images/icons/filled/454655/filter.png" alt="">
              <select id="mr-patient-status-filter" aria-label="Filter by status">
                <option value="">Filtered: All</option>
                <option value="pending">Filtered: Pending</option>
                <option value="stable">Filtered: Stable</option>
                <option value="inactive">Filtered: Inactive</option>
              </select>
            </label>
            <span class="mr-badge mr-badge--pill mr-badge--case-normal">Total: 3</span>
          </div>

          <button type="button" class="mr-btn mr-btn--primary mr-btn--sm" data-modal-open="mr-add-patient-modal">
            <img src="presentation/assets/images/icons/filled/ffffff/plus.png" alt="">
            Add Patient
          </button>
        </div>

        <div class="mr-pay-table-wrap">
          <table class="mr-pay-table" id="mr-patient-table">
            <thead>
              <tr>
                <th data-sort="name">Patient ID / Name</th>
                <th data-sort="age">Age/Demographics</th>
                <th data-sort="status">Status</th>
                <th data-sort="updated">Last Update</th>
                <th class="mr-pay-table__amount">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr data-name="pt-9824-a amma" data-age="72" data-status="pending" data-updated="2026-08-23T09:42:00">
                <td>
                  <span class="mr-patient-id">PT-9824-A</span>
                  <strong>Amma</strong>
                </td>
                <td><span class="mr-eyebrow">72 yrs | F</span></td>
                <td><span class="mr-badge mr-badge--accent"><span class="mr-badge__dot"></span>Pending</span></td>
                <td><span class="mr-eyebrow mr-eyebrow--mono">09:42 AM, Today</span></td>
                <td class="mr-pay-table__amount">
                  <button type="button" class="mr-table-menu-btn" aria-label="Actions for Amma">
                    <img src="presentation/assets/images/icons/filled/454655/more.png" alt="">
                  </button>
                  <div class="mr-row-menu" hidden>
                    <a href="order-history.php">View orders</a>
                    <button type="button" data-modal-open="mr-edit-patient-modal" data-subject="Amma">Edit details</button>
                    <button type="button" class="mr-row-menu__danger" data-modal-open="mr-remove-blocked-modal" data-subject="Amma">Remove patient</button>
                  </div>
                </td>
              </tr>
              <tr data-name="pt-3319-x seeya" data-age="80" data-status="stable" data-updated="2026-08-23T08:15:00">
                <td>
                  <span class="mr-patient-id">PT-3319-X</span>
                  <strong>Seeya</strong>
                </td>
                <td><span class="mr-eyebrow">80 yrs | M</span></td>
                <td><span class="mr-badge mr-badge--success"><span class="mr-badge__dot"></span>Stable</span></td>
                <td><span class="mr-eyebrow mr-eyebrow--mono">08:15 AM, Today</span></td>
                <td class="mr-pay-table__amount">
                  <button type="button" class="mr-table-menu-btn" aria-label="Actions for Seeya">
                    <img src="presentation/assets/images/icons/filled/454655/more.png" alt="">
                  </button>
                  <div class="mr-row-menu" hidden>
                    <a href="order-history.php">View orders</a>
                    <button type="button" data-modal-open="mr-edit-patient-modal" data-subject="Seeya">Edit details</button>
                    <button type="button" class="mr-row-menu__danger" data-modal-open="mr-remove-patient-modal" data-subject="Seeya">Remove patient</button>
                  </div>
                </td>
              </tr>
              <tr data-name="pt-7741-b dinuli" data-age="24" data-status="inactive" data-updated="2026-08-22T00:00:00">
                <td>
                  <span class="mr-patient-id">PT-7741-B</span>
                  <strong>Dinuli</strong>
                </td>
                <td><span class="mr-eyebrow">24 yrs | F</span></td>
                <td><span class="mr-badge mr-badge--pill"><span class="mr-badge__dot"></span>Inactive</span></td>
                <td><span class="mr-eyebrow mr-eyebrow--mono">Yesterday</span></td>
                <td class="mr-pay-table__amount">
                  <button type="button" class="mr-table-menu-btn" aria-label="Actions for Dinuli">
                    <img src="presentation/assets/images/icons/filled/454655/more.png" alt="">
                  </button>
                  <div class="mr-row-menu" hidden>
                    <a href="order-history.php">View orders</a>
                    <button type="button" data-modal-open="mr-edit-patient-modal" data-subject="Dinuli">Edit details</button>
                    <button type="button" class="mr-row-menu__danger" data-modal-open="mr-remove-patient-modal" data-subject="Dinuli">Remove patient</button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <p class="mr-roster-empty" hidden>No patients match this search or filter.</p>

        <div class="mr-pagination">
          <span class="mr-pagination__count" id="mr-patient-count">Showing 1-3 of 3</span>
          <nav class="mr-pagination__nav" aria-label="Patient pages">
            <button type="button" class="mr-pagination__btn" aria-disabled="true">
              <img src="presentation/assets/images/icons/filled/454655/back.png" alt="Previous">
            </button>
            <button type="button" class="mr-pagination__btn" aria-disabled="true">
              <img src="presentation/assets/images/icons/filled/1a1b24/forward.png" alt="Next">
            </button>
          </nav>
        </div>
      </section>

      </div>

      <div class="mr-dash-col">

        <section class="mr-resp-summary">
          <span class="mr-eyebrow" style="color: var(--mr-color-primary-dark);">Family Wellness</span>
          <h2>Adherence Overview</h2>
          <div class="mr-fleet-card__stat">
            <strong>87%</strong>
            <span class="mr-badge mr-badge--success mr-badge--case-normal">Optimal</span>
          </div>
          <p class="mr-fleet-card__caption">Combined medication adherence across managed patients.</p>
          <canvas id="mr-adherence-chart" class="mr-mini-bars" height="48" role="img" aria-label="7-day adherence trend, rising from 30% to 90%"></canvas>
        </section>

        <section class="mr-card mr-help-card mr-help-card--alert">
          <span class="mr-icon-badge mr-icon-badge--danger">
            <img src="presentation/assets/images/icons/filled/d6534a/error.png" alt="">
          </span>
          <div>
            <strong>Action required</strong>
            <p class="mr-eyebrow mr-eyebrow--mono">REF: PT-9824-A</p>
            <p>Amma's prescription refill needs pharmacist confirmation before the next dispatch.</p>
            <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" style="margin-top: 0.75rem;" data-toast="Acknowledged — we'll notify you once the pharmacist confirms.">Acknowledge</button>
          </div>
        </section>

        <section class="mr-card mr-dash-card">
          <h2>Activity Log</h2>
          <ul class="mr-activity-list">
            <li class="mr-activity-list__item mr-activity-list__item--active">
              <span class="mr-activity-list__dot"></span>
              <div>
                <span class="mr-eyebrow mr-eyebrow--mono">10:05 AM</span>
                <p>Status updated to Pending for <span class="mr-patient-id">PT-9824-A</span></p>
              </div>
            </li>
            <li class="mr-activity-list__item">
              <span class="mr-activity-list__dot"></span>
              <div>
                <span class="mr-eyebrow mr-eyebrow--mono">09:42 AM</span>
                <p>Routine check completed for <span class="mr-patient-id">PT-9824-A</span></p>
              </div>
            </li>
            <li class="mr-activity-list__item">
              <span class="mr-activity-list__dot"></span>
              <div>
                <span class="mr-eyebrow mr-eyebrow--mono">08:15 AM</span>
                <p>Profile reviewed for <span class="mr-patient-id">PT-3319-X</span></p>
              </div>
            </li>
          </ul>
        </section>

      </div>
      </div>
    </main>
  </div>

  <div class="mr-modal" id="mr-add-patient-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Add Patient</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <form class="mr-auth-form mr-auth-form--grid mr-modal__form" id="mr-add-patient-form" data-toast="Patient profile saved.">
        <label class="mr-field mr-field--span2">
          <span>Full Name</span>
          <div class="mr-field__input">
            <input type="text" placeholder="e.g. Nimal Perera" required>
          </div>
        </label>
        <label class="mr-field">
          <span>DOB</span>
          <div class="mr-field__input">
            <input type="date">
          </div>
        </label>
        <label class="mr-field">
          <span>Relationship</span>
          <div class="mr-field__input">
            <select required>
              <option value="" disabled selected>Select...</option>
              <option>Mother</option>
              <option>Father</option>
              <option>Spouse</option>
              <option>Child</option>
              <option>Other</option>
            </select>
          </div>
        </label>
        <label class="mr-field mr-field--span2">
          <span>Phone Number</span>
          <div class="mr-field__input">
            <input type="tel" placeholder="+94 77 123 4567">
          </div>
        </label>
        <label class="mr-field mr-field--span2">
          <span>Delivery Address</span>
          <textarea rows="3" placeholder="Enter full address..."></textarea>
        </label>

        <div class="mr-modal__actions mr-field--span2">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Save Patient Profile</button>
        </div>
      </form>
    </div>
  </div>

  <div class="mr-modal" id="mr-edit-patient-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Edit <span data-subject-slot="patient"></span></h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <form class="mr-auth-form mr-auth-form--grid mr-modal__form" data-toast="Patient details updated.">
        <label class="mr-field">
          <span>Phone Number</span>
          <div class="mr-field__input">
            <input type="tel" placeholder="+94 77 123 4567">
          </div>
        </label>
        <label class="mr-field">
          <span>Status</span>
          <div class="mr-field__input">
            <select>
              <option>Stable</option>
              <option>Pending</option>
              <option>Inactive</option>
            </select>
          </div>
        </label>
        <label class="mr-field mr-field--span2">
          <span>Delivery Address</span>
          <textarea rows="3" placeholder="Enter full address..."></textarea>
        </label>

        <div class="mr-modal__actions mr-field--span2">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Save changes</button>
        </div>
      </form>
    </div>
  </div>

  <div class="mr-modal" id="mr-remove-patient-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Remove <span data-subject-slot="patient"></span>?</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <p class="mr-modal__text">Their profile is removed from your family list. Past orders stay in your order history.</p>

      <form class="mr-modal__form" data-toast="Patient removed from your family list.">
        <div class="mr-modal__actions">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--dark mr-btn--sm">Remove patient</button>
        </div>
      </form>
    </div>
  </div>

  <div class="mr-modal" id="mr-remove-blocked-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Can't remove <span data-subject-slot="patient"></span></h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <p class="mr-modal__text">This patient has an active or pending order. You can remove them once every order is delivered or cancelled.</p>

      <div class="mr-modal__actions">
        <a class="mr-btn mr-btn--ghost mr-btn--sm" href="order-history.php">View orders</a>
        <button type="button" class="mr-btn mr-btn--primary mr-btn--sm" data-modal-close>OK</button>
      </div>
    </div>
  </div>
