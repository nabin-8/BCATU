<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCA ADMIN | View User</title>
    <link rel="stylesheet" href="../../assest/admincss/style.css">
    <link rel="stylesheet" href="../../assest/admincss/userprofile.css">
    <link rel="stylesheet" href="../../assest/admincss/user.css">
</head>

<body>
    <!-- top navbar start -->
    <?php include '../../include/header.php'; ?>
    <!-- top navbar end -->
    <!--sidebar starts -->
    <section id="left-sidebar-container">
        <?php include '../../include/sidebar.php'; ?>
        <div id="main-content-container">
            <?php
            // Check for existing user 
            $query = "SELECT * FROM user_tb WHERE user_id = ?";
            $statement = $pdo->prepare($query);
            $statement->execute([$_GET['user_id']]);
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
                                    <td><?= $user->semester_id ?></td>
                                    <th>College:</th> <!-- Corrected typo -->
                                    <td><?= $user->college ?></td>
                                </tr>
                            </tbody>
                        </table>

                    <?php
                } else { ?>

                        <section>User not found!</section>
                    <?php } ?>
                    </div>

                </div>
        </div>
    </section>
    <!--sidebar end -->
</body>

</html>