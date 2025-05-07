<?php 
$page_title ="Login Form";
include('partials/__header.php');
include('navbar.php'); 
?>

<!-- Add this style to position the footer correctly -->
<style>
   html, body {
    height: 100%;
}
body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}
.content-wrapper {
    flex: 1 0 auto;
}
footer {
    flex-shrink: 0;
    margin-top: auto;
}
</style>

<div class="content-wrapper py-5">
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
                <div class="card border">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-4">Login Form</h5>
                        <form action="login_process.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="email">Email Address:</label>
                                <input type="email" id="email" name="email" class="form-control bg-light" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control bg-light" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <a href="forgot_password.php" class="text-primary">Forgot Password?</a>
                            </div>
                    
                            <div class="form-group">
                                <button type="submit" name="login_btn" class="btn text-white" style="background-color: #ff9248;">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>

<?php include('footer.php'); ?>