<?php
include 'db.php'; // Ensure your database connection is included

$conn = getDatabaseConnection();


if (isset($_GET['booking_id']) && isset($_GET['action'])) {
    $booking_id = intval($_GET['booking_id']);
    $action = $_GET['action'];

    // Only allow "Approved" or "Rejected" as valid actions
    if ($action === 'approve') {
        $new_status = 'Approved';
    } elseif ($action === 'reject') {
        $new_status = 'Rejected';
    } else {
        die("Invalid action.");
    }

    // Update booking status in the database
    $query = "UPDATE bookings SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $new_status, $booking_id);
    
    if ($stmt->execute()) {
        header("Location: profile.php?message=Booking updated successfully");
        exit();
    } else {
        echo "Error updating booking: " . $conn->error;
    }
}
?>
