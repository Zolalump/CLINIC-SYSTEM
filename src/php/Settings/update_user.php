<?php
session_start();
include "../db.php";

header("Content-Type: application/json");

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not authenticated"]);
    exit;
}

$user_id = $_SESSION['user_id'];

// Get JSON input data
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['student_id']) || !isset($data['firstname']) || !isset($data['lastname'])) {
    echo json_encode(["error" => "Missing data", "received" => $data]);
    exit;
}

$student_id = $data['student_id'];
$firstname = $data['firstname'];
$lastname = $data['lastname'];

// Update user information
$sql = "UPDATE users SET student_id = ?, firstname = ?, lastname = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $student_id, $firstname, $lastname, $user_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "User updated successfully"]);
} else {
    echo json_encode(["error" => "Database update failed"]);
}
?>
