<?php
$host = "localhost";
$user = "root";
$password = "12345";
$database = "library";

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Database connected successfully";
}
?>
