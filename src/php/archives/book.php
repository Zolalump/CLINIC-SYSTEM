<?php
session_start();
include '/xampp/htdocs/WebDa/booking/db.php';

header("Content-Type: application/json");

$response = [];

// Debugging: Log session data
error_log("Session Data in book.php: " . print_r($_SESSION, true));

if (!isset($_SESSION["user_id"])) {
    error_log("Session issue: User not logged in during fetch request.");
    echo json_encode(["success" => false, "error" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION["user_id"];

// Get raw JSON data from fetch request
$rawData = file_get_contents("php://input");
error_log("Raw JSON received: " . $rawData);

$data = json_decode($rawData, true);

if (!$data) {
    error_log("JSON Decode Error: " . json_last_error_msg());
    echo json_encode(["success" => false, "error" => "Invalid JSON"]);
    exit;
}

$facility = $data["facility"] ?? "";
$date = $data["date"] ?? "";
$timeSlot = $data["timeSlot"] ?? "";
$purpose = $data["purpose"] ?? "";
$attendees = $data["attendees"] ?? 0;

if (!$facility || !$date || !$timeSlot || !$purpose || !$attendees) {
    echo json_encode(["success" => false, "error" => "Missing required fields"]);
    exit;
}

if ($conn->connect_error) {
    echo json_encode(["success" => false, "error" => "Database connection failed"]);
    exit;
}

$check_user_stmt = $conn->prepare("SELECT id, status FROM reservations WHERE user_id = ? AND date >= CURDATE()");
$check_user_stmt->bind_param("i", $user_id);
$check_user_stmt->execute();
$result = $check_user_stmt->get_result();

while ($row = $result->fetch_assoc()) {
    if ($row["status"] === "approved") {
        echo json_encode(["success" => false, "error" => "Active reservation is ongoing, cannot book twice."]);
        exit;
    } elseif ($row["status"] === "pending") {
        echo json_encode(["success" => false, "error" => "Pending reservations still ongoing, cannot book while on the process."]);
        exit;
    }
}

$check_stmt = $conn->prepare("SELECT id FROM reservations WHERE facility = ? AND date = ? AND time_slot = ?");
$check_stmt->bind_param("sss", $facility, $date, $timeSlot);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
    echo json_encode(["success" => false, "error" => "Facility already booked for this time slot!"]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO reservations (user_id, facility, date, time_slot, purpose, attendees, status) VALUES (?, ?, ?, ?, ?, ?, 'pending')");

if (!$stmt) {
    echo json_encode(["success" => false, "error" => "SQL Prepare failed: " . $conn->error]);
    exit;
}

$stmt->bind_param("issssi", $user_id, $facility, $date, $timeSlot, $purpose, $attendees);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Booking request submitted! Pending approval."]);
} else {
    echo json_encode(["success" => false, "error" => "SQL Execution failed: " . $stmt->error]);
}

$stmt->close();
$check_stmt->close();
$check_user_stmt->close();
$conn->close();
?>
