<?php
$title = 'Support Inbox — MedReach';
$active = 'support';
?>
  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <h1>Support Inbox</h1>

        <div class="mr-dash-header__actions">
          <div class="mr-dash-stats">
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value mr-dash-stat__value--pending">3</strong>
              <span>Open</span>
            </div>
            <div class="mr-dash-stat">
              <strong class="mr-dash-stat__value">12</strong>
              <span>Resolved this week</span>
            </div>
          </div>
        </div>
      </header>

      <section class="mr-card mr-dash-card">
        <div class="mr-dash-card__head">
          <h2>Tickets</h2>
        </div>

        <div class="mr-roster-toolbar">
          <div class="mr-roster-toolbar__chips">
            <label class="mr-roster-filter">
              <img src="presentation/assets/images/icons/filled/454655/filter.png" alt="">
              <select data-row-filter="mr-ticket-table" aria-label="Filter by status">
                <option value="">Filtered: All</option>
                <option value="open">Filtered: Open</option>
                <option value="resolved">Filtered: Resolved</option>
              </select>
            </label>
            <span class="mr-badge mr-badge--pill mr-badge--case-normal">Total: 4</span>
          </div>

          <button type="button" class="mr-btn mr-btn--primary mr-btn--sm" data-modal-open="mr-ticket-form-modal">
            <img src="presentation/assets/images/icons/filled/ffffff/plus.png" alt="">
            Log a call
          </button>
        </div>

        <div class="mr-pay-table-wrap">
          <table class="mr-pay-table" id="mr-ticket-table">
            <thead>
              <tr>
                <th>Ticket</th>
                <th>From</th>
                <th>Topic</th>
                <th>Status</th>
                <th>Received</th>
                <th class="mr-pay-table__amount">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr data-filter-value="open">
                <td><span class="mr-eyebrow mr-eyebrow--mono">T-1043</span></td>
                <td>
                  <strong>Nimal Perera</strong>
                  <span class="mr-eyebrow">Patient</span>
                </td>
                <td>An order or delivery</td>
                <td><span class="mr-badge mr-badge--accent"><span class="mr-badge__dot"></span>Open</span></td>
                <td>12 min ago</td>
                <td class="mr-pay-table__amount">
                  <button type="button" class="mr-table-menu-btn" aria-label="Actions for T-1043">
                    <img src="presentation/assets/images/icons/filled/454655/more.png" alt="">
                  </button>
                  <div class="mr-row-menu" hidden>
                    <button type="button" data-modal-open="mr-ticket-view-modal" data-subject="T-1043 · Nimal Perera">View &amp; reply</button>
                    <button type="button" data-toast="T-1043 marked as resolved.">Mark resolved</button>
                    <button type="button" class="mr-row-menu__danger" data-modal-open="mr-ticket-delete-modal" data-subject="T-1043">Delete</button>
                  </div>
                </td>
              </tr>
              <tr data-filter-value="open">
                <td><span class="mr-eyebrow mr-eyebrow--mono">T-1042</span></td>
                <td>
                  <strong>CityHealth Pharmacy</strong>
                  <span class="mr-eyebrow">Pharmacist</span>
                </td>
                <td>My account</td>
                <td><span class="mr-badge mr-badge--accent"><span class="mr-badge__dot"></span>Open</span></td>
                <td>1 hr ago</td>
                <td class="mr-pay-table__amount">
                  <button type="button" class="mr-table-menu-btn" aria-label="Actions for T-1042">
                    <img src="presentation/assets/images/icons/filled/454655/more.png" alt="">
                  </button>
                  <div class="mr-row-menu" hidden>
                    <button type="button" data-modal-open="mr-ticket-view-modal" data-subject="T-1042 · CityHealth Pharmacy">View &amp; reply</button>
                    <button type="button" data-toast="T-1042 marked as resolved.">Mark resolved</button>
                    <button type="button" class="mr-row-menu__danger" data-modal-open="mr-ticket-delete-modal" data-subject="T-1042">Delete</button>
                  </div>
                </td>
              </tr>
              <tr data-filter-value="open">
                <td><span class="mr-eyebrow mr-eyebrow--mono">T-1040</span></td>
                <td>
                  <strong>Kasun Priyankara</strong>
                  <span class="mr-eyebrow">Delivery</span>
                </td>
                <td>Payments</td>
                <td><span class="mr-badge mr-badge--accent"><span class="mr-badge__dot"></span>Open</span></td>
                <td>Yesterday</td>
                <td class="mr-pay-table__amount">
                  <button type="button" class="mr-table-menu-btn" aria-label="Actions for T-1040">
                    <img src="presentation/assets/images/icons/filled/454655/more.png" alt="">
                  </button>
                  <div class="mr-row-menu" hidden>
                    <button type="button" data-modal-open="mr-ticket-view-modal" data-subject="T-1040 · Kasun Priyankara">View &amp; reply</button>
                    <button type="button" data-toast="T-1040 marked as resolved.">Mark resolved</button>
                    <button type="button" class="mr-row-menu__danger" data-modal-open="mr-ticket-delete-modal" data-subject="T-1040">Delete</button>
                  </div>
                </td>
              </tr>
              <tr data-filter-value="resolved">
                <td><span class="mr-eyebrow mr-eyebrow--mono">T-1037</span></td>
                <td>
                  <strong>Sunethra Fernando</strong>
                  <span class="mr-eyebrow">Patient</span>
                </td>
                <td>Something else</td>
                <td><span class="mr-badge mr-badge--success"><span class="mr-badge__dot"></span>Resolved</span></td>
                <td>Sep 23, 2026</td>
                <td class="mr-pay-table__amount">
                  <button type="button" class="mr-table-menu-btn" aria-label="Actions for T-1037">
                    <img src="presentation/assets/images/icons/filled/454655/more.png" alt="">
                  </button>
                  <div class="mr-row-menu" hidden>
                    <button type="button" data-modal-open="mr-ticket-view-modal" data-subject="T-1037 · Sunethra Fernando">View &amp; reply</button>
                    <button type="button" data-toast="T-1037 reopened.">Reopen</button>
                    <button type="button" class="mr-row-menu__danger" data-modal-open="mr-ticket-delete-modal" data-subject="T-1037">Delete</button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
    </main>
  </div>

  <div class="mr-modal" id="mr-ticket-form-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Log a support call</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <form class="mr-auth-form mr-modal__form" data-toast="Ticket created.">
        <label class="mr-field">
          <span>Caller's email</span>
          <div class="mr-field__input">
            <input type="email" placeholder="name@example.lk" required>
          </div>
        </label>
        <label class="mr-field">
          <span>Topic</span>
          <div class="mr-field__input">
            <select required>
              <option value="" disabled selected>Select...</option>
              <option>An order or delivery</option>
              <option>Payments</option>
              <option>My account</option>
              <option>Something else</option>
            </select>
          </div>
        </label>
        <label class="mr-field">
          <span>What they said</span>
          <textarea rows="3" placeholder="Include the order ID if it's about an order..." required></textarea>
        </label>

        <div class="mr-modal__actions">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Create ticket</button>
        </div>
      </form>
    </div>
  </div>

  <div class="mr-modal" id="mr-ticket-view-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2><span data-subject-slot="Ticket"></span></h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <p class="mr-modal__text">"My order #ORD-9921 says out for delivery since this morning but nobody has called. Can you check?"</p>

      <form class="mr-auth-form mr-modal__form" data-toast="Reply emailed — ticket updated.">
        <label class="mr-field">
          <span>Reply</span>
          <textarea rows="3" placeholder="Sent to the user by email..." required></textarea>
        </label>
        <label class="mr-field">
          <span>Status</span>
          <div class="mr-field__input">
            <select>
              <option value="open">Keep open</option>
              <option value="resolved">Mark resolved</option>
            </select>
          </div>
        </label>

        <div class="mr-modal__actions">
          <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
          <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Send reply</button>
        </div>
      </form>
    </div>
  </div>

  <div class="mr-modal" id="mr-ticket-delete-modal">
    <div class="mr-modal__backdrop" data-modal-close></div>
    <div class="mr-modal__card mr-card">
      <div class="mr-modal__head">
        <h2>Delete <span data-subject-slot="ticket"></span>?</h2>
        <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
          <img src="presentation/assets/images/icons/filled/1a1b24/multiply.png" alt="">
        </button>
      </div>

      <p class="mr-modal__text">The ticket and its replies are removed for good. Use this for spam or duplicates — resolve real tickets instead.</p>

      <div class="mr-modal__actions">
        <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
        <button type="button" class="mr-btn mr-btn--danger-outline mr-btn--sm" data-modal-close data-toast="Ticket deleted.">Delete</button>
      </div>
    </div>
  </div>
