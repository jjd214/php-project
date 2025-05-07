<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database connection
include('dbcon.php');
// Include mailer functions
include('mailer.php');

// Check if form is submitted
if(isset($_POST['reset_btn'])) {
    // Get email from form
    $email = mysqli_real_escape_string($con, $_POST['email']);
    
    // Check if email exists in database
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $query);
    
    if(mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Generate unique token
        $token = bin2hex(random_bytes(32));
        $expires = date("Y-m-d H:i:s", strtotime('+1 hour'));
        
        // Store token in database
        $update_query = "UPDATE users SET reset_token = '$token', reset_expires = '$expires' WHERE email = '$email'";
        mysqli_query($con, $update_query);
        
        // Send password reset email
        $name = $user['firstname'] . ' ' . $user['surname'];
        $email_result = sendPasswordResetEmail($email, $name, $token);
        
        if ($email_result['success']) {
            $_SESSION['message'] = "Password reset instructions have been sent to your email.";
        } else {
            $_SESSION['message'] = "We couldn't send the password reset email. Please try again later or contact support. Error: " . $email_result['message'];
        }
        
        header("Location: forgot_password.php");
        exit();
    } else {
        $_SESSION['message'] = "Email not found in our records.";
        header("Location: forgot_password.php");
        exit();
    }
}
?>
