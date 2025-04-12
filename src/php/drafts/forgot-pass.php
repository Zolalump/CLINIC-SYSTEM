<?php require_once "/xampp/htdocs/WebDa/booking/src/php/controllUserD.php"; ?>
<?php require_once "/xampp/htdocs/WebDa/booking/db.php"; ?>

<?php
$email = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['check-email'])) {
        $email = trim($_POST['email']);

        if (empty($email)) {
            $errors[] = "Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        if (count($errors) === 0) {
            include __DIR__ . '/send_email.php'; 
            $success[] = "Sent successfully.";
        }
    } elseif (isset($_POST['submit-reset-code'])) {
        if (isset($_POST['reset_code'])) {
            $resetCode = trim($_POST['reset_code']);

            if (empty($resetCode)) {
                $errors[] = "Reset code is required.";
            } else {
                require_once '/xampp/htdocs/WebDa/booking/db.php'; 

                $stmt = $conn->prepare('SELECT * FROM password_resets WHERE reset_code = ?');
                $stmt->bind_param('s', $resetCode);
                $stmt->execute();
                $result = $stmt->get_result();
                $reset = $result->fetch_assoc();

                if ($reset) {
                    header('Location: reset_password_form.php?reset_code=' . $resetCode);
                    exit();
                } else {
                    $errors[] = "Invalid reset code.";
                }
            }
        } else {
            $errors[] = "Reset code is required.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../../font/Suisse/stylesheet.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6">Forgot Password</h2>
        <p class="text-gray-600 text-center mb-6">Enter your email address to reset your password.</p>

        <?php if (count($errors) > 0): ?>
            <div id="error-message" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" style="text-align: center;">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($success_message)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <p><?php echo $success_message; ?></p>
            </div>
        <?php endif; ?>

        <form action="" method="POST" autocomplete="off" class="mb-6">
            <div class="mb-6">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Enter your email address"
                    required
                    value="<?php echo htmlspecialchars($email); ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
            </div>
            <div>
                <button
                    type="submit"
                    aria-label="Submit"
                    name="check-email"
                    class="w-full bg-blue-900 text-white py-2 px-4 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    Send Reset Code
                </button>
            </div>
        </form>

        <h2 class="text-2xl font-bold text-center mb-6">Enter Reset Code</h2>
        <form action="" method="POST" autocomplete="off">
            <div class="mb-6">
                <label for="reset_code" class="block text-gray-700 text-sm font-bold mb-2">Reset Code</label>
                <input
                    type="text"
                    name="reset_code"
                    id="reset_code"
                    placeholder="Enter your reset code"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                />
            </div>
            <div>
                <button
                    id="ResetCode"
                    aria-label="ResetCode"
                    type="submit"
                    name="submit-reset-code"
                    class="w-full bg-blue-900 text-white py-2 px-4 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-green-500"
                >
                    Submit
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
    </script>
</body>
</html>