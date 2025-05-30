<?php
session_start();
include 'db.php';

$token = $_GET['token'] ?? '';

if (empty($token)) {
    $_SESSION['message'] = 'Invalid or expired verification link.';
    $_SESSION['message_type'] = 'error';
    header("Location: /WebDa/CLINIC-SYSTEM-3/admin_reg.php");
    exit;
}

    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE tracking_url LIKE ?");
    $searchToken = "%$token%";
    $stmt->bind_param("s", $searchToken);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $updateStmt = $conn->prepare("UPDATE admin_users SET email_verified = TRUE WHERE id = ?");
        $updateStmt->bind_param("i", $user['id']);
        if ($updateStmt->execute()) {
            $_SESSION['message'] = 'Email verified successfully! You can now log in.';
            $_SESSION['message_type'] = 'success';
            header("Location: /WebDa/CLINIC-SYSTEM-3/admin_reg.php");
            exit;
        } else {
            error_log("Error updating email_verified for user: " . $user['id']);
            $_SESSION['message'] = 'There was an error verifying your email. Please try again.';
            $_SESSION['message_type'] = 'error';
            header("Location: /WebDa/CLINIC-SYSTEM-3/admin_reg.php");
            exit;
        }
    } else {
        $_SESSION['message'] = 'Invalid or expired verification link.';
        $_SESSION['message_type'] = 'error';
        header("Location: /WebDa/CLINIC-SYSTEM-3/admin_reg.php");
        exit;
    }

    if ($updateStmt->execute()) {
        error_log("Email verification successful for user ID: " . $user['id']);
        $_SESSION['message'] = 'Email verified successfully! You can now log in.';
        $_SESSION['message_type'] = 'success';
        header("Location: /WebDa/CLINIC-SYSTEM-3/admin_reg.php");
        exit;
    } else {
        error_log("Error updating email_verified for user: " . $user['id']);
        $_SESSION['message'] = 'There was an error verifying your email. Please try again.';
        $_SESSION['message_type'] = 'error';
        header("Location: /WebDa/CLINIC-SYSTEM-3/admin_reg.php");
        exit;
    }
?>
