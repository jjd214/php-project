<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database connection
include('dbcon.php');
// Include mailer functions
include('mailer.php');

// Check if email is provided
if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    
    // Check if email exists and is not verified
    $query = "SELECT * FROM users WHERE email = '$email' AND is_verified = 0";
    $result = mysqli_query($con, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Generate new verification token
        $verification_token = bin2hex(random_bytes(32));
        $verification_expires = date("Y-m-d H:i:s", strtotime('+24 hours'));
        
        // Update user with new token
        $update_query = "UPDATE users SET verification_token = '$verification_token', verification_expires = '$verification_expires' WHERE id = " . $user['id'];
        
        if (mysqli_query($con, $update_query)) {
            // Send verification email
            $name = $user['firstname'] . ' ' . $user['surname'];
            $email_result = sendVerificationEmail($email, $name, $verification_token);
            
            if ($email_result['success']) {
                $_SESSION['message'] = "Verification email has been sent. Please check your email.";
            } else {
                $_SESSION['message'] = "Failed to send verification email. Please try again later. Error: " . $email_result['message'];
            }
            
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['message'] = "Error resending verification email: " . mysqli_error($con);
            header("Location: login.php");
            exit();
        }
    } else {
        // Email not found or already verified
        $_SESSION['message'] = "Email not found or already verified.";
        header("Location: login.php");
        exit();
    }
} else {
    // Display resend verification form
    include('header.php');
    include('navbar.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                if(isset($_SESSION['message'])) {
                    echo '<div class="alert alert-info">'.$_SESSION['message'].'</div>';
                    unset($_SESSION['message']);
                }
                ?>
                <div class="card-shadow">
                    <div class="card">
                        <div class="card-header">
                            <h5>Resend Verification Email</h5>
                        </div>
                        <div class="card-body">
                            <p>Enter your email address below to resend the verification email.</p>
                            <form action="resend_verification.php" method="POST">
                                <div class="form-group mb-3">
                                    <label for="email">Email Address:</label>
                                    <input type="email" id="email" name="email" class="form-control" required>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Resend Verification Email</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>

<?php
    include('footer.php');
}
?>
