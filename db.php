<?php
// $servername = "localhost";
// $username = "finezin_dbu_zillalstudio";
// $password = "Studio101#";
// $dbname = "finezin_db_zillalstudio";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zillal_studio";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get a setting
function get_setting($conn, $key) {
    $stmt = $conn->prepare("SELECT setting_value FROM settings WHERE setting_key = ?");
    $stmt->bind_param("s", $key);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        return $row['setting_value'];
    }
    return '';
}

// Function to get page content
function get_page_content($conn, $page_name, $section_name) {
    $stmt = $conn->prepare("SELECT content, image_path FROM pages WHERE page_name = ? AND section_name = ?");
    $stmt->bind_param("ss", $page_name, $section_name);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        return $row;
    }
    return ['content' => '', 'image_path' => ''];
}
?>
