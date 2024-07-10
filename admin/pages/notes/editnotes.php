<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';
require_once './notes_helper_functions.php';

$error = '';

if (!isset($_GET['post_id'], $_GET['tbl'])) {
    admin_redirect('/pages/notes/notes.php');
}

$post_id = urldecode($_GET['post_id']);
$table = urldecode($_GET['tbl']);
$colid = str_replace('_tb', '_id', $table);
//$post_id_field = $table . '_id';
//
//$table = $table . '_tb';
//
//if ($table == 'note_tb') {
//    $table = 'notes_tb';
//    $post_id_field = 'notes_id';
//}

$query = "SELECT $table.*, subject_tb.subject_name, semester_tb.semester_name
          FROM $table
          INNER JOIN subject_tb ON $table.subject_id = subject_tb.subject_id
          INNER JOIN semester_tb ON subject_tb.semester_id = semester_tb.semester_id
          WHERE $table.$colid = ?";
$statement = $pdo->prepare($query);
$statement->execute([$post_id]);
$note = $statement->fetch();

if ($note === false) {
    admin_redirect('/pages/notes/notes.php');
}

if (
    isset($_POST['title'], $_POST['semester'], $_POST['notestype'], $_POST['subject'], $_POST['notebody']) &&
    !empty($_POST['title']) && !empty($_POST['semester']) && !empty($_POST['notestype']) && !empty($_POST['subject']) && !empty($_POST['notebody'])
) {
    $noteType = $_POST['notestype'];

    if (in_array($noteType, ['note', 'lab', 'presentation'])) {
        $query = "SELECT * FROM semester_tb WHERE semester_id = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$_POST['semester']]);
        $semester = $statement->fetch();

        if ($semester !== false) {
            $pdfFetch = $note->file_path;
            if (isset($_FILES['file_url']) && $_FILES['file_url']['name'] !== '') {
                $pdfFetch = file_upload();
                if ($pdfFetch === false) {
                    $pdfFetch = $note->file_path;
                }
            }

            $imageFetch = $note->image;
            if (isset($_FILES['note_image']) && $_FILES['note_image']['name'] !== '') {
                $imageFetch = image_upload();
                if ($imageFetch === false) {
                    $imageFetch = $note->image;
                }
            }

            $query = "UPDATE $table SET title = ?, subject_id = ?, description = ?, file_path = ?, image = ? WHERE $colid = ?";
            $statement = $pdo->prepare($query);
            $statement->execute([$_POST['title'], $_POST['subject'], $_POST['notebody'], $pdfFetch, $imageFetch, $post_id]);

            admin_redirect('/pages/notes/notes.php');
        } else {
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
                            $query = "SELECT * FROM semester_tb";
                            $statement = $pdo->prepare($query);
                            $statement->execute();
                            $semesters = $statement->fetchAll(PDO::FETCH_OBJ);
                            foreach ($semesters as $semester) : ?>
                                <option value="<?= $semester->semester_id ?>" <?= $semester->semester_id === $note->notes_id ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($semester->semester_name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="add-notes-input-container">
                        <select name="notestype" id="notestype">
                            <option value="">Select Note Type...</option>
                            <option value="note" <?= $table == 'notes_tb' ? 'selected' : '' ?>>Note</option>
                            <option value="lab" <?= $table == 'lab_tb' ? 'selected' : '' ?>>Lab Reports</option>
                            <option value="presentation" <?= $table == 'presentation_tb' ? 'selected' : '' ?>>Presentation</option>
                        </select>
                    </div>
                    <div class="add-notes-input-container">
                        <select name="subject" id="subject">
                            <option value="">Select Subject</option>
                            <?php
                            $query = "SELECT * FROM subject_tb";
                            $statement = $pdo->prepare($query);
                            $statement->execute();
                            $subjects = $statement->fetchAll(PDO::FETCH_OBJ);
                            foreach ($subjects as $subject) : ?>
                                <option value="<?= $subject->subject_id ?>" <?= $subject->subject_id == $note->subject_id ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($subject->subject_name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="add-notes-input-container">
                        <textarea class="body-content-content same-inputs" name="notebody" id="notebody" placeholder="Body"><?= htmlspecialchars($note->description) ?></textarea>
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
<script src="../../assest/js/jquery.js"></script>
<script src="./main.js"></script>
</body>

</html>
