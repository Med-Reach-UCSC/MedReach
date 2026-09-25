<?php
// MedReach - Privacy, terms, security and contact policies (presentation tier: HTML output only)
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Policies — MedReach</title>
  <link rel="stylesheet" href="presentation/assets/css/style.css">
</head>
<body>

  <?php require __DIR__ . '/partials/nav.php'; ?>

  <div class="mr-page">
    <main>

      <section class="mr-hero mr-section mr-section--center">
        <h1 class="mr-page-title">Policies</h1>
        <p class="mr-section__lede">How MedReach handles your data, what you agree to, and how to reach us.</p>
      </section>

      <section class="mr-section">
        <div class="mr-card mr-faq">
          <details id="privacy" open>
            <summary>Privacy Policy</summary>
            <p>Prescription images, delivery addresses and contact details are used only to fulfil your order. A prescription is shared with the pharmacies it is routed to and nobody else. Couriers see the delivery address and contact number for the order they carry, never the prescription itself.</p>
          </details>
          <details id="terms" open>
            <summary>Terms of Service</summary>
            <p>Pharmacies make the final call on every prescription and may decline it. A substitute medicine is only dispensed after the patient or guardian approves it. Prescriptions past their expiry date cannot be fulfilled or reordered. Payment is taken by card or cash on delivery; refunds follow the cancellation window shown at checkout.</p>
          </details>
          <details id="security" open>
            <summary>Security</summary>
            <p>Accounts are protected by hashed passwords and one-time email codes. Each role — patient, pharmacist, courier and admin — only sees the pages and orders that belong to it.</p>
          </details>
          <details id="contact" open>
            <summary>Contact</summary>
            <p>Email support@medreach.lk or call +94 11 234 5678, 8:00 AM – 8:00 PM daily. Signed-in users can also reach support from the help card on their dashboard.</p>
          </details>
        </div>
      </section>

    </main>
  </div>

  <footer id="site-footer" class="mr-footer">
    <div class="mr-footer__brand">
      <strong>MedReach</strong>
      <span class="mr-eyebrow">Pickup. Deliver. Care.</span>
    </div>
    <nav class="mr-footer__links">
      <a href="policies.php#privacy">Privacy Policy</a>
      <a href="policies.php#terms">Terms of Service</a>
      <a href="policies.php#security">Security</a>
      <a href="policies.php#contact">Contact</a>
    </nav>
    <span class="mr-footer__copy">© 2026 MedReach Inc. Intelligent healthcare logistics.</span>
    <a class="mr-attribution" href="https://icons8.com" target="_blank" rel="noopener">Icons by Icons8</a>
  </footer>

  <script src="presentation/assets/js/main.js"></script>
</body>
</html>
