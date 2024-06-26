<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';

if (!isset($_COOKIE['user_cookie'])) {
    redirect('/pages/auth/Login.php');
}

$error = '';
if (isset($_POST['title']) && $_POST['title'] !== '' && isset($_POST['cat_id']) && $_POST['cat_id'] !== '' && isset($_POST['body']) && $_POST['body'] !== '' && isset($_FILES['image']) && $_FILES['image']['name'] !== '') {

    $query = "SELECT * FROM blog_categories_tb WHERE blog_cat_id = ?;"; // Changed table name and column name
    $statement = $pdo->prepare($query);
    $user_id = $_COOKIE['user_cookie'];
    $statement->execute([$_POST['cat_id']]);
    $category = $statement->fetch();

    $allowedMimes = ['png', 'jpg', 'gif', 'jpeg'];
    $imageMime = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    if (!in_array($imageMime, $allowedMimes)) {
        $error = "only: png, jpg, jpeg images are allowed";
        redirect('/pages/dashboard/addblog.php');
    }

    $basePath = dirname(dirname(__DIR__));
    $imageFetch = '/assets/images/blogimages/' . date('Y_m_d_H_i_s') . '.' . $imageMime;
    $image_upload = move_uploaded_file($_FILES['image']['tmp_name'], $basePath . $imageFetch);
    if ($category !== false && $image_upload !== false) {
        $query = "INSERT INTO blogs_tb SET user_id=?, title = ?, cat_id = ?, body = ?, image = ?, created_at = NOW();"; // Changed table name and added placeholders for user_id
        $statement = $pdo->prepare($query);
        $statement->execute([$user_id, $_POST['title'], $_POST['cat_id'], $_POST['body'], $imageFetch]);
        redirect('/pages/dashboard/myblogs.php');
    }
} else {
    if (!empty($_POST))
        $error = 'All fields are required';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCATU | Add Blogs</title>
    <link rel="stylesheet" href="../../assets/css/dashboard/user.css">
    <link rel="stylesheet" href="../../assets/css/blog/addblog.css">
    <link rel="stylesheet" href="../../assets/css/blog/blogcss.css">
</head>

<body>
    <?php include '../../include/dashboard_includes/header.php'; ?>

    <!-- addBlog Section Start Here -->
    <section class="add-blog">
        <div class="add-blog-container">
            <h1>Add Post</h1>
            <div id="blog-content-error" style="color: white; text-align:center;" class="same-inputs"><?php if ($error !== '') echo $error; ?></div>
            <form action="<?= url('/pages/dashboard/addblog.php') ?>" method="post" enctype="multipart/form-data">
                <div class="blog-content-main ">
                    <div class="blog-title-container">
                        <input class="blog-title same-inputs" type="text" name="title" id="title" placeholder="Title">
                    </div>
                    <div class="blog-catogery-container">
                        <select class="same-inputs" name="cat_id" id="cato-selection">
                            <option value="">Select Category</option>
                            <?php
                            $query = "SELECT * FROM blog_categories_tb;";
                            $statement = $pdo->prepare($query);
                            $statement->execute();
                            $categories = $statement->fetchAll();

                            foreach ($categories as $category) { ?>
                                <option value="<?= $category->blog_cat_id ?>"><?= $category->name ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="body-content-container">
                        <textarea class="body-content-content same-inputs" name="body" id="body" placeholder="Body"></textarea>
                    </div>
                    <div class="body-image-container">
                        <p>Add Thumbnail</p>
                        <input class="body-image-content same-inputs" type="file" name="image" id="image">
                    </div>
                    <div class="add-btn">
                        <button type="submit">Add Post</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- addBlog Section end Here -->

</body>

</html>