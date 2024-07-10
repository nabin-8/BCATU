<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCATU | View Blog</title>
    <link rel="stylesheet" href="../../assets/css/blog/blogcss.css">
    <link rel="stylesheet" href="../../assets/css/blog/viewblog.css">
    <link rel="stylesheet" href="../../assets/css/header/header.css">
    <link rel="stylesheet" href="../../assets/css/footer/footer.css">
    <link rel="stylesheet" type="text/css" href="<?= url('/assets/fonts/dynamic_fonts.php') ?>">
</head>

<body>
    <?php require_once '../../include/header/Header.php'; ?>

    <section class="view-blogs-section">
        <div class="view-blog-container">
            <?php

            //check for exist blog 
            $query = "SELECT blogs_tb.*, blog_categories_tb.name AS category_name 
                FROM blogs_tb 
                JOIN blog_categories_tb ON blogs_tb.cat_id = blog_categories_tb.blog_cat_id 
                WHERE blogs_tb.blog_id = ?";
            $statement = $pdo->prepare($query);
            $statement->execute([$_GET['post_id']]);
            $blog = $statement->fetch();
            if ($blog !== false) {
            ?>
                <div class="view-blog-description">
                    <h1 id="view-blogg-title"><?= $blog->title ?></h1>
                    <div id="view-blogg-dates-user-container">
                        <span><?= date("Y F j", strtotime($blog->created_at)) ?></span>
                    </div>
                </div>


                <!-- Description section -->
                <div class="view-blog-description">
                    <!-- Image container -->
                    <div id="view-img-container">
                        <img src="<?= asset($blog->image) ?>" alt="" srcset="">
                    </div>
                    <div class="view-blogg-description">
                        <p><?= $blog->body ?></p>
                    </div>
                </div>
            <?php
            } else { ?>

                <section>Blog not found!</section>
            <?php } ?>
        </div>
    </section>
    <!-- view blogg ends here -->

    <!-- Footer starts  -->
    <section><?php require_once '../../include/footer/Footer.php'; ?></section>
    <!-- Footer ends -->
</body>

</html>