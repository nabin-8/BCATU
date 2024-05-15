<?php
require_once 'C:/laragon/www/completeprojectbcatu/config/pdo_connection.php';

if (isset($_POST['semester_id'])) {
    $semesterId = $_POST['semester_id'];
    $query = "SELECT * FROM subject_tb WHERE semester_id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$semesterId]);
    $subjects = $statement->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($subjects);
}
