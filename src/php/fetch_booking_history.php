<?php
session_start();
include 'db.php'; 

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id']; 

$sql = "SELECT * FROM reservations WHERE user_id = ? AND status IN ('approved', 'canceled', 'disapproved') ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$bookings = [];

while ($row = $result->fetch_assoc()) {
    $bookings[] = [
        'id' => $row['id'],
        'facility' => $row['facility'],
        'date' => $row['date'],
        'time_slot' => $row['time_slot'],
        'status' => $row['status'],
        'created_at' => $row['created_at']
    ];
}

echo json_encode(['success' => true, 'bookings' => $bookings]);

$stmt->close();
$conn->close();
?>
