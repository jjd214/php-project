<?php 
$page_title = "Reset Password";
include('header.php');
include('navbar.php'); 

// Database connection
require_once 'connection.php';

// Check if token is valid
$token = isset($_GET['token']) ? $_GET['token'] : '';
$valid_token = false;

if(!empty($token)) {
    $query = "SELECT * FROM users WHERE reset_token = '$token' AND reset_expires > NOW()";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0) {
        $valid_token = true;
    }
}
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                session_start();
                if(isset($_SESSION['message'])) {
                    echo '<div class="alert alert-info">'.$_SESSION['message'].'</div>';
                    unset($_SESSION['message']);
                }
                ?>
                <div class="card-shadow">
                    <div class="card">
                        <div class="card-header">
                            <h5>Reset Password</h5>
                        </div>
                        <div class="card-body">
                            <?php if($valid_token): ?>
                                <form action="reset_password_process.php" method="POST" onsubmit="return validatePasswords()">
                                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                                    
                                    <div class="form-group mb-3">
                                        <label for="password">New Password:</label>
                                        <input type="password" id="password" name="password" class="form-control" required>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="confirm_password">Confirm New Password:</label>
                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <button type="submit" name="update_password_btn" class="btn btn-primary">Update Password</button>
                                    </div>
                                </form>
                                
                                <script>
                                function validatePasswords() {
                                    const password = document.getElementById("password").value;
                                    const confirmPassword = document.getElementById("confirm_password").value;
                                
                                    if (password !== confirmPassword) {
                                        alert("Passwords do not match!");
                                        return false;
                                    }
                                
                                    return true;
                                }
                                </script>
                            <?php else: ?>
                                <div class="alert alert-danger">
                                    Invalid or expired password reset link. Please request a new password reset link.
                                </div>
                                <a href="forgot_password.php" class="btn btn-primary">Request New Link</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>

<?php include('footer.php'); ?>
