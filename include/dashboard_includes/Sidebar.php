<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';

?>

<div id="main-sidebar-container">
    <div class="sidebar-content">
        <a href="<?= url('/pages/dashboard/userprofile.php') ?>">Profile</a>
        <a href="<?= url('/pages/dashboard/editprofile.php') ?>">Edit Profile</a>
        <a href="<?= url('/pages/dashboard/myblogs.php') ?>">My Blogs</a>
        <a href="<?= url('/pages/dashboard/addblog.php') ?>">Add Blogs</a>
    </div>
</div>