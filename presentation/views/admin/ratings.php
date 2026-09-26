<?php
$title = 'Ratings — MedReach';
$active = 'ratings';
?>
  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <h1>Ratings</h1>

        <div class="mr-dash-header__actions">
          <div class="mr-dash-stats">
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value">4.6</strong>
              <span>Network average</span>
            </div>
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--pending">1</strong>
              <span>Hidden</span>
            </div>
          </div>
        </div>
      </header>

      <section class="mr-card mr-dash-card">
        <div class="mr-dash-card__head">
          <h2>Recent ratings</h2>
          <label class="mr-roster-filter">
            <img src="presentation/assets/images/icons/filled/454655/filter.png" alt="">
            <select data-row-filter="mr-rating-table" aria-label="Filter by visibility">
              <option value="">All ratings</option>
              <option value="visible">Visible</option>
              <option value="hidden">Hidden</option>
            </select>
          </label>
        </div>

        <div class="mr-pay-table-wrap">
          <table class="mr-pay-table" id="mr-rating-table">
            <thead>
              <tr>
                <th>Pharmacy</th>
                <th>Patient</th>
                <th>Stars</th>
                <th>Comment</th>
                <th>Status</th>
                <th class="mr-pay-table__amount">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr data-filter-value="visible">
                <td>
                  <span class="mr-eyebrow mr-eyebrow--mono">#ORD-9921</span>
                  <strong>CityHealth Pharmacy</strong>
                </td>
                <td>Nimal Perera</td>
                <td>5 / 5</td>
                <td>Ready within the hour, the substitute was explained clearly.</td>
                <td><span class="mr-badge mr-badge--success"><span class="mr-badge__dot"></span>Visible</span></td>
                <td class="mr-pay-table__amount">
                  <button type="button" class="mr-table-menu-btn" aria-label="Actions for rating on #ORD-9921">
                    <img src="presentation/assets/images/icons/filled/454655/more.png" alt="">
                  </button>
                  <div class="mr-row-menu" hidden>
                    <button type="button" data-modal-open="mr-rating-hide-modal" data-subject="rating on #ORD-9921">Hide</button>
                    <button type="button" class="mr-row-menu__danger" data-modal-open="mr-rating-delete-modal" data-subject="rating on #ORD-9921">Delete</button>
                  </div>
                </td>
              </tr>
              <tr data-filter-value="visible">
                <td>
                  <span class="mr-eyebrow mr-eyebrow--mono">#ORD-9874</span>
                  <strong>Osu Sala</strong>
                </td>
                <td>Sunethra Fernando</td>
                <td>3 / 5</td>
                <td>Took two tries to get the right strength.</td>
                <td><span class="mr-badge mr-badge--success"><span class="mr-badge__dot"></span>Visible</span></td>
                <td class="mr-pay-table__amount">
                  <button type="button" class="mr-table-menu-btn" aria-label="Actions for rating on #ORD-9874">
                    <img src="presentation/assets/images/icons/filled/454655/more.png" alt="">
                  </button>
                  <div class="mr-row-menu" hidden>
                    <button type="button" data-modal-open="mr-rating-hide-modal" data-subject="rating on #ORD-9874">Hide</button>
                    <button type="button" class="mr-row-menu__danger" data-modal-open="mr-rating-delete-modal" data-subject="rating on #ORD-9874">Delete</button>
                  </div>
                </td>
              </tr>
              <tr data-filter-value="hidden">
                <td>
                  <span class="mr-eyebrow mr-eyebrow--mono">#ORD-9810</span>
                  <strong>Union Chemists</strong>
                </td>
                <td>Ruwan Silva</td>
                <td>1 / 5</td>
                <td>Contains a staff member's phone number.</td>
                <td><span class="mr-badge mr-badge--pill mr-badge--case-normal"><span class="mr-badge__dot"></span>Hidden</span></td>
                <td class="mr-pay-table__amount">
                  <button type="button" class="mr-table-menu-btn" aria-label="Actions for rating on #ORD-9810">
                    <img src="presentation/assets/images/icons/filled/454655/more.png" alt="">
                  </button>
                  <div class="mr-row-menu" hidden>
                    <button type="button" data-toast="Rating visible again — pharmacy average updated.">Show again</button>
                    <button type="button" class="mr-row-menu__danger" data-modal-open="mr-rating-delete-modal" data-subject="rating on #ORD-9810">Delete</button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
    </main>
  </div>

  <div class="mr-modal" id="mr-rating-hide-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Hide <span data-subject-slot="rating"></span>?</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <p class="mr-modal__text">Hidden ratings drop out of the pharmacy's average and patients stop seeing them. You can show it again later.</p>

      <form class="mr-auth-form mr-modal__form" data-toast="Rating hidden — pharmacy average updated.">
        <label class="mr-field">
          <span>Reason</span>
          <textarea rows="2" placeholder="Kept in the audit log..." required></textarea>
        </label>

        <div class="mr-modal__actions">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Hide</button>
        </div>
      </form>
    </div>
  </div>

  <div class="mr-modal" id="mr-rating-delete-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Delete <span data-subject-slot="rating"></span>?</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <p class="mr-modal__text">The rating is removed for good and the patient can rate this order again.</p>

      <div class="mr-modal__actions">
        <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
        <button type="button" class="mr-btn mr-btn--danger-outline mr-btn--sm" data-modal-close data-toast="Rating deleted.">Delete</button>
      </div>
    </div>
  </div>
