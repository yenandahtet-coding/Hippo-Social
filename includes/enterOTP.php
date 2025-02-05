<?php
include '../core/init.php';
include 'OTPsetting.php';

if (isset($_POST['btnSend'])) {
  $otp = $_POST['otp'];
  $email = $_SESSION['email'];

  $sql = "SELECT otp FROM users WHERE email = :email";
  $stmt = $getFromO->getConnection()->prepare($sql);
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result && $result['otp'] == $otp) {
    $sql = "UPDATE users SET otp = NULL WHERE email = :email";
    $stmt = $getFromO->getConnection()->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    header("Location: reset_password.php");
    // $getFromO->redirect("Location: reset_password.php");
    exit();
  } else {
    echo "<p class='error-message'>Invalid OTP</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OTP Input Box</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    /* Container Styling */
    .otp-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
      background: #ffffff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
      max-width: 400px;
      margin: auto;
      text-align: center;
      animation: fadeIn 1s ease-in-out;
    }

    /* Label Styling */
    .otp-container label {
      font-size: 16px;
      color: #555;
      font-weight: bold;
      margin-bottom: 8px;
    }

    /* Input Box Styling */
    .otp-container input {
      width: 100%;
      max-width: 300px;
      height: 50px;
      font-size: 18px;
      border: 2px solid #ddd;
      border-radius: 8px;
      padding: 15px 20px;
      box-sizing: border-box;
      text-align: center;
      background-color: #f9f9f9;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .otp-container input::placeholder {
      color: #aaa;
      font-size: 16px;
    }

    .otp-container input:focus {
      outline: none;
      border-color: #007bff;
      box-shadow: 0 0 10px rgba(0, 123, 255, 0.3);
      animation: pulse 1s infinite;
    }

    /* Button Styling */
    .otp-container button {
      width: 100%;
      max-width: 300px;
      height: 50px;
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: white;
      font-size: 18px;
      font-weight: bold;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
      margin-top: 10px;
      /* Added spacing between input and button */
    }

    .otp-container button:hover {
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .otp-container button:active {
      transform: scale(0.98);
    }

    /* Animations */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes pulse {
      0% {
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.4);
      }

      50% {
        box-shadow: 0 0 15px rgba(0, 123, 255, 0.6);
      }

      100% {
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.4);
      }
    }
  </style>
</head>

<body>
  <div class="otp-container">
    <label for="otp">Please enter the OTP to reset your password</label>
    <form autocomplete="off" method="POST">
      <input type="text" name="otp" maxlength="6" placeholder="Enter your OTP" required>
      <button type="submit" name="btnSend">Submit</button>
    </form>
  </div>
</body>

</html>