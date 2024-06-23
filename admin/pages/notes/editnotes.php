<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';
require_once './notes_helper_functions.php';

$error = '';

// Redirect if post_id or tbl is not set
if (!isset($_GET['post_id'], $_GET['tbl'])) {
    admin_redirect('/pages/notes/notes.php');
}

$post_id = urldecode($_GET['post_id']);
$table = urldecode($_GET['tbl']);

// Adjust table name and post_id field based on the table
$post_id_field = $table . '_id';
$table = $table . '_tb';
if ($table == 'note_tb') {
    $table = 'notes_tb';
    $post_id_field = 'notes_id';
}

// Fetch the note
$query = "SELECT $table.*, subject_tb.subject_name, semester_tb.semester_name
          FROM $table
          INNER JOIN subject_tb ON $table.subject_id = subject_tb.subject_id
          INNER JOIN semester_tb ON subject_tb.semester_id = semester_tb.semester_id
          WHERE $table.$post_id_field = ?";
$statement = $pdo->prepare($query);
$statement->execute([$post_id]);
$note = $statement->fetch();

// Redirect if note does not exist
if ($note === false) {
    admin_redirect('/pages/notes/notes.php');
}

// Check if form submitted with required fields
if (
    isset($_POST['title'], $_POST['semester'], $_POST['notestype'], $_POST['subject'], $_POST['notebody']) &&
    !empty($_POST['title']) && !empty($_POST['semester']) && !empty($_POST['notestype']) && !empty($_POST['subject']) && !empty($_POST['notebody'])
) {
    $noteType = $_POST['notestype'];

    if (in_array($noteType, ['note', 'lab', 'presentation'])) {
        // Fetch the category details
        $query = "SELECT * FROM semester_tb WHERE semester_id = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$_POST['semester']]);
        $semester = $statement->fetch();

        // Proceed if semester found
        if ($semester !== false) {
            // Check if PDF file uploaded
            $pdfFetch = $note->file_path;
            if (isset($_FILES['file_url']) && $_FILES['file_url']['name'] !== '') {
                $pdfFetch = file_upload();
                if ($pdfFetch === false) {
                    $pdfFetch = $note->file_path;
                }
            }

            // Check if image uploaded
            $imageFetch = $note->image;
            if (isset($_FILES['note_image']) && $_FILES['note_image']['name'] !== '') {
                $imageFetch = image_upload();
                if ($imageFetch === false) {
                    $imageFetch = $note->image;
                }
            }

            // Update database with or without image
            $query = "UPDATE $table SET title = ?, semester_id = ?, notestype = ?, subject_id = ?, body = ?, file_path = ?, image = ?, updated_at = NOW() WHERE $post_id_field = ?";
            $statement = $pdo->prepare($query);
            $statement->execute([$_POST['title'], $_POST['semester'], $noteType, $_POST['subject'], $_POST['notebody'], $pdfFetch, $imageFetch, $post_id]);

            // Redirect after updating
            admin_redirect('/pages/notes/notes.php');
        } else {
            // Redirect if semester not found
            admin_redirect('/pages/notes/notes.php');
        }
    } else {
        $error = "Note Type is Not Selected";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Edit Notes</title>
    <link rel="stylesheet" href="../../assest/admincss/style.css">
    <link rel="stylesheet" href="../../assest/admincss/addnotes.css">
</head>

<body>
    <?php include '../../include/header.php'; ?>

    <!-- Sidebar starts -->
    <section id="left-sidebar-container">
        <?php include '../../include/sidebar.php'; ?>
        <div id="main-content-container">
            <div class="add-notes-main-container">
                <h2>Edit Notes</h2>
                <div class="add-notes-main">
                    <form action="<?= admin_url('/pages/notes/editnotes.php?post_id=' . urlencode($post_id) . '&tbl=' . urlencode($table)) ?>" method="post" enctype="multipart/form-data">
                        <div class="error-msg"><?php echo $error; ?></div>
                        <div class="add-notes-input-container">
                            <input name="title" class="add-notes-input" type="text" placeholder="Title" value="<?= htmlspecialchars($note->title) ?>">
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
                                    <option value="<?= $semester->semester_id ?>" <?= $semester->semester_id == $note->semester_id ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($semester->semester_name) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="add-notes-input-container">
                            <select name="notestype" id="notestype">
                                <option value="">Select Note Type...</option>
                                <option value="note" <?= $note->notestype == 'note' ? 'selected' : '' ?>>Note</option>
                                <option value="lab" <?= $note->notestype == 'lab' ? 'selected' : '' ?>>Lab Reports</option>
                                <option value="presentation" <?= $note->notestype == 'presentation' ? 'selected' : '' ?>>Presentation</option>
                            </select>
                        </div>
                        <div class="add-notes-input-container">
                            <select name="subject" id="subject">
                                <option value="">Select Subject</option>
                                <?php
                                $query = "SELECT * FROM subjects_tb;";
                                $statement = $pdo->prepare($query);
                                $statement->execute();
                                $subjects = $statement->fetchAll();
                                foreach ($subjects as $subject) : ?>
                                    <option value="<?= $subject->subject_id ?>" <?= $subject->subject_id == $note->subject_id ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($subject->subject_name) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="add-notes-input-container">
                            <textarea class="body-content-content same-inputs" name="notebody" id="notebody" placeholder="Body"><?= htmlspecialchars($note->body) ?></textarea>
                        </div>
                        <div class="add-notes-input-container submit-notes-files-container">
                            <div>
                                <label for="file_url">File</label>
                                <input name="file_url" id="file_url" type="file">
                            </div>
                            <div>
                                <label for="note_image">Image</label>
                                <input name="note_image" id="note_image" type="file">
                            </div>
                        </div>
                        <?php if ($note->file_path) : ?>
                            <div class="body-image-container">
                                <p>Current File: <a href="<?= asset($note->file_path) ?>" target="_blank">View</a></p>
                            </div>
                        <?php endif; ?>
                        <?php if ($note->image) : ?>
                            <div class="body-image-container">
                                <img src="<?= asset($note->image) ?>" alt="" width="150" height="100" />
                            </div>
                        <?php endif; ?>
                        <div class="add-notes-input-container submit-btn-container">
                            <button id="submit_btn" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Sidebar end -->
    <script src="../../assest/js/jquery.js"></script>
    <script src="./main.js"></script>
</body>

</html>