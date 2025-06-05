<?php
require_once '../../php/db.php';
header('Content-Type: application/json');

$id = $_POST['id_number'] ?? '';

if (empty($id)) {
    echo json_encode(['success' => false, 'error' => 'ID number is required']);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM complaints WHERE id_number = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

$complaints = [];
while ($row = $result->fetch_assoc()) {
    $complaints[] = $row;
}

echo json_encode([
    'success' => true,
    'complaints' => $complaints
]);

$stmt->close();
$conn->close();
?>
