<?php
// MedReach - Pharmacist single-request review (presentation tier: HTML output only)
// Converted from docs/prescription-request.php (Tailwind mockup) onto the mr-
// component system — reuses mr-order-row, mr-resp-summary, mr-mini-stat and
// mr-help-card from the patient module instead of introducing new classes.
//
// Defects fixed vs the mockup: dropped the Inventory nav item (no
// MEDICINE/INVENTORY table per CLAUDE.md); substitution proposal is a native
// <details> disclosure instead of scripted show/hide, matching mr-faq.
//
// Body carries a page-scoped class (mr-page-request), same convention as
// mr-page-order/mr-page-track/mr-page-nearby — lets this page override
// .mr-dash-content into a literal 3-column bento without touching the
// shared 2-column grid every other dashboard page relies on.
$active = 'requests';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Request RQ-2318 — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body class="mr-page-request">

  <div class="mr-dashboard">
    <?php require __DIR__ . '/../partials/sidebar-pharmacy.php'; ?>

    <main class="mr-dash-main">
      <header class="mr-dash-header">
        <div>
          <a class="mr-link mr-link--sm" href="pharmacy-dashboard.php">&larr; Back to requests</a>
          <h1>Request RQ-2318</h1>
        </div>

        <div class="mr-dash-header__actions">
          <span class="mr-badge mr-badge--pill mr-badge--case-normal">
            <img src="https://img.icons8.com/ios-filled/50/454655/user.png" alt="">
            Eleanor Vance
          </span>
          <span class="mr-badge mr-badge--pill mr-badge--case-normal">
            <img src="https://img.icons8.com/ios-filled/50/dd8e1c/clock.png" alt="">
            05:42
          </span>
          <button type="button" class="mr-icon-btn" aria-label="Print request" onclick="window.print()">
            <img src="https://img.icons8.com/ios-filled/50/454655/print.png" alt="">
          </button>
        </div>
      </header>

      <div class="mr-dash-content">
        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>
                <img class="mr-heading-icon" src="https://img.icons8.com/ios-filled/50/2d3fd7/document.png" alt="">
                Original Document
              </h2>
            </div>
            <div class="mr-resp-rx">
              <span class="mr-resp-rx__thumb">
                <img src="https://img.icons8.com/ios-filled/50/2d3fd7/image.png" alt="Prescription scan">
              </span>
              <div class="mr-resp-rx__body">
                <p class="mr-resp-rx__meta">Patient: Eleanor Vance · Dr. S. Weerasinghe · GMC-4471</p>
              </div>
            </div>
          </section>

          <section class="mr-card mr-help-card mr-help-card--alert">
            <span class="mr-icon-badge mr-icon-badge--info">
              <img src="https://img.icons8.com/ios-filled/50/2d3fd7/chat.png" alt="">
            </span>
            <div>
              <strong class="mr-eyebrow mr-eyebrow--mono">Patient Note</strong>
              <p>"Prefers liquid form if available for the Amoxicillin."</p>
            </div>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-card mr-dash-card">
            <div class="mr-dash-card__head">
              <h2>Medicine Checklist</h2>
              <span class="mr-eyebrow mr-eyebrow--mono">3 Items</span>
            </div>

            <div class="mr-order-row">
              <span class="mr-icon-badge mr-icon-badge--accent">
                <img src="https://img.icons8.com/ios-filled/50/dd8e1c/pill.png" alt="">
              </span>
              <div class="mr-order-row__info">
                <strong>Amoxicillin 500mg</strong>
                <span class="mr-eyebrow mr-eyebrow--mono">Qty: 30</span>
              </div>
              <span class="mr-badge mr-badge--success mr-badge--case-normal">In Stock</span>
              <label class="mr-price-field">
                <span class="mr-price-field__prefix">LKR</span>
                <input type="text" inputmode="decimal" placeholder="0.00" value="850.00" aria-label="Price for Amoxicillin 500mg">
              </label>
            </div>

            <details class="mr-order-row mr-order-row--expandable">
              <summary>
                <span class="mr-icon-badge mr-icon-badge--danger">
                  <img src="https://img.icons8.com/ios-filled/50/de4a4f/error--v1.png" alt="">
                </span>
                <div class="mr-order-row__info">
                  <strong>Lisinopril 10mg</strong>
                  <span class="mr-eyebrow mr-eyebrow--mono">Qty: 90</span>
                </div>
                <span class="mr-badge mr-badge--danger mr-badge--case-normal">Out of Stock</span>
              </summary>

              <form class="mr-auth-form mr-auth-form--grid mr-order-row__form">
                <label class="mr-field mr-field--span2">
                  <span>Substitute Name</span>
                  <div class="mr-field__input">
                    <input type="text" placeholder="e.g. Enalapril 5mg">
                  </div>
                </label>
                <label class="mr-field">
                  <span>Reason</span>
                  <div class="mr-field__input">
                    <select>
                      <option>Similar Generic Available</option>
                      <option>Different Brand Available</option>
                      <option>Alternative Formulation</option>
                    </select>
                  </div>
                </label>
                <label class="mr-field">
                  <span>New Price</span>
                  <div class="mr-price-field mr-price-field--block">
                    <span class="mr-price-field__prefix">LKR</span>
                    <input type="text" inputmode="decimal" placeholder="0.00">
                  </div>
                </label>
                <div class="mr-field--span2">
                  <button type="submit" class="mr-btn mr-btn--dark mr-btn--sm">Send suggestion</button>
                </div>
              </form>
            </details>

            <div class="mr-order-row">
              <span class="mr-icon-badge mr-icon-badge--accent">
                <img src="https://img.icons8.com/ios-filled/50/dd8e1c/pill.png" alt="">
              </span>
              <div class="mr-order-row__info">
                <strong>Atorvastatin 20mg</strong>
                <span class="mr-eyebrow mr-eyebrow--mono">Qty: 30</span>
              </div>
              <span class="mr-badge mr-badge--success mr-badge--case-normal">In Stock</span>
              <label class="mr-price-field">
                <span class="mr-price-field__prefix">LKR</span>
                <input type="text" inputmode="decimal" placeholder="0.00" value="1,200.00" aria-label="Price for Atorvastatin 20mg">
              </label>
            </div>
          </section>

        </div>

        <div class="mr-dash-col">

          <section class="mr-resp-summary">
            <h2>Request Summary</h2>
            <div class="mr-resp-summary__row">
              <span>Subtotal</span>
              <i class="mr-resp-summary__rule"></i>
              <strong>LKR 2,050.00</strong>
            </div>
            <div class="mr-resp-summary__row">
              <span>Service Fee</span>
              <i class="mr-resp-summary__rule"></i>
              <strong>LKR 400.00</strong>
            </div>
            <div class="mr-resp-summary__row">
              <span>Total Estimated Value</span>
              <i class="mr-resp-summary__rule"></i>
              <strong>LKR 2,450.00</strong>
            </div>
          </section>

          <section class="mr-card mr-mini-stat">
            <div>
              <span class="mr-eyebrow mr-eyebrow--mono">Delivery Method</span>
              <strong>Standard Pharmacy Delivery</strong>
            </div>
            <span class="mr-icon-badge mr-icon-badge--info mr-icon-badge--lg">
              <img src="https://img.icons8.com/ios-filled/50/2d3fd7/delivery.png" alt="">
            </span>
          </section>

        </div>
      </div>
    </main>
  </div>

  <div class="mr-decision-bar">
    <span class="mr-decision-bar__note">
      <img src="https://img.icons8.com/ios-filled/50/8a8fa3/lock-2.png" alt="" width="14" height="14">
      Secure Healthcare Environment
    </span>
    <div class="mr-decision-bar__actions">
      <button type="button" class="mr-btn mr-btn--ghost">Decline Request</button>
      <button type="button" class="mr-btn mr-btn--dark">Accept Request</button>
    </div>
  </div>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
