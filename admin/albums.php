<?php
require_once 'includes/header.php';

$message = '';

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM albums WHERE id = $id");
    $message = '<div class="alert">Album deleted.</div>';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    
    // Handle cover image
    $cover_image = '';
    if (isset($_FILES['cover']) && $_FILES['cover']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "../images/";
        if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);
        $file_name = time() . '_' . basename($_FILES["cover"]["name"]);
        $target_file = $target_dir . $file_name;
        if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
            $cover_image = "images/" . $file_name;
        }
    }

    $stmt = $conn->prepare("INSERT INTO albums (title, cover_image) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $cover_image);
    if ($stmt->execute()) {
        $message = '<div class="alert">Album created successfully.</div>';
    }
}

$albums = [];
$result = $conn->query("SELECT * FROM albums ORDER BY created_at DESC");
while ($row = $result->fetch_assoc()) {
    $albums[] = $row;
}
?>

<h1>Gallery Albums</h1>
<?= $message ?>
<div class="card">
    <h3>Create New Album</h3>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label>Album Title</label>
            <input type="text" name="title" required>
        </div>
        <div class="form-group">
            <label>Cover Image (Optional)</label>
            <input type="file" name="cover" accept="image/*">
        </div>
        <button type="submit" class="btn">Create Album</button>
    </form>
</div>

<div class="card">
    <h3>Existing Albums</h3>
    <table>
        <tr>
            <th>Title</th>
            <th>Cover Image</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($albums as $album): ?>
        <tr>
            <td><?= htmlspecialchars($album['title']) ?></td>
            <td>
                <?php if ($album['cover_image']): ?>
                    <img src="../<?= htmlspecialchars($album['cover_image']) ?>" width="80">
                <?php endif; ?>
            </td>
            <td>
                <a href="photos.php?album_id=<?= $album['id'] ?>" class="btn" style="padding: 5px 10px; font-size:12px;">Manage Photos</a>
                <a href="albums.php?delete=<?= $album['id'] ?>" class="btn btn-danger" style="padding: 5px 10px; font-size:12px;" onclick="return confirm('Are you sure? This will delete all photos inside.')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require_once 'includes/footer.php'; ?>
