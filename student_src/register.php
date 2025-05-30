<?php
// Include the existing DB connection
include('db.php');

// Collect form data
$idnumber = $_POST['idnumber'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$department = $_POST['department'];
$gender = $_POST['gender'];
$birthdate = $_POST['birthdate'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validate password match
if ($password !== $confirm_password) {
    echo "Passwords do not match.";
    exit;
}

// Escape input to prevent SQL injection
$idnumber = mysqli_real_escape_string($conn, $idnumber);
$email = mysqli_real_escape_string($conn, $email);

// Check if email or ID already exists in the database
$email_check_query = "SELECT * FROM user_client WHERE email = ? LIMIT 1";
$id_check_query = "SELECT * FROM user_client WHERE idnumber = ? LIMIT 1";

// Prepare and bind for email
$email_stmt = $conn->prepare($email_check_query);
$email_stmt->bind_param("s", $email);
$email_stmt->execute();
$email_result = $email_stmt->get_result();

// Prepare and bind for idnumber
$id_stmt = $conn->prepare($id_check_query);
$id_stmt->bind_param("s", $idnumber);
$id_stmt->execute();
$id_result = $id_stmt->get_result();

if ($email_result->num_rows > 0) {
    echo "Email already registered.";
    exit;
}

if ($id_result->num_rows > 0) {
    echo "ID Number already registered.";
    exit;
}

// Hash password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert data into database
$stmt = $conn->prepare("INSERT INTO user_client (idnumber, fname, lname, email, department, gender, birthdate, phone, address, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssss", $idnumber, $fname, $lname, $email, $department, $gender, $birthdate, $phone, $address, $hashed_password);

if ($stmt->execute()) {
    echo "Registration successful.";
    header("Location: ../login_student.php"); // Redirect to login
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>
