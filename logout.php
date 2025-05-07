<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Set a message for the user
session_start();
$_SESSION['message'] = "You have been successfully logged out.";

// Redirect to login page
header("Location: login.php");
exit();
?>
