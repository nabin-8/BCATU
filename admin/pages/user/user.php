<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | User</title>
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
                <h2>Users</h2>
                <div class="blog-container">
                    <table>
                        <thead id="blog-container-heading">
                            <tr>
                                <th>#</th>
                                <th>image</th>
                                <th class="title-blogs">Name:</th>
                                <th>Email:</th>
                                <th class="blog-cat-body">Semester</th>
                                <th>College</th>
                                <th>role</th>
                                <th>setting</th>
                            </tr>
                        </thead>
                        <tbody id="blog-container-body">
                            <?php
                            $query = "SELECT * FROM user_tb";
                            $statement = $pdo->prepare($query);
                            $statement->execute();
                            $users = $statement->fetchAll();
                            foreach ($users as $key => $user) { ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td class="blog-img-container"><img src="<?= asset($user->image) ?>" alt="alt"></td>
                                    <td class="title-blogs"><?= $user->username ?></td>
                                    <td><?= $user->email ?></td>
                                    <td class="blog-cat-body"><?= $user->semester_id ?></td>
                                    <td><?= $user->college ?></td>
                                    <td>
                                        <p><?= $user->role ?></p>
                                    </td>
                                    <td>
                                        <a class="blog-post-view" href="<?= admin_url('/pages/user/view.php?user_id=') . $user->user_id ?>">View</a>
                                        <a class="blog-post-edit" href="">Edit</a>
                                        <a class="blog-post-delete" href="<?= admin_url('/pages/user/deleteuser.php?user_id=') . $user->user_id ?>">Delete</a>
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