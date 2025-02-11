<?php
require_once '../../core/init.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: ../../index1.php");
    exit;
}

if (isset($_POST['logoutBtn'])) {
    $getFromU->logout();
    header('Location:' . BASE_URL . 'index1.php');
}
$admin_id = $_SESSION['user_id'];
$admin = $getFromU->getAdminProfile($admin_id);
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
    <style>
        .account-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            animation: fadeInUp 0.5s ease-out;
        }

        .card-header {
            background-color: #4e73df;
            color: #fff;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #4e73df;
        }

        .btn-save {
            background-color: #4e73df;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-save:hover {
            background-color: #2e59d9;
            transform: translateY(-3px);
        }

        /* Adding a fade-in effect to the account section */
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .account-card {
                padding: 20px;
            }

            .form-control {
                font-size: 14px;
            }

            .btn-save {
                width: 100%;
            }
        }


        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            cursor: pointer;
            font-size: 18px;
            transition: transform 0.2s ease-in-out;
        }

        .toggle-password:hover {
            transform: scale(1.2);
        }

        .form-control {
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.8);
            transform: scale(1.02);
        }

        .btn-save {
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-save:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <script>
        function showSection(section) {
            const sections = document.querySelectorAll('.content');
            sections.forEach(sec => sec.classList.remove('active'));

            const activeSection = document.getElementById(section);
            if (activeSection) {
                activeSection.classList.add('active');
            }
        }
    </script>

    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="#home" onclick="showSection('home')"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="#users" onclick="showSection('users')"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="#managepost" onclick="showSection('managepost')"><i class="fas fa-edit"></i> Manage Posts</a></li>
            <li><a href="#managerepost" onclick="showSection('managerepost')"><i class="fas fa-retweet"></i> Manage Reposts</a></li>
            <li><a href="#reports" onclick="showSection('reports')"><i class="fas fa-chart-line"></i> Reports</a></li>
            <li>
                <a href="#settings" onclick="toggleDropdown()"><i class="fas fa-cogs"></i> Settings</a>
                <div class="dropdown">
                    <a href="#general_setting" onclick="showSection('settings')">Term & Privacy</a>
                    <a href="#account_setting" onclick="showSection('account')">Account Settings</a>
                </div>
            </li>
        </ul>
    </div>

    <div class="navbar">
        <div class="profile">
            <?php 
                $profileImagePath = '../../' . htmlspecialchars($admin->profileImage);
            ?>
            <img src="<?php echo $profileImagePath ?>" alt="Profile Picture">
            <div class="profile-info">
                <span><?php
<<<<<<< HEAD
                        echo htmlspecialchars($admin->username);
                        ?></span>
                <span><?php
=======
                        // echo $admin_name;
                        echo htmlspecialchars($admin->username);
                        ?></span>
                <span><?php
                        // echo $admin_email;
>>>>>>> 81fc449ef99aedb37fa546fe30de780262737670
                        echo htmlspecialchars($admin->email);
                        ?></span>
            </div>
        </div>
        <a href="<?php echo BASE_URL; ?>includes/logout.php" name="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a>

    </div>

    <div class="content" id="home">
        <?php include 'home.php'; ?>
    </div>

    <div class="content" id="users">
        <?php include 'manage_users.php'; ?>
    </div>

    <div class="content" id="managepost">
        <?php include 'manage_posts.php'; ?>
    </div>

    <div class="content" id="managerepost">
        <?php include 'manage_reposts.php'; ?>
    </div>

    <div class="content" id="reports">
        <?php include 'manage_reports.php'; ?>
    </div>

    <div class="content" id="settings">
        <div class="card">
            <div class="card-header">Terms & Privacy</div>
            <div class="card-body">
                <p>Configure platform terms and privacy for users and content.</p>
                <h3>Hippo-Social's Terms of Service and Privacy Policy outline how Twitter collects and uses user information. Users agree to these terms when they use Hippo Social.</h3>
                <dl>
                    <dt>
                        <h4>Terms of Service</h4>
                    </dt>
                    <dd>
                        <p>Users must agree to the Terms of Service to use Hippo Social
                            Users are responsible for the content they post and must comply with applicable laws
                            Hippo Social can suspend or terminate accounts for violating the Terms of Service.</p>
                    </dd>
                    <dt>
                        <h4>Privacy Policy</h4>
                    </dt>
                    <dd>
                        <p>Users consent to the collection and use of their information as described in the Privacy Policy
                            Hippo Social may transfer user information to other countries for storage, processing, and use
                            Hippo Social may keep user information longer than its policies specify for legal and safety reasons.</p>
                    </dd>
                    <dt>
                        <h4>Privacy</h4>
                    </dt>
                    <dd>
                        <ul>
                            <li>Users' names and usernames are public, but they can use a pseudonym</li>
                            <li>Users can control notifications they receive from Hippo Social</li>
                            <li>Hippo Social does not use private Direct Message content to serve ads</li>
                            <li>Users can opt out of interest-based advertising</li>
                            <li>Hippo-Social's private information policy prohibits sharing other people's private information without their permission</li>
                        </ul>
                    </dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="content" id="account">
        <?php
        include 'account_setting.php'; 
        ?>
<<<<<<< HEAD
=======
        <!-- <div class="card account-card">
            <div class="card-header">
                <h3>Account Settings</h3>
            </div>
            <div class="card-body">
                <form id="account-form" action="account_setting.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="profile_picture">Profile Picture</label>
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($admin->username); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($admin->email); ?>" required>
                    </div>

                    <div class="form-group password-container">
                        <label for="password">New Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" class="form-control">
                            <span class="toggle-password" onclick="togglePassword('password')">&#128065;</span>
                        </div>
                    </div>

                    <div class="form-group password-container">
                        <label for="confirm_password">Confirm Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                            <span class="toggle-password" onclick="togglePassword('confirm_password')">&#128065;</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-save" name="save-changes">Save Changes</button>
                </form>
            </div>
        </div> -->
>>>>>>> 81fc449ef99aedb37fa546fe30de780262737670
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



    //     function togglePassword(fieldId) {
    //     var field = document.getElementById(fieldId);
    //     field.type = field.type === "password" ? "text" : "password";
    // }

    // document.getElementById('account-form').addEventListener('submit', function(event) {
    //     event.preventDefault();

    //     var formData = new FormData(this);

    //     fetch('account_setting.php', { 
    //         method: 'POST',
    //         body: formData
    //     })
    //     .then(response => response.json()) // Expect JSON response
    //     // .then(Response => Response.text())
    //     // .then(text => {
    //     //     console.log(text);
    //     //     return JSON.parse(text);
    //     // })
    //     .then(data => {
    //         console.log(data);
    //         if (data.status === "success") {
    //             Swal.fire({
    //                 title: "Profile Updated!",
    //                 text: "Your profile has been successfully updated.",
    //                 icon: "success",
    //                 confirmButtonText: "OK"
    //             }).then(() => {
    //                 window.location.href = "admindashboard.php"; // Redirect after success
    //             });
    //         } else {
    //             Swal.fire({
    //                 title: "Update Failed!",
    //                 text: data.message,
    //                 icon: "error",
    //                 confirmButtonText: "Try Again"
    //             });
    //         }
    //     })
    //     .catch(error => {
    //         console.error("Error:", error);
    //         Swal.fire({
    //             title: "Error!",
    //             text: "Something went wrong. Please try again.",
    //             icon: "error"
    //         });
    //     });
    // });
    </script>
</body>

</html>