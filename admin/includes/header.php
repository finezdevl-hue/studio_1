<?php

session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}
require_once '../db.php';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zillal Studio Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="admin-wrapper">
    <aside class="sidebar">
        <h2>Admin Panel</h2>
        <a href="index.php" <?= $current_page == 'index.php' ? 'class="active"' : '' ?>>Dashboard</a>
        <a href="settings.php" <?= $current_page == 'settings.php' ? 'class="active"' : '' ?>>Site Settings</a>
        <a href="albums.php" <?= $current_page == 'albums.php' || $current_page == 'photos.php' ? 'class="active"' : '' ?>>Gallery Albums</a>
        <a href="../index.php" target="_blank">View Site</a>
        <a href="logout.php">Logout</a>
    </aside>
    <main class="main-content">
