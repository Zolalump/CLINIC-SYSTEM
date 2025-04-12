<?php
include 'db.php';

header('Content-Type: application/json'); 
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $sql = "SELECT 
                r.id, 
                u.firstname, 
                u.lastname, 
                r.facility, 
                r.date, 
                r.time_slot 
            FROM reservations r
            JOIN users u ON r.user_id = u.id
            WHERE r.status = 'approved'
            ORDER BY r.date DESC";
    
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
