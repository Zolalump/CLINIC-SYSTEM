<?php

require 'db.php'; 

$data = json_decode(file_get_contents('php://input'), true);

$name = $data['name'];
$student_id = $data['student_id'];
$department = $data['department'];
$classification = $data['classification'];
$section = $data['section'] ?? null;
$year = $data['year'] ?? null;
$position = $data['position'] ?? null;
$age = $data['age'];
$complaints = $data['complaints'];
$intervention = $data['intervention'];

$sql = "INSERT INTO log_entries 
(student_id, name, department, classification, section, year, position, age, complaints, intervention) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "issssssiss", // CORRECTED type string below:
    $student_id,     // i
    $name,           // s
    $department,     // s
    $classification, // s
    $section,        // s (nullable)
    $year,           // s (nullable)
    $position,       // s (nullable)
    $age,            // i
    $complaints,     // s
    $intervention    // s
);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
