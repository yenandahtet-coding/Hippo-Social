<?php
    // get count of user form db
    // require_once '../../core/init.php';
    // $userQty = $getFromU->countUser();
    // $postQty = $getFromT->countPosts();
    // $repostQty = $getFromT->countReposts();

?>

<div class="card">
    <div class="card-header">Welcome to the Admin Dashboard</div>
    <div class="card-body">
        <p>Here, you can manage users, posts, and see activity reports. Use the sidebar to navigate.</p>

        <!-- Dashboard Stats -->
        <div class="dashboard-stats">
            <div class="stat-card">
                <h3>Users Quantity</h3>
                <p id="user-qty"><?php 
                    // echo $userQty; 
                ?>Loading...</p>
            </div>
            <div class="stat-card">
                <h3>Posts Quantity</h3>
                <p id="post-qty"><?php 
                    // echo $postQty; 
                ?>Loading...</p>
            </div>
            <div class="stat-card">
                <h3>Reposts Quantity</h3>
                <p id="repost-qty"><?php 
                    // echo $repostQty; 
                ?>Loading...</p>
            </div>
            <div class="stat-card">
                <h3>Logged In Users</h3>
                <p id="logged-in-users">Loading...</p>
            </div>
            <div class="stat-card">
                <h3>Logged Out Users</h3>
                <p id="logged-out-users">Loading...</p>
            </div>
        </div>
    </div>
</div>