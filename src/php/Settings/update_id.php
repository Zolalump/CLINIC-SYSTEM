<?php
session_start();
include "../db.php"; 

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['student_id'])) {
    echo json_encode(["error" => "No student ID provided"]);
    exit;
}

$student_id = $data['student_id'];

$sql = "UPDATE users SET student_id = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $student_id, $user_id);

if ($stmt->execute()) {
    echo json_encode(["success" => "Student ID updated successfully."]);
} else {
    echo json_encode(["error" => "Error updating Student ID."]);
}
?>
