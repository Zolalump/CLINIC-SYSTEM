<?php
include '/xampp/htdocs/WebDa/booking/db.php';

header("Content-Type: application/json");

$query = "SELECT id, email FROM users"; 
$result = $conn->query($query);

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode(["success" => true, "users" => $users]);

$conn->close();
?>
