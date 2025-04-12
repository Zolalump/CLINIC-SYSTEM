<?php
session_start();
include '/xampp/htdocs/WebDa/booking/db.php';

header("Content-Type: application/json");

if (!isset($_SESSION["user_id"])) {
    echo json_encode(["success" => false, "error" => "User not logged in"]);
    exit;
}

$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

if (!$data || !isset($data["message"])) {
    echo json_encode(["success" => false, "error" => "Invalid message data"]);
    exit;
}

$user_id = $_SESSION["user_id"];
$message = trim($data["message"]); // Trim to remove spaces
$recipient_id = isset($data["recipient_id"]) ? intval($data["recipient_id"]) : 0; 

if (empty($message)) {
    echo json_encode(["success" => false, "error" => "Empty"]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO messages (sender_id, recipient_id, message) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $user_id, $recipient_id, $message);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Message sent successfully"]);
} else {
    echo json_encode(["success" => false, "error" => "Message sending failed: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
