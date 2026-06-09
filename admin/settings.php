<?php
require_once 'includes/header.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = ?");
    foreach ($_POST['settings'] as $key => $value) {
        $stmt->bind_param("ss", $value, $key);
        $stmt->execute();
    }
    $message = '<div class="alert">Settings updated successfully.</div>';
}

$settings = [];
$result = $conn->query("SELECT * FROM settings");
while ($row = $result->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
?>

<h1>Site Settings</h1>
<?= $message ?>
<div class="card">
    <form method="post" action="">
        <?php foreach ($settings as $key => $value): ?>
        <div class="form-group">
            <label><?= ucwords(str_replace('_', ' ', $key)) ?></label>
            <?php if (strpos($key, 'text') !== false || strpos($key, 'desc') !== false): ?>
                <textarea name="settings[<?= $key ?>]" rows="4"><?= htmlspecialchars($value) ?></textarea>
            <?php else: ?>
                <input type="text" name="settings[<?= $key ?>]" value="<?= htmlspecialchars($value) ?>">
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
        <button type="submit" class="btn">Save Settings</button>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>
