<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';


if (isset($_POST['name']) && $_POST['name'] !== '') {

    $query = "INSERT INTO blog_categories_tb (name, created_at) VALUES (?, NOW())";
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['name']]);
    admin_redirect('/pages/category/category.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCA ADMIN | Create Category</title>
    <link rel="stylesheet" href="../../assest/admincss/style.css">
    <link rel="stylesheet" href="../../assest/admincss/createcat.css">
    <link rel="stylesheet" href="../../assest/admincss/userprofile.css">
</head>

<body>
    <!-- top navbar start -->
    <?php include '../../include/header.php'; ?>
    <!-- top navbar end -->
    <!--sidebar starts -->
    <section id="left-sidebar-container">
        <!-- sidebar include start -->
        <?php include '../../include/sidebar.php'; ?>
        <!-- sidebar include end -->

        <!-- create cat -->
        <div class="create-category-main">
            <form action="<?= admin_url('/pages/category/createcat.php') ?>" method="post">
                <label for="name">Name</label>
                <input type="text" name="name" id="create-cat-name" placeholder="Enter category name...">

                <button class="blog-post-view category-style" type="submit">Create</button>
            </form>
        </div>
</body>

</html>