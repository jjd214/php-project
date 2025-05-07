<?php 
$page_title = "User Dashboard";
include('header.php');

// Check if user is logged in, if not redirect to login page
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "Please login to access the dashboard";
    header("Location: login.php");
    exit();
}

// Include database connection
include('dbcon.php');

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Fetch complete user data from database
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    
    // Extract user data
    $surname = $user['surname'];
    $firstname = $user['firstname'];
    $middle_initial = $user['middle_initial'] ?? '';
    $birthdate = $user['birthdate'] ?? '';
    $address = $user['address'] ?? '';
    $email = $user['email'];
    $contact = $user['contact'] ?? '';
    
    // Format full name
    $full_name = $firstname;
    if (!empty($middle_initial)) {
        $full_name .= ' ' . $middle_initial . '.';
    }
    $full_name .= ' ' . $surname;
    
    // Format birthdate
    $formatted_birthdate = !empty($birthdate) ? date('F j, Y', strtotime($birthdate)) : 'Not provided';
} else {
    // User not found in database
    session_destroy();
    $_SESSION['message'] = "User account not found. Please login again.";
    header("Location: login.php");
    exit();
}
?>

<!-- Include navbar -->
<?php include('navbar.php'); ?>

<!-- Dashboard Styles -->
<style>
    :root {
        --primary-color: #ff9248;
        --primary-hover: #e67e30;
        --secondary-color: #6c757d;
        --light-bg: #f8f9fa;
        --border-color: #dee2e6;
        --card-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    
    .dashboard-container {
        display: flex;
        min-height: calc(100vh - 56px);
    }
    
    .sidebar {
        width: 250px;
        background-color: var(--light-bg);
        border-right: 1px solid var(--border-color);
        transition: all 0.3s;
        position: fixed;
        height: calc(100vh - 56px);
        overflow-y: auto;
        z-index: 1000;
    }
    
    .sidebar-collapsed {
        margin-left: -250px;
    }
    
    .content-area {
        flex: 1;
        margin-left: 250px;
        padding: 20px;
        transition: all 0.3s;
    }
    
    .content-expanded {
        margin-left: 0;
    }
    
    .sidebar .nav-link {
        color: #333;
        padding: 0.75rem 1rem;
        border-radius: 0.25rem;
        margin: 0.2rem 0.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .sidebar .nav-link.active {
        background-color: var(--primary-color);
        color: white;
    }
    
    .sidebar .nav-link:hover:not(.active) {
        background-color: rgba(255, 146, 72, 0.1);
    }
    
    .sidebar-header {
        padding: 1rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .sidebar-section {
        margin-top: 1rem;
    }
    
    .sidebar-section-title {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
        text-transform: uppercase;
        color: var(--secondary-color);
        font-weight: 600;
    }
    
    .card-stats {
        transition: transform 0.3s, box-shadow 0.3s;
        border: none;
        border-radius: 0.5rem;
        box-shadow: var(--card-shadow);
    }
    
    .card-stats:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .stat-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: rgba(255, 146, 72, 0.1);
        color: var(--primary-color);
    }
    
    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: white;
    }
    
    .large-avatar {
        width: 100px;
        height: 100px;
        font-size: 2.5rem;
    }
    
    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        padding: 0.25rem 0.5rem;
        border-radius: 50%;
        background-color: var(--primary-color);
        color: white;
        font-size: 0.75rem;
    }
    
    .profile-info {
        margin-bottom: 1rem;
    }
    
    .profile-info .label {
        font-size: 0.875rem;
        color: var(--secondary-color);
        margin-bottom: 0.25rem;
    }
    
    .profile-info .value {
        font-weight: 500;
    }
    
    .user-profile-header {
        background-color: white;
        border-radius: 0.5rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: var(--card-shadow);
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    @media (min-width: 768px) {
        .user-profile-header {
            flex-direction: row;
            align-items: center;
        }
    }
    
    .toggle-sidebar {
        display: none;
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1050;
        box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.15);
    }
    
    @media (max-width: 991.98px) {
        .sidebar {
            margin-left: -250px;
        }
        
        .content-area {
            margin-left: 0;
        }
        
        .sidebar-active {
            margin-left: 0;
        }
        
        .toggle-sidebar {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-primary:hover {
        background-color: var(--primary-hover);
        border-color: var(--primary-hover);
    }
    
    .btn-outline-primary {
        color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-outline-primary:hover {
        background-color: var(--primary-color);
        color: white;
    }
    
    .activity-item {
        display: flex;
        align-items: flex-start;
        padding: 1rem 0;
        border-bottom: 1px solid var(--border-color);
    }
    
    .activity-item:last-child {
        border-bottom: none;
    }
    
    .activity-content {
        flex: 1;
        margin-left: 1rem;
    }
    
    .activity-title {
        font-weight: 500;
        margin-bottom: 0.25rem;
    }
    
    .activity-time {
        font-size: 0.875rem;
        color: var(--secondary-color);
    }
    
    .welcome-message {
        background-color: rgba(255, 146, 72, 0.1);
        border-left: 4px solid var(--primary-color);
        padding: 1rem;
        margin-bottom: 1.5rem;
        border-radius: 0.25rem;
    }
</style>

<div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="d-flex align-items-center">
                <i class="bi bi-speedometer2 me-2" style="color: var(--primary-color);"></i>
                <h5 class="mb-0">Dashboard</h5>
            </div>
            <button class="btn btn-sm d-lg-none" id="close-sidebar">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        
        <div class="sidebar-section">
            <div class="sidebar-section-title">Main</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        <i class="bi bi-house-door"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-person"></i>
                        Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-bell"></i>
                        Notifications
                        <span class="badge bg-danger ms-auto">3</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-envelope"></i>
                        Messages
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="sidebar-section">
            <div class="sidebar-section-title">Settings</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-gear"></i>
                        Account Settings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-shield-lock"></i>
                        Privacy
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <i class="bi bi-box-arrow-right"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <!-- Main Content Area -->
    <div class="content-area" id="content">
        <!-- Top Navigation Bar -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">My Dashboard</h2>
            <div class="d-flex align-items-center gap-3">
                <div class="position-relative">
                    <button class="btn btn-outline-secondary position-relative">
                        <i class="bi bi-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                            <span class="visually-hidden">unread notifications</span>
                        </span>
                    </button>
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center gap-2" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar">
                            <?php echo strtoupper(substr($firstname, 0, 1) . substr($surname, 0, 1)); ?>
                        </div>
                        <span class="d-none d-md-inline"><?php echo htmlspecialchars($firstname); ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <?php
        if(isset($_SESSION['message'])) {
            echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                    '.$_SESSION['message'].'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            unset($_SESSION['message']);
        }
        ?>
        
        <!-- Welcome Message -->
        <div class="welcome-message">
            <h4>Welcome back, <?php echo htmlspecialchars($firstname); ?>!</h4>
            <p class="mb-0">Here's what's happening with your account today.</p>
        </div>
        
        <!-- User Profile Section -->
        <div class="user-profile-header">
            <div class="avatar large-avatar">
                <?php echo strtoupper(substr($firstname, 0, 1) . substr($surname, 0, 1)); ?>
            </div>
            <div>
                <h3 class="mb-1"><?php echo htmlspecialchars($full_name); ?></h3>
                <p class="mb-1"><i class="bi bi-envelope me-2"></i><?php echo htmlspecialchars($email); ?></p>
                <p class="mb-0"><i class="bi bi-telephone me-2"></i><?php echo htmlspecialchars($contact); ?></p>
                <div class="mt-3">
                    <button class="btn btn-sm btn-primary">
                        <i class="bi bi-pencil me-2"></i>Edit Profile
                    </button>
                    <button class="btn btn-sm btn-outline-primary ms-2">
                        <i class="bi bi-upload me-2"></i>Upload Photo
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Stats Cards -->
        <h4 class="mb-3">Overview</h4>
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-lg-3">
                <div class="card card-stats h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="stat-icon">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <h6 class="card-title mb-0 text-muted">Account Age</h6>
                        </div>
                        <h3 class="mb-0">1 day</h3>
                        <p class="text-muted small mb-0">
                            Since registration
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card card-stats h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="stat-icon">
                                <i class="bi bi-box-arrow-in-right"></i>
                            </div>
                            <h6 class="card-title mb-0 text-muted">Login Count</h6>
                        </div>
                        <h3 class="mb-0">1</h3>
                        <p class="text-muted small mb-0">
                            Total logins
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card card-stats h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="stat-icon">
                                <i class="bi bi-person-check"></i>
                            </div>
                            <h6 class="card-title mb-0 text-muted">Profile Status</h6>
                        </div>
                        <h3 class="mb-0">Complete</h3>
                        <p class="text-muted small mb-0">
                            All information provided
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card card-stats h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="stat-icon">
                                <i class="bi bi-bell"></i>
                            </div>
                            <h6 class="card-title mb-0 text-muted">Notifications</h6>
                        </div>
                        <h3 class="mb-0">3</h3>
                        <p class="text-muted small mb-0">
                            Unread messages
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- User Information Cards -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-transparent">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Personal Information</h5>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="profile-info">
                                    <div class="label">Full Name</div>
                                    <div class="value"><?php echo htmlspecialchars($full_name); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-info">
                                    <div class="label">Email Address</div>
                                    <div class="value"><?php echo htmlspecialchars($email); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-info">
                                    <div class="label">Birth Date</div>
                                    <div class="value"><?php echo htmlspecialchars($formatted_birthdate); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-info">
                                    <div class="label">Contact Number</div>
                                    <div class="value"><?php echo htmlspecialchars($contact); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-transparent">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Address Information</h5>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="profile-info">
                            <div class="label">Current Address</div>
                            <div class="value"><?php echo htmlspecialchars($address); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Activity -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h5 class="card-title mb-0">Recent Activity</h5>
                    </div>
                    <div class="card-body">
                        <div class="activity-item">
                            <div class="avatar" style="background-color: #ff9248;">
                                <i class="bi bi-person-plus"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Account Created</div>
                                <div class="activity-text">You successfully registered an account</div>
                                <div class="activity-time">Just now</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="avatar" style="background-color: #20c997;">
                                <i class="bi bi-box-arrow-in-right"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">First Login</div>
                                <div class="activity-text">You logged in for the first time</div>
                                <div class="activity-time">Just now</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="avatar" style="background-color: #0d6efd;">
                                <i class="bi bi-eye"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Profile Viewed</div>
                                <div class="activity-text">You viewed your profile for the first time</div>
                                <div class="activity-time">Just now</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h5 class="card-title mb-0">Notifications</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action px-0 border-0">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Welcome to the Dashboard</h6>
                                    <small>Just now</small>
                                </div>
                                <p class="mb-1">Welcome to your new account dashboard. Get started by exploring the features.</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action px-0">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Complete Your Profile</h6>
                                    <small>Just now</small>
                                </div>
                                <p class="mb-1">Make sure your profile information is up to date.</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action px-0">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Security Tip</h6>
                                    <small>Just now</small>
                                </div>
                                <p class="mb-1">Remember to use a strong, unique password for your account.</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Toggle Button -->
<button class="toggle-sidebar" id="toggle-sidebar">
    <i class="bi bi-list"></i>
</button>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Dashboard JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const toggleSidebar = document.getElementById('toggle-sidebar');
        const closeSidebar = document.getElementById('close-sidebar');
        
        // Toggle sidebar on mobile
        toggleSidebar.addEventListener('click', function() {
            sidebar.classList.toggle('sidebar-active');
        });
        
        // Close sidebar on mobile
        closeSidebar.addEventListener('click', function() {
            sidebar.classList.remove('sidebar-active');
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnToggleButton = toggleSidebar.contains(event.target);
            
            if (!isClickInsideSidebar && !isClickOnToggleButton && window.innerWidth < 992) {
                sidebar.classList.remove('sidebar-active');
            }
        });
        
        // Adjust layout on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 992) {
                sidebar.classList.remove('sidebar-active');
            }
        });
    });
</script>

<?php include('footer.php'); ?>
