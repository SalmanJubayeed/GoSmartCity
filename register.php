<?php
include 'db_connect.php';  // Connect to database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Secure password hashing

    // Insert into database
    $sql = "INSERT INTO users (first_name, email, password, user_type) VALUES (?, ?, ?, 'user')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $first_name, $email, $password);

    if ($stmt->execute()) {
        echo "Registration successful! <a href='login.html'>Login here</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
