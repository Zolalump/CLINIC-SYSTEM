<?php
session_start();
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // 1. Fetch user data from archived_users
    $result = $conn->query("SELECT * FROM archived_log_entries WHERE id = $id");
    
    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Prepare data (adjust column names if necessary)
        $name = $conn->real_escape_string($user['name']);
        $classification = $conn->real_escape_string($user['classification']);
        $department = $conn->real_escape_string($user['department']);
        // Add other columns here if needed...

        // 2. Insert user data back into active users table
        $insert_sql = "INSERT INTO log_entries (name, classification, department) VALUES ('$name', '$classification', '$department')";
        if ($conn->query($insert_sql)) {
            // 3. Delete user from archived_users
            $delete_sql = "DELETE FROM archived_log_entries WHERE id = $id";
            if ($conn->query($delete_sql)) {
                $_SESSION['message'] = "User '$name' has been successfully restored.";
            } else {
                $_SESSION['error'] = "Failed to delete user from archive.";
            }
        } else {
            $_SESSION['error'] = "Failed to restore user to active users.";
        }
    } else {
        $_SESSION['error'] = "Archived user not found.";
    }
} else {
    $_SESSION['error'] = "Invalid request.";
}

// Redirect back to archive users page
header("Location: archive_users.php");
exit();
