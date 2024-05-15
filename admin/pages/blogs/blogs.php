<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Blogs</title>
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
                <h2>Bloggs</h2>
                <div class="blog-container">
                    <table>
                        <thead id="blog-container-heading">
                            <tr>
                                <th>#</th>
                                <th>image</th>
                                <th class="title-blogs">title</th>
                                <th class="blog-cat-body">category</th>
                                <th class="blog-cat-body">body</th>
                                <th>status</th>
                                <th>setting</th>
                            </tr>
                        </thead>
                        <tbody id="blog-container-body">
                            <?php
                            $query = "SELECT blogs_tb.*, blog_categories_tb.name AS category_name FROM blogs_tb LEFT JOIN blog_categories_tb ON blogs_tb.cat_id = blog_categories_tb.blog_cat_id;"; // Changed table and column names
                            $statement = $pdo->prepare($query);
                            $statement->execute();
                            $blogs = $statement->fetchAll();
                            if (count($blogs) > 0) {
                                foreach ($blogs as $key => $blog) { ?>
                                    <tr>
                                        <td><?= $key + 1 ?> </td> <!-- Changed to $key + 1 -->
                                        <td class="blog-img-container"><img src="<?= asset($blog->image) ?>" alt="alt"></td>
                                        <td class="title-blogs"><?= $blog->title ?></td>
                                        <td class="blog-cat-body"><?= $blog->category_name ?></td>
                                        <td class="blog-cat-body">
                                            <p><?= substr($blog->body, 0, 30)  ?></p>
                                        </td>
                                        <td>
                                            <?php if ($blog->status == 10) { ?>
                                                <span style="color: #14532d;" class="text-success">enable</span>
                                            <?php } else { ?>
                                                <span style="color: #7f1d1d; background-color:#111827;" class="text-danger">disable</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a class="blog-post-status" href="<?= admin_url('/pages/blogs/change-status.php?post_id=') . $blog->blog_id ?>">Change</a> <!-- Changed post_id to blog_id -->
                                            <a class="blog-post-view" href="<?= admin_url('/pages/blogs/viewblogs.php?post_id=') . $blog->blog_id ?>">View</a> <!-- Changed post_id to blog_id -->
                                            <a class="blog-post-edit" href="<?= admin_url('/pages/blogs/editblog.php?post_id=') . $blog->blog_id ?>">Edit</a> <!-- Changed post_id to blog_id -->
                                            <a class="blog-post-delete" href="<?= admin_url('/pages/blogs/deleteblog.php?post_id=') . $blog->blog_id ?>">Delete</a> <!-- Changed post_id to blog_id -->
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="7">No blogs found</td>
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