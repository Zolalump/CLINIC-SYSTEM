<?php
require_once '../../php/db.php';
header('Content-Type: application/json');

$id = $_POST['id_number'] ?? '';

if ($id === '') {
    echo json_encode(['success' => false, 'error' => 'ID number is required']);
    exit;
}

// Get profile
$stmt = $conn->prepare("SELECT * FROM profiles WHERE id_number = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    // Get complaints using id_number (not user_id!)
    $stmt2 = $conn->prepare("SELECT * FROM complaints WHERE id_number = ?");
    $stmt2->bind_param("s", $id);
    $stmt2->execute();
    $complaintsResult = $stmt2->get_result();

    $complaints = [];
    while ($complaint = $complaintsResult->fetch_assoc()) {
        $complaints[] = [
            'date' => $complaint['date'],
            'nurse' => $complaint['nurse'],
            'disease' => $complaint['disease'],
            'severity' => $complaint['severity'],
            'medication' => $complaint['medication'],
            'dosage' => $complaint['dosage']
        ];
    }

    echo json_encode([
        'success' => true,
        'profile' => [
            'name' => $row['name'],
            'email' => $row['email'],
            'course' => $row['course'],
            'year' => $row['year'],
            'id_number' => $row['id_number'],
            'gender' => $row['gender'],
            'birthdate' => $row['birthdate'],
            'phone' => $row['phone'],
            'address' => $row['address'],
            'blood_pressure' => $row['blood_pressure'],
            'weight' => $row['weight'],
            'temperature' => $row['temperature']
        ],
        'complaints' => $complaints
    ]);

    $stmt2->close();
} else {
    file_put_contents('debug_log.txt', print_r($complaints, true));
    echo json_encode(['success' => false, 'error' => 'Student not found']);
}

$stmt->close();
$conn->close();
