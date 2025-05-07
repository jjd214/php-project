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

$page_title = "Change Password";
include('header.php');
include('navbar.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                if (isset($_SESSION['message'])) {
                    echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
                    unset($_SESSION['message']);
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h5>Change Password</h5>
                    </div>
                    <div class="card-body">
                        <form action="update_password.php" method="POST" onsubmit="return validatePasswords()">
                            <div class="form-group mb-3">
                                <label for="current_password">Current Password:</label>
                                <input type="password" id="current_password" name="current_password" class="form-control" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="new_password">New Password:</label>
                                <input type="password" id="new_password" name="new_password" class="form-control" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="confirm_password">Confirm New Password:</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" name="change_password_btn" class="btn btn-primary">Change Password</button>
                            </div>
                        </form>
                        
                        <script>
                        function validatePasswords() {
                            const newPassword = document.getElementById("new_password").value;
                            const confirmPassword = document.getElementById("confirm_password").value;
                            
                            if (newPassword !== confirmPassword) {
                                alert("New passwords do not match!");
                                return false;
                            }
                            
                            return true;
                        }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
