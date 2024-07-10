<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';

$user_id = $_GET['post_id'];

// Fetch user information
$query = "SELECT user_tb.*, semester_tb.semester_name 
          FROM user_tb 
          JOIN semester_tb ON user_tb.semester_id = semester_tb.semester_id 
          WHERE user_tb.user_id = ?";
$statement = $pdo->prepare($query);
$statement->execute([$user_id]);
$user = $statement->fetch(PDO::FETCH_OBJ);

// Fetch blogs
$query = "SELECT blogs_tb.*, blog_categories_tb.name AS category_name 
          FROM blogs_tb 
          INNER JOIN blog_categories_tb ON blogs_tb.cat_id = blog_categories_tb.blog_cat_id 
          WHERE blogs_tb.user_id = ?";
$statement = $pdo->prepare($query);
$statement->execute([$user_id]);
$blogs = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCATU | Blogs</title>
    <link rel="stylesheet" href="../../assets/css/blog/userblogs.css">
    <link rel="stylesheet" href="../../assets/css/header/header.css">
    <link rel="stylesheet" href="../../assets/css/footer/footer.css">
    <script src="../../assets/js/jquery.js"></script>
    <script src="./Search_Blogs.js"></script>
</head>

<body>
<?php require_once '../../include/header/Header.php'; ?>
<section class="user-container-wraper">
    <div class="user-section-left-wraper">
        <div class="user-section-left-contents">
            <img class="user-profile-image" src="<?= asset($user->image) ?>" alt="User Image">
        </div>
        <div class="user-section-left-contents">
            <h4><?= htmlspecialchars($user->username) ?></h4>
            <p>Joined at: <?= htmlspecialchars(date("Y F j", strtotime($user->created_at))) ?></p>
        </div>
        <div  class="user-section-left-contents">
            <p>Photoes</p>
           <div id="blogs-images-user-show">
               <?php foreach ($blogs as $blog) : ?>
                   <img class="blog-images" src="<?= asset($blog->image) ?>" alt="Blog Image">
               <?php endforeach; ?>
           </div>
        </div>
    </div>
    <!-- user blogs section right bottom -->
    <div class="user-section-right-bottom-wraper">
        <div class="user-section-right-bottom-main" id="blog-user-user-content">
            <?php foreach ($blogs as $blog) :
                $vewUrl = blog_url('/viewblogs.php?post_id=') . $blog->blog_id;
                ?>
                <div class="blog-user-user-content-main">
                    <div class="blog-user-user-image-container">
                        <img src="<?= asset($blog->image) ?>" alt="Blog Image">
                    </div>
                    <div class="blog-user-user-content-container" >
                        <p><?= htmlspecialchars($blog->title) ?></p>
                        <p><?= htmlspecialchars(date("Y F j", strtotime($blog->created_at))) ?> </p>
                        <p><?= htmlspecialchars(substr($blog->body, 0, 200)) ?></p>
                        <a class="blogs-user-readmore" href="<?= htmlspecialchars($vewUrl) ?>">Read More</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- footer -->
<?php include 'C:/laragon/www/completeprojectbcatu/include/footer/Footer.php'; ?>
</body>

</html>
