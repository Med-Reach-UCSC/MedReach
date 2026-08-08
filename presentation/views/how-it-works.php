<?php
// MedReach - How It Works page (presentation tier: HTML output only)
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>How It Works — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body>

  <?php require __DIR__ . '/partials/nav.php'; ?>

  <div class="mr-page">
    <main>

      <section class="mr-hero mr-section mr-section--center">
        <h1 class="mr-page-title">From prescription to doorstep</h1>
        <p class="mr-section__lede">Seamlessly connect with local pharmacies to fulfill your medical needs with speed and transparency.</p>
      </section>

      <section class="mr-features mr-features--3col">
        <article class="mr-feature">
          <div class="mr-feature__head">
            <span class="mr-feature-icon mr-feature-icon--primary">
              <img src="https://img.icons8.com/ios-filled/50/2d3fd7/clock.png" alt="">
            </span>
            <h3>Never wait in line</h3>
          </div>
          <p>Order from home, pharmacy comes to you.</p>
        </article>
        <article class="mr-feature">
          <div class="mr-feature__head">
            <span class="mr-feature-icon mr-feature-icon--accent">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/price-tag.png" alt="">
            </span>
            <h3>Best price automatically</h3>
          </div>
          <p>Your order routes to the nearest pharmacy that has stock, with fallback if declined.</p>
        </article>
        <article class="mr-feature">
          <div class="mr-feature__head">
            <span class="mr-feature-icon">
              <img src="https://img.icons8.com/ios-filled/50/1f9d6b/visible.png" alt="">
            </span>
            <h3>Full transparency</h3>
          </div>
          <p>See exactly which pharmacy accepted, what it costs, and where your delivery is in real time.</p>
        </article>
      </section>

      <section id="platform" class="mr-section">
        <h2>The four steps</h2>
        <p class="mr-section__lede">From upload to delivery, here's what happens behind the scenes.</p>
        <div class="mr-roles">
          <article class="mr-feature">
            <span class="mr-feature-icon mr-feature-icon--primary">
              <img src="https://img.icons8.com/ios-filled/50/2d3fd7/upload.png" alt="">
            </span>
            <h3>Upload prescription</h3>
            <span class="mr-badge mr-badge--info">Instant Scan</span>
          </article>
          <article class="mr-feature">
            <span class="mr-feature-icon mr-feature-icon--accent">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/pharmacy-shop.png" alt="">
            </span>
            <h3>Nearby pharmacies respond</h3>
            <span class="mr-badge mr-badge--pill">3-5m response</span>
          </article>
          <article class="mr-feature">
            <span class="mr-feature-icon mr-feature-icon--primary">
              <img src="https://img.icons8.com/ios-filled/50/2d3fd7/goal.png" alt="">
            </span>
            <h3>Confirm and choose pickup or delivery</h3>
            <span class="mr-badge mr-badge--info">Cash on delivery</span>
          </article>
          <article class="mr-feature">
            <span class="mr-feature-icon">
              <img src="https://img.icons8.com/ios-filled/50/1f9d6b/checklist.png" alt="">
            </span>
            <h3>Track until delivered</h3>
            <span class="mr-badge mr-badge--success">Live status</span>
          </article>
        </div>
      </section>

      <section class="mr-section">
        <h2>See it in action</h2>
        <p class="mr-section__lede">A live look at how a request moves from your upload to your door.</p>
        <div class="mr-card mr-network">
          <div>
            <h3>Prescription matched to nearby pharmacies</h3>
            <p>Amoxicillin 500mg — routed to the two closest pharmacies with it in stock.</p>
            <ul class="mr-pharmacy-list">
              <li>
                <div>
                  <strong>City Health Pharmacy</strong>
                  <small>1.2 km away</small>
                </div>
                <span class="mr-badge mr-badge--success">Active</span>
              </li>
              <li>
                <div>
                  <strong>CarePlus Meds</strong>
                  <small>2.8 km away</small>
                </div>
                <span class="mr-badge mr-badge--success">Active</span>
              </li>
            </ul>
          </div>
          <div class="mr-timer-card">
            <h3>Auto-Forwarding</h3>
            <p>Searching network...</p>
            <div class="mr-timer-ring">
              <span>05:00</span>
            </div>
          </div>
        </div>

        <div class="mr-card mr-suggestion-demo">
          <span class="mr-feature-icon mr-feature-icon--primary">
            <img src="https://img.icons8.com/ios-filled/50/2d3fd7/pill.png" alt="">
          </span>
          <p><strong>Pharmacist Suggestion:</strong> Substitute with generic? Same formula, 15% cheaper.</p>
          <div class="mr-request-card__actions">
            <button type="button" class="mr-btn mr-btn--muted mr-btn--sm">Reject</button>
            <button type="button" class="mr-btn mr-btn--dark mr-btn--sm">Approve</button>
          </div>
        </div>
      </section>

      <section class="mr-card mr-stats">
        <div class="mr-stat"><strong>240+</strong><span>Pharmacies</span></div>
        <div class="mr-stat"><strong>Under 5m</strong><span>Avg Response</span></div>
        <div class="mr-stat"><strong>500k+</strong><span>Orders Delivered</span></div>
        <div class="mr-stat"><strong>40+</strong><span>Cities</span></div>
      </section>

      <section class="mr-section mr-section--center">
        <h2>Common questions</h2>
        <p class="mr-section__lede">What people ask before their first order.</p>
        <div class="mr-card mr-faq">
          <details>
            <summary>What if no nearby pharmacy has my medicine?</summary>
            <p>Our system automatically expands the search radius and notifies you if the item is out of stock across the whole network.</p>
          </details>
          <details>
            <summary>Can I choose cash on delivery or pickup instead?</summary>
            <p>Yes — you can toggle between delivery and self-pickup at checkout. Payment is cash on delivery only.</p>
          </details>
          <details>
            <summary>How does the auto-forwarding timer work?</summary>
            <p>Each pharmacy has a limited window to accept your order. If they don't respond, it moves to the next-closest pharmacy automatically.</p>
          </details>
          <details>
            <summary>Can a guardian order for a family member?</summary>
            <p>Absolutely. You can upload prescriptions for dependents and manage their delivery tracking from your own account.</p>
          </details>
        </div>
      </section>

    </main>
  </div>

  <div class="mr-cta">
    <div class="mr-cta__text">
      <h2>Ready to get started?</h2>
      <p>Join the intelligent healthcare logistics network today.</p>
    </div>
    <button type="button" class="mr-btn mr-btn--light">Join Network</button>
  </div>

  <footer id="site-footer" class="mr-footer">
    <div class="mr-footer__brand">
      <strong>MedReach</strong>
      <span class="mr-eyebrow">Pickup. Deliver. Care.</span>
    </div>
    <nav class="mr-footer__links">
      <a href="#">Privacy Policy</a>
      <a href="#">Terms of Service</a>
      <a href="#">Security</a>
      <a href="#">Contact</a>
    </nav>
    <span class="mr-footer__copy">© 2024 MedReach Inc. Intelligent healthcare logistics.</span>
    <a class="mr-attribution" href="https://icons8.com" target="_blank" rel="noopener">Icons by Icons8</a>
  </footer>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
