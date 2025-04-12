<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE reservations SET status = 'approved' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: admin-panel.php?success=approved");
    } else {
        header("Location: admin-panel.php?error=failed");
    }
}
?>

