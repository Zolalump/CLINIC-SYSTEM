<?php
require_once '../../php/db.php';
header('Content-Type: application/json');

// Total visits
$totalVisits = $conn->query("SELECT COUNT(*) AS total FROM log_entries")->fetch_assoc()['total'] ?? 0;

// Most common complaint
$commonComplaintQuery = $conn->query("SELECT complaints, COUNT(*) AS count 
                                      FROM log_entries 
                                      WHERE complaints IS NOT NULL AND complaints != ''
                                      GROUP BY complaints 
                                      ORDER BY count DESC 
                                      LIMIT 1");
$commonComplaint = $commonComplaintQuery->fetch_assoc()['complaints'] ?? 'None';

// Visits per department
$deptCounts = $conn->query("SELECT department, COUNT(*) AS count 
                            FROM log_entries 
                            GROUP BY department");

$departments = ['basic-education' => 0, 'tertiary' => 0, 'personnel' => 0];
while ($row = $deptCounts->fetch_assoc()) {
    $key = strtolower(str_replace(' ', '-', $row['department']));
    if (isset($departments[$key])) {
        $departments[$key] = $row['count'];
    }
}

// Average daily visits
$avgDailyQuery = $conn->query("SELECT COUNT(*) / COUNT(DISTINCT DATE(timestamp)) AS avg FROM log_entries");
$avgDaily = $avgDailyQuery->fetch_assoc()['avg'] ?? 0;

// Visits by Day of Week
$visitsByDay = [];
$dayQuery = $conn->query("
    SELECT DAYNAME(timestamp) AS day, COUNT(*) AS count
    FROM log_entries
    GROUP BY day
    ORDER BY FIELD(DAYNAME(timestamp), 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday')
");
while ($row = $dayQuery->fetch_assoc()) {
    $visitsByDay[] = [
        'day' => $row['day'],
        'count' => (int)$row['count']
    ];
}

// Top 5 Common Complaints (for chart)
$commonComplaints = [];
$complaintQuery = $conn->query("
    SELECT complaints, COUNT(*) AS count
    FROM log_entries
    WHERE complaints IS NOT NULL AND complaints != ''
    GROUP BY complaints
    ORDER BY count DESC
    LIMIT 5
");
while ($row = $complaintQuery->fetch_assoc()) {
    $commonComplaints[] = [
        'complaint' => $row['complaints'],
        'count' => (int)$row['count']
    ];
}

// Detailed Stats by Classification
$classificationStats = [];
$totalForClass = $totalVisits ?: 1; // prevent division by 0
$classQuery = $conn->query("
    SELECT classification, COUNT(*) AS visits
    FROM log_entries
    GROUP BY classification
");
while ($row = $classQuery->fetch_assoc()) {
    $classification = $conn->real_escape_string($row['classification']);
    $complaintResult = $conn->query("
        SELECT complaints, COUNT(*) AS count
        FROM log_entries
        WHERE classification = '$classification' AND complaints IS NOT NULL AND complaints != ''
        GROUP BY complaints
        ORDER BY count DESC
        LIMIT 1
    ");
    $commonComplaintClass = $complaintResult->fetch_assoc()['complaints'] ?? 'None';

    $classificationStats[] = [
        'classification' => $classification,
        'visits' => (int)$row['visits'],
        'commonComplaint' => $commonComplaintClass,
        'percent' => round(($row['visits'] / $totalForClass) * 100, 2)
    ];
}

echo json_encode([
    'totalVisits' => $totalVisits,
    'commonComplaint' => $commonComplaint,
    'departments' => $departments,
    'avgDailyVisits' => round($avgDaily, 2),
    'visitsByDay' => $visitsByDay,
    'commonComplaints' => $commonComplaints,
    'classificationStats' => $classificationStats
]);
