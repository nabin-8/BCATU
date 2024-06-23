<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';
require_once './notes_helper_functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requiredFields = ['title', 'semester', 'notestype', 'subject', 'notebody'];
    $missingFields = array_diff($requiredFields, array_keys(array_filter($_POST)));

    if (!empty($missingFields)) {
        $error = "All Fields are required";
    } else {
        $noteType = $_POST['notestype'];
        if (in_array($noteType, ['note', 'lab', 'presentation'])) {
            $pdfFetch = file_upload();
            if ($pdfFetch !== '') {
                if (!empty($_FILES['note_image']['name'])) {
                    $imageFetch = image_upload();
                    if ($imageFetch !== '') {
                        upload_notes_all_required($pdfFetch, $imageFetch, $noteType, $pdo);
                    }
                } else {
                    upload_notes_without_image($pdfFetch, $noteType, $pdo);
                }
            }
        } else {
            $error = "Note Type is Not Selected";
        }
    }
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