<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // Redirect to login page if admin session does not exist
    redirect('/pages/auth/Login.php');
    exit();
}
?>

<!-- top navbar start -->
<header id="top-bar-container">
    <div class="admin-header-left-container">
        <a href="<?= admin_url('/pages/index.php') ?>">
            <h4>BCATU</h4>
        </a>
    </div>
    <div class="admin-header-right-container">
        <a href="<?= url("/pages/auth/logout.php") ?>"><span>logout</span></a>
    </div>
</header>
<!-- top navbar end -->