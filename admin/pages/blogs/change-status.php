<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';



if (isset($_GET['post_id']) && $_GET['post_id']) {

   $query = "SELECT * FROM blogs_tb WHERE blog_id = ?;";
   $statement = $pdo->prepare($query);
   $statement->execute([$_GET['post_id']]);
   $post = $statement->fetch();

   if ($post !== false) {
      $status = ($post->status == 10) ? 0 : 10;

      $query = "UPDATE blogs_tb SET status = ? WHERE blog_id = ? ;";
      $statement = $pdo->prepare($query);
      $statement->execute([$status, $_GET['post_id']]);
   }
}


admin_redirect('/pages/blogs/blogs.php');
