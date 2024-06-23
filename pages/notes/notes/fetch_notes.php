<?php
require_once 'C:/laragon/www/completeprojectbcatu/config/pdo_connection.php';
require_once 'C:/laragon/www/completeprojectbcatu/config/helpers.php';

if (isset($_POST['note_type'])) {
    if (!($_POST['note_type'] === '')) {
        $noteType = $_POST['note_type'];


        $query = "SELECT $noteType.*, semester_tb.semester_name, 
        subject_tb.subject_name, 
        $noteType.title, 
        $noteType.description,
        '$noteType' as tbl
        FROM $noteType 
        INNER JOIN subject_tb ON $noteType.subject_id = subject_tb.subject_id 
        INNER JOIN semester_tb ON subject_tb.semester_id = semester_tb.semester_id;";
        $statement = $pdo->prepare($query);
        $statement->execute();

        $notes = $statement->fetchAll(PDO::FETCH_NUM);
        // echo "<pre>";
        // print_r($notes);
        $table = '';
        switch ($noteType) {
            case 'notes_tb':
                $table = 'notes';
                break;
            case 'presentation_tb':
                $table = 'presentation';
                break;
            case 'lab_tb':
                $table = 'lab';
                break;
            default:
                $table = '';
        }
        if ($notes) {
            foreach ($notes as $note) {
                $noteId = $note[0];
                // $table = $note['tbl'];
                // echo $noteId . $table;
                $url = url('/pages/notes/notes/viewnotes.php?post_id=' . $noteId . '&tbl=' . $table);
?>
                <a class="notes_link" href="<?= $url ?>">
                    <div class="notes-bottom-main-contents">
                        <div class="note-bottom-sem-section">
                            <img src="<?= asset($note[5]); ?>" alt="img">
                            <p><?= $note[6] ?></p>
                        </div>
                        <div class="note-bottom-title-section">
                            <h4><?= $note[8] ?></h4>
                            <p><?= $note[9] ?></p>
                        </div>
                        <div class="note-bottom-note-type-section">
                            <p>Subject</p>
                            <p class="note-bottom-subject"><?= $note[7] ?></p>
                        </div>
                    </div>
                </a>
<?php
            }
        } else {
            echo "<p style='text-align:center;' >No notes found for the selected type.</p>";
        }
    } else {
        echo "<p style='text-align:center;' >Note type not provided.</p>";
    }
} else {
    echo "<p style='text-align:center;' >Note type not provided.</p>";
}
?>