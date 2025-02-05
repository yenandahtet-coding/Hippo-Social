<?php 
  include '../core/init.php';
  include 'OTPsetting.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Request OTP</title>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .form-container {
      background: #ffffff;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 450px;
      font-size: 16px;
    }

    .form-container h2 {
      margin-bottom: 20px;
      text-align: center;
      font-size: 24px;
      color: #333;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 8px;
      color: #444;
    }

    .form-group input {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
      color: #555;
      transition: border-color 0.3s;
    }

    .form-group input:focus {
      border-color: #007bff;
      outline: none;
    }

    .form-group button {
      width: 100%;
      padding: 12px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.5s ease;
    }

    .form-group button:hover {
      background-color: #0056b3;
    }

    .form-group button:active {
      background-color: #003f7f;
    }

    .form-group .note {
      font-size: 12px;
      text-align: center;
      color: #888;
      margin-top: 10px;
    }

    .form-group .note a {
      color: #007bff;
      text-decoration: none;
    }

    .form-group .note a:hover {
      text-decoration: underline;
    }

    .form-container {
      position: relative;
      /* Ensures it stays fixed within its container */
    }

    .swal2-container {
      position: fixed !important;
      /* Prevents it from shifting content */
    }
  </style>
</head>

<body>
  <div class="form-container">
    <h2>Request OTP Code</h2>
    <form id="otpForm" action="sendOTP.php" method="POST">
      <div class="form-group">
        <label for="email">Enter Your Email:</label>
        <input type="email" id="email" name="email" placeholder="e.g., youremail@example.com" required>
      </div>
      <div class="form-group">
        <button type="submit" name="request_OTP" onclick="Send_OTP">Request OTP</button>
      </div>
      <div class="form-group note">
        <p>By requesting an OTP, you agree to our <a href="#">Terms of Service</a>.</p>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
  <script>
    document.getElementById("otpForm").addEventListener("submit", function(event) {
      event.preventDefault();

      let submitButton = document.querySelector(".form-group button");
      submitButton.disabled = true; // Disable button to prevent multiple clicks
      submitButton.style.opacity = "0.7"; // Reduce opacity for visual feedback

      Swal.fire({
        title: 'Please wait...',
        text: 'Sending OTP code...',
        didOpen: () => {
          Swal.showLoading();
        },
        allowOutsideClick: false,
        showConfirmButton: false
      });

      const formData = new FormData(this);
      fetch('sendOTP.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.text())
        .then(data => {
          Swal.close();
          submitButton.disabled = false; // Re-enable button
          submitButton.style.opacity = "1"; // Restore opacity

          if (data.includes('OTP has been sent')) {
            Swal.fire({
              icon: 'success',
              title: 'OTP Sent!',
              text: 'Check your email for the OTP code.',
            }).then(() => {
              window.location.href = 'enterOTP.php';
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: data,
            });
          }
        })
        .catch(error => {
          Swal.close();
          submitButton.disabled = false;
          submitButton.style.opacity = "1";

          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while sending the OTP. Please try again.',
          });
        });
    });
  </script>
</body>

</html>