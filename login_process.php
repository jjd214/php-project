<?php
require_once 'project/config/config.php';

$session = new Session();
$auth = new Auth();

if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $result = $auth->login($email, $password);
    
    if ($result['status']) {
        $session->setFlash("Welcome back, " . $result['user']['firstname'] . "!");
        header("Location: dashboard.php");
        exit();
    } else {
        $session->setFlash($result['message']);
        header("Location: login.php");
        exit();
    }
} else {
    $session->setFlash("Access denied");
    header("Location: login.php");
    exit();
}
?>