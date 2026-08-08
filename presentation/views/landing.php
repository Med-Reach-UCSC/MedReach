<?php
// MedReach - Public landing page (presentation tier: HTML output only)
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MedReach — Prescription Fulfillment &amp; Medicine Delivery</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body>

  <?php require __DIR__ . '/partials/nav.php'; ?>

  <div class="mr-page">
    <main>

      <section class="mr-hero">
        <div class="mr-hero__banner">
          <div class="mr-hero__content">
            <span class="mr-badge mr-badge--pill">
              <img src="https://img.icons8.com/ios-filled/50/2d3fd7/shield.png" alt="">
              Intelligent Logistics
            </span>
            <h1>Your prescription, fulfilled and <span class="mr-text-accent">delivered</span></h1>
            <p>MedReach connects patients, pharmacies, and couriers in real-time to ensure rapid, reliable medication access.</p>
            <div class="mr-hero__actions">
              <button type="button" class="mr-btn mr-btn--primary">Get Started</button>
              <a href="#platform" class="mr-btn mr-btn--ghost">See how it works</a>
            </div>
          </div>

          <div class="mr-hero__preview">
            <div class="mr-card mr-tracking-card">
              <div class="mr-tracking-card__head">
                <div>
                  <span class="mr-eyebrow mr-eyebrow--mono">Order #MR-9241</span>
                  <h3>Delivery Tracking</h3>
                </div>
                <span class="mr-badge mr-badge--info">In Transit</span>
              </div>
              <ol class="mr-timeline">
                <li class="mr-timeline__step">
                  <span class="mr-timeline__time">09:41</span>
                  <strong>Prescription Verified</strong>
                  <small>City Health Pharmacy</small>
                </li>
                <li class="mr-timeline__step">
                  <span class="mr-timeline__time">10:15</span>
                  <strong>Picked Up</strong>
                  <small>Courier assigned: Michael T.</small>
                </li>
                <li class="mr-timeline__step mr-timeline__step--active">
                  <span class="mr-timeline__time">10:42</span>
                  <strong>Out for Delivery</strong>
                  <small>Arriving in approx. 12 mins</small>
                </li>
              </ol>
            </div>

            <div class="mr-card mr-request-card">
              <div class="mr-request-card__head">
                <span class="mr-icon-badge mr-icon-badge--accent">
                  <img src="https://img.icons8.com/ios-filled/50/dd8e1c/pill.png" alt="">
                </span>
                <div>
                  <span class="mr-eyebrow mr-eyebrow--accent">New Request</span>
                  <h4>Amoxicillin 500mg</h4>
                </div>
              </div>
              <div class="mr-request-card__actions">
                <button type="button" class="mr-btn mr-btn--muted mr-btn--sm">Decline</button>
                <button type="button" class="mr-btn mr-btn--dark mr-btn--sm">Accept</button>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="mr-card mr-stats">
        <div class="mr-stat"><strong>240+</strong><span>Pharmacies</span></div>
        <div class="mr-stat"><strong>&lt;5m</strong><span>Avg Response</span></div>
        <div class="mr-stat"><strong>500k+</strong><span>Orders Delivered</span></div>
        <div class="mr-stat"><strong>40+</strong><span>Cities Active</span></div>
      </section>

      <section id="solutions" class="mr-section mr-section--center">
        <h2>Built for everyone</h2>
        <p class="mr-section__lede">One platform, tuned to what each person in the delivery chain actually needs to do.</p>
        <div class="mr-roles">
          <article class="mr-role-card mr-role-card--highlight">
            <span class="mr-role-icon">
              <img src="https://img.icons8.com/ios-filled/50/2b1fd6/user.png" alt="">
            </span>
            <h3>Patient</h3>
            <p>Upload prescriptions easily and track delivery to your door.</p>
          </article>
          <article class="mr-role-card">
            <span class="mr-role-icon">
              <img src="https://img.icons8.com/ios-filled/50/454655/family.png" alt="">
            </span>
            <h3>Guardian</h3>
            <p>Manage medications for dependents from a single interface.</p>
          </article>
          <article class="mr-role-card">
            <span class="mr-role-icon">
              <img src="https://img.icons8.com/ios-filled/50/1f9d6b/pharmacy-shop.png" alt="">
            </span>
            <h3>Pharmacist</h3>
            <p>Receive orders directly, verify instantly, and boost fulfillment.</p>
          </article>
          <article class="mr-role-card">
            <span class="mr-role-icon">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/scooter.png" alt="">
            </span>
            <h3>Delivery Partner</h3>
            <p>Optimized routing for swift and secure medical deliveries.</p>
          </article>
        </div>
      </section>

      <section id="network" class="mr-section">
        <h2>Pharmacy Network</h2>
        <p class="mr-section__lede">Partner pharmacies onboarded this year, by quarter.</p>
        <div class="mr-card mr-network">
          <div>
            <h3>Network Growth</h3>
            <p>240 partner pharmacies now cover 40+ cities.</p>
            <div class="mr-bar-chart">
              <div class="mr-bar-chart__col">
                <span class="mr-bar-chart__bar" style="--mr-bar-value:25%"></span>
                <strong>60</strong>
                <small>Q1</small>
              </div>
              <div class="mr-bar-chart__col">
                <span class="mr-bar-chart__bar" style="--mr-bar-value:58%"></span>
                <strong>140</strong>
                <small>Q2</small>
              </div>
              <div class="mr-bar-chart__col">
                <span class="mr-bar-chart__bar" style="--mr-bar-value:79%"></span>
                <strong>190</strong>
                <small>Q3</small>
              </div>
              <div class="mr-bar-chart__col">
                <span class="mr-bar-chart__bar" style="--mr-bar-value:100%"></span>
                <strong>240</strong>
                <small>Q4</small>
              </div>
            </div>
          </div>
          <div>
            <h3>Top Partner Pharmacies</h3>
            <ul class="mr-pharmacy-list">
              <li>
                <div>
                  <strong>City Health Pharmacy</strong>
                  <small>Downtown • 0.5 miles</small>
                </div>
                <span class="mr-badge mr-badge--success">Active</span>
              </li>
              <li>
                <div>
                  <strong>CarePlus Meds</strong>
                  <small>Westside • 1.2 miles</small>
                </div>
                <span class="mr-badge mr-badge--success">Active</span>
              </li>
              <li>
                <div>
                  <strong>Sunrise Pharmacy</strong>
                  <small>North Hills • 3.0 miles</small>
                </div>
                <span class="mr-badge mr-badge--success">Active</span>
              </li>
            </ul>
          </div>
        </div>
      </section>

      <section id="platform" class="mr-section">
        <h2>Intelligent fulfillment</h2>
        <p class="mr-section__lede">The routing engine handles the logistics most delivery apps still leave to a phone call.</p>
        <div class="mr-features">
          <article class="mr-feature mr-feature--tall">
            <span class="mr-feature-icon mr-feature-icon--primary">
              <img src="https://img.icons8.com/ios-filled/50/2d3fd7/flow-chart.png" alt="">
            </span>
            <h3>Smart Split-Routing</h3>
            <p>No fixed lead pharmacy — each item in a multi-item prescription routes independently to the nearest pharmacy that has it in stock. A pharmacy that can't fulfill in time is skipped automatically and the item forwards to the next-closest option.</p>
            <div class="mr-route-diagram">
              <div class="mr-route-diagram__stop">
                <span class="mr-route-diagram__icon">
                  <img src="https://img.icons8.com/ios-filled/50/2d3fd7/pill.png" alt="">
                </span>
                <small>Prescription</small>
              </div>
              <i class="mr-route-diagram__line"></i>
              <div class="mr-route-diagram__stop">
                <span class="mr-route-diagram__icon">
                  <img src="https://img.icons8.com/ios-filled/50/1f9d6b/pharmacy-shop.png" alt="">
                </span>
                <small>City Health</small>
              </div>
              <i class="mr-route-diagram__line"></i>
              <div class="mr-route-diagram__stop">
                <span class="mr-route-diagram__icon">
                  <img src="https://img.icons8.com/ios-filled/50/1f9d6b/pharmacy-shop.png" alt="">
                </span>
                <small>CarePlus Meds</small>
              </div>
              <i class="mr-route-diagram__line"></i>
              <div class="mr-route-diagram__stop">
                <span class="mr-route-diagram__icon">
                  <img src="https://img.icons8.com/ios-filled/50/1f9d6b/home.png" alt="">
                </span>
                <small>Delivered</small>
              </div>
            </div>
            <div class="mr-route-tags">
              <span class="mr-badge mr-badge--pill">No phone calls needed</span>
              <span class="mr-badge mr-badge--pill">Re-routes instantly</span>
            </div>
            <p class="mr-feature-note">2 items split across 2 nearby pharmacies — both accepted in under a minute.</p>
          </article>

          <article class="mr-feature">
            <span class="mr-feature-icon mr-feature-icon--primary">
              <img src="https://img.icons8.com/ios-filled/50/2d3fd7/redo.png" alt="">
            </span>
            <h4>Auto-Forwarding</h4>
            <p>A pharmacy that declines or misses the response window is skipped automatically.</p>
            <div class="mr-forward-demo">
              <span class="mr-forward-demo__stop mr-forward-demo__stop--declined">Sunrise Pharmacy</span>
              <span class="mr-forward-demo__arrow">&rarr;</span>
              <span class="mr-forward-demo__stop mr-forward-demo__stop--accepted">CarePlus Meds</span>
            </div>
          </article>

          <article class="mr-feature">
            <span class="mr-feature-icon">
              <img src="https://img.icons8.com/ios-filled/50/1f9d6b/exchange.png" alt="">
            </span>
            <h4>1-Tap Substitution</h4>
            <p>The pharmacist proposes an equivalent; the patient or guardian approves with a single tap.</p>
            <div class="mr-swap-demo">
              <span class="mr-swap-demo__old">Panadol 500mg</span>
              <span class="mr-swap-demo__new">Paracetamol (Generic) <em>Suggested</em></span>
            </div>
          </article>

          <article class="mr-feature">
            <span class="mr-feature-icon mr-feature-icon--accent">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/cash.png" alt="">
            </span>
            <h4>Cash on Delivery</h4>
            <p>No cards, no online payments — pay the courier when the order reaches your door.</p>
            <div class="mr-receipt-demo-group">
              <div class="mr-receipt-demo">
                <span>Order total</span>
                <strong>Rs. 2,450</strong>
              </div>
              <div class="mr-receipt-demo">
                <span>Payment method</span>
                <strong>Cash on Delivery</strong>
              </div>
            </div>
          </article>

          <article class="mr-feature">
            <span class="mr-feature-icon mr-feature-icon--primary">
              <img src="https://img.icons8.com/ios-filled/50/2d3fd7/checklist.png" alt="">
            </span>
            <h4>Order Tracking</h4>
            <p>Plain-language status updates from verification to your door — no maps required.</p>
            <ul class="mr-status-demo">
              <li class="mr-status-demo--done">Verified</li>
              <li class="mr-status-demo--done">Picked up</li>
              <li>Out for delivery</li>
            </ul>
          </article>
        </div>
      </section>

      <section class="mr-section mr-section--center">
        <h2>What our users say</h2>
        <p class="mr-section__lede">Feedback from the people relying on MedReach every day.</p>
        <div class="mr-testimonials">
          <blockquote class="mr-card mr-testimonial">
            <div class="mr-testimonial__stars">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="">
            </div>
            <p>"MedReach completely changed how I get my prescriptions. It's incredibly fast and tracking gives me peace of mind."</p>
            <footer>
              <span class="mr-avatar">SJ</span>
              <div>
                <strong>Sarah J.</strong>
                <small>Patient</small>
              </div>
            </footer>
          </blockquote>

          <blockquote class="mr-card mr-testimonial">
            <div class="mr-testimonial__stars">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="">
            </div>
            <p>"As a pharmacist, the interface is seamless. We can process requests much faster and focus on patient care."</p>
            <footer>
              <span class="mr-avatar">DR</span>
              <div>
                <strong>David R.</strong>
                <small>Pharmacist</small>
              </div>
            </footer>
          </blockquote>

          <blockquote class="mr-card mr-testimonial">
            <div class="mr-testimonial__stars">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="">
              <img src="https://img.icons8.com/ios-filled/50/dd8e1c/star.png" alt="">
            </div>
            <p>"Managing my parents' medication used to be a headache. Now it's a few taps on my phone."</p>
            <footer>
              <span class="mr-avatar">MK</span>
              <div>
                <strong>Maria K.</strong>
                <small>Guardian</small>
              </div>
            </footer>
          </blockquote>
        </div>
      </section>

      <section class="mr-section mr-section--center">
        <h2>Frequently Asked Questions</h2>
        <p class="mr-section__lede">What people ask before their first order.</p>
        <div class="mr-card mr-faq">
          <details>
            <summary>How secure is my medical data?</summary>
            <p>We use end-to-end encryption and comply with all healthcare data privacy regulations to ensure your information is strictly confidential.</p>
          </details>
          <details>
            <summary>What if a medication is out of stock?</summary>
            <p>Our smart split-routing system will automatically try to source the medication from another nearby partner pharmacy, or suggest an equivalent generic alternative for your approval.</p>
          </details>
          <details>
            <summary>How quickly are deliveries made?</summary>
            <p>Delivery times vary by location, but our average time from pharmacy acceptance to delivery is under 45 minutes in active coverage zones.</p>
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
