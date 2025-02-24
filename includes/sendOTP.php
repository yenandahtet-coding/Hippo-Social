<?php 
    require_once '../core/init.php';
    require_once 'OTPsetting.php';
?>
    <?php
    // session_start();
    require_once '../core/database/connection.php';
    require_once '../core/classes/otp.php';

    if(isset($_POST['btnResend'])){
        $email = $_SESSION['email'];
    } else {
        $email = $_POST['email'];
    }
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
            $mail->setFrom($sender, 'Hippo Social');
            $mail->addAddress($email, 'User');
            $mail->addReplyTo($sender, 'Admin');

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'OTP Verification';
            $mail->Body = 'Hi, Here is your OTP code: ' . $otp;
            $mail->send();
            ?>

            <!-- <div class="container">
                <h2>Hi, your OTP has been sent to your email!</h2>
                <a href="enterOTP.php" class="link-button" target="_blank">Go & Submit</a>
            </div> -->

    <?php
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Email does not exist!";
    }
    
    ?>