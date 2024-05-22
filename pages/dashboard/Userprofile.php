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
    <title>Dashboard | Profile</title>
    <link rel="stylesheet" href="../../assets/css/dashboard/user.css">
    <link rel="stylesheet" href="../../assets/css/dashboard/userprofile.css">
</head>

<body>
    <!-- top navbar start -->
    <?php include '../../include/dashboard_includes/header.php'; ?>
    <!-- top navbar end -->
    <!--sidebar starts -->
    <section id="left-sidebar-container">
        <?php include '../../include/dashboard_includes/sidebar.php'; ?>

        <div id="main-content-container">
            <?php

            //check for exist user 
            $query = "SELECT user_tb.*, semester_tb.semester_name 
            FROM user_tb 
            JOIN semester_tb ON user_tb.semester_id = semester_tb.semester_id 
            WHERE user_tb.user_id = ?;
            ";
            $statement = $pdo->prepare($query);
            $user_id = $_COOKIE['user_cookie'];
            $statement->execute([$user_id]);
            $user = $statement->fetch();
            if ($user !== false) {
            ?>
                <div class="user-image-container">
                    <img src="<?= asset($user->image) ?>" alt="userimg">
                </div>
                <div class="user-profile-details">
                    <div class="user-profile-details-main">

                        <h2><?= $user->username ?></h2>
                        <table border="1">
                            <tbody>
                                <tr>
                                    <th>Name:</th>
                                    <td><?= $user->username ?></td>
                                    <th>Email:</th>
                                    <td><?= $user->email ?></td>
                                </tr>
                                <tr>
                                    <th>Semester:</th>
                                    <td><?= $user->semester_name ?></td>
                                    <th>Collage:</th>
                                    <td><?= $user->college ?></td>
                                </tr>
                            </tbody>
                        </table>

                    <?php
                } else { ?>

                        <section>user not found!</section>
                    <?php } ?>
                    </div>

                </div>
        </div>
    </section>
    <!--sidebar end -->
</body>

</html>