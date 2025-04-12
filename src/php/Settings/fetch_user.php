<?php
session_start();
include "../db.php";

header('Content-Type: application/json'); 

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not logged in", "session" => $_SESSION]);
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT firstname, lastname, COALESCE(student_id, '-') AS student_id FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo json_encode(["error" => "Not found"]);
} else {
    echo json_encode($user);
}
?>
