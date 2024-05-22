<?php
require_once '../../config/pdo_connection.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json'); // Ensure JSON response

// Retrieve POST parameters
$id = $_POST['id'] ?? '';
$user_id = $_COOKIE['user_cookie'] ?? '';
$msg = $_POST['msg'] ?? '';

if ($user_id != "" && $msg != "") {
    try {
        $query = "INSERT INTO community_tb (user_id, parent_comment_id, post, created_at) VALUES (?, ?, ?, NOW())";
        $statement = $pdo->prepare($query);
        $statement->execute([$user_id, $id, $msg]);

        echo json_encode(array("statusCode" => 200));
    } catch (PDOException $e) {
        echo json_encode(array("statusCode" => 500, "error" => $e->getMessage()));
    }
} else {
    echo json_encode(array("statusCode" => 201, "error" => "Missing parameters."));
}
$pdo = null;
