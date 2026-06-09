<?php
// Security Key
$API_KEY = 'api_secret_789';
$provided_key = $_POST['api_key'] ?? $_GET['api_key'] ?? '';

if ($provided_key !== $API_KEY) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Database Connection
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'zillal_studio';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

header('Content-Type: application/json');

switch ($action) {
    case 'stats':
        $albums_count = $conn->query("SELECT COUNT(*) as count FROM albums")->fetch_assoc()['count'] ?? 0;
        $photos_count = $conn->query("SELECT COUNT(*) as count FROM photos")->fetch_assoc()['count'] ?? 0;
        echo json_encode(['albums' => $albums_count, 'photos' => $photos_count]);
        break;

    case 'albums':
        $result = $conn->query("SELECT * FROM albums ORDER BY created_at DESC");
        $data = [];
        while ($row = $result->fetch_assoc()) $data[] = $row;
        echo json_encode($data);
        break;

    case 'add_album':
        $title = $_POST['title'] ?? '';
        // No description for Zillal
        $db_path = '';
        if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
            if (!is_dir('uploads')) mkdir('uploads', 0777, true);
            $file_name = time() . '_album_' . basename($_FILES['cover_image']['name']);
            $db_path = 'uploads/' . $file_name;
            move_uploaded_file($_FILES['cover_image']['tmp_name'], $db_path);
        }
        $stmt = $conn->prepare("INSERT INTO albums (title, cover_image) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $db_path);
        echo json_encode(['success' => $stmt->execute()]);
        $stmt->close();
        break;

    case 'edit_album':
        $album_id = (int)$_POST['album_id'];
        $title = $_POST['title'] ?? '';
        $db_path = null;
        if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
            if (!is_dir('uploads')) mkdir('uploads', 0777, true);
            $file_name = time() . '_album_edit_' . basename($_FILES['cover_image']['name']);
            $db_path = 'uploads/' . $file_name;
            move_uploaded_file($_FILES['cover_image']['tmp_name'], $db_path);
        }
        if ($db_path) {
            $stmt = $conn->prepare("UPDATE albums SET title = ?, cover_image = ? WHERE id = ?");
            $stmt->bind_param("ssi", $title, $db_path, $album_id);
        } else {
            $stmt = $conn->prepare("UPDATE albums SET title = ? WHERE id = ?");
            $stmt->bind_param("si", $title, $album_id);
        }
        echo json_encode(['success' => $stmt->execute()]);
        $stmt->close();
        break;

    case 'photos':
        $result = $conn->query("SELECT p.*, a.title as album_title FROM photos p LEFT JOIN albums a ON p.album_id = a.id ORDER BY p.created_at DESC LIMIT 50");
        $data = [];
        while ($row = $result->fetch_assoc()) $data[] = $row;
        echo json_encode($data);
        break;
        
    case 'albums_list':
        $result = $conn->query("SELECT id, title FROM albums ORDER BY title ASC");
        $data = [];
        while ($row = $result->fetch_assoc()) $data[] = $row;
        echo json_encode($data);
        break;

    case 'add_photo':
        $album_id = $_POST['album_id'] ?? 0;
        $caption = $_POST['caption'] ?? '';
        $db_path = '';
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            if (!is_dir('uploads')) mkdir('uploads', 0777, true);
            $file_name = time() . '_' . basename($_FILES['photo']['name']);
            $db_path = 'uploads/' . $file_name;
            move_uploaded_file($_FILES['photo']['tmp_name'], $db_path);
        }
        $stmt = $conn->prepare("INSERT INTO photos (album_id, image_path, caption) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $album_id, $db_path, $caption);
        echo json_encode(['success' => $stmt->execute()]);
        $stmt->close();
        break;

    case 'settings':
        $result = $conn->query("SELECT * FROM settings");
        $data = [];
        while ($row = $result->fetch_assoc()) $data[$row['setting_key']] = $row['setting_value'];
        echo json_encode($data);
        break;

    case 'save_settings':
        $settings = $_POST['settings'] ?? [];
        $stmt = $conn->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = ?");
        $success = true;
        foreach ($settings as $key => $value) {
            $stmt->bind_param("ss", $value, $key);
            if (!$stmt->execute()) $success = false;
        }
        echo json_encode(['success' => $success]);
        $stmt->close();
        break;

    default:
        echo json_encode(['error' => 'Invalid action']);
        break;
}
$conn->close();
?>
