<?php 
$page_title ="Registration Form";
include('partials/__header.php');
include('includes/navbar.php');
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
                                <h5>Registration Form</h5>
                            </div>
                            <div class="card-body">
                                <form action="connection.php" method="POST" onsubmit="return validateForm()">
                                    <div class="form-group mb-3">
                                        <label for="surname">Surname:</label>
                                        <input type="text" id="surname" name="surname" class="form-control" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="firstname">First Name:</label>
                                        <input type="text" id="firstname" name="firstname" class="form-control" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="middlename">Middle Name:</label>
                                        <input type="text" id="middlename" name="middlename" class="form-control">
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="gender">Gender:</label>
                                        <select id="gender" name="gender" class="form-control" required>
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="birthdate">Birth Date:</label>
                                        <input type="date" id="birthdate" name="birthdate" class="form-control" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="address">Address:</label>
                                        <input type="text" id="address" name="address" class="form-control" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="email">Email Address:</label>
                                        <input type="email" id="email" name="email" class="form-control" required>
                                        <small class="form-text text-muted">Only Gmail accounts are allowed.</small>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="contact">Contact Number:</label>
                                        <input type="tel" id="contact" name="contact" class="form-control" required maxlength="11">
                                        <small class="form-text text-muted">Contact number must be exactly 11 digits.</small>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="password">Password:</label>
                                        <input type="password" id="password" name="password" class="form-control" required minlength="8">
                                        <small class="form-text text-muted">Password must be at least 8 characters long.</small>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="confirm_password">Confirm Password:</label>
                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="register_btn" class="btn btn-primary">Register Now</button>
                                    </div>
                                </form>
                                    
                                <script>
                                function validateForm() {
                                    const password = document.getElementById("password").value;
                                    const confirmPassword = document.getElementById("confirm_password").value;
                                    const email = document.getElementById("email").value;
                                    const contact = document.getElementById("contact").value;
                                
                                    // Check password length
                                    if (password.length < 8) {
                                        alert("Password must be at least 8 characters long!");
                                        return false;
                                    }
                                
                                    // Check if passwords match
                                    if (password !== confirmPassword) {
                                        alert("Passwords do not match!");
                                        return false;
                                    }
                                    
                                    // Validate email (only Gmail)
                                    if (!email.endsWith("@gmail.com")) {
                                        alert("Only Gmail accounts are allowed!");
                                        return false;
                                    }
                                    
                                    // Validate contact number (exactly 11 digits)
                                    if (!/^\d{11}$/.test(contact)) {
                                        alert("Contact number must be exactly 11 digits!");
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
    </div>
   
<?php include('footer.php'); ?>