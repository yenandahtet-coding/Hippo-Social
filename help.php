<?php
include 'core/init.php';
$user_id = $_SESSION['user_id'];
$user = $getFromU->userData( $user_id );
$notify  = $getFromM->getNotificationCount( $user_id );

if ( $getFromU->loggedIn() === false ) {
    header( 'Location: '.BASE_URL.'index.php' );
}

if ( isset( $_POST['tweet'] ) ) {
    $status = $getFromU->checkinput( $_POST['status'] );
    $tweetImage = '';

    if ( !empty( $status ) or !empty( $_FILES['file']['name'][0] ) ) {
        if ( !empty( $_FILES['file']['name'][0] ) ) {
            $tweetImage = $getFromU->uploadImage( $_FILES['file'] );
        }

        if ( strlen( $status ) > 1000 ) {
            $error = 'The text of your tweet is too long';
        }
        $tweet_id = $getFromU->create( 'tweets', array( 'status' => $status, 'tweetBy' => $user_id, 'tweetImage' => $tweetImage, 'postedOn' => date( 'Y-m-d H:i:s' ) ) );
        preg_match_all( '/#+([a-zA-Z0-9_]+)/i', $status, $hashtag );

        if ( !empty( $hashtag ) ) {
            $getFromT->addTrend( $status );
        }
        $getFromT->addMention( $status, $user_id, $tweet_id );
        header( 'Location: home.php' );
    } else {
        $error = 'Type or choose image to tweet';
    }
}
?>


<!DOCTYPE HTML>
<html>

<head>

    <title>Home  - Help </title>
    <meta charset='UTF-8' />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,shrink-to-fit=no">
    <!-- <link rel="shortcut icon" type="image/x-icon" href="./assets/images/bird.svg"> -->
    <link rel = 'stylesheet' href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css'/>
    
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/style-complete.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/style.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/font-awesome.css' />
    <link rel='stylesheet' href='<?php echo BASE_URL; ?>assets/css/bootstrap.css' />
    <script src='<?php echo BASE_URL; ?>assets/js/jquery-3.1.1.min.js'></script>

    <script src = 'https://code.jquery.com/jquery-3.2.1.min.js'></script>


</head>
<Style>
    i{
        color:brown;
    }
</Style>
<body>

    <div class="grid-container">
        <!--    <div class='wrapper'>-->

        <?php require 'left-sidebar.php' ?>

        <div class="main" style="margin-left: 30px;">
            <div style="margin-top: 50px;">
                
            
                <h1><i class="fa fa-users"></i> What Can I Help With?</h1>
             <h4 style="margin-top: 30px; ">  <i class="fa fa-heart"></i>   Need help personalizing your profile? </h4>
                <h6 style="margin:  0px 10px;">    Let's make it uniquely yours!</h6> 

                <h4 style="margin-top: 10px;"> <i class="fa fa-heart"></i> Looking to find and connect with friends? </h4>
                <h6 style="margin:0px 10px;">   I can guide you through it.</h6> 

                <h4 style="margin-top: 10px;"><i class="fa fa-heart"></i>  Want to adjust your privacy settings?</h4>
                <h6 style="margin:0px 10px;">    I'll show you how to keep your information secure.</h6> 

                <h4 style="margin-top: 10px;"><i class="fa fa-heart"></i> Curious about how to post updates, photos, or videos? </h4>
                <h6 style="margin:0px 10px;">  Let's get you sharing in no time.</h6> 

                <h4 style="margin-top: 10px;"> <i class="fa fa-heart"></i> Interested in joining groups or attending events? </h4>
                <h6 style="margin:0px 10px;">   I'll help you discover what's happening.</h6> 

                <h4 style="margin-top: 10px;"><i class="fa fa-heart"></i> Need assistance with messaging or managing notifications?  </h4>
                <h6 style="margin:0px 10px;">  I've got you covered.</h6> 

                <h4 style="margin-top: 10px;"><i class="fa fa-heart"></i>  Encountering any issues? </h4>
                <h6 style="margin:0px 10px;">    Let me help you troubleshoot and resolve them.</h6> 
           
 

            </div>
    </div>

    <div class="right_sidebar">
        <img src="./assets/images/browncat.jpg" alt="" style="width: 100%; height: 100%; margin-top: 50px;">
    
    </div>


    <!-- <script type='text/javascript' src='<?php echo BASE_URL; ?>assets/js/follow.js'></script> -->

    <script src='<?php echo BASE_URL; ?>assets/js/jquery-3.1.1.min.js'></script>
    <script src='<?php echo BASE_URL; ?>assets/js/popper.min.js'></script>
    <script src='<?php echo BASE_URL; ?>assets/js/bootstrap.min.js'></script>

</body>

</html>