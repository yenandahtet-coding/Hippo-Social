<?php
require_once 'core/init.php';

if (isset($_POST['get_started'])) {
  echo "<script>
          Swal.fire({
            icon: 'success',
            title: 'Welcome!',
            text: 'Redirecting you to the next page...',
            showConfirmButton: false,
            timer: 2000
          }).then(() => {
            window.location.href = 'index1.php';
          });
        </script>";
  exit;
}

if (isset($_POST['feedback'])) {
  $reportName = $_POST['contactusername'];
  $reportSurname = $_POST['surname'];
  $reportEmail = $_POST['email'];
  $reportMessage = $_POST['message'];

  if (empty($reportName) || empty($reportSurname) || empty($reportEmail) || empty($reportMessage)) {
    echo "<script>
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Please fill in all fields!'
            });
          </script>";
  } else if (!filter_var($reportEmail, FILTER_VALIDATE_EMAIL)) {
    echo "<script>
            Swal.fire({
              icon: 'error',
              title: 'Invalid Email',
              text: 'Please enter a valid email address!'
            });
          </script>";
  } else {
    $userId = $getFromU->getIdByEmail($reportEmail);
    if ($userId === false) {
      echo "<script>
              Swal.fire({
                icon: 'error',
                title: 'Not Registered',
                text: 'Email address is not registered!'
              });
            </script>";
    } else {
      if ($getFromU->putReports($userId, $reportName, $reportSurname, $reportEmail, $reportMessage)) {
        echo "<script>
                Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: 'Report submitted successfully!'
                });
              </script>";
      } else {
        echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: 'Report submission failed!'
                        });
                      </script>";
      }
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>


  <title>Hippo Chat</title>

  <!-- Bootstrap core CSS -->
  <link href="boot_jquery/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-space-dynamic.css">
  <link rel="stylesheet" href="assets/css/animated.css">
  <link rel="stylesheet" href="assets/css/owl.css">

  <style>
    #btn-Go:hover {
      background-position: right;
      color: black;
      background: linear-gradient(to right, bisque, bisque);
      transition: color 0.5s ease;
    }
  </style>

</head>

<body>
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>

  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="intro.html" class="logo">
              <h4>HIPPO<span>Chat</span></h4>
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
              <li class="scroll-to-section"><a href="#about">Founders</a></li>
              <li class="scroll-to-section"><a href="#services">smth</a></li>
              <li class="scroll-to-section"><a href="#portfolio">About Us</a></li>
              <li class="scroll-to-section"><a href="#blog">Services</a></li>
              <!-- <li class="scroll-to-section"><a href="#contact">Message Us</a></li> -->
              <li class="scroll-to-section">
                <div class="main-red-button"><a href="#contact">Contact Now</a></div>
              </li>
            </ul>
            <a class='menu-trigger'>
              <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>

  <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-6 align-self-center">
              <div class="left-content header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                <h6>Welcome to HIPPO Chat</h6>
                <h2>We Make <em>Talking Chat</em> &amp; <span>HIPPO</span> Website</h2>
                <p>Welcome to HIPPO CHAT, a vibrant social media platform designed to connect individuals, foster community, and facilitate meaningful interactions.
                   Our mission is to empower users to share their stories,  and build lasting relationships in a safe and inclusive environment.
                   Join us as we create a dynamic online community where every voice matters</p>
                <form id="search" action="index1.php" method="GET">
                  <!-- <fieldset>
                    <input type="address" name="address" class="email" placeholder="Your website URL..." autocomplete="on" required>
                  </fieldset> -->
                  <fieldset>
                    <button type="submit" class="main-button" id="btn-Go">Get Started</button>
                  </fieldset>
                </form>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                <img src="assets/images/computer(1).png" alt="team meeting"><!----Home ka photo-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="about" class="about-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="left-image wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
            <img src="assets/images/tired.png" alt="person graphic">
          </div>
        </div>
        <div class="col-lg-8 align-self-center">
          <div class="services">
            <div class="row">
              <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                  <div class="icon">
                    <img src="assets/images/smile.png" alt="reporting">
                  </div>
                  <div class="right-text">
                    <h4>Thant Thiha</h4>
                    <p> Member of HIPPO CHAT</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.7s">
                  <div class="icon">
                    <img src="assets/images/smiley.png" alt="">
                  </div>
                  <div class="right-text">
                    <h4>Saw Yoon Nwe</h4>
                    <p>UI Desinger\Member of HIPPO CHAT.</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="0.9s">
                  <div class="icon">
                    <img src="assets/images/confused.png" alt="">
                  </div>
                  <div class="right-text">
                    <h4>Ye Nanda Htet</h4>
                    <p>UI\Ux desinger.Admin of HIPPO CHAT. </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="item wow fadeIn" data-wow-duration="1s" data-wow-delay="1.1s">
                  <div class="icon">
                    <img src="assets/images/laugh.png" alt="">
                  </div>
                  <div class="right-text">
                    <h4>Khin La Pyae Htun</h4>
                    <p>UI\Ux desinger.Founder of the HIPPO CHAT.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="services" class="our-services section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center  wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
          <div class="left-image">
            <img src="assets/images/coding.png" alt="">
          </div>
        </div>
        <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
          <div class="section-heading">
            <h2>Grow your website with our <em>HIPPO</em> Chat &amp; <span>User's</span>Data</h2>
            <p>Space Dynamic HTML5 template is free to use for your website projects. However, you are not permitted to redistribute the template ZIP file on any CSS template collection websites. Please contact us for more information. Thank you for your kind cooperation.</p>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="first-bar progress-skill-bar">
                <h4>Website Analysis</h4>
                <span>84%</span>
                <div class="filled-bar"></div>
                <div class="full-bar"></div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="second-bar progress-skill-bar">
                <h4>SEO Reports</h4>
                <span>88%</span>
                <div class="filled-bar"></div>
                <div class="full-bar"></div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="third-bar progress-skill-bar">
                <h4>Page Optimizations</h4>
                <span>94%</span>
                <div class="filled-bar"></div>
                <div class="full-bar"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="portfolio" class="our-portfolio section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading  wow bounceIn" data-wow-duration="1s" data-wow-delay="0.2s">
            <h2>See What Our Website<em>Offers</em> &amp; What We <span>Provide</span></h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-sm-6">
          <a href="#">
            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.3s">
              <div class="hidden-content">
                <h4>Making Friends</h4>
                <p>You can make more friends by using HIPPO CHAT.</p>
              </div>
              <div class="showed-content">
                <img src="assets/images/login.png" alt="">
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-sm-6">
          <a href="#">
            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.4s">
              <div class="hidden-content">
                <h4>Sharing Info</h4>
                <p>You can share your daily activities with your friends by using HIPPO CHAT.</p>
              </div>
              <div class="showed-content">
                <img src="assets/images/database.png" alt="">
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-sm-6">
          <a href="#">
            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.5s">
              <div class="hidden-content">
                <h4>Share Feeling</h4>
                <p>You can also share your emotions by liking other people's posts.</p>
              </div>
              <div class="showed-content">
                <img src="assets/images/notification.png" alt="">
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-sm-6">
          <a href="#">
            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.6s">
              <div class="hidden-content">
                <h4>Communication</h4>
                <p>You can communicate with your friend by sending messages to each other."</p>
              </div>
              <div class="showed-content">
                <img src="assets/images/photography.png" alt="">
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div id="blog" class="our-blog section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.25s">
          <div class="section-heading">
            <h2>Check Out What Is <em>Trending</em> In Our Latest <span>News</span></h2>
          </div>
        </div>
        <div class="col-lg-6 wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.25s">
          <div class="top-dec">
            <!-- <img src="assets/images/coding(1).png" alt=""> --> <!--Blog ka photo-->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
          <div class="left-image">
            <a href="#"><img src="assets/images/Screenshot 2025-02-14 221158.png" alt="Workspace Desktop"></a>
            <div class="info">
              <div class="inner-content">

                <!-- <ul>
                  <li><i class="fa fa-calendar"></i> 24 Mar 2021</li>
                  <li><i class="fa fa-users"></i> TemplateMo</li>
                  <li><i class="fa fa-folder"></i> Branding</li>
                </ul> -->
                <!-- <a href="#"><h4>SEO Agency &amp; Digital Marketing</h4></a>
                <p>Lorem ipsum dolor sit amet, consectetur and sed doer ket eismod tempor incididunt ut labore et dolore magna...</p> -->
                <div class="main-blue-button">
                  <!-- <a href="#">Discover More</a> -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.25s">
          <div class="right-list">
            <ul>
              <li>
                <div class="left-content align-self-center">
                  <span><i class="fa fa-heart"></i> Sharing Feeling</span>
                  <a href="#">
                    <h4>Can give feedback to your friends</h4>
                  </a>
                  <p>You can share your daily activities with your friends by using HIPPO CHAT.</p>
                </div>
                <div class="right-image">
                  <a href="#"><img src="assets/images/Screenshot 2025-02-14 221338.png" alt=""></a>
                </div>
              </li>
              <li>
                <div class="left-content align-self-center">
                  <span><i class="fa fa-heart"></i>Communication</span>
                  <a href="#">
                    <h4>The message box design</h4>
                  </a>
                  <p>You can communicate with your friend by sending messages to each other.</p>
                </div>
                <div class="right-image">
                  <a href="#"><img src="assets/images/Screenshot 2025-02-14 221058.png" alt=""></a>
                </div>
              </li>
              <li>
                <div class="left-content align-self-center">
                  <span><i class="fa fa-heart"></i>Making Friends</span>
                  <a href="#">
                    <h4>Making friends by following ..</h4>
                  </a>
                  <p>If you feel lonely you can connent more people...</p>
                </div>
                <div class="right-image">
                  <a href="#"><img src="assets/images/Screenshot 2025-02-14 221027.png" alt=""></a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="contact" class="contact-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.25s">
          <div class="section-heading">
            <h2>Feel Free To Send Us a Message About Our Website</h2>
            <p>We sincerely appreciate your feedback and understand the challenges you may be facing.
               Please be assured that we are committed to resolving your issue promptly and effectively.
                Our team is dedicated to providing you with the highest level of service,
               and we will keep you informed throughout the process. Thank you for your patience and understanding</p>
            <div class="phone-info">
              <h4>For any enquiry, Call Us: <span><i class="fa fa-phone"></i> <a href="#">09-967320321</a></span></h4>
            </div>
          </div>
        </div>
        <div class="col-lg-6 wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.25s">
          <form id="contact" method="post">
            <div class="row">
              <div class="col-lg-6">
                <fieldset>
                  <input type="text" name="contactusername" id="name" placeholder="Name" autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-6">
                <fieldset>
                  <input type="text" name="surname" id="surname" placeholder="Surname" autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" placeholder="Your Email" required="">
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <textarea name="message" type="text" class="form-control" id="message" placeholder="Message" required=""></textarea>
                </fieldset>
              </div>
              <div class="col-lg-12">
                <fieldset>
                  <button type="submit" id="form-submit" class="main-button" name="feedback">Send Message</button>
                </fieldset>
              </div>
            </div>
            <div class="contact-dec">
              <img src="assets/images/contact-decoration.png" alt="">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.25s">
          
        </div>
      </div>
    </div>
  </footer>
  <!-- Scripts -->
  <script src="boot_jquery/jquery/jquery.min.js"></script>
  <script src="boot_jquery/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/animation.js"></script>
  <script src="assets/js/imagesloaded.js"></script>
  <script src="assets/js/templatemo-custom.js"></script>

</body>

</html>