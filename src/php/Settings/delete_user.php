<?php
session_start();
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Step 1: Get user data
    $get = $conn->prepare("SELECT * FROM log_entries WHERE id = ?");
    $get->bind_param("i", $id);
    $get->execute();
    $result = $get->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Step 2: Archive user
        $archive = $conn->prepare("INSERT INTO archived_log_entries (name, classification, department, deleted_at) VALUES (?, ?, ?, ?)");
        $archive->bind_param("ssss", $user['name'], $user['classification'], $user['department'], $user['timestamp']);
        $archive->execute();

        // Step 3: Delete user
        $delete = $conn->prepare("DELETE FROM log_entries WHERE id = ?");
        $delete->bind_param("i", $id);
        $delete->execute();
    }
}

header("Location: dashboard.php"); // Or whatever this page is called
exit();
