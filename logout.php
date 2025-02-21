<?php
session_start(); // Start the session

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Ensure that session data is cleared immediately
session_write_close();

// Redirect to the homepage (ensure there’s no additional output before this)
header("Location: index.php");
exit; // Ensure the script stops execution after redirection
?>
