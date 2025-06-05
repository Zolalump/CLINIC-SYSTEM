<?php
require_once '../../php/db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and fetch POST data
    $id_number = $_POST['id_number'] ?? null;
    $name = $_POST['name'] ?? null;
    $email = $_POST['email'] ?? null;

    if (!$id_number) {
        echo json_encode(['success' => false, 'error' => 'Missing ID Number']);
        exit;
    }

    // Other fields
    $course = $_POST['course'] ?? null;
    $year = $_POST['year'] ?? null;
    $gender = $_POST['gender'] ?? null;
    $birthdate = $_POST['birthdate'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $address = $_POST['address'] ?? null;
    $bp = $_POST['blood_pressure'] ?? null;
    $weight = $_POST['weight'] ?? null;
    $temp = $_POST['temperature'] ?? null;
    $department = $_POST['department'] ?? null;
    $role = $_POST['role'] ?? null;

    // Check if profile exists by id_number
    $stmt = $conn->prepare("SELECT id FROM profiles WHERE id_number = ?");
    $stmt->bind_param("s", $id_number);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($profile_id);
        $stmt->fetch();

        // Update profile including name and email
        $update = $conn->prepare("UPDATE profiles SET name=?, email=?, course=?, year=?, gender=?, birthdate=?, phone=?, address=?, blood_pressure=?, weight=?, temperature=?, department=?, role=? WHERE id=?");
        $update->bind_param(
            "sssssssssssssi",
            $name, $email, $course, $year, $gender, $birthdate, $phone, $address, $bp, $weight, $temp, $department, $role, $profile_id
        );

        if ($update->execute()) {
            echo json_encode(['success' => true, 'message' => 'Profile updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update profile.']);
        }
        $update->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'No profile found. Please contact admin.']);
    }

    $stmt->close();
    $conn->close();
}
?>
