<?php 
    include '../core/init.php';
    include 'OTPsetting.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sentence with Link Button</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .container h2 {
            font-size: 20px;
            color: #333;
            margin-bottom: 20px;
        }

        .link-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .link-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php
    // session_start();
    // require_once '../core/database/connection.php';
    // require_once '../core/classes/otp.php';

    $email = $_POST['email'];
    $_SESSION['email'] = $email;
    $otp = rand(100000, 999999);
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $getFromO->getConnection()->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $sql = "UPDATE users SET otp = :otp WHERE email = :email";
        $stmt = $getFromO->getConnection()->prepare($sql);
        $stmt->bindParam(':otp', $otp);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        try {
            require 'emailAPI.php';
            $mail->setFrom($sender, 'Happy Happy');
            $mail->addAddress($email, 'User');
            $mail->addReplyTo($sender, 'Admin');

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'OTP Verification';
            $mail->Body = 'Hi, Here is your OTP code: ' . $otp;
            $mail->send();
            ?>

            <div class="container">
                <h2>Hi, your OTP has been sent to your email!</h2>
                <a href="enterOTP.php" class="link-button" target="_blank">Go & Submit</a>
            </div>

    <?php
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Email does not exist!";
    }

    ?>
</body>