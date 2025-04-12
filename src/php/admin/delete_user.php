<?php
include '/xampp/htdocs/WebDa/booking/db.php';

header('Content-Type: application/json');

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = intval($_POST['id']); 

        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            $archive_query = "INSERT INTO archived_users (id, email, created_at) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($archive_query);
            $stmt->bind_param("iss", $user['id'], $user['email'], $user['created_at']);
            if (!$stmt->execute()) {
                echo json_encode(["success" => false, "message" => "Archiving failed: " . $stmt->error]);
                exit;
            }

            $delete_query = "DELETE FROM users WHERE id = ?";
            $stmt = $conn->prepare($delete_query);
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "User deleted and archived successfully"]);
            } else {
                echo json_encode(["success" => false, "message" => "Error deleting user: " . $stmt->error]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "User not found"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Missing user ID"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}

$conn->close();
?>
