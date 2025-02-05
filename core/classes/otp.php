<?php
// require_once '../database/connection.php';

class OTP extends User
{
    protected $pdo;

    public function __construct($pdo){											
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

    // public function insert($name, $email, $password, $defaultProfile)
    // {
    //     try {
    //         $new_password = password_hash($password, PASSWORD_DEFAULT);
    //         $sql = "INSERT INTO users_tbl (user_name, user_email, user_password, default_profile) VALUES (:name, :email, :password, :defaultProfile)";
    //         $stmt = $this->pdo->prepare($sql);
    //         $stmt->bindparam(":name", $name);
    //         $stmt->bindparam(":email", $email);
    //         $stmt->bindparam(":password", $new_password);
    //         $stmt->bindparam(":defaultProfile", $defaultProfile);
    //         $stmt->execute();
    //         $_SESSION['adminname'] = $name;
    //         return true;
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //         return false;
    //     }
    // }

    // public function update($id, $name, $password, $defaultProfile)
    // {
    //     try {
    //         $new_password = password_hash($password, PASSWORD_DEFAULT);
    //         $stmt = $this->pdo->prepare("UPDATE users_tbl SET user_name = :name, user_password = :password, default_profile = :defaultProfile WHERE user_id = :id");
    //         $stmt->bindparam(":id", $id);
    //         $stmt->bindparam(":name", $name);
    //         $stmt->bindparam(":password", $new_password);
    //         $stmt->bindparam(":defaultProfile", $defaultProfile);
    //         $stmt->execute();
    //         // return $stmt;
    //         return true;
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //         return false;
    //     }
    // }

    // public function delete($id)
    // {
    //     try {
    //         $stmt = $this->conn->prepare("DELETE FROM users_tbl WHERE admin_id = :id");
    //         $stmt->bindparam(":id", $id);
    //         $stmt->execute();
    //         // return $stmt;
    //         return true;
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //         return false;
    //     }
    // }

    // public function redirect($url)
    // {
    //     header("Location: $url");
    // }

    // public function login($email, $password)
    // {
    //     try {
    //         $sql = "SELECT * FROM users WHERE email = :email";
    //         $stmt = $this->pdo->prepare($sql);
    //         $stmt->bindParam(":email", $email);
    //         $stmt->execute();

    //         if ($stmt->rowCount() > 0) {
    //             $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
    //             if (password_verify($password, $userRow['password']) && $userRow['isAdmin'] == 0) {
    //                 $_SESSION['user_session'] = $userRow['user_id'];
    //                 return true;
    //             } else {
    //                 // echo "Invalid password";
    //                 // var_dump(password_verify($password, $userRow['user_password']));
    //                 // echo $password;
    //                 return false;
    //             }
    //         } else {
    //             return false;
    //         }
    //     } catch (PDOException $e) {
    //         echo "Error: " . $e->getMessage();
    //         return false;
    //     }
    // }

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

    // public function Is_admin($email)
    // {
    //     try {
    //         $sql = "SELECT * FROM users WHERE email = :email";
    //         $stmt = $this->pdo->prepare($sql);
    //         $stmt->bindparam(':email', $email);
    //         $stmt->execute();
    //         $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //         if ($result->rowCount() > 0) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //         // if ($result && isset($result['isAdmin'])) {
    //         //     return $result['isAdmin'] == 1;
    //         // } else {
    //         //     return false; // No user found or 'isAdmin' column doesn't exist
    //         // }
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //     }
    // }

    // public function takeAdmin($userID)
    // {
    //     try {
    //         $sql = "SELECT username, email FROM users WHERE user_id = :userID";
    //         $stmt = $this->pdo->prepare($sql);
    //         $stmt->bindParam(":userID", $userID);
    //         $stmt->execute();
    //         $admin_detail = $stmt->fetch(PDO::FETCH_ASSOC);
    //         if($admin_detail){
    //             return $admin_detail;
    //         } else {
    //             return false;
    //         }
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //         return false;
    //     }
    // }
}
