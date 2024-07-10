<?php
require_once '../../config/pdo_connection.php';

try {
    // Fetch data from database
    $query = "SELECT 
        c.*,
        u.username,
        u.image 
    FROM 
        community_tb c
    LEFT JOIN 
        user_tb u ON c.user_id = u.user_id
    ORDER BY 
        c.parent_comment_id DESC ";

    $statement = $pdo->prepare($query);
    $statement->execute(); // Execute the query
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Return data as JSON
    echo json_encode($data);
} catch (PDOException $e) {
    echo json_encode(array("error" => $e->getMessage()));
}
