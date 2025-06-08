<?php
require_once 'db.php';  // your DB connection file

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$action = $_GET['action'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];

if ($action === 'load' && $method === 'GET') {
    $id_number = $mysqli->real_escape_string($_GET['id_number'] ?? '');

    if (!$id_number) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing id_number']);
        exit;
    }

    $result = $mysqli->query("SELECT id, content, created_at FROM notes WHERE id_number = '$id_number' ORDER BY created_at DESC");

    $notes = [];
    while ($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }

    echo json_encode($notes);
    exit;
}

if ($action === 'save' && $method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id_number = $mysqli->real_escape_string($data['id_number'] ?? '');
    $content = $mysqli->real_escape_string($data['content'] ?? '');

    if (!$id_number || !$content) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing data']);
        exit;
    }

    $stmt = $mysqli->prepare("INSERT INTO notes (id_number, content, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $id_number, $content);
    $stmt->execute();

    echo json_encode(['success' => true]);
    exit;
}

if ($action === 'delete' && $method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = intval($data['id'] ?? 0);
    $id_number = $mysqli->real_escape_string($data['id_number'] ?? '');

    if ($id <= 0 || !$id_number) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid note ID or missing id_number']);
        exit;
    }

    // Verify note belongs to this id_number before deleting
    $stmt = $mysqli->prepare("SELECT id FROM notes WHERE id = ? AND id_number = ?");
    $stmt->bind_param("is", $id, $id_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        http_response_code(403);
        echo json_encode(['error' => 'Unauthorized or note not found']);
        exit;
    }

    $stmt = $mysqli->prepare("DELETE FROM notes WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo json_encode(['success' => true]);
    exit;
}

http_response_code(400);
echo json_encode(['error' => 'Invalid request']);