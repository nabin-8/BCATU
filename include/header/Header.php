<?php
require_once 'C:/laragon/www/completeprojectbcatu/config/pdo_connection.php';
require_once 'C:/laragon/www/completeprojectbcatu/config/helpers.php';
// echo $_SERVER['DOCUMENT_ROOT'];
?>

<header>
    <nav>
        <div class="logo">
            <a href="<?= url('/index.php') ?>">
                <span>B</span>CATU
            </a>
        </div>
        <!-- pages -->
        <div class="pages">
            <ul>
                <li><a href="<?= notes_url('/notes/notes.php') ?>">Notes</a></li>
                <li><a href="<?= url('/pages/community/communitypage.php') ?>">Community</a></li>
                <li><a href="<?= blog_url('/blogpage.php') ?>">Blogs</a></li>
                <li><a href="<?= notes_url('/syllabus/syllabus.php') ?>">Syllabus</a></li>
                <li><a href="<?= url('/pages/aboutus/AboutUs.php') ?>">About Us</a></li>
                <li><a href="<?= url('/pages/contactus/ContactUs.php') ?>">Contact Us</a></li>
            </ul>
        </div>
        <?php if (isset($_COOKIE['user_cookie'])) {
            $query = "SELECT * FROM user_tb WHERE user_id = ?";
            $statement = $pdo->prepare($query);
            // $userid = [$_GET['user_id']];
            $user_cookie = $_COOKIE['user_cookie'];
            $statement->execute([$user_cookie]);
            $posts = $statement->fetch(); ?>
            <div class="dropdown">
                <img src="<?= asset($posts->image) ?>" alt="">
                <div class="dropdown-content">
                    <div class="dropdown-info">
                        <span><?= $posts->username ?></span>
                        <span><?= $posts->email ?></span>
                    </div>
                    <hr class="dropdown-hr">
                    <ul class="dropdown-list">
                        <li><a href="<?= url('/pages/dashboard/Userprofile.php') ?>">Profile</a></li>
                        <li><a href="<?= url('/pages/dashboard/Myblogs.php') ?>">Dashboard</a></li>
                        <li><a href="<?= blog_url('/addblog.php') ?>">Add Blog</a></li>
                        <li><a href="<?= url("/pages/auth/logout.php") ?>">Sign Out</a></li>
                    </ul>
                </div>
            </div>
        <?php } else { ?>
            <div class="bottom-dropdown-login">
                <a href="<?= url('/pages/auth/Login.php') ?>">Login</a>
                <hr>
                <a href="<?= url('/pages/auth/Registration.php') ?>">Register</a>
            </div>
        <?php } ?>
    </nav>
</header>