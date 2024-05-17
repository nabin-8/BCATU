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
                <input type="text" placeholder="Search notes,labes..." name="" id="">
            </div>
            <div class="notes-section-left-contents">
                <select name="semester" id="semester">
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
                </select>
            </div>
            <div class="notes-section-left-contents">
                <select name="notetype" id="notetype">
                    <option value="">Select Note Type</option>
                    <option value="notes_tb">Note</option>
                    <option value="lab_tb">Lab</option>
                    <option value="presentation_tb">Presentation</option>
                </select>
            </div>
            <div class="notes-section-left-contents">
                <select name="subject" id="subject">
                    <option value="">Select Subject</option>
                </select>
            </div>
        </div>
        <!-- notes section right bottom -->
        <div class="notes-section-right-bottom-wraper">
            <div class="notes-section-right-bottom-main">
                <div class="notes-bottom-main-contents">
                    <!-- <div class="note-bottom-sem-section">
                        <img src="../../../assets/images/notes/bcatu.svg" alt="img">
                        <p>sem</p>
                    </div>
                    <div class="note-bottom-title-section">
                        <h4>BCA Notes</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, repellat.</p>
                    </div>
                    <div class="note-bottom-note-type-section">
                        <p>Lab</p>
                        <p>CFA</p>
                    </div> -->
                    <p>Search or Select Notes by Options</p>
                </div>
            </div>
        </div>

    </section>
    <!-- footer -->
    <?php include 'C:/laragon/www/completeprojectbcatu/include/footer/Footer.php'; ?>

    <script src="../../../assets/js/jquery.js"></script>
    <script src="./notes.js"></script>
</body>

</html>