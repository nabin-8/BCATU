<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCA ADMIN | View Blogs</title>
    <link rel="stylesheet" href="../../assest/admincss/style.css">
    <link rel="stylesheet" href="../../assest/admincss/viewblog.css">
</head>

<body>
    <?php include '../../include/header.php'; ?>

    <section class="view-blogs-section">
        <div class="view-blog-container">
            <?php
            // Check for the existence of a post
            $query = "SELECT blogs_tb.*, blog_categories_tb.name AS category_name 
                FROM blogs_tb 
                JOIN blog_categories_tb ON blogs_tb.cat_id = blog_categories_tb.blog_cat_id 
                WHERE blogs_tb.blog_id = ?";
            $statement = $pdo->prepare($query);
            $statement->execute([$_GET['post_id']]);
            $blog = $statement->fetch();

            if ($blog !== false) {
            ?>
                <!-- Image container -->
                <div id="view-img-container">
                    <img src="<?= asset($blog->image) ?>" alt="" srcset="">
                </div>

                <!-- Description section -->
                <div class="view-blog-description">
                    <h1 id="view-blogg-title"><?= $blog->title ?></h1>
                    <div class="view-blogg-description">
                        <p><?= $blog->body ?></p>
                    </div>
                </div>
            <?php
            } else {
            ?>

                <section>Blog not found!</section>
            <?php
            }
            ?>

        </div>
    </section>
    <!-- view blogg ends here -->
</body>

</html>