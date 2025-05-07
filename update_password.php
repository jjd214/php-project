<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "Please login to change your password.";
    header("Location: login.php");
    exit();
}

// Include database connection
include('dbcon.php');

// Process form data when form is submitted
if (isset($_POST['change_password_btn'])) {
    // Get form data
    $user_id = $_SESSION['user_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Verify new passwords match
    if ($new_password !== $confirm_password) {
        $_SESSION['message'] = "New passwords do not match.";
        header("Location: change_password.php");
        exit();
    }
    
    // Get current user data
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_assoc($result);
    
    // Verify current password
    if (!password_verify($current_password, $user['password'])) {
        $_SESSION['message'] = "Current password is incorrect.";
        header("Location: change_password.php");
        exit();
    }
    
    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    
    // Update password in database
    $update_query = "UPDATE users SET password = '$hashed_password' WHERE id = '$user_id'";
    
    if (mysqli_query($con, $update_query)) {
        $_SESSION['message'] = "Password changed successfully!";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['message'] = "Error changing password: " . mysqli_error($con);
        header("Location: change_password.php");
        exit();
    }
}
?>
