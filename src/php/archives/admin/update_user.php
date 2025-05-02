<?php
session_start();
include "../db.php";

header("Content-Type: application/json");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not authenticated"]);
    exit;
}

$user_id = $_SESSION['user_id'];

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['firstname']) || !isset($data['lastname'])) {
    echo json_encode(["error" => "Missing data", "received" => $data]);
    exit;
}

$firstname = $data['firstname'];
$lastname = $data['lastname'];

$sql = "UPDATE admin_users SET firstname = ?, lastname = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $firstname, $lastname, $user_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "User updated successfully"]);
} else {
    echo json_encode(["error" => "Database update failed"]);
}
?>
