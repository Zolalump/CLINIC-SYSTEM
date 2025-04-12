<?php
session_start();
include '/xampp/htdocs/WebDa/booking/db.php';

header("Content-Type: application/json");

$response = []; 

error_log("Session Data in event_book.php: " . print_r($_SESSION, true));

if (!isset($_SESSION["user_id"])) {
    error_log("Session issue: User not logged in during fetch request.");
    $response = ["success" => false, "error" => "User not logged in"];
    echo json_encode($response);
    exit;
}

$user_id = $_SESSION["user_id"];

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
    $response = ["success" => false, "error" => "Missing required fields"];
    echo json_encode($response);
    exit;
}

if ($conn->connect_error) {
    $response = ["success" => false, "error" => "Database connection failed"];
    echo json_encode($response);
    exit;
}

$stmt = $conn->prepare("INSERT INTO reservations (user_id, facility, date, time_slot, purpose, attendees) VALUES (?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    $response = ["success" => false, "error" => "SQL Prepare failed: " . $conn->error];
    echo json_encode($response);
    exit;
}

$stmt->bind_param("issssi", $user_id, $facility, $date, $timeSlot, $purpose, $attendees);

if ($stmt->execute()) {
    $response = ["success" => true, "message" => "Booking successful"];
} else {
    $response = ["success" => false, "error" => "SQL Execution failed: " . $stmt->error];
}

$stmt->close();
$conn->close();

echo json_encode($response);
exit;
?>
