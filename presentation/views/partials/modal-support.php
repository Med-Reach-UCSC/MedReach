<?php
// MedReach - Shared "Contact support" modal (presentation tier: HTML output only)
// Opened by any [data-modal-open="mr-support-modal"] on the including page.
?>
<div class="mr-modal" id="mr-support-modal">
  <div class="mr-modal__backdrop" data-modal-close></div>
  <div class="mr-modal__card mr-card">
    <div class="mr-modal__head">
      <h2>Contact support</h2>
      <button type="button" class="mr-modal__close" data-modal-close aria-label="Close">
        <img src="https://img.icons8.com/ios-filled/50/1a1b24/multiply.png" alt="">
      </button>
    </div>

    <p class="mr-modal__text">Call +94 11 234 5678 (8:00 AM – 8:00 PM) or send us a message and we'll reply by email.</p>

    <form class="mr-auth-form mr-modal__form" data-toast="Message sent — support will reply by email.">
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
        <span>Message</span>
        <textarea rows="4" placeholder="Include the order ID if it's about an order..." required></textarea>
      </label>

      <div class="mr-modal__actions">
        <button type="button" class="mr-btn mr-btn--ghost mr-btn--sm" data-modal-close>Cancel</button>
        <button type="submit" class="mr-btn mr-btn--primary mr-btn--sm">Send message</button>
      </div>
    </form>
  </div>
</div>
