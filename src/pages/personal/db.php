<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "school";

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Failed to connect to DB: " . $mysqli->connect_error);
}
?>
