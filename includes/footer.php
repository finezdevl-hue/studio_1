<!-- CTA -->
<section class="cta">
  <h2>Let’s create something unforgettable together.</h2>
  <a href="contact.php" class="btn white-btn">
    Contact <?= htmlspecialchars(get_setting($conn, 'site_title')) ?>
  </a>
</section>

<!-- FOOTER -->
<footer class="footer">

  <div class="footer-logo">
    <?= htmlspecialchars(get_setting($conn, 'site_title')) ?>
  </div>

  <p>
    <?= htmlspecialchars(get_setting($conn, 'footer_text')) ?>
  </p>

  <div class="footer-links">
    <a href="index.php">Home</a>
    <a href="services.php">Services</a>
    <a href="gallery.php">Gallery</a>
    <a href="contact.php">Contact</a>
  </div>

  <small>
    © <?= date('Y') ?> <?= htmlspecialchars(get_setting($conn, 'site_title')) ?>. All Rights Reserved.
  </small>

</footer>

<script src="script.js"></script>

</body>
</html>
