<?php
require_once 'C:/laragon/www/BCATU/config/pdo_connection.php';
require_once 'C:/laragon/www/BCATU/config/helpers.php';

if (isset($_POST['search_note'])) {
    if (!($_POST['search_note'] === '')) {
        $searchNote = '%' . $_POST['search_note'] . '%';

        try {

            $query = "
                SELECT 'note' AS type, notes_tb.notes_id AS id, notes_tb.title, notes_tb.description, notes_tb.image, semester_tb.semester_name, subject_tb.subject_name 
                FROM notes_tb 
                INNER JOIN subject_tb ON notes_tb.subject_id = subject_tb.subject_id 
                INNER JOIN semester_tb ON subject_tb.semester_id = semester_tb.semester_id 
                WHERE notes_tb.title LIKE :searchNote
                UNION
                SELECT 'presentation' AS type, presentation_tb.presentation_id AS id, presentation_tb.title, presentation_tb.description, presentation_tb.image, semester_tb.semester_name, subject_tb.subject_name 
                FROM presentation_tb 
                INNER JOIN subject_tb ON presentation_tb.subject_id = subject_tb.subject_id 
                INNER JOIN semester_tb ON subject_tb.semester_id = semester_tb.semester_id 
                WHERE presentation_tb.title LIKE :searchNote
                UNION
                SELECT 'lab' AS type, lab_tb.lab_id AS id, lab_tb.title, lab_tb.description, lab_tb.image, semester_tb.semester_name, subject_tb.subject_name 
                FROM lab_tb 
                INNER JOIN subject_tb ON lab_tb.subject_id = subject_tb.subject_id 
                INNER JOIN semester_tb ON subject_tb.semester_id = semester_tb.semester_id 
                WHERE lab_tb.title LIKE :searchNote
            ";
            $statement = $pdo->prepare($query);
            $statement->bindParam(':searchNote', $searchNote, PDO::PARAM_STR);
            $statement->execute();

            $notes = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Unable to find: " . $e->getMessage();
        }

        if (isset($notes) && count($notes) > 0) {
            foreach ($notes as $note) {
                $noteId = $note['id'];
                $table = $note['type'];
                $url = url('/pages/notes/notes/viewnotes.php?post_id=' . $noteId . '&tbl=' . $table);
?>
                <a class="notes_link" href="<?= $url ?>">
                    <div class="notes-bottom-main-contents">
                        <div class="note-bottom-sem-section">
                            <img src="<?= asset($note['image']); ?>" alt="img">
                            <p><?= $note['semester_name'] ?></p>
                        </div>
                        <div class="note-bottom-title-section">
                            <h4><?= $note['title'] ?></h4>
                            <p><?= $note['description'] ?></p>
                        </div>
                        <div class="note-bottom-note-type-section">
                            <p>Subject</p>
                            <p class="note-bottom-subject"><?= $note['subject_name'] ?></p>
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