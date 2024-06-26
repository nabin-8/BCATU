<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCATU | Blogs</title>
    <link rel="stylesheet" href="../../assets/css/blog/blogcss.css">
    <link rel="stylesheet" href="../../assets/css/blog/viewblog.css">
    <link rel="stylesheet" href="../../assets/css/header/header.css">
    <link rel="stylesheet" href="../../assets/css/footer/footer.css">
    <script src="../../assets/js/jquery.js"></script>
    <script src="./Search_Blogs.js"></script>
</head>

<body>
    <?php require_once '../../include/header/Header.php'; ?>
    <!-- Blogg section start -->
    <section class="blog-section">
        <div class="blog-container">
            <div class="title">
                <h1>BLOGS</h1>
            </div>
            <div class="blog-categories-container">
                <?php
                $query = "SELECT c.blog_cat_id, c.name
                        FROM blog_categories_tb c
                        WHERE EXISTS (
                            SELECT 1
                            FROM blogs_tb b
                            WHERE b.cat_id = c.blog_cat_id
                            AND b.status = 10)
                        ";
                $statement = $pdo->prepare($query);
                $statement->execute();
                $blogs_cat = $statement->fetchAll();

                // echo "<pre>";
                // print_r($blogs_cat);
                if ($blogs_cat) { ?>
                    <div class="blog-categories-main-container">
                        <?php foreach ($blogs_cat as $blog_cat) { ?>
                            <button class="blog-categories-buttons" data-category="<?= $blog_cat->name ?>">
                                <?= $blog_cat->name ?></button>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
            <?php
            $query = "SELECT blogs_tb.*, user_tb.username, user_tb.image AS userimage 
                    FROM blogs_tb 
                    LEFT JOIN user_tb ON blogs_tb.user_id = user_tb.user_id 
                    WHERE blogs_tb.status = 10";
            $statement = $pdo->prepare($query);
            $statement->execute();
            $blogs = $statement->fetchAll();

            if ($blogs) { ?>
                <div class="main-blog-container">
                    <?php foreach ($blogs as $blog) {
                        $vewUrl = blog_url('/viewblogs.php?post_id=') . $blog->blog_id; ?>
                        <article>
                            <h2><a href="<?= $vewUrl ?>"><?= $blog->title ?></a></h2>
                            <p><?= substr($blog->body, 0, 80) ?></p>
                            <div class="blog-bottom-container">
                                <div>
                                    <img src="<?= asset($blog->userimage) ?>" alt="<?= $blog->username ?> image">
                                    <span><?= $blog->username ?></span>
                                </div>
                                <a href="<?= $vewUrl ?>">Read More</a>
                            </div>
                        </article>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <p style="text-align: center; background-color:#475569; color:white;">Blogs not found.</p>
            <?php } ?>
        </div>
    </section>
    <!-- Blogg section end -->

    <!-- Footer starts  -->
    <section><?php require_once '../../include/footer/Footer.php'; ?></section>
    <!-- Footer ends -->
</body>

</html>