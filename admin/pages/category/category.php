<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Category</title>
    <link rel="stylesheet" href="../../assest/admincss/style.css">
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
        <div id="main-content-container">
            <div id="main-blogg-container">
                <div class="category-header">
                    <h2>Category</h2>
                    <a class="blog-post-view category-style" href="<?= admin_url('/pages/category/createcat.php') ?>">Create</a>
                </div>
                <div class="blog-container">
                    <table>
                        <thead id="blog-container-heading">
                            <tr>
                                <th>#</th>
                                <th class="title-category">name</th>
                                <th>setting</th>
                            </tr>
                        </thead>
                        <tbody id="blog-container-body">
                            <?php
                            $query = "SELECT * FROM blog_categories_tb"; // Updated table name
                            $statement = $pdo->prepare($query);
                            $statement->execute();
                            $categories = $statement->fetchAll();

                            foreach ($categories as $key => $category) { ?>
                                <tr>
                                    <td><?= $key + 1 ?> </td> <!-- Changed from $key += 1 to $key + 1 -->
                                    <td class="title-category"><?= $category->name ?> </td>
                                    <td>
                                        <a class="blog-post-edit category-style" href="<?= admin_url('/pages/category/editcat.php?cat_id=') . $category->blog_cat_id ?>">Edit</a> <!-- Changed column name -->
                                        <a class="blog-post-delete category-style" href="<?= admin_url('/pages/category/deletecat.php?cat_id=') . $category->blog_cat_id ?>">Delete</a> <!-- Changed column name -->
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--sidebar end -->
</body>

</html>