<?php
require_once 'project/config/config.php';

$session = new Session();
$user = new User();

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database connection
include('dbcon.php');

if (isset($_POST['register_btn'])) {
    $result = $user->register($_POST);
    
    if ($result['status']) {
        $session->setFlash($result['message'] . " You can now login with your email and password.");
        header("Location: login.php");
        exit();
    } else {
        $session->setFlash($result['message']);
        header("Location: register.php");
        exit();
    }
} else {
    $session->setFlash("Access denied");
    header("Location: register.php");
    exit();
}
?>