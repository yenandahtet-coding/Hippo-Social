<?php
// session_start();
require_once '../../core/init.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../../index1.php");
    exit;
}
// $admin_name = $_SESSION['admin_name'];
// $admin_email = $_SESSION['admin_email'];
// $getFromU->logout();
// if (isset($_SESSION['logoutBtn'])) {
//     if ($getFromU->loggedIn() === false) {
//         header('Location:' . BASE_URL . 'index1.php');
//         exit;
//     }
// }

// if logoutBtn is selected go to index1.php 
if (isset($_POST['logoutBtn'])) {
    $getFromU->logout();
    header('Location:' . BASE_URL . 'index1.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/adminhome.css">
</head>

<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="#" onclick="showSection('home')"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="#" onclick="showSection('users')"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="#" onclick="showSection('managepost')"><i class="fas fa-edit"></i> Manage Posts</a></li>
            <li><a href="#" onclick="showSection('managerepost')"><i class="fas fa-retweet"></i> Manage Reposts</a></li>
            <li><a href="#" onclick="showSection('reports')"><i class="fas fa-chart-line"></i> Reports</a></li>
            <li>
                <a href="#" onclick="toggleDropdown()"><i class="fas fa-cogs"></i> Settings</a>
                <div class="dropdown">
                    <a href="#" onclick="showSection('settings')">General Settings</a>
                    <a href="#" onclick="showSection('account')">Account Settings</a>
                </div>
            </li>
        </ul>
    </div>

    <div class="navbar">
        <div class="profile">
            <img src="../../assets/images/defaultpic.jpg" alt="Profile Picture">
            <div class="profile-info">
                <span><?php
                        // echo $admin_name;
                        // htmlspecialchars($admin_name);
                        ?>thant</span>
                <span><?php
                        // echo $admin_email;
                        // htmlspecialchars($admin_email);
                        ?>thant@gmail.com</span>
            </div>
        </div>
        <a href="<?php echo BASE_URL; ?>includes/logout.php" name="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a>

    </div>

    <div class="content" id="home">
        <!-- <div class="card"> -->
        <!-- <div class="card-header">Welcome to the Admin Dashboard</div>
            <div class="card-body">
                <p>Here, you can manage users, posts, and see activity reports. Use the sidebar to navigate.</p>
            </div>
        </div> -->
        <?php include 'home.php'; ?>
    </div>

    <div class="content" id="users">
        <!-- <div class="card">
            <div class="card-header">User Management</div>
            <div class="card-body">
                <p>Manage users, view details, and perform actions such as deactivating or deleting users.</p>
            </div>
        </div> -->
        <?php include 'manage_users.php'; ?>
    </div>

    <div class="content" id="managepost">
        <!-- <div class="card">
            <div class="card-header">Manage Posts</div>
            <div class="card-body">
                <p>Manage user posts, approve or delete content as needed.</p>
            </div>
        </div> -->
        <?php include 'manage_posts.php'; ?>
    </div>

    <div class="content" id="managerepost">
        <!-- <div class="card">
            <div class="card-header">Manage Reposts</div>
            <div class="card-body">
                <p>Handle reposts and platform activities effectively.</p>
            </div>
        </div> -->
        <?php include 'manage_reposts.php'; ?>
    </div>

    <div class="content" id="reports">
        <!-- <div class="card">
            <div class="card-header">Reports</div>
            <div class="card-body">
                <p>View detailed reports on platform activity and performance.</p>
            </div>
        </div> -->
        <?php include 'manage_reports.php'; ?>
    </div>

    <div class="content" id="settings">
        <div class="card">
            <div class="card-header">Settings</div>
            <div class="card-body">
                <p>Configure platform settings and preferences for users and content.</p>
            </div>
        </div>
    </div>

    <div class="content" id="account">
        <div class="card">
            <div class="card-header">Account Settings</div>
            <div class="card-body">
                <p>Update your account details and preferences here.</p>
            </div>
        </div>
    </div>

    <div class="content" id="logout">
        <div class="card">
            <div class="card-header">Logout</div>
            <div class="card-body">
                <p>You have been logged out successfully. <a href="#">Log in again</a>.</p>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>© 2025 Admin Panel. All rights reserved.</p>
    </div>

    <script>
        function showSection(section) {
            const sections = document.querySelectorAll('.content');
            sections.forEach(sec => sec.classList.remove('active'));

            const activeSection = document.getElementById(section);
            if (activeSection) {
                activeSection.classList.add('active');
            }
        }
        showSection('home');

        function toggleDropdown() {
            const dropdown = document.querySelector('.dropdown');
            dropdown.classList.toggle('active');
        }

        function searchUser() {
            let input = document.querySelector('.search-bar').value.toLowerCase();
            let rows = document.querySelectorAll('#users-table tbody tr');
            rows.forEach(row => {
                let name = row.cells[0].textContent.toLowerCase();
                let email = row.cells[1].textContent.toLowerCase();
                if (name.includes(input) || email.includes(input)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>