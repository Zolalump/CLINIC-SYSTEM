<?php
session_start();
include '/xampp/htdocs/WebDa/booking/db.php';

header("Content-Type: application/json");

if (!isset($_SESSION["user_id"])) {
    $_SESSION['message'] = 'Unauthorized access.';
    echo json_encode(["success" => false]);
    exit;
}

$user_id = $_SESSION["user_id"];
$data = json_decode(file_get_contents("php://input"), true);
$reservation_id = $data["id"] ?? null;

error_log("Session User ID: " . $user_id);
error_log("Received Reservation ID: " . json_encode($data));
error_log("Extracted Reservation ID: " . $reservation_id);


error_log("Session User ID: " . $user_id);
error_log("Received Reservation ID: " . $reservation_id);

if (!$reservation_id) {
    $_SESSION['message'] = 'Invalid Request';
    echo json_encode(["success" => false]);
    exit;
}

$check_stmt = $conn->prepare("SELECT * FROM reservations WHERE id = ? AND user_id = ?");
$check_stmt->bind_param("ii", $reservation_id, $user_id);
$check_stmt->execute();
$result = $check_stmt->get_result();
$reservation = $result->fetch_assoc();

if (!$reservation) {
    error_log("Reservation ID: $reservation_id not found for User ID: $user_id.");
    $_SESSION['message'] = 'Reservation not found';
    echo json_encode(["success" => false]);
    exit;
}

$stmt = $conn->prepare("DELETE FROM reservations WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $reservation_id, $user_id);
if ($stmt->execute()) {
    error_log("Successfully canceled reservation ID: $reservation_id for User ID: $user_id.");
    $_SESSION['message'] = 'Reservation canceled successfully.';
    echo json_encode(["success" => true]);
} else {
    error_log("Failed to cancel reservation ID: $reservation_id for User ID: $user_id.");
    $_SESSION['message'] = 'Failed to cancel reservation.';
    echo json_encode(["success" => false]);
}

$stmt->close();
$conn->close();
?>
