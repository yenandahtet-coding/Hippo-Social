<?php
include 'core/init.php';
if ($getFromU->loggedIn() === true) {
    header('Location: home.php');
}

?>
<html>

<head>
    <title>Hippo Chat</title>
    <meta charset="UTF-8" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" />
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    <!-- <link rel="shortcut icon" type="image/x-icon" href="./assets/images/bird.svg"> -->

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style-complete.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" />
    <script src="<?php echo BASE_URL; ?>assets/js/popper.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery-3.1.1.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

    <!-- <style>
        .preloader {
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }
    </style> -->
</head>

<body>
    <!-- <script>
        // Show SweetAlert loading when the page starts loading
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "Loading...",
                text: "Please wait while the page loads.",
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        });

        // Ensure SweetAlert and the preloader disappear when the page is fully loaded
        window.onload = function() {
            setTimeout(function() {
                document.getElementById('preloader').style.display = 'none';
                Swal.close(); // Close SweetAlert after 3 seconds
            }, 3000);
        };
    </script> -->
    <div class="preloader" id="preloader">
        <div id="loader">
        </div>
    </div>

    <div class="container-fluid">
        <div class="main-box">

            <div class="main-box-wrapper">
                <div class="row">
                    <div class="left col-md-6 col-12">
                        <div class="items-wrapper">
                            <div class="item">
                                <span class="fa fa-search"></span>
                                <h3>Hi welcome from our app</h3>
                            </div>
                            <div class="item">
                                <span class="fa fa-user"></span>
                                <h3>You can make friends</h3>
                            </div>
                            <div class="item">
                                <span class="fa fa-comment-o"></span>
                                <h3>Join the conversation.</h3>
                            </div>
                        </div>
                    </div>
                    <div class="right col-md-6 col-12">
                    <div class="top">
                        <?php include 'includes/login.php'; ?>
                    </div>
                        <div class="middle">
                            <i class="" style="font-size:50px;"></i>
                            <h1>See what's happening in<br />the world right now</h1>
                            <span>Join Our website today.</span>
                        </div>

                        <?php include 'includes/signup-form.php'; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            var preloader = document.getElementsByClassName('preloader')[0];
            setTimeout(function() {
                preloader.style.display = 'none';
            }, 3000);
        };
    </script>

</body>

</html>