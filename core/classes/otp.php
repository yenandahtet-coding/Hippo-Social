<?php
// require_once '../database/connection.php';

class OTP
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getConnection()
    {
        return $this->pdo;
    }

    public function runQuery($sql)
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt;
    }

    public function checkEmail($email)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindparam(":email", $email);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function changePassword($email, $New_password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindparam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $hashed_password = md5($New_password);
            $update_sql = "UPDATE users SET password = :password, otp = NULL WHERE email = :email";
            $update_stmt = $this->pdo->prepare($update_sql);
            $update_stmt->bindparam(':password', $hashed_password);
            $update_stmt->bindparam(':email', $email);
            $update_stmt->execute();
            // echo "<p class='success-message'>Password has been reset successfully!</p>";
            return $update_stmt;
        }
    }

    public function generateOTP($email)
    {
        $otp = rand(100000, 999999);
        $sql = "UPDATE users SET otp = :otp WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':otp', $otp);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $otp;
    }

    public function resendOTP($email, $otp)
    {
        $subject = "Your OTP Code";
        $message = "Your OTP code is: " . $otp;
        $headers = "From: no-reply@yourdomain.com";

        return mail($email, $subject, $message, $headers);
    }
}
