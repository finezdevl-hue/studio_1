<?php
require_once 'includes/header.php';
?>

<!-- HERO -->
<section class="hero">
  <div class="hero-content">
    <span class="tagline"><?= htmlspecialchars(get_setting($conn, 'tagline')) ?></span>
    <h1>Turning Moments<br>Into Timeless<br>Visual Stories</h1>
    <p>Zillal Studio delivers elegant photography and cinematic videography experiences for brands, businesses, and special occasions.</p>
    <div class="hero-buttons">
      <a href="gallery.php" class="btn primary-btn">Explore Portfolio</a>
      <a href="contact.php" class="btn secondary-btn">Book Session</a>
    </div>
  </div>
  <div class="hero-image">
    <img src="images/hero.png" alt="">
  </div>
</section>

<!-- ABOUT -->
<section class="about">
  <div class="about-image">
    <img src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?q=80&w=1200" alt="">
  </div>
  <div class="about-content">
    <span class="section-tag">Who We Are</span>
    <h2>Modern Storytelling<br>Through Creative<br>Visual Production</h2>
    <p>At Zillal Studio, we believe every event and brand deserves to be captured with originality and style.</p>
    <p>From corporate productions to private celebrations, we create visuals that feel authentic, elegant, and memorable.</p>
    <a href="about.php" class="btn primary-btn">Learn More</a>
  </div>
</section>

<!-- SERVICES SECTION -->
<section class="services">
  <div class="section-header">
    <span class="section-tag">Our Services</span>
    <h2>Creative Media Solutions</h2>
    <p>Premium photography and cinematic videography designed with creativity, elegance, and modern storytelling.</p>
  </div>
  <div class="services-grid">
    <div class="service-card reveal">
      <div class="service-image"><img src="https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=1200" alt=""></div>
      <div class="service-content">
        <h3>Event Coverage</h3>
        <p>Professional photography and cinematic coverage for weddings and events.</p>
        <a href="services.php">Learn More</a>
      </div>
    </div>
    <div class="service-card reveal">
      <div class="service-image"><img src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?q=80&w=1200" alt=""></div>
      <div class="service-content">
        <h3>Photography</h3>
        <p>Elegant portrait, fashion, and commercial photography productions.</p>
        <a href="services.php">Learn More</a>
      </div>
    </div>
    <div class="service-card reveal">
      <div class="service-image"><img src="https://images.unsplash.com/photo-1585951237318-9ea5e175b891?q=80&w=1200" alt=""></div>
      <div class="service-content">
        <h3>Videography</h3>
        <p>Cinematic films and creative video storytelling for modern brands.</p>
        <a href="services.php">Learn More</a>
      </div>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
