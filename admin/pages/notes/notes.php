<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Notes</title>
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
                <h2>Notes</h2>
                <div class="blog-container">
                    <table>
                        <thead id="blog-container-heading">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Body</th>
                                <th>Note Type</th>
                                <th>Subject</th>
                                <th>Setting</th>
                            </tr>
                        </thead>
                        <tbody id="blog-container-body">
                            <?php
                            $query = "SELECT 'note' AS type, notes_tb.*, subject_tb.subject_name, semester_tb.semester_name
                            FROM notes_tb
                            INNER JOIN subject_tb ON notes_tb.subject_id = subject_tb.subject_id
                            INNER JOIN semester_tb ON subject_tb.semester_id = semester_tb.semester_id
                            
                            UNION ALL
                            
                            SELECT 'lab' AS type, lab_tb.*, subject_tb.subject_name, semester_tb.semester_name
                            FROM lab_tb
                            INNER JOIN subject_tb ON lab_tb.subject_id = subject_tb.subject_id
                            INNER JOIN semester_tb ON subject_tb.semester_id = semester_tb.semester_id
                            
                            UNION ALL
                            
                            SELECT 'presentation' AS type, presentation_tb.*, subject_tb.subject_name, semester_tb.semester_name
                            FROM presentation_tb
                            INNER JOIN subject_tb ON presentation_tb.subject_id = subject_tb.subject_id
                            INNER JOIN semester_tb ON subject_tb.semester_id = semester_tb.semester_id";

                            $statement = $pdo->prepare($query);
                            $statement->execute();
                            $notes = $statement->fetchAll();
                            echo "<pre>";
                            print_r($notes);
                            foreach ($notes as $key => $note) { ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td class="blog-img-container"><img src="<?= asset($note->image) ?>" alt="Note Image" /></td>
                                    <td><?= $note->title ?></td>
                                    <td><?= $note->description ?></td>
                                    <td><?= $note->type ?></td>
                                    <td><?= $note->subject_name ?></td>
                                    <td>
                                        <a class="blog-post-view" href="">View</a>
                                        <a class="blog-post-edit" href="">Edit</a>
                                        <a class="blog-post-delete" href="">Delete</a>
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