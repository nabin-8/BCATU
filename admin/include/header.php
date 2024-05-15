<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';
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