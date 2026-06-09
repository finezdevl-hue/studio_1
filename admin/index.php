<?php 
require_once 'includes/header.php'; 

// Fetch stats
$album_count = $conn->query("SELECT COUNT(*) AS c FROM albums")->fetch_assoc()['c'];
$photo_count = $conn->query("SELECT COUNT(*) AS c FROM photos")->fetch_assoc()['c'];
?>

<div class="dashboard-header">
    <h1>Dashboard Overview</h1>
    <p>Welcome back to the Zillal Studio Admin Panel.</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(52, 152, 219, 0.1); color: #3498db;">
            📁
        </div>
        <div class="stat-info">
            <h3><?= $album_count ?></h3>
            <span>Total Albums</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: rgba(46, 204, 113, 0.1); color: #2ecc71;">
            🖼️
        </div>
        <div class="stat-info">
            <h3><?= $photo_count ?></h3>
            <span>Total Photos</span>
        </div>
    </div>
</div>

<div class="card" style="margin-top: 30px;">
    <h2>Quick Actions</h2>
    <div style="display: flex; gap: 15px; margin-top: 20px;">
        <a href="albums.php" class="btn" style="text-decoration: none;">Manage Gallery</a>
        <a href="settings.php" class="btn btn-secondary" style="text-decoration: none;">Site Settings</a>
        <a href="../index.php" target="_blank" class="btn btn-outline" style="text-decoration: none;">View Live Site</a>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
