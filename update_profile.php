<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "Please login to update your profile.";
    header("Location: login.php");
    exit();
}

// Include database connection
include('dbcon.php');

// Process form data when form is submitted
if (isset($_POST['update_profile_btn'])) {
    // Get form data and sanitize inputs
    $user_id = $_SESSION['user_id'];
    $surname = mysqli_real_escape_string($con, $_POST['surname']);
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $middleinitial = mysqli_real_escape_string($con, $_POST['middleinitial']);
    $birthdate = mysqli_real_escape_string($con, $_POST['birthdate']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    
    // SQL query to update user data
    $query = "UPDATE users SET 
              surname = '$surname', 
              firstname = '$firstname', 
              middle_initial = '$middleinitial', 
              birthdate = '$birthdate', 
              address = '$address', 
              contact = '$contact' 
              WHERE id = '$user_id'";
    
    // Execute query
    if (mysqli_query($con, $query)) {
        // Update successful
        $_SESSION['user_name'] = $firstname . ' ' . $surname;
        $_SESSION['message'] = "Profile updated successfully!";
        header('Location: profile.php');
        exit();
    } else {
        // Update failed
        $_SESSION['message'] = "Error updating profile: " . mysqli_error($con);
        header('Location: profile.php');
        exit();
    }
}
?>
