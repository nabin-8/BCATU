<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';

if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

$query = "SELECT user_tb.*, semester_tb.semester_name 
          FROM user_tb 
          JOIN semester_tb ON user_tb.semester_id = semester_tb.semester_id 
          WHERE user_tb.user_id = ?";
$statement = $pdo->prepare($query);
$statement->execute([$user_id]);
$user = $statement->fetch();

if ($user === false) {
    echo "User not found.";
    admin_redirect('/pages/blogs/blogs.php');
    exit;
}

// Check if form submitted with required fields
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
        $allowedMimes = ['png', 'jpg', 'jpeg', 'gif'];
        $imageMime = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        if (in_array($imageMime, $allowedMimes)) {
            $directory = 'C:/laragon/www/BCATU/assets/images/profile/';
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }

            // Generate unique filename and move uploaded file
            $imageUpload = '/assets/images/profile/' . date('Y_m_d_H_i_s') . '.' . $imageMime;
            $imageFetch = 'C:/laragon/www/BCATU' . $imageUpload;
            $image_upload = move_uploaded_file($_FILES['image']['tmp_name'], $imageFetch);

            if ($image_upload) {
                $query = "UPDATE user_tb SET image = ? WHERE user_id = ?";
                $statement = $pdo->prepare($query);
                $statement->execute([$imageUpload, $user_id]);
                echo "Image updated successfully.<br>";
            } else {
                echo "Failed to upload image.<br>";
            }
        } else {
            echo "Invalid image format!<br>";
        }
    }

    if (
        isset($_POST['username'], $_POST['email'], $_POST['semester_id'], $_POST['college']) &&
        !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['semester_id']) && !empty($_POST['college'])
    ) {

        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $semester_id = htmlspecialchars($_POST['semester_id']);
        $college = htmlspecialchars($_POST['college']);

        echo "Username: $username, Email: $email, Semester ID: $semester_id, College: $college<br>";

        try {
            $query = "UPDATE user_tb SET username = ?, email = ?, semester_id = ?, college = ? WHERE user_id = ?";
            $statement = $pdo->prepare($query);
            $result = $statement->execute([$username, $email, $semester_id, $college, $user_id]);

            if ($result) {
                echo "Profile updated successfully.<br>";
                admin_redirect('/pages/user/user.php');
            } else {
                $errorInfo = $statement->errorInfo();
                echo "Failed to update profile. Error Info: " . print_r($errorInfo, true) . "<br>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        }
    } else {
        echo "Please fill in all required fields.<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN | Profile</title>
    <link rel="stylesheet" href="../../assest/admincss/style.css">
    <link rel="stylesheet" href="../../assest/admincss/userprofile.css">
</head>

<body>
    <!-- top navbar start -->
    <?php include '../../include/header.php'; ?>
    <!-- top navbar end -->
    <!--sidebar starts -->
    <section id="left-sidebar-container">
        <?php include '../../include/sidebar.php'; ?>

        <div id="main-content-container">
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) . "?user_id=" . $user_id ?>" method="POST" enctype="multipart/form-data">
                <?php if ($user !== false) : ?>
                    <div class="user-image-container">
                        <img id="edit-image-profile" src="<?= asset($user->image) ?>" alt="">
                        <div class="user-edit-image">
                            <input type="file" name="image">
                        </div>
                    </div>
                    <div class="user-profile-details">
                        <div class="user-profile-details-main">
                            <div class="edit-profile-bottom">
                                <input type="text" name="username" value="<?= $user->username ?>" placeholder="Edit Your Name">
                                <input type="text" name="email" value="<?= $user->email ?>" placeholder="Email">
                            </div>
                            <div class="edit-profile-bottom">
                                <select name="semester_id" id="semester-selections">
                                    <?php
                                    $query = "SELECT * FROM semester_tb;";
                                    $statement = $pdo->prepare($query);
                                    $statement->execute();
                                    $semesters = $statement->fetchAll();
                                    foreach ($semesters as $semester) : ?>
                                        <option value="<?= $semester->semester_id ?>" <?= $semester->semester_id === $user->semester_id ? 'selected' : '' ?>>
                                            <?= $semester->semester_name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="text" name="college" value="<?= $user->college ?>" placeholder="College">
                            </div>
                        </div>
                    </div>
                    <div class="user-image-container">
                        <div class="user-edit-image">
                            <button type="submit">Update Profile</button>
                        </div>
                    </div>
                <?php else : ?>
                    <section>User not found!</section>
                <?php endif; ?>
            </form>
        </div>
    </section>
    <!--sidebar end -->
</body>

</html>