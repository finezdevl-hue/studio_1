<?php require_once 'includes/header.php'; ?>

<!-- HERO -->
<section class="contact-hero">
  <div class="overlay"></div>
  <div class="hero-content">
    <span>Get In Touch</span>
    <h1>Let’s Create Something Amazing</h1>
    <p>Reach out to Zillal Studio for photography, videography, and premium creative media services.</p>
  </div>
</section>

<!-- CONTACT SECTION -->
<section class="contact-section">

  <!-- LEFT -->

  <div class="contact-info reveal">

    <span class="section-tag">
      Contact Information
    </span>

    <h2>
      We'd Love
      To Hear
      From You
    </h2>

    <p>
      Contact our creative team for bookings, collaborations, event coverage, and media production inquiries.
    </p>

    <div class="info-box">

      <div class="info-icon">📍</div>

      <div>
        <h4>Location</h4>
        <p>Dubai, United Arab Emirates</p>
      </div>

    </div>

    <div class="info-box">

      <div class="info-icon">📞</div>

      <div>
        <h4>Phone</h4>
        <p><?= htmlspecialchars(get_setting($conn, 'contact_phone')) ?></p>
      </div>

    </div>

    <div class="info-box">

      <div class="info-icon">✉️</div>

      <div>
        <h4>Email</h4>
        <p><?= htmlspecialchars(get_setting($conn, 'contact_email')) ?></p>
      </div>

    </div>

    <div class="social-links">

      <a href="<?= htmlspecialchars(get_setting($conn, 'instagram_url')) ?>" target="_blank">📷</a>
      <a href="<?= htmlspecialchars(get_setting($conn, 'facebook_url')) ?>" target="_blank">📘</a>
      <a href="<?= htmlspecialchars(get_setting($conn, 'twitter_url')) ?>" target="_blank">🐦</a>

    </div>

  </div>

  <!-- RIGHT -->

      <!-- CONTACT FORM -->
      <div class="contact-form-wrap fade-up delay-2">
        <div class="contact-form-header">
          <h3>Send Us a Message</h3>
          <p>Tell us about your project and we'll get back to you with a tailored quote.</p>
        </div>
        <form id="contact-form" class="contact-form" data-whatsapp-phone="<?= htmlspecialchars(preg_replace('/[^0-9]/', '', get_setting($conn, 'contact_phone'))) ?>" novalidate>
          <div class="form-row">
            <div class="form-group">
              <label for="name">Full Name <span class="required">*</span></label>
              <input type="text" id="name" name="name" placeholder="John Smith" required>
            </div>
            <div class="form-group">
              <label for="email">Email Address <span class="required">*</span></label>
              <input type="email" id="email" name="email" placeholder="john@example.com" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="phone">Phone Number</label>
              <input type="tel" id="phone" name="phone" placeholder="+61 000 000 000">
            </div>
            <div class="form-group">
              <label for="location">Your Location <span class="required">*</span></label>
              <input type="text" id="location" name="location" placeholder="City, Country" required>
            </div>
          </div>
          <div class="form-group">
            <label for="service">Service Required <span class="required">*</span></label>
            <select id="service" name="service" required>
              <option value="" disabled selected>Select a service...</option>
              <option value="Photography">Photography</option>
              <option value="Videography">Videography</option>
              <option value="Event Coverage">Event Coverage</option>
              <option value="Commercial Production">Commercial Production</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message">Message <span class="required">*</span></label>
            <textarea id="message" name="message" rows="5" placeholder="Tell us about your project" required></textarea>
          </div>
          <div id="alert-msg" class="form-alert" aria-live="polite"></div>
          <div class="form-status" id="formStatus" aria-live="polite"></div>
          <div class="form-submit-row">
            <button type="button" onclick="SendMessage();" class="btn btn-primary form-submit">
              <span>Send Message</span>
            </button>
            <div class="form-loader" id="formLoader" aria-hidden="true">
              <div class="spinner"></div>
              <span>Sending...</span>
            </div>
          </div>
          <p class="form-note">We typically respond within 24 hours on business days.</p>
        </form>
      </div>


</section>


<!-- MAP -->
<section class="map-section">
  <div class="section-header light">
    <span class="section-tag">Our Location</span>
    <h2>Visit Zillal Studio</h2>
  </div>
</section>

<!-- FAQ -->
<section class="faq-section">
  <div class="section-header">
    <span class="section-tag">FAQ</span>
    <h2>Frequently Asked Questions</h2>
  </div>
  <div class="faq-grid">
    <div class="faq-card reveal">
      <h3>How early should I book?</h3>
      <p>We recommend booking at least 2–4 weeks in advance for events and productions.</p>
    </div>
    <div class="faq-card reveal">
      <h3>Do you travel outside Dubai?</h3>
      <p>Yes, we provide photography and videography services across the UAE.</p>
    </div>
    <div class="faq-card reveal">
      <h3>How long is delivery?</h3>
      <p>Standard delivery is 48–72 hours depending on project requirements.</p>
    </div>
    <div class="faq-card reveal">
      <h3>Can packages be customized?</h3>
      <p>Absolutely. Every package can be tailored based on your creative needs.</p>
    </div>
  </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="mailapi/js/contactmail.js"></script>
<script src="mailapi/js/loadingoverlay.min.js"></script>
<?php require_once 'includes/footer.php'; ?>

