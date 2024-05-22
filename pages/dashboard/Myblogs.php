<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';

if (!isset($_COOKIE['user_cookie'])) {
    redirect('/pages/auth/Login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | My Blogs</title>
    <link rel="stylesheet" href="../../assets/css/dashboard/user.css">
    <link rel="stylesheet" href="../../assets/css/dashboard/userprofile.css">
</head>

<body>
    <!-- top navbar start -->
    <?php include '../../include/dashboard_includes/Header.php'; ?>
    <!-- top navbar end -->
    <!--sidebar starts -->
    <section id="left-sidebar-container">
        <?php include '../../include/dashboard_includes/Sidebar.php'; ?>
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
                            $query = "SELECT blogs_tb.*, blog_categories_tb.name AS category_name 
                            FROM blogs_tb 
                            INNER JOIN blog_categories_tb ON blogs_tb.cat_id = blog_categories_tb.blog_cat_id 
                            WHERE blogs_tb.user_id = ?";
                            $statement = $pdo->prepare($query);
                            $user_id = $_COOKIE['user_cookie'];
                            $statement->execute([$user_id]);
                            $blogs = $statement->fetchAll();
                            if (empty($blogs)) : ?>
                                <tr>
                                    <td colspan="5">You haven't posted any blogs yet.</td>
                                    <td><a class="blog-post-view" href="<?= url('/pages/dashboard/addblog.php') ?>">Add Blog</a></td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($blogs as $key => $blog) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td class="blog-img-container"><img src="<?= asset($blog->image) ?>" alt="alt"></td>
                                        <td class="title-blogs"><?= $blog->title ?></td>
                                        <td class="blog-cat-body"><?= $blog->category_name ?></td>
                                        <td class="blog-cat-body">
                                            <p><?= substr($blog->body, 0, 30) ?></p>
                                        </td>
                                        <td>
                                            <?php if ($blog->status == 10) { ?>
                                                <span style="color: #14532d;" class="text-success">enable</span>
                                            <?php } else { ?>
                                                <span style="color: #7f1d1d; background-color:#111827;" class="text-danger">pending</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a class="blog-post-view" href="<?= url('/pages/dashboard/Viewblogs.php?post_id=') . $blog->blog_id ?>">View</a>
                                            <a class="blog-post-edit" href="<?= url('/pages/dashboard/Editblog.php?post_id=') . $blog->blog_id ?>">Edit</a>
                                            <a class="blog-post-delete" href="<?= url('/pages/dashboard/Deleteblog.php?post_id=') . $blog->blog_id ?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--sidebar end -->
</body>

</html>