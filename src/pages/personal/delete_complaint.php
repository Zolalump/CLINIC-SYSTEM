<?php
require_once '../../php/db.php';  // Adjust path if needed
header('Content-Type: application/json');

// Debug log file path
$logFile = __DIR__ . '/debug_delete.log';

// Log incoming POST data for debugging
file_put_contents($logFile, "=== Delete Complaint Request ===\n", FILE_APPEND);
file_put_contents($logFile, "Timestamp: " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
file_put_contents($logFile, "POST data: " . print_r($_POST, true) . "\n", FILE_APPEND);

$id = $_POST['id_number'] ?? '';
$complaintId = $_POST['complaint_id'] ?? '';

if ($id === '' || $complaintId === '') {
    file_put_contents($logFile, "Error: ID number and complaint ID are required.\n\n", FILE_APPEND);
    echo json_encode(['success' => false, 'error' => 'ID number and complaint ID are required']);
    exit;
}

// Verify complaint belongs to this id_number before deleting
$stmt = $conn->prepare("SELECT id FROM complaints WHERE id = ? AND id_number = ?");
if (!$stmt) {
    file_put_contents($logFile, "Prepare failed: " . $conn->error . "\n\n", FILE_APPEND);
    echo json_encode(['success' => false, 'error' => 'Database error: prepare failed']);
    exit;
}

$stmt->bind_param("is", $complaintId, $id);

if (!$stmt->execute()) {
    file_put_contents($logFile, "Execute failed: " . $stmt->error . "\n\n", FILE_APPEND);
    echo json_encode(['success' => false, 'error' => 'Database error: execute failed']);
    $stmt->close();
    $conn->close();
    exit;
}

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    file_put_contents($logFile, "Error: Complaint not found for this user.\n\n", FILE_APPEND);
    echo json_encode(['success' => false, 'error' => 'Complaint not found for this user']);
    $stmt->close();
    $conn->close();
    exit;
}

$stmt->close();

// Proceed to delete
$stmtDelete = $conn->prepare("DELETE FROM complaints WHERE id = ? AND id_number = ?");
if (!$stmtDelete) {
    file_put_contents($logFile, "Delete prepare failed: " . $conn->error . "\n\n", FILE_APPEND);
    echo json_encode(['success' => false, 'error' => 'Database error: delete prepare failed']);
    exit;
}

$stmtDelete->bind_param("is", $complaintId, $id);

file_put_contents($logFile, "Deleting complaintId: $complaintId for id_number: $id\n", FILE_APPEND);

if ($stmtDelete->execute()) {
    file_put_contents($logFile, "Delete successful.\n\n", FILE_APPEND);
    echo json_encode(['success' => true, 'message' => 'Complaint deleted successfully']);
} else {
    file_put_contents($logFile, "Delete failed: " . $stmtDelete->error . "\n\n", FILE_APPEND);
    echo json_encode(['success' => false, 'error' => 'Failed to delete complaint']);
}

$stmtDelete->close();
$conn->close();
