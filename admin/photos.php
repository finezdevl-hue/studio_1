<?php
require_once 'includes/header.php';

if (!isset($_GET['album_id'])) {
    die("Album ID required.");
}

$album_id = (int)$_GET['album_id'];
$message = '';

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM photos WHERE id = $id AND album_id = $album_id");
    $message = '<div class="alert">Photo deleted.</div>';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $caption = $_POST['caption'] ?? '';
    
    // Handle multiple photo uploads
    if (isset($_FILES['photos'])) {
        $count = count($_FILES['photos']['name']);
        for ($i = 0; $i < $count; $i++) {
            if ($_FILES['photos']['error'][$i] == UPLOAD_ERR_OK) {
                $target_dir = "../images/gallery/";
                if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);
                
                $file_name = time() . '_' . $i . '_' . basename($_FILES["photos"]["name"][$i]);
                $target_file = $target_dir . $file_name;
                
                if (move_uploaded_file($_FILES["photos"]["tmp_name"][$i], $target_file)) {
                    $image_path = "images/gallery/" . $file_name;
                    $stmt = $conn->prepare("INSERT INTO photos (album_id, image_path, caption) VALUES (?, ?, ?)");
                    $stmt->bind_param("iss", $album_id, $image_path, $caption);
                    $stmt->execute();
                }
            }
        }
        $message = '<div class="alert">Photos uploaded successfully.</div>';
    }
}

$album = $conn->query("SELECT * FROM albums WHERE id = $album_id")->fetch_assoc();
if (!$album) {
    die("Album not found.");
}

$photos = [];
$result = $conn->query("SELECT * FROM photos WHERE album_id = $album_id ORDER BY created_at DESC");
while ($row = $result->fetch_assoc()) {
    $photos[] = $row;
}
?>

<div class="dashboard-header">
    <h1>Manage Photos: <?= htmlspecialchars($album['title']) ?></h1>
    <a href="albums.php" style="display:inline-block; margin-bottom:20px; text-decoration:none; color:var(--primary); font-weight:500;">&larr; Back to Albums</a>
</div>

<?= $message ?>
<div class="card">
    <h3>Upload Photos</h3>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label>Select Photos (You can select multiple)</label>
            <input type="file" name="photos[]" accept="image/*" multiple required>
        </div>
        <div class="form-group">
            <label>Caption (Optional, applies to all selected)</label>
            <input type="text" name="caption">
        </div>
        <button type="submit" class="btn">Upload Photos</button>
    </form>
</div>

<div class="card">
    <h3>Album Photos</h3>
    
    <div class="photo-grid">
        <?php foreach ($photos as $photo): ?>
        <div class="photo-card">
            <img src="../<?= htmlspecialchars($photo['image_path']) ?>">
            <div class="photo-card-body">
                <?php if($photo['caption']): ?>
                    <p><?= htmlspecialchars($photo['caption']) ?></p>
                <?php endif; ?>
                <a href="photos.php?album_id=<?= $album_id ?>&delete=<?= $photo['id'] ?>" class="btn btn-danger" style="padding: 6px 12px; font-size:13px; display:inline-block; text-decoration:none;" onclick="return confirm('Delete this photo?')">Delete</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <?php if (empty($photos)): ?>
        <p style="color:var(--text-light); text-align:center; padding: 20px 0;">No photos in this album yet.</p>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>
