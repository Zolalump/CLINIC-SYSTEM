<?php
session_start();
include 'db.php';

header("Content-Type: application/json");

error_log("Session Data: " . print_r($_SESSION, true));

if (!isset($_SESSION["user_id"])) {
    echo json_encode(["success" => false, "error" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION["user_id"];

$query = "SELECT id, facility, date, time_slot, purpose, attendees 
          FROM reservations 
          WHERE user_id = ? AND status = 'pending' 
          ORDER BY date DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$bookings = [];
while ($row = $result->fetch_assoc()) {
    $bookings[] = $row;
}

$stmt->close();
$conn->close();

// Ensure only JSON is output
echo json_encode(["success" => true, "bookings" => $bookings]);
exit;
?>
