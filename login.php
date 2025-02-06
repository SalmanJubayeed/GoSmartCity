<?php
session_start();
include 'db_connect.php';  // Connect to MySQL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Start session and store user data
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_type'] = $user['user_type'];

        // Check if admin is approved
        if ($user['user_type'] == 'admin' && $user['is_approved'] == 0) {
            die("Admin account not approved yet.");
        }

        header("Location: dashboard.php");  // Redirect to dashboard
        exit();
    } else {
        echo "Invalid email or password.";
    }
}
?>
