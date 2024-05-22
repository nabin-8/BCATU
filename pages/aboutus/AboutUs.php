<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | BCATU</title>
    <link rel="stylesheet" href="../../assets/css/footer/footer.css">
    <link rel="stylesheet" href="../../assets/css/header/header.css">
    <link rel="stylesheet" href="../../assets/css/aboutus/aboutus.css">
</head>

<body>
    <?php require_once '../../include/header/Header.php'; ?>
    <!-- Blogg section start -->
    <div class="about-main">
        <div class="about-rows about-top-row">
            <div class="about-cols about-col-1">
                <h1>About Us</h1>
                <p>BCATU is a platform that provides a wide range of services to students and teachers. It is a platform that is designed to help students and teachers to connect with each other and share their knowledge and experiences.</p>
                <a href="<?= url('/pages/community/communitypage.php') ?>">Join Our Community</a>
            </div>
            <div class="about-cols about-col-2">
                <img src="../../assets/images/aboutusimages/about_us.png" alt="About Us">
            </div>
        </div>

        <div class="about-rows about-top-row">
            <div class="about-cols about-col-1">
                <h1>Our Vision</h1>
                <p>Our vision is to create a platform that is designed to help students and teachers to connect with each other and share their knowledge and experiences.</p>
            </div>
            <div class="about-col-2">
                <img src="../../assets/images/aboutusimages/our_vision.png" alt="Our Vision">
            </div>
            <div class="about-cols about-col-2">
            </div>
        </div>

        <div class="about-rows about-top-row">
            <div class="about-cols about-col-1">
                <h1>Our Team</h1>
                <p>Our team is made up of a group of dedicated individuals who are passionate about helping students and teachers to connect with each other and share their knowledge and experiences.</p>
            </div>
            <div class="about-cols about-col-2">
                <img src="../../assets/images/aboutusimages/our_team.png" alt="Our Team">
            </div>
        </div>

        <div class="about-rows about-bottom-row">
            <div class="about-cols about-col-1">
                <img src="../../assets/images/aboutusimages/sairaj_profile1.png" alt="Person 1">
                <div class="person-desc">
                    <h3 class="about-person-name">Sairaj Timilsina</h3>
                    <p> Sairaj Timilsina is passionate about helping students and teachers to connect with each other and share their knowledge and experiences.</p>
                </div>
            </div>
            <div class="about-cols about-col-2">
                <img src="../../assets/images/aboutusimages/mahenra_profile.png" alt="Person 2">
                <div class="person-desc">
                    <h3 class="about-person-name">Mahendra Singh Mahara</h3>
                    <p>Mahendra Singh Mahara is passionate about helping students and teachers to connect with each other and share their knowledge and experiences.</p>
                </div>
            </div>
            <div class="about-cols about-col-3">
                <img src="../../assets/images/aboutusimages/nabin_profile.png" alt="Person 3">
                <div class="person-desc">
                    <h3 class="about-person-name">Nabin Acharya</h3>
                    <p>Nabin Acharya is passionate about helping students and teachers to connect with each other and share their knowledge and experiences.</p>
                </div>
            </div>
            <div class="about-cols about-col-4">
                <img src="../../assets/images/aboutusimages/adyatan_profile.png" alt="Person 4">
                <div class="person-desc">
                    <h3 class="about-person-name">Adyatan Guragain</h3>
                    <p>Adyatan Guragain is passionate about helping students and teachers to connect with each other and share their knowledge and experiences.</p>
                </div>
            </div>
            <div class="about-cols about-col-5">
                <img src="../../assets/images/aboutusimages/hemanta_profile.png" alt="Person 5">
                <div class="person-desc">
                    <h3 class="about-person-name">HC Thakuri</h3>
                    <p>Hemanta Chand Thakuri is passionate about helping students and teachers to connect with each other and share their knowledge and experiences.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer starts  -->
    <section><?php require_once '../../include/footer/Footer.php'; ?></section>
    <!-- Footer ends -->
</body>

</html>