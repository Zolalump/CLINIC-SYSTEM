<?php

$errors = []; 

if (isset($_GET['reset_code'])) {
    $resetCode = $_GET['reset_code'];
    require_once 'db.php';

    $stmt = $conn->prepare('SELECT * FROM password_resets WHERE reset_code = ?');
    $stmt->bind_param('s', $resetCode);
    $stmt->execute();
    $result = $stmt->get_result();
    $reset = $result->fetch_assoc();
    $errors = isset($errors) ? $errors : []; 
    

    if (!$reset || strtotime($reset['expires_at']) < time()) {
        $errors[] = "Invalid or expired reset code";
    } 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    } else {
        header('Location: /WebDa/CLINIC-SYSTEM-3/index.php');
    }

    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    $stmt = $conn->prepare('UPDATE users SET password = ? WHERE email = ?');
    $stmt->bind_param('ss', $hashedPassword, $reset['email']);
    if ($stmt->execute()) {
        error_log("Password updated for email: " . $reset['email']); 
    } else {
        error_log("Failed to update password for email: " . $reset['email']); 
    }

    $stmt = $conn->prepare('DELETE FROM password_resets WHERE reset_code = ?');
    $stmt->bind_param('s', $resetCode);
    $stmt->execute();

    $success[] = "Password successfully updated!";
    
}
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../font/Suisse/stylesheet.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/WebDa/CLINIC-SYSTEM-3/src/output.css">
    <link rel="stylesheet" href="/WebDa/CLINIC-SYSTEM-3/font/Suisse/stylesheet.css">
    <title>Reset Password</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Reset Your Password</h2>
        <p class="text-gray-600 text-center mb-6">Enter and confirm new password.</p>

        <?php if (count($errors) > 0): ?>   
            <div id="error-message" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" style="text-align: center;">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($success_message)): ?>
            <div class="bg-green-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-6">
                <p><?php echo $success_message; ?></p>
            </div>
        <?php endif; ?>
        
        <form action="reset_password_form2.php?reset_code=<?php echo $_GET['reset_code']; ?>" method="POST" class="space-y-6">
            <div>
                <label for="new_password" class="block text-gray-700 text-sm font-bold mb-2">New Password</label>
                <div class="relative">
                <input
                    type="password"
                    name="new_password"
                    id="new_password"
                    placeholder="Enter new password"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <button
                        type="button"
                        id="togglePassword2"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5"
                    >
                    <div style="font-size: x-large;">
                        <i class='bx bx-show' id="showIcon2"></i>
                        <i class='bx bx-hide' id="hideIcon2" style="display: none;"></i>
                    </div>      
                    </button>
                </div>

            </div>
            <div>
                <label for="confirm_password" class="block text-gray-700 text-sm font-bold mb-2">Confirm New Password</label>
                <div class="relative">
                    <input
                        type="password"
                        name="confirm_password"
                        id="confirm_password"
                        placeholder="Confirm new password"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        
                    />
                    <button
                        type="button"
                        id="togglePassword"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5"
                    >
                    <div style="font-size: x-large;">
                        <i class='bx bx-show' id="showIcon"></i>
                        <i class='bx bx-hide' id="hideIcon" style="display: none;"></i>
                    </div>      
                    </button>
                </div>
            </div>
                <div>
                <button
                    type="submit"
                    aria-label="Reset Password"
                    class="w-full bg-blue-800 text-white py-2 px-4 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    Reset Password
                </button>
            </div>
        </form>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const errorMessage = document.getElementById("error-message");

        if (errorMessage) {
            setTimeout(function() {
                errorMessage.style.display = "none";
            }, 3000); 
        }
    });

    document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('confirm_password');
            const showIcon = document.getElementById('showIcon');
            const hideIcon = document.getElementById('hideIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                showIcon.style.display = 'none';
                hideIcon.style.display = 'inline';
            } else {
                passwordInput.type = 'password';
                showIcon.style.display = 'inline';
                hideIcon.style.display = 'none';
            }
        });

    document.getElementById('togglePassword2').addEventListener('click', function() {
            const passwordInput = document.getElementById('new_password');
            const showIcon = document.getElementById('showIcon2');
            const hideIcon = document.getElementById('hideIcon2');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                showIcon.style.display = 'none';
                hideIcon.style.display = 'inline';
            } else {
                passwordInput.type = 'password';
                showIcon.style.display = 'inline';
                hideIcon.style.display = 'none';
            }
        });
        

    
    </script>
</body>
</html>
