<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';

// Redirect if post_id is not set
if (!isset($_GET['post_id'])) {
    admin_redirect('/pages/blogs/blogs.php');
}

// Fetch the post
$query = "SELECT * FROM blogs_tb WHERE blog_id = ?";
$statement = $pdo->prepare($query);
$statement->execute([$_GET['post_id']]);
$post = $statement->fetch();

// Redirect if post does not exist
if ($post === false) {
    admin_redirect('/pages/blogs/blogs.php');
}

// Check if form submitted with required fields
if (
    isset($_POST['title'], $_POST['cat_id'], $_POST['body']) &&
    !empty($_POST['title']) && !empty($_POST['cat_id']) && !empty($_POST['body'])
) {
    // Fetch the category details
    $query = "SELECT * FROM blog_categories_tb WHERE blog_cat_id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['cat_id']]);
    $category = $statement->fetch();

    // Proceed if category found
    if ($category !== false) {
        // Check if image uploaded
        if (isset($_FILES['image']) && $_FILES['image']['name'] !== '') {
            // Validate image type
            $allowedMimes = ['png', 'jpg', 'gif', 'jpeg'];
            $imageMime = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            if (in_array($imageMime, $allowedMimes)) {
                // Define directory and create if not exists
                $directory = 'C:/laragon/www/BCATU/assets/images/blogimages/';
                if (!file_exists($directory)) {
                    mkdir($directory, 0777, true); // Ensure permissions are set correctly
                }

                // Generate unique filename and move uploaded file
                $imageUpload = '/assets/images/blogimages/' . date('Y_m_d_H_i_s') . '.' . $imageMime;
                $imageFetch = 'C:/laragon/www/BCATU' . $imageUpload;
                $image_upload = move_uploaded_file($_FILES['image']['tmp_name'], $imageFetch);

                // Update database if image uploaded successfully
                if ($image_upload) {
                    $query = "UPDATE blogs_tb SET title = ?, cat_id = ?, body = ?, image = ?, updated_at = NOW() WHERE blog_id = ?";
                    $statement = $pdo->prepare($query);
                    $statement->execute([$_POST['title'], $_POST['cat_id'], $_POST['body'], $imageUpload, $_GET['post_id']]);
                } else {
                    // Handle image upload failure
                }
            } else {
                // Redirect if invalid image type
                admin_redirect('/pages/blogs/blogs.php');
            }
        } else {
            // Update database without image
            $query = "UPDATE blogs_tb SET title = ?, cat_id = ?, body = ?, updated_at = NOW() WHERE blog_id = ?";
            $statement = $pdo->prepare($query);
            $statement->execute([$_POST['title'], $_POST['cat_id'], $_POST['body'], $_GET['post_id']]);
        }
    } else {
        // Redirect if category not found
        admin_redirect('/pages/blogs/blogs.php');
    }

    // Redirect after updating
    admin_redirect('/pages/blogs/blogs.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCA ADMIN | Edit Blogs</title>
    <link rel="stylesheet" href="../../assest/admincss/style.css">
    <link rel="stylesheet" href="../../assest/admincss/viewblog.css">
    <link rel="stylesheet" href="../../../assets/css/blog/addblog.css">
    <link rel="stylesheet" href="../../../assets/css/blog/viewblog.css">
</head>

<body>
    <?php include '../../include/header.php'; ?>

    <!-- addBlog Section Start Here -->
    <section class="add-blog" style="margin-top: 8px;">
        <div class="add-blog-container">
            <h1>Edit</h1>
            <div id="blog-content-error" class="same-inputs">
                <p><?php $error ?></p>
            </div>
            <form action="<?= admin_url('/pages/blogs/editblog.php?post_id=') . $_GET['post_id'] ?>" method="post" enctype="multipart/form-data">
                <div class="blog-content-main ">
                    <div class="blog-title-container">
                        <input class="blog-title same-inputs" type="text" name="title" id="title" placeholder="Title" value="<?= $post->title ?>">
                    </div>
                    <div class="blog-catogery-container">
                        <select class="same-inputs" name="cat_id" id="cato-selection">
                            <?php
                            $query = "SELECT * FROM blog_categories_tb";
                            $statement = $pdo->prepare($query);
                            $statement->execute();
                            $categories = $statement->fetchAll();
                            foreach ($categories as $category) { ?>
                                <option value="<?= $category->blog_cat_id ?>" <?php if ($category->blog_cat_id == $post->cat_id) echo 'selected' ?>>
                                    <?= $category->name ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="body-content-container">
                        <textarea class="body-content-content same-inputs" name="body" id="body" placeholder="Body"><?= $post->body ?></textarea>
                    </div>
                    <div class="body-image-container">
                        <img src="<?= asset($post->image) ?>" alt="" width="150" height="100" />

                    </div>
                    <hr style="border: 1px solid #1F2937;">
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