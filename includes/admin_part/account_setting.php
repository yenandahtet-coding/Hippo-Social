<?php
require_once '../../core/init.php';

$admin = $getFromU->getAdminProfile($_SESSION['user_id']);
$message = '';
$alertType = '';

if (isset($_POST['save-changes'])) {
    $adminID = $_SESSION['user_id'];
    $adminName = $_POST['name'];
    $adminEmail = $_POST['email'];
    $adminPassword = $_POST['password'];
    $adminPasswordConfirm = $_POST['confirm_password'];
    $profileImage = $_FILES['profile_picture'];

    if (empty($adminName) || empty($adminEmail) || empty($adminPassword) || empty($adminPasswordConfirm)) {
        $message = "Fill all required fields!";
        $alertType = "error";
    } else if ($adminPassword !== $adminPasswordConfirm) {
        $message = "Password and confirm password do not match!";
        $alertType = "error";
    } else {
        if ($profileImage['error'] === 0) {

            $uploadDir = '../../users/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
            }
            $profileImagePath = $uploadDir . basename($profileImage['name']);
            if (move_uploaded_file($profileImage['tmp_name'], $profileImagePath)) {
                $profileImagePath = 'users/' . basename($profileImage['name']); // Update the path to be relative to the project root
            } else {
                $message = "Failed to upload profile image!";
                $alertType = "error";
            }
        } else {
            $profileImagePath = $admin->profileImage; // Keep the existing image if no new image is uploaded
        }

        if ($alertType !== "error" && $getFromU->updateAdmin($adminID, $adminName, $adminEmail, $adminPassword, $profileImagePath)) {
            $message = "Your profile has been successfully updated.";
            $alertType = "success";
        } else {
            $message = "Profile update failed!";
            $alertType = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
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

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-info {
            color: #31708f;
            background-color: #d9edf7;
            border-color: #bce8f1;
        }
    </style>
</head>

<body>
    <div class="card account-card">
        <div class="card-header">
            <h3>Account Settings</h3>
        </div>
        <div class="card-body">
            <?php if ($message): ?>
                <script>
                    Swal.fire({
                        title: "<?php echo $alertType === 'success' ? 'Profile Updated!' : 'Update Failed!'; ?>",
                        text: "<?php echo htmlspecialchars($message); ?>",
                        icon: "<?php echo $alertType; ?>",
                        confirmButtonText: "OK"
                    }).then(() => {
                        <?php if ($alertType === 'success'): ?>
                            window.location.href = "admindashboard.php";
                        <?php endif; ?>
                    });
                </script>
            <?php endif; ?>
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
                    </div>
                </div>

                <div class="form-group password-container">
                    <label for="confirm_password">Confirm Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                    </div>
                </div>

                <button type="submit" class="btn btn-save" name="save-changes">Save Changes</button>
            </form>
        </div>
    </div>
</body>

</html>