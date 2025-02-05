<?php

if ($_SERVER['REQUEST_METHOD'] == "GET" && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
  header('Location: ../index.php');
}
if (isset($_POST['login']) && !empty($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

  if (!empty($email) or !empty($password)) {
    $email = $getFromU->checkInput($email);
    $password = $getFromU->checkInput($password);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errorMsg = "Invalid format";
    } else {
      if ($getFromU->login($email, $password) === false) {
        $errorMsg = "The email or password is incorrect!";
      }
    }
  } else {
    $errorMsg = "Please enter username and password!";
  }
}

if (isset($_GET['page']) && $_GET['page'] == 're_otp') {
  header("Location: includes/requestOTP.php");
  exit;
}
?>

<div class="top">
  <form method="post" autocomplete="off">

    <h1 class="mb-4 " style="text-align:center;">Log in to Hippo Chat</h1>
    <div class="form-group  form-row">
      <input class="form-control col-4 mr-3 ml-5 mt-1 p-3" name="email" type="text" placeholder="Email" style="height:50px;" />
      <input class="form-control col-4 mr-3 mt-1 p-3" name="password" type="password" placeholder="Password" style="height:50px;" />

      <input class="new-btn col-2 mt-1" name="login" type="submit" value="login" style="height: 50px; font-size:20px;">
      <div style="text-align: center; justify-content: center;margin-left: 7%; margin-top:20px;">
        <a href="?page=re_otp">Forgot Password?</a>
      </div>
    </div>
    <?php
    if (isset($errorMsg)) {
      echo '<div class="alert alert-danger" role="alert"style="width: 400px; margin:20px auto;text-align:center;">
              ' . $errorMsg . '
            </div>';
    }
    ?>

  </form>
</div>