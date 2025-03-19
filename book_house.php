<?php
session_start();
include 'db.php';

$conn = getDatabaseConnection();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    echo "<script>alert('You need to log in to book a house.'); window.location.href='login.php';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rental_id = $_POST['rental_id'];

    // Fetch logged-in user details
    $user_email = $_SESSION['email'];
    $stmt = $conn->prepare("SELECT id, first_name, phone FROM users WHERE email=?");
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        echo "<script>alert('User not found. Please log in again.'); window.location.href='login.php';</script>";
        exit;
    }

    $user_id = $user['id'];
    $user_name = $user['first_name'];
    $user_phone = $user['phone'];

    // Fetch the owner ID
    $query = "SELECT user_id FROM rentals WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $rental_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $rental = $result->fetch_assoc();
    $owner_id = $rental['user_id'];

    // Insert booking request with 'Pending' status
    $stmt = $conn->prepare("INSERT INTO bookings (rental_id, owner_id, user_name, user_phone, user_email, status, created_at) 
                            VALUES (?, ?, ?, ?, ?, 'Pending', NOW())");
    $stmt->bind_param("iisss", $rental_id, $owner_id, $user_name, $user_phone, $user_email);

    if ($stmt->execute()) {
        echo "<script>alert('Booking Request Sent! Awaiting approval.'); window.location.href='housing.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
