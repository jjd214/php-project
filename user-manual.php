<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Manual - HealthCare</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">User Manual</h1>
                <p class="text-muted">Last Updated: <?php echo date("F d, Y"); ?></p>
                <a href="index.php" class="btn btn-sm mb-4" style="background-color: #12ac8e; color: white;">
                    <i class="ri-arrow-left-line"></i> Back to Home
                </a>
                
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="h4 mb-3">Introduction</h2>
                        <p>Welcome to the HealthCare User Manual. This guide will help you navigate our services and website effectively to access the healthcare you need.</p>
                        
                        <h2 class="h4 mb-3 mt-4">Creating an Account</h2>
                        <ol>
                            <li>Visit our website and click on the "Register" button in the top navigation bar.</li>
                            <li>Fill in the required information, including your name, email address, and password.</li>
                            <li>Verify your email address by clicking the link sent to your email.</li>
                            <li>Complete your profile by adding your personal and medical information.</li>
                        </ol>
                        
                        <h2 class="h4 mb-3 mt-4">Logging In</h2>
                        <ol>
                            <li>Click on the "Login" button in the top navigation bar.</li>
                            <li>Enter your email address and password.</li>
                            <li>Click "Login" to access your account.</li>
                            <li>If you forget your password, click on "Forgot Password?" and follow the instructions.</li>
                        </ol>
                        
                        <h2 class="h4 mb-3 mt-4">Contacting Healthcare Providers</h2>
                        <ol>
                            <li>Log in to your account.</li>
                            <li>Navigate to the "Messages" section.</li>
                            <li>Click on "New Message."</li>
                            <li>Select the recipient (your healthcare provider).</li>
                            <li>Write your message and click "Send."</li>
                        </ol>
                        
                        <h2 class="h4 mb-3 mt-4">Getting Help</h2>
                        <p>If you need assistance with our website or services:</p>
                        <ul>
                            <li>Visit the "FAQ" section for answers to common questions.</li>
                            <li>Contact our support team at salitranII@gmail.com.</li>
                            <li>Call our helpline at 911.</li>
                            <li>Visit our facility in Barangay Salitran II during business hours.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('footer.php'); ?>