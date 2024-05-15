<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';


if (isset($_GET['cat_id']) && $_GET['cat_id'] !== '') {
    $query = "DELETE FROM blog_categories_tb WHERE blog_cat_id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$_GET['cat_id']]);
}


admin_redirect('/pages/category/category.php');
