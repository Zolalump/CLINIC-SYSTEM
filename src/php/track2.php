<?php
session_start();
include 'db.php';

    $timestamp = date('Y-m-d H:i:s');
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $referer = $_SERVER['HTTP_REFERER'] ?? 'Direct';
    $pageURL = $_SERVER['REQUEST_URI'];
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $sessionId = session_id();
    $userId = null;

    $token = $_GET['token'] ?? '';
    $username = $_POST['username'] ?? '';

    $startTime = microtime(true);

    if (!empty($token)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE tracking_url LIKE ?");
        $searchToken = "%$token%";
        $stmt->bind_param("s", $searchToken);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            $userId = $user['id']; 
        }
    }

    $pageLoadTime = microtime(true) - $startTime;

    $cookieValue = $sessionId . '_' . uniqid('user_', true);
    setcookie('user_session', $cookieValue, time() + 3600, '/');  

    $cookieData = $_COOKIE['user_session'] ?? '';  


    if ($userId !== null) {
        $stmt = $conn->prepare("INSERT INTO tracking_data (user_id, visit_time, ip_address, user_agent, referer, page_url, method, session_id, load_time, cookies) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssssss", $userId, $timestamp, $ipAddress, $userAgent, $referer, $pageURL, $requestMethod, $sessionId, $pageLoadTime, $cookieData);

        if (!$stmt->execute()) {
            error_log("Error inserting tracking data: " . $stmt->error);
        }

        if (headers_sent()) {
            error_log("Headers already sent! Cannot redirect.");
        } else {
            header("Location: ./verify2.php?token=$token");
            exit;
        }
        
    } else {
        error_log("Skipping tracking data insertion due to missing user_id.");
    }

    header("Content-Type: image/png");
    $image = imagecreatetruecolor(1, 1);
    $transparent = imagecolorallocatealpha($image, 0, 0, 0, 127);
    imagefill($image, 0, 0, $transparent);
    imagesavealpha($image, true);
    imagepng($image);
    imagedestroy($image);

?>