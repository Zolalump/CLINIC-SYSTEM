<?php
session_start();
header('Content-Type: application/json');
require_once 'db.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Ensure $mysqli is set
if (!isset($mysqli) || !$mysqli instanceof mysqli) {
    echo json_encode(['success' => false, 'error' => 'Database connection not established']);
    exit;
}

// Optional authentication check
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'User not authenticated']);
    exit;
}

// Get POST data safely
$id_number = isset($_POST['id_number']) ? $mysqli->real_escape_string(trim($_POST['id_number'])) : '';
$nurse = isset($_POST['nurse']) ? $mysqli->real_escape_string(trim($_POST['nurse'])) : '';
$date = isset($_POST['date']) ? $mysqli->real_escape_string(trim($_POST['date'])) : '';
$disease = isset($_POST['disease']) ? $mysqli->real_escape_string(trim($_POST['disease'])) : '';
$severity = isset($_POST['severity']) ? $mysqli->real_escape_string(trim($_POST['severity'])) : '';
$medication = isset($_POST['medication']) ? $mysqli->real_escape_string(trim($_POST['medication'])) : '';
$dosage = isset($_POST['dosage']) ? $mysqli->real_escape_string(trim($_POST['dosage'])) : '';

// Basic validation
if ($id_number === '') {
    echo json_encode(['success' => false, 'error' => 'ID number is required']);
    exit;
}

// Verify id_number exists
$userLookup = $mysqli->prepare("SELECT id FROM profiles WHERE id_number = ?");
$userLookup->bind_param("s", $id_number);
$userLookup->execute();
$userLookup->store_result();

if ($userLookup->num_rows === 0) {
    echo json_encode(['success' => false, 'error' => 'Invalid ID number']);
    exit;
}
$userLookup->close();

// Validate fields
if ($disease === '') {
    echo json_encode(['success' => false, 'error' => 'Complaint name (disease) is required']);
    exit;
}
if ($severity !== 'mild' && $severity !== 'severe') {
    echo json_encode(['success' => false, 'error' => 'Invalid severity value']);
    exit;
}
if ($medication === '') {
    echo json_encode(['success' => false, 'error' => 'Medication is required']);
    exit;
}
if ($dosage === '') {
    echo json_encode(['success' => false, 'error' => 'Dosage is required']);
    exit;
}
if ($nurse === '') {
    echo json_encode(['success' => false, 'error' => 'Nurse name is required']);
    exit;
}
if ($date === '') {
    echo json_encode(['success' => false, 'error' => 'Date is required']);
    exit;
}

// Insert complaint
$sql = "INSERT INTO complaints (id_number, nurse, date, disease, severity, medication, dosage)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$insertStmt = $mysqli->prepare($sql);

if (!$insertStmt) {
    echo json_encode(['success' => false, 'error' => 'Prepare failed: ' . $mysqli->error]);
    exit;
}

$insertStmt->bind_param("sssssss", $id_number, $nurse, $date, $disease, $severity, $medication, $dosage);

if ($insertStmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Execute failed: ' . $insertStmt->error]);
}

$insertStmt->close();
$mysqli->close();