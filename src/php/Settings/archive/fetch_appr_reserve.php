<?php
session_start();
include "../db.php";

header("Content-Type: application/json");

$query = "SELECT id, facility, date, time_slot FROM reservations WHERE status = 'approved'";
$result = $conn->query($query);

$approvedBookings = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $approvedBookings[] = $row;
    }
}

echo json_encode(["success" => true, "bookings" => $approvedBookings]);

$conn->close();
?>
