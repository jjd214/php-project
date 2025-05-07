<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "Please login to access your profile.";
    header("Location: login.php");
    exit();
}

// Include database connection
include('dbcon.php');

// Get user data
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);

$page_title = "My Profile";
include('header.php');
include('navbar.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                if (isset($_SESSION['message'])) {
                    echo '<div class="alert alert-info">' . $_SESSION['message'] . '</div>';
                    unset($_SESSION['message']);
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h5>My Profile</h5>
                    </div>
                    <div class="card-body">
                        <form action="update_profile.php" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="surname">Surname:</label>
                                        <input type="text" id="surname" name="surname" class="form-control" value="<?php echo $user['surname']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="firstname">First Name:</label>
                                        <input type="text" id="firstname" name="firstname" class="form-control" value="<?php echo $user['firstname']; ?>" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="middleinitial">Middle Initial:</label>
                                <input type="text" id="middleinitial" name="middleinitial" maxlength="1" class="form-control" value="<?php echo $user['middle_initial']; ?>">
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="birthdate">Birth Date:</label>
                                <input type="date" id="birthdate" name="birthdate" class="form-control" value="<?php echo $user['birthdate']; ?>" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="address">Address:</label>
                                <input type="text" id="address" name="address" class="form-control" value="<?php echo $user['address']; ?>" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="email">Email Address:</label>
                                <input type="email" id="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" readonly>
                                <small class="text-muted">Email address cannot be changed.</small>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="contact">Contact Number:</label>
                                <input type="tel" id="contact" name="contact" class="form-control" value="<?php echo $user['contact']; ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" name="update_profile_btn" class="btn btn-primary">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
