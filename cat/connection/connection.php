<?php
$servername = "localhost"; // Replace with your server name
$username = "kamugundu"; // Replace with your database username
$password = "2220133234"; // Replace with your database password
$dbname = "student_portal"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
