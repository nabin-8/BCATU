<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';


if (isset($_GET['post_id']) && isset($_GET['tbl'])) {
    $post_id = urldecode($_GET['post_id']);
    $tbl_name = urldecode($_GET['tbl']);
    $tbl_id = str_replace('_tb', '_id', $tbl_name);

//    $tbl_id = $tbl_name . '_id';
//    $tbl_name = $tbl_name . '_tb';
//    if ($tbl_name == 'note_tb') {
//        $tbl_name = 'notes_tb';
//        $tbl_id = 'notes_id';
//    }

    $query = "
    SELECT 
        'note' AS type, 
        $tbl_name.*, 
        subject_tb.subject_name, 
        semester_tb.semester_name
    FROM 
        $tbl_name
    INNER JOIN 
        subject_tb ON $tbl_name.subject_id = subject_tb.subject_id
    INNER JOIN 
        semester_tb ON subject_tb.semester_id = semester_tb.semester_id
    WHERE 
        $tbl_name.$tbl_id = :post_id"; // Assuming 'note_id' is the correct column

    $statement = $pdo->prepare($query);
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->execute();
    $note = $statement->fetch();

    if ($note) {
        // Process your $note data here
        // echo "<pre>";
        // print_r($note);
    } else {
        echo "Note not found.";
    }
}

$file1 = $note->file_path;
$file1 = asset($file1);
// echo $file1;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes | View</title>
    <!-- <link rel="stylesheet" href="../../../assets/css/notes/note-sec.css"> -->
    <link rel="stylesheet" href="../../assest/admincss/note-view.css">
    <link rel="stylesheet" href="../../assest/admincss/style.css">
    <link rel="stylesheet" href="../../assest/admincss/userprofile.css">
</head>

<body>
    <!-- top navbar start -->
    <!-- top navbar start -->
    <?php include '../../include/header.php'; ?>
    <!-- top navbar end -->

    <!-- sidebar include end -->
    <div class="note-view-wraper-main">
        <div class="note-view-main">
            <div class="note-view-top-section">
                <div class="note-view-bottom-pdf-view">
                    <iframe id="myframe" src="view_pdf.php?file=<?php echo urlencode($file1); ?>"></iframe>
                    </iframe>
                </div>
                <div class="note-image-view-container">
                    <img src="<?= asset($note->image) ?>" alt="Note Image">
                    <h3>Title: <?= $note->title ?></h3>
                    <p>semester: <?= $note->semester_name ?></p>
                    <p>Subject: <?= $note->subject_name ?></p>
                    <p><?= $note->description ?></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>