<?php

function getDatabaseConnection() {
    $servername = "127.0.0.1"; // Use "localhost" or "127.0.0.1"
    $username = "root"; // Default username in Laragon
    $password = ""; // Default password is empty in Laragon
    $dbname = "gosmartcity"; // Replace with your actual database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

?>
