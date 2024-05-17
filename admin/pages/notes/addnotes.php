<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';
require_once './notes_helper_functions.php';

$error = '';

if (
    isset($_POST['title'], $_POST['semester'], $_POST['notestype'], $_POST['subject'], $_POST['notebody'], $_FILES['file_url']['name'], $_FILES['note_image']['name']) &&
    !empty($_POST['title']) && !empty($_POST['semester']) && !empty($_POST['notestype']) && !empty($_POST['subject']) && !empty($_POST['notebody'])
) {

    if ($_POST['notestype'] === 'note') {
        if (isset($_FILES['note_image']['name']) && !empty($_FILES['note_image']['name'])) {
            $imageFetch = image_upload();
            $pdfFetch = file_upload();
            if ($pdf_upload !== false && $image_upload !== false) {
                notes_all_required($pdfFetch, $imageFetch, $pdo);
            }
        } else {
            $pdfFetch = file_upload();
            if ($pdf_upload !== false) {
                notes_without_image($pdfFetch, $pdo);
            }
        }
    } elseif ($_POST['notestype'] === 'lab') {
        if (isset($_FILES['note_image']['name']) && !empty($_FILES['note_image']['name'])) {
            $imageFetch = image_upload();
            $pdfFetch = file_upload();
            if ($pdf_upload !== false && $image_upload !== false) {
                lab_all_required($pdfFetch, $imageFetch, $pdo);
            }
        } else {
            $pdfFetch = file_upload();
            if ($pdf_upload !== false) {
                lab_without_image($pdfFetch, $pdo);
            }
        }
    } elseif ($_POST['notestype'] === 'presentation') {
        if (isset($_FILES['note_image']['name']) && !empty($_FILES['note_image']['name'])) {
            $imageFetch = image_upload();
            $pdfFetch = file_upload();
            if ($pdf_upload !== false && $image_upload !== false) {
                presentation_all_required($pdfFetch, $imageFetch, $pdo);
            }
        } else {
            $pdfFetch = file_upload();
            if ($pdf_upload !== false) {
                presentation_without_image($pdfFetch, $pdo);
            }
        }
    } else {
        $error = "Note Type is Not Selected";
    }
} else {
    $error = "All Fields are required";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Add Notes</title>
    <link rel="stylesheet" href="../../assest/admincss/style.css">
    <link rel="stylesheet" href="../../assest/admincss/addnotes.css">
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
            <div class="add-notes-main-container">
                <h2>Add Notes</h2>
                <div class="add-notes-main">
                    <form action="<?= admin_url('/pages/notes/addnotes.php') ?>" method="post" enctype="multipart/form-data">
                        <div class="error-msg"><?php echo $error; ?></div>
                        <div class="add-notes-input-container">
                            <input name="title" class="add-notes-input" type="text" placeholder="Title">
                        </div>
                        <div class="add-notes-input-container">
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
                        <div class="add-notes-input-container">
                            <select name="notestype" id="notestype">
                                <option value="">Select Note Type...</option>
                                <option value="note">Note</option>
                                <option value="lab">Lab Reports</option>
                                <option value="presentation">Presentation</option>
                            </select>
                        </div>
                        <div class="add-notes-input-container">
                            <select name="subject" id="subject">
                                <option value="">Select Subject</option>
                            </select>
                        </div>
                        <div class="add-notes-input-container">
                            <textarea class="body-content-content same-inputs" name="notebody" id="notebody" placeholder="Body"></textarea>
                        </div>
                        <div class="add-notes-input-container submit-notes-files-container">
                            <div>
                                <label for="file_url">file_url</label>
                                <input name="file_url" id="file_url" type="file">
                            </div>
                            <div>
                                <label for="image">image</label>
                                <input name="note_image" type="file">
                            </div>
                        </div>
                        <div class="add-notes-input-container submit-btn-container">
                            <button id="submit_btn" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--sidebar end -->
    <script src="../../assest/js/jquery.js"></script>
    <script src="./main.js"></script>
</body>

</html>