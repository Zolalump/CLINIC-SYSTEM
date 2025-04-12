<?php
session_start();
include '/xampp/htdocs/WebDa/booking/db.php';

header("Content-Type: application/json");

if (!isset($_SESSION["user_id"])) {
    echo json_encode(["success" => false, "error" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION["user_id"];

// Fetch only unread messages
$stmt = $conn->prepare("SELECT id, sender_id, message, sent_at FROM messages WHERE (recipient_id = 0 OR recipient_id = ?) AND is_read = 0 ORDER BY sent_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode(["success" => true, "messages" => $messages]);
?>
