<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '/xampp/htdocs/WebDa/booking/vendor/autoload.php'; 
require_once '/xampp/htdocs/WebDa/booking/db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);  
    $stmt->execute();
    $result = $stmt->get_result();  
    $user = $result->fetch_assoc(); 

    if ($user) {
        $resetCode = random_int(100000, 999999);
        $expiresAt = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        $stmt = $conn->prepare('INSERT INTO password_resets (email, reset_code, expires_at) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $email, $resetCode, $expiresAt);
        $stmt->execute();

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP(); 
            $mail->SMTPDebug = 0; 
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true; 
            $mail->Username = 'cursorex4@gmail.com'; 
            $mail->Password = 'hqnxmkouamyqosxp'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
            $mail->Port = 587; 

            $mail->setFrom('johnaustria013@gmail.com', 'Online Booking'); 
            $mail->addAddress($email); 

            $mail->isHTML(true); 
            $mail->Subject = 'Reset Password'; 
            $mail->Body    = 'Your password reset code is: <b>' . $resetCode . '</b>';
            $mail->AltBody = 'Your password reset code is: ' . $resetCode;

            $mail->send();
            error_log("Email sent successfully to $email");
            $_SESSION['success'] = "Code Sent"; 
        } catch (Exception $e) {
            error_log("Failed to send email: {$mail->ErrorInfo}");
            $_SESSION['error'] = "Failed to send reset code. Please try again.";
        }
    } else {
        $_SESSION['error'] = "Email not found."; 
    }
}
?>