<?php
session_start();
include 'db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '/xampp/htdocs/WebDa/booking/vendor/autoload.php'; 

if (isset($_POST['signUp'])) {
    $firstName = $_POST['fName'] ?? '';
    $lastName = $_POST['lName'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    function validateEmail($email) {
        return preg_match('/^[a-zA-Z0-9._%+-]+@(gmail\.com|email\.com)$/', $email);
    }

    if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPassword)) {
        $_SESSION['message'] = 'All fields are required!';
        $_SESSION['message_type'] = 'error';
        header("Location: /WebDa/booking/admin_reg.php");
        exit;
    }

    if (!validateEmail($email)) {
        $_SESSION['message'] = "Invalid email and gmail domain!";
        $_SESSION['message_type'] = 'error';
        header("Location: /WebDa/booking/admin_reg.php");
        exit;
    }

    if ($password !== $confirmPassword) {
        $_SESSION['message'] = 'Passwords do not match!';        $_SESSION['message_type'] = 'error';
        header("Location: /WebDa/booking/admin_reg.php");
        exit;
    }

    $query = "SELECT id, email, password FROM admin_users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['email'] = $email;
        header("Location: admin-panel.php");
        exit;
    } else {
        echo "Invalid email or password.";
    }
   

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $checkEmail = "SELECT * FROM admin_users WHERE email='$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        $_SESSION['message'] = 'Email Address Already Exists!';
        $_SESSION['message_type'] = 'error';
    } else {
        $uniqueToken = md5(uniqid(rand(), true));
        $trackingUrl = ($_SERVER['SERVER_NAME'] == 'localhost') ?
                        "http://localhost/WebDa/booking/src/php/track_admin.php?token=$uniqueToken" :
                        "http://localhost/WebDa/booking/src/php/verify_admin.php?token=$uniqueToken";

        $insertQuery = "INSERT INTO admin_users (firstName, lastName, email, password, tracking_url) 
                        VALUES ('$firstName', '$lastName', '$email', '$hashedPassword', '$trackingUrl')";

        if ($conn->query($insertQuery) === TRUE) {
            $_SESSION['message'] = 'Sign-Up Successful!';
            $_SESSION['message_type'] = 'success';

        } else {
            $_SESSION['message'] = 'Error: ' . $conn->error;
            $_SESSION['message_type'] = 'error';
        }

        $verificationToken = md5(uniqid(rand(), true));
        $verificationUrl = "http://localhost/WebDa/booking/src/php/verify_admin.php?token=$verificationToken"; 

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'cursorex4@gmail.com';
            $mail->Password = 'pdwrjkdkjlbjbzpn';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = '587';

            $mail->setFrom('johnaustria013@gmail.com', 'Your Website');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Email Verification';
            $mail->Body = 'Click here to verify your email: <a href="' . $trackingUrl . '">Verify Email</a>';
            $mail->AltBody = 'Click the link to verify your email: ' . $trackingUrl ;

            $mail->send();
            error_log("Verification email sent successfully to $email");
            $_SESSION['message'] = 'Sign-Up Successful! Please check your inbox for the verification link.';
            $_SESSION['message_type'] = 'success';
        } catch (Exception $e) {
            error_log("Failed to send verification email: {$mail->ErrorInfo}");
            $_SESSION['message'] = 'Error sending verification email. Please try again.';
            $_SESSION['message_type'] = 'error';
        }
    }

    header("Location:  /WebDa/booking/admin_reg.php");
    exit;
}

if (isset($_POST['signIn'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['pass'] ?? '';

    if (empty($email) || empty($password)) {
        $_SESSION['message'] = 'All fields are required!';
        $_SESSION['message_type'] = 'error';
        header("Location: /WebDa/booking/admin_reg.php");
        exit;
    }

    $query = "SELECT * FROM admin_users WHERE email='$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        error_log("User found: " . $user['email']); 

        error_log("Email verified status: " . $user['email_verified']); 

        if ($user['email_verified'] == 1) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id']; 
                $_SESSION['email'] = $email;
                header("Location: admin-panel.php");
                exit;
            } else {
                $_SESSION['message'] = 'Invalid email or password!';
                $_SESSION['message_type'] = 'error';
                header("Location: /WebDa/booking/admin_reg.php");
                exit;
            }
        } else {
            $_SESSION['message'] = 'Please verify your email before logging in.';
            $_SESSION['message_type'] = 'error';
            header("Location: /WebDa/booking/admin_reg.php");
            exit;
        }
    } else {
        error_log("User not found: " . $email); 
        $_SESSION['message'] = 'Invalid email or password!';
        $_SESSION['message_type'] = 'error';
        header("Location: /WebDa/booking/admin_reg.php");
        exit;
    }
}
?>
