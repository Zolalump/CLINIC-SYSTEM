<?php
session_start();
include "../db.php";

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not logged in", "session_data" => $_SESSION]);
    exit;
}

// Debugging session data
error_log("Session Data: " . print_r($_SESSION, true));

$user_id = $_SESSION['user_id'];

// Check if the user exists
$sql = "SELECT id, firstname, lastname FROM admin_users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo json_encode(["error" => "User not found", "user_id" => $user_id, "session_data" => $_SESSION]);
} else {
    echo json_encode($user);
}

?>

