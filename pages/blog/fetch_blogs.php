<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';

if (isset($_POST['category'])) {
    $category = $_POST['category'];
    // echo $category;
    // echo "<br>" . "Hello from inner";

    $query = "SELECT blogs_tb.*, user_tb.username, user_tb.image AS userimage 
        FROM blogs_tb 
        INNER JOIN blog_categories_tb ON blogs_tb.cat_id = blog_categories_tb.blog_cat_id
        LEFT JOIN user_tb ON blogs_tb.user_id = user_tb.user_id 
        WHERE blogs_tb.status = 10 AND blog_categories_tb.name = ?
    ";

    $statement = $pdo->prepare($query);
    $statement->execute([$category]); // Bind the value to the placeholder

    $blogs = $statement->fetchAll();
    // echo "<pre>";
    // print_r($blogs);

    if ($blogs) { ?>

        <?php foreach ($blogs as $blog) {
            $vewUrl = blog_url('/viewblogs.php?post_id=') . $blog->blog_id;
            $user_blog_id = blog_url('/userblogs.php?post_id=') . $blog->user_id;?>
            <article>
                <h2><a href="<?= $vewUrl ?>"><?= $blog->title ?></a></h2>
                <p><?= substr($blog->body, 0, 80) ?></p>
                <div class="blog-bottom-container">
                    <div>
                        <img src="<?= asset($blog->userimage) ?>" alt="<?= $blog->username ?> image">
                        <a class="user-usernames" href="<?= $user_blog_id ?>"><span><?= $blog->username ?></span></a>
                    </div>
                    <a href="<?= $vewUrl ?>">Read More</a>
                </div>
            </article>
        <?php } ?>

    <?php } else { ?>
        <p style="text-align: center; background-color:#475569; color:white;">Blogs not found.</p>
<?php }
}
