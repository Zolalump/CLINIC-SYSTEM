<?php
session_start();
include 'db.php'; 

header('Content-Type: application/json');

if (!isset($_SESSION["user_id"])) {
    echo json_encode(["success" => false, "error" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION["user_id"];
$is_admin = isset($_SESSION["role"]) && $_SESSION["role"] === "admin";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($is_admin) {
        $sql = "UPDATE reservations SET status = 'canceled' WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
    } else {
        $sql = "UPDATE reservations SET status = 'canceled' WHERE id = ? AND user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $id, $user_id);
    }

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        echo json_encode(["success" => true, "message" => "Cancellation successful."]);
    } else {
        echo json_encode(["success" => false, "error" => "Failed to cancel reservation."]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "error" => "Invalid request"]);
}

$conn->close();
?>
