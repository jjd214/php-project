<?php
// Start session
session_start();

// Database connection
require_once 'connection.php';

// Check if form is submitted
if(isset($_POST['update_password_btn'])) {
    // Get form data
    $token = mysqli_real_escape_string($conn, $_POST['token']);
    $password = $_POST['password'];
    
    // Check if token is valid
    $query = "SELECT * FROM users WHERE reset_token = '$token' AND reset_expires > NOW()";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Hash the new password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Update password and clear reset token
        $update_query = "UPDATE users SET password = '$hashed_password', reset_token = NULL, reset_expires = NULL WHERE id = " . $user['id'];
        
        if(mysqli_query($conn, $update_query)) {
            $_SESSION['message'] = "Your password has been updated successfully. You can now login with your new password.";
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['message'] = "Error updating password: " . mysqli_error($conn);
            header("Location: reset_password.php?token=$token");
            exit();
        }
    } else {
        $_SESSION['message'] = "Invalid or expired token.";
        header("Location: forgot_password.php");
        exit();
    }
}
?>
