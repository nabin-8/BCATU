<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';


if (!isset($_GET['cat_id'])) {
    admin_redirect('/pages/category/category.php');
}

// Check if cat_id exists
$query = "SELECT * FROM blog_categories_tb WHERE blog_cat_id = ?;";
$statement = $pdo->prepare($query);
$statement->execute([$_GET['cat_id']]);
$category = $statement->fetch();
if ($category === false) {
    admin_redirect('/pages/category/category.php');
}

if (isset($_POST['name']) && $_POST['name'] !== '') {
    $query = "UPDATE blog_categories_tb SET name = ?, updated_at = NOW() WHERE blog_cat_id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['name'], $_GET['cat_id']]);
    admin_redirect('/pages/category/category.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCA ADMIN | Edit Category</title>
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
            <form action="editcat.php?cat_id=<?= $_GET['cat_id'] ?>" method="post">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter category name..." value="<?= $category->name ?>">

                <button class="blog-post-view category-style" type="submit">Update</button>
            </form>
        </div>
</body>

</html>