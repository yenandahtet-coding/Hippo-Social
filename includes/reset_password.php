<?php 
    ob_start();
    include '../core/init.php';
    include 'OTPsetting.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            animation: backgroundAnimation 5s infinite alternate;
        }

        @keyframes backgroundAnimation {
            0% {
                background: linear-gradient(45deg, #6a11cb, #2575fc);
            }

            100% {
                background: linear-gradient(45deg, #2575fc, #6a11cb);
            }
        }

        .form-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            text-align: center;
            transition: all 0.3s ease;
            transform: scale(0.98);
            animation: scaleUp 1s forwards;
        }

        @keyframes scaleUp {
            0% {
                transform: scale(0.9);
            }

            100% {
                transform: scale(1);
            }
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
            font-weight: 600;
            animation: fadeIn 2s;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .form-group {
            margin-bottom: 20px;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            color: #444;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            color: #555;
            outline: none;
            transition: border-color 0.3s ease;
            animation: inputFocusAnimation 0.5s ease-out;
        }

        @keyframes inputFocusAnimation {
            0% {
                border-color: #ccc;
            }

            100% {
                border-color: #2575fc;
            }
        }

        .form-group input:focus {
            border-color: #2575fc;
        }

        .form-group button {
            width: 100%;
            padding: 12px 15px;
            background: linear-gradient(45deg, #ff6b6b, #ff8e53);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .form-group button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background-color: white;
            transition: all 0.4s ease;
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(1);
        }

        .form-group button:hover {
            background: linear-gradient(45deg, #ff8e53, #ff6b6b);
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .form-group button:hover::before {
            transform: translate(-50%, -50%) scale(0);
        }

        .form-group button:focus {
            outline: none;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
            display: none;
            animation: fadeInError 1s ease-out;
        }

        @keyframes fadeInError {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .success-message {
            color: green;
            font-size: 16px;
            margin-top: 15px;
        }

        .link {
            margin-top: 20px;
            font-size: 14px;
            animation: fadeInLink 1.5s ease-out;
        }

        @keyframes fadeInLink {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .link a {
            text-decoration: none;
            color: #2575fc;
            font-weight: 600;
        }

        .link a:hover {
            color: #1c5bbf;
        }

        .reset-btn {
            width: 100%;
            padding: 12px 15px;
            /* background: linear-gradient(45deg, #ff6b6b, #ff8e53); */
            background: linear-gradient(45deg,rgba(40, 108, 255, 0.76), #ff8e53);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            text-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transform: scale(1);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .reset-btn::before {
            /* content: ''; */
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background-color:rgb(196, 69, 254);
            transition: all 0.4s ease;
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(1);
        }

        .reset-btn::after {
            content: '';
            color: black;
            background-color: skyblue;
        }

        .reset-btn:hover {
            /* background: linear-gradient(135deg, #6a11cb, #2575fc); */
            background: linear-gradient(45deg, #ff8e53,rgba(40, 108, 255, 0.76));
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .reset-btn:hover::before {
            transform: translate(-50%, -50%) scale(0);
            background-color: skyblue;
        }

        .reset-btn:focus {
            outline: none;
        }

        .reset-btn:active {
            transform: scale(0.98);
        }

        .reset-btn span {
            position: relative;
            z-index: 1;
        }
    </style>
</head>

<body>
    <?php

    if (isset($_POST['btnReset'])) {
        $email = $_SESSION['email'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if ($new_password !== $confirm_password) {
            echo "<p class='error-message'>Passwords do not match!</p>";
        } else {
            if($getFromO->changePassword($email, $new_password)){
                echo "<p class='success-message'>Password has been reset successfully!</p>";
                // $getFromO->redirect('../index.php');
                header("Location: ../index1.php");
                exit;
            }
        }
    } ?>
    <div class="form-container">
        <h2>Reset Password</h2>
        <form id="reset-password-form" action="reset_password.php" method="POST">
            <div class="form-group">
                <label for="new-password">New Password:</label>
                <input type="password" id="new-password" name="new_password" placeholder="Enter new password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm new password" required>
            </div>
            <!-- <input type="hidden" name="otp" value="<?php echo htmlspecialchars($otp); ?>"> -->
            <button type="submit" name="btnReset" class="reset-btn">Reset Password</button>
        </form>
        <div class="link">
            <a href="../index1.php">Back to Login</a>
        </div>
    </div>

    <script>
        const form = document.getElementById('reset-password-form');
        const newPassword = document.getElementById('new-password');
        const confirmPassword = document.getElementById('confirm-password');
        const errorMessage = document.querySelector('.error-message');

        form.addEventListener('submit', function(event) {
            if (newPassword.value !== confirmPassword.value) {
                event.preventDefault(); // Prevent form submission
                errorMessage.style.display = 'block';
            } else {
                errorMessage.style.display = 'none';
            }
        });
    </script>
</body>

</html>
<?php 
    ob_end_flush();
?>