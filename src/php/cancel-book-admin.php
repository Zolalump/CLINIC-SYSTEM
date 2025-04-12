<?php
include 'db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: Invalid request.");
}

$id = $_GET['id'];

$sql = "UPDATE reservations SET status = 'disapproved' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header('location: admin-panel.php');
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
