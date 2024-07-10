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

    // Corrected: Pass the parameter to execute
    $query = "SELECT * FROM $tbl_name WHERE $tbl_id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$post_id]);
    $post = $statement->fetch();

    if ($post) {
        // Deleting the post's image file if it exists
        $basePath = dirname(dirname(__DIR__));
        if (file_exists($basePath . $post->image) || file_exists($basePath . $post->file_path)) {
            if (file_exists($basePath . $post->image)) {
                unlink($basePath . $post->image);
            }
            if (file_exists($basePath . $post->file_path)) {
                unlink($basePath . $post->file_path);
            }
        }

        // Corrected: Pass the parameter to execute
        $query = "DELETE FROM $tbl_name WHERE $tbl_id = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$post_id]);
    }
}

admin_redirect('/pages/notes/notes.php');
