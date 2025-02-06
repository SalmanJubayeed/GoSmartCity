<?php
$servername = "localhost";  // Your MySQL server
$username = "root";  // Your MySQL username (default: root)
$password = "";  // Your MySQL password (leave empty for XAMPP)
$dbname = "gosmartcity";  // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
