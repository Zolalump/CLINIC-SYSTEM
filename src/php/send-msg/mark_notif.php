<?php
session_start();
include '/xampp/htdocs/WebDa/booking/db.php';

header("Content-Type: application/json");

if (!isset($_SESSION["user_id"])) {
    echo json_encode(["success" => false, "error" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION["user_id"];

$stmt = $conn->prepare("UPDATE messages SET is_read = 1 WHERE recipient_id = 0 OR recipient_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$stmt->close();
$conn->close();

echo json_encode(["success" => true, "message" => "Notifications marked as read"]);
?>
