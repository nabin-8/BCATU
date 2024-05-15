<?php
require_once '../../config/pdo_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if required fields are set
    if (isset($_POST['name'], $_POST['question']) || isset($_POST['commentId'], $_POST['replyName'], $_POST['replyMsg'])) {
        try {
            // Prepare statement
            $stmt = $conn->prepare("INSERT INTO community (parent_comment, student, post) VALUES (?, ?, ?)");

            // Bind parameters
            if (isset($_POST['commentId'], $_POST['replyName'], $_POST['replyMsg'])) {
                $parentId = $_POST['commentId'];
                $name = $_POST['replyName'];
                $msg = $_POST['replyMsg'];
            } else {
                $parentId = 0;
                $name = $_POST['name'];
                $msg = $_POST['question'];
            }
            $stmt->bindParam(1, $parentId);
            $stmt->bindParam(2, $name);
            $stmt->bindParam(3, $msg);

            // Execute statement
            $stmt->execute();

            // Provide success response
            echo json_encode(array("statusCode" => 200));
        } catch (PDOException $e) {
            // Provide error response
            echo json_encode(array("statusCode" => 500, "error" => $e->getMessage()));
        }
    } else {
        // Provide missing parameters error response
        echo json_encode(array("statusCode" => 400, "error" => "Missing parameters."));
    }
} else {
    // Provide method not allowed error response
    echo json_encode(array("statusCode" => 405, "error" => "Method Not Allowed."));
}
