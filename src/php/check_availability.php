<?php
header("Content-Type: application/json");
error_reporting(E_ALL);
ini_set("display_errors", 1);
require "db.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $facility = $_POST["facility"] ?? "";
    $date = $_POST["date"] ?? "";
    $timeSlot = $_POST["timeSlot"] ?? "";

    if (empty($facility) || empty($date) || empty($timeSlot)) {
        echo json_encode(["status" => "error", "message" => "Missing data"]);
        exit;
    }

    $stmt = $conn->prepare("SELECT id FROM reservations WHERE facility = ? AND date = ? AND time_slot = ?");
    $stmt->bind_param("sss", $facility, $date, $timeSlot);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Facility already booked for this time slot."]);
    } else {
        echo json_encode(["status" => "available"]);
    }

    $stmt->close();
    $conn->close();
}
?>
