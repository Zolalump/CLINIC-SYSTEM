<?php
include 'db.php'; 

header('Content-Type: application/json'); 
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $sql = "SELECT reservations WHERE id, firstname, lastname, facility, date, time FROM reservations WHERE status = 'approved' ORDER BY date DESC";
    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception("Query Error: " . $conn->error);
    }

    $reservations = [];

    while ($row = $result->fetch_assoc()) {
        $reservations[] = $row;
    }

    echo json_encode($reservations);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
