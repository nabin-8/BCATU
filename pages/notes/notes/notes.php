<?php
require_once 'C:/laragon/www/completeprojectbcatu/config/pdo_connection.php';
require_once 'C:/laragon/www/completeprojectbcatu/config/helpers.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCATU | Notes</title>
    <!-- <link rel="stylesheet" href="../../../assets/css/syllabus/syllabus.css"> -->
    <link rel="stylesheet" href="../../../assets/css/notes/note-sec.css">
    <link rel="stylesheet" href="../../../assets/css/header/header.css">
    <link rel="stylesheet" href="../../../assets/css/footer/footer.css">
</head>

<body>
    <!-- top navbar start -->
    <?php include 'C:/laragon/www/completeprojectbcatu/include/header/Header.php'; ?>
    <!-- top navbar end -->
    <section class="notes-container-wraper">
        <div class="notes-section-left-wraper">
            <div class="notes-section-left-contents">
                <input type="text" placeholder="Search notes,labes..." name="searchnotes" id="searchnotes">
            </div>
            <div class="notes-section-left-contents">
                <!-- <select name="semester" id="semester">
                    <option value="">Select Semester</option>
                    <?php
                    $query = "SELECT * FROM semester_tb;";
                    $statement = $pdo->prepare($query);
                    $statement->execute();
                    $semesters = $statement->fetchAll();
                    foreach ($semesters as $semester) : ?>
                        <option value="<?= $semester->semester_id ?>"> <?= $semester->semester_name ?>
                        </option>
                    <?php endforeach; ?>
                </select> -->
            </div>
            <div class="notes-section-left-contents">
                <select name="notetype" id="notetype">
                    <option value="">Select Note Type</option>
                    <option value="notes_tb">Note</option>
                    <option value="lab_tb">Lab</option>
                    <option value="presentation_tb">Presentation</option>
                </select>
            </div>
            <!-- <div class="notes-section-left-contents">
                <select name="subject" id="subject">
                    <option value="">Select Subject</option>
                </select>
            </div> -->
        </div>
        <!-- notes section right bottom -->
        <div class="notes-section-right-bottom-wraper">
            <div class="notes-section-right-bottom-main">
                <?php

                $query = "
                    SELECT 'note' AS type, notes_tb.notes_id AS id, notes_tb.image, notes_tb.title, notes_tb.description, subject_tb.subject_name, semester_tb.semester_name
                    FROM notes_tb
                    INNER JOIN subject_tb ON notes_tb.subject_id = subject_tb.subject_id
                    INNER JOIN semester_tb ON subject_tb.semester_id = semester_tb.semester_id

                    UNION ALL

                    SELECT 'lab' AS type, lab_tb.lab_id AS id, lab_tb.image, lab_tb.title, lab_tb.description, subject_tb.subject_name, semester_tb.semester_name
                    FROM lab_tb
                    INNER JOIN subject_tb ON lab_tb.subject_id = subject_tb.subject_id
                    INNER JOIN semester_tb ON subject_tb.semester_id = semester_tb.semester_id

                    UNION ALL

                    SELECT 'presentation' AS type, presentation_tb.presentation_id AS id, presentation_tb.image, presentation_tb.title, presentation_tb.description, subject_tb.subject_name, semester_tb.semester_name
                    FROM presentation_tb
                    INNER JOIN subject_tb ON presentation_tb.subject_id = subject_tb.subject_id
                    INNER JOIN semester_tb ON subject_tb.semester_id = semester_tb.semester_id ";

                $statement = $pdo->prepare($query);
                $statement->execute();
                $notes = $statement->fetchAll(PDO::FETCH_ASSOC);

                foreach ($notes as $note) {
                    $noteId = $note['id'];
                    $table = $note['type'];
                    $image = asset($note['image']);
                    $semesterName = htmlspecialchars($note['semester_name']);
                    $title = htmlspecialchars($note['title']);
                    $description = htmlspecialchars($note['description']);
                    $subjectName = htmlspecialchars($note['subject_name']);
                    $url = url('/pages/notes/notes/viewnotes.php?post_id=' . $noteId . '&tbl=' . $table);
                ?>
                    <a class="notes_link" href="<?= $url ?>">
                        <div class="notes-bottom-main-contents">
                            <div class="note-bottom-sem-section">
                                <img src="<?= $image ?>" alt="img">
                                <p><?= $semesterName ?></p>
                            </div>
                            <div class="note-bottom-title-section">
                                <h4><?= $title ?></h4>
                                <p><?= $description ?></p>
                            </div>
                            <div class="note-bottom-note-type-section">
                                <p><?= ucfirst($table) ?></p>
                                <p class="note-bottom-subject"><?= $subjectName ?></p>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>


            </div>
        </div>

    </section>
    <!-- footer -->
    <?php include 'C:/laragon/www/completeprojectbcatu/include/footer/Footer.php'; ?>

    <script src="../../../assets/js/jquery.js"></script>
    <script src="./notes.js"></script>
</body>

</html>