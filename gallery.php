<?php require_once 'includes/header.php'; ?>

<section class="about-hero">
  <div class="overlay"></div>
  <div class="hero-content">
    <span>Portfolio</span>
    <h1>Our Gallery Albums</h1>
  </div>
</section>

<section class="services-grid" style="padding-top: 60px;">
<?php
$result = $conn->query("SELECT * FROM albums ORDER BY created_at DESC");
if ($result->num_rows > 0) {
    while ($album = $result->fetch_assoc()) {
        $cover = $album['cover_image'] ? $album['cover_image'] : 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=1200';
?>
  <div class="service-card reveal">
    <img src="<?= htmlspecialchars($cover) ?>" alt="<?= htmlspecialchars($album['title']) ?>">
    <div class="service-content">
      <h3><?= htmlspecialchars($album['title']) ?></h3>
      <a href="album.php?id=<?= $album['id'] ?>" class="btn primary-btn" style="margin-top:10px;">View Album</a>
    </div>
  </div>
<?php
    }
} else {
    echo "<p style='text-align:center; width:100%;'>No albums available right now. Please check back later.</p>";
}
?>
</section>

<?php require_once 'includes/footer.php'; ?>
