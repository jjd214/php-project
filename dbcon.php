<<?php 
// Correct format: mysqli_connect(hostname, username, password, database_name)
$con = mysqli_connect("localhost", "root", "", "user_registration");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
