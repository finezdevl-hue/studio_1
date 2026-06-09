<?php require_once 'includes/header.php'; ?>
<?php
if (!isset($_GET['id'])) {
    header("Location: gallery.php");
    exit;
}
$album_id = (int)$_GET['id'];
$album = $conn->query("SELECT * FROM albums WHERE id = $album_id")->fetch_assoc();
if (!$album) {
    header("Location: gallery.php");
    exit;
}
?>

<section class="about-hero" style="height: 40vh; min-height: 300px;">
  <div class="overlay"></div>
  <div class="hero-content">
    <a href="gallery.php" style="color:#fff; text-decoration:none; margin-bottom:10px; display:inline-block;">&larr; Back to Gallery</a>
    <h1><?= htmlspecialchars($album['title']) ?></h1>
  </div>
</section>

<section class="services-grid" style="padding-top: 60px;">
<?php
$photos = $conn->query("SELECT * FROM photos WHERE album_id = $album_id ORDER BY created_at DESC");
if ($photos->num_rows > 0) {
    while ($photo = $photos->fetch_assoc()) {
?>
  <div class="service-card reveal" style="padding:0; box-shadow:none;">
    <img src="<?= htmlspecialchars($photo['image_path']) ?>" alt="<?= htmlspecialchars($photo['caption']) ?>" style="border-radius:8px;">
    <?php if ($photo['caption']): ?>
    <p style="text-align:center; padding:10px; font-weight:500;"><?= htmlspecialchars($photo['caption']) ?></p>
    <?php endif; ?>
  </div>
<?php
    }
} else {
    echo "<p style='text-align:center; width:100%;'>No photos in this album yet.</p>";
}
?>
</section>

<?php require_once 'includes/footer.php'; ?>
