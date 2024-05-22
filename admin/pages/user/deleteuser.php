<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';

if (isset($_GET['user_id']) && $_GET['user_id'] !== '') {
    $user_id = $_GET['user_id'];

    // Start a transaction
    $pdo->beginTransaction();

    try {
        // Delete related records in community_tb if any
        $query = "DELETE FROM community_tb WHERE user_id = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$user_id]);

        // Delete related records in blogs_tb if any
        $query = "DELETE FROM blogs_tb WHERE user_id = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$user_id]);

        // Delete the user record in user_tb
        $query = "DELETE FROM user_tb WHERE user_id = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$user_id]);

        // Commit the transaction
        $pdo->commit();
    } catch (Exception $e) {
        // Rollback the transaction if something goes wrong
        $pdo->rollBack();
        throw $e;
    }
}

admin_redirect('/pages/user/user.php');
