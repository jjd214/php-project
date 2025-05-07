<?php 
$page_title = "Forgot Password";
include('header.php');
include('navbar.php'); 
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
                            <h5>Forgot Password</h5>
                        </div>
                        <div class="card-body">
                            <p>Enter your email address below and we'll send you a link to reset your password.</p>
                            <form action="forgot_password_process.php" method="POST">
                                <div class="form-group mb-3">
                                    <label for="email">Email Address:</label>
                                    <input type="email" id="email" name="email" class="form-control" required>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" name="reset_btn" class="btn btn-primary">Send Reset Link</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>

<?php include('footer.php'); ?>
