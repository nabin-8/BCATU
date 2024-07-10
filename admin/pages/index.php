<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assest/admincss/style.css">
    <link rel="stylesheet" href="../assest/admincss/userprofile.css">
</head>

<body>
    <!-- top navbar start -->
    <?php include '../include/header.php'; ?>
    <!-- top navbar end -->
    <!--sidebar starts -->
    <section id="left-sidebar-container">
        <!-- sidebar include start -->
        <?php include '../include/sidebar.php'; ?>
        <!-- sidebar include end -->
        <div id="main-content-container">
            <!-- admin pannel starts -->
            <div id="admin-pannel-container">
                <div class="admin-pannel-main">
                    <div class="admin-pannel-upper-section">
                        <h2>Admin Pannel</h2>
                    </div>
                    <div class="admin-pannel-bottom-section">
                        <div class="admin-bottom-main-container">
                            <div class="admin-bottom-item-container">
                                <?php
                                $query = "SELECT COUNT(*) AS total_user FROM user_tb";
                                $statement = $pdo->prepare($query);
                                $statement->execute();
                                $result = $statement->fetch(PDO::FETCH_ASSOC);
                                $total_user = $result['total_user'];

                                if ($total_user > 0) {
                                ?>
                                    <div>
                                        <h3><?= $total_user ?></h3>
                                        <p>Total User</p>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div>
                                        <p>No users found!</p>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                            <div class="admin-bottom-item-container">
                                <?php
                                $query = "SELECT COUNT(*) AS total_blog FROM blogs_tb";
                                $statement = $pdo->prepare($query);
                                $statement->execute();
                                $result = $statement->fetch(PDO::FETCH_ASSOC);
                                $total_blog = $result['total_blog'];

                                if ($total_blog > 0) {
                                ?>
                                    <div>
                                        <h3><?= $total_blog ?></h3>
                                        <p>Total Blogs</p>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div>
                                        <p>No blog found!</p>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="admin-bottom-main-container">
                            <div class="admin-bottom-item-container">
                                <?php
                                $query = "SELECT COUNT(*) AS total_forum FROM community_tb"; // corrected table name
                                $statement = $pdo->prepare($query);
                                $statement->execute();
                                $result = $statement->fetch(PDO::FETCH_ASSOC);
                                $total_forum = $result['total_forum'];

                                if ($total_forum > 0) {
                                ?>
                                    <div>
                                        <h3><?= $total_forum ?></h3>
                                        <p>Total Forum Raised</p>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div>
                                        <p>No forum found!</p>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                            <div class="admin-bottom-item-container">
                                <?php
                                $query = "SELECT 'note' AS type, COUNT(*) AS total FROM notes_tb
                                    UNION ALL
                                    SELECT 'lab' AS type, COUNT(*) AS total FROM lab_tb
                                    UNION ALL
                                    SELECT 'presentation' AS type, COUNT(*) AS total FROM presentation_tb";

                                $statement = $pdo->prepare($query);
                                $statement->execute();
                                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                                $total_notes = 0;
                                foreach ($results as $result) {
                                    // $type = ucfirst($result['type']); // Capitalize the first letter of the type
                                    $total_notes += $result['total'];
                                }

                                if ($total_notes > 0) {
                                ?>
                                    <div>
                                        <h3><?= $total_notes ?></h3>
                                        <p>Total Notes</p>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div>
                                        <p>No notes found!</p>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- admin pannel ends -->
        </div>
    </section>
    <!--sidebar end -->
</body>

</html>