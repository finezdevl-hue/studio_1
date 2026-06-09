<?php
require_once 'db.php';
$site_title = get_setting($conn, 'site_title');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= htmlspecialchars($site_title) ?></title>

  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
</head>
<body>

<!-- NAVBAR -->
<header class="navbar">
  <div class="logo"><a href="index.php"><img src="images/logo.png" alt="<?= htmlspecialchars($site_title) ?> Logo"></a></div>

  <nav id="navMenu">
    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="services.php">Services</a>
    <a href="equipment.php">Equipment</a>
    <a href="gallery.php">Gallery</a>
    <a href="contact.php">Contact</a>
  </nav>

  <div class="menu-btn" id="menuBtn">
    ☰
  </div>
</header>
