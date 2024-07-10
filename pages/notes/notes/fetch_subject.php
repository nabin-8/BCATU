<?php
require_once 'C:/laragon/www/BCATU/config/pdo_connection.php';

if (isset($_POST['semester_id'])) {
    $semesterId = $_POST['semester_id'];
    $query = "SELECT * FROM subject_tb WHERE semester_id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$semesterId]);
    $subjects = $statement->fetchAll(PDO::FETCH_ASSOC);

    $options = "<option value=''>Select Subject</option>";

    // Check if subjects exist
    if ($subjects) {
        foreach ($subjects as $subject) {
            $options .= "<option value='{$subject['subject_id']}'>{$subject['subject_name']}</option>";
        }
    } else {
        $options .= "<option value=''>No subjects found</option>";
    }

    // Echo options string
    echo $options;
} else {
    echo "<option value=''>Semester ID not provided</option>";
}
