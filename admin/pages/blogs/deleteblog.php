<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';



if (isset($_GET['post_id']) && $_GET['post_id']) {
    // Selecting post data
    $query = "SELECT * FROM blogs_tb WHERE blog_id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$_GET['post_id']]);
    $post = $statement->fetch();

    // Checking if the post exists
    if ($post) {
        // Deleting the post's image file if it exists
        $basePath = dirname(dirname(__DIR__));
        if (file_exists($basePath . $post->image)) {
            unlink($basePath . $post->image);
        }

        // Deleting the post from the database
        $query = "DELETE FROM blogs_tb WHERE blog_id = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$_GET['post_id']]);
    }
}

admin_redirect('/pages/blogs/blogs.php');
