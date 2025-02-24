<?php
require_once '../../core/init.php';
    $userQty = $getFromU->countUser()->total;
    $postQty = $getFromT->countPosts();
    $repostQty = $getFromT->countReposts();
    $loginCount = $_SESSION['loginCount'];
    $logoutCount = $_SESSION['logoutCount'];
    $usagePerMonth = $getFromU->getUsagePerMonth();
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
                    echo $userQty; 
                ?></p>
            </div>
            <div class="stat-card">
                <h3>Posts Quantity</h3>
                <p id="post-qty"><?php 
                    echo $postQty; 
                ?></p>
            </div>
            <div class="stat-card">
                <h3>Reposts Quantity</h3>
                <p id="repost-qty"><?php 
                    echo $repostQty; 
                ?></p>
            </div>
            <div class="stat-card">
                <h3>Logged In Users</h3>
                <p id="logged-in-users"><?php 
                    echo $loginCount;
                ?></p>
            </div>
            <div class="stat-card">
                <h3>Logged Out Users</h3>
                <p id="logged-out-users"><?php
                    echo $logoutCount;
                ?></p>
            </div>
            <div class="stat-card">
                <h3>Useage per Month</h3>
                <p id="useage-per-month"><?php 
                    echo $usagePerMonth . " %";
                ?></p>
            </div>
        </div>
    </div>
</div>