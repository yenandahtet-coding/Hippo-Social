<?php
$user_id = @$_SESSION['user_id'];
$user = $getFromU->userData($user_id);
$notify  = $getFromM->getNotificationCount($user_id);

if (isset($_GET['username']) === true && empty($_GET['username']) === false) {
    $username = $getFromU->checkInput($_GET['username']);
    $profileId = $getFromU->userIdByUsername($username);
    $profileData = $getFromU->userData($profileId);
    // $user_id = @$_SESSION['user_id'];
    // $user = $getFromU->userData($user_id);
    // $notify  = $getFromM->getNotificationCount($user_id);


    if (!$profileData) {
        header('Location: ' . BASE_URL . 'index.php');
        exit;
    }
}

?>
<div class="sidebar " style="margin-top:50px; background:rgba(230, 236, 240, 0.5); width:100%;">
    <ul style="list-style:none; ">
        <li></li>


        <li class="active_menu"><a href='<?php echo BASE_URL; ?>home.php'><i class="fa fa-home" style="color:brown;"></i><span>Home</span></a></li>
        <?php if ($getFromU->loggedIn() === true) {
        ?>
            <li><a href='<?php echo BASE_URL; ?>help.php'><i class="fa fa-bars" style="color:brown;"></i><span>Help</span></a></li>
            <li><a href="<?php echo BASE_URL; ?>i/notifications"><i class="fa fa-bell" aria-hidden="true" style="color:brown;"></i><span>Notifications</span><span id="notificaiton" class="ml-0"><?php if ($notify->totalN > 0) {
                                                                                                                                                                                                        echo '<span class="span-i">' . $notify->totalN . '</span>';
                                                                                                                                                                                                    } ?></span></a></li>
            <li id='messagePopup'><a><i class="fa fa-envelope" aria-hidden='true' style="color:brown;"></i><span>Messages</span><span id='messages'>
                        <?php if ($notify->totalM > 0) {
                            echo '<span class="span-i">' . $notify->totalM . '</span>';
                        } ?>
                    </span></a></li>
            <li><a href="<?php echo BASE_URL; ?><?php echo "profile.php?username=" . $user->username . ""; ?>"><i class="fa fa-user" style="color:brown;"></i><span>Profile</span></a></li>
            <li><a href='<?php echo BASE_URL; ?>settings/account'><i class="fa fa-cog" style="color:brown;"></i><span>Settings</span></a></li>
            <li><a href='<?php echo BASE_URL; ?>includes/logout.php'><i class="fa fa-power-off" style="color:brown;"></i><span>Logout</span></a></li>

        <?php } ?>
        <?php if ($getFromU->loggedIn() === false) {
        ?>
            <a href='<?php echo BASE_URL; ?>' style="text-decoration:none;">
                <li style="padding:10px 40px;"><button class="sidebar_tweet button" style="outline:none;">Login</button></li>
            </a>
        <?php } ?>
    </ul>
    <ul>
        <?php if ($getFromU->loggedIn() === true) {
        ?>
            <div class="media" style="margin-top:150px;">
                <!-- <li class="media-inner">
                        <a href="<?php echo BASE_URL . $user->username; ?>">
                            <img class="mr-1" src="<?php echo BASE_URL; ?><?php echo $user->profileImage; ?>" style="height:40px; width:40px; border-radius:50%;" />
                            <div class="media-body">
                                <h5 class="mt-0 mb-1">
                                    <a href="<?php echo $user->username; ?>"><span><?php echo '<b>' . $user->screenName . '</b>';
                                                                                    ?></span></a>
                                </h5>
                                <span class="text-muted"><?php echo "@" . $user->username;
                                                            ?></span>
                            </div>
                        </a>
                    </li> -->
            </div>
        <?php } ?>
    </ul>
</div>