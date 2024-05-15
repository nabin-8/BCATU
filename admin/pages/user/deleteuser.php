<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';

if (isset($_GET['user_id']) && $_GET['user_id'] !== '') {
    $query = "DELETE FROM user_tb WHERE user_id = ?"; // Changed table name and column name
    $statement = $pdo->prepare($query);
    $statement->execute([$_GET['user_id']]);
}

admin_redirect('/pages/user/user.php');
