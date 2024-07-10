<?php

require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';
require_once './notes_helper_functions.php';

function adjust_table_name($table_name) {
    // Remove one _tb if present twice
    if (substr($table_name, -6) === '_tb_tb') {
        $table_name = substr($table_name, 0, -3); // Remove last 3 characters ('_tb')
    }

    // Add _tb suffix if the table name is notes, lab, or presentation and not already ends with _tb
    if (in_array($table_name, ['notes', 'lab', 'presentation']) && substr($table_name, -3) !== '_tb') {
        $table_name .= '_tb';
    }

    return $table_name;
}

function adjust_id_field($field_name) {
    // Remove duplicate _id if present twice
    if (substr($field_name, -6) === '_id_id') {
        $field_name = substr($field_name, 0, -3); // Remove last 3 characters ('_id')
    }

    // Add _id suffix if the field name is notes, lab, or presentation and not already ends with _id
    if (in_array($field_name, ['notes', 'lab', 'presentation']) && substr($field_name, -3) !== '_id') {
        $field_name .= '_id';
    }

    return $field_name;
}

if (
    isset($_POST['title'], $_POST['semester'], $_POST['notestype'], $_POST['subject'], $_POST['notebody']) &&
    !empty($_POST['title']) && !empty($_POST['semester']) && !empty($_POST['notestype']) && !empty($_POST['subject']) && !empty($_POST['notebody'])
) {
    $noteType = $_POST['notestype'];

    if (in_array($noteType, ['note', 'lab', 'presentation'])) {
        // Fetch the category details
        $query = "SELECT * FROM semester_tb WHERE semester_id = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$_POST['semester']]);
        $semester = $statement->fetch();

        // Proceed if semester found
        if ($semester !== false) {
            // Check if PDF file uploaded
            $pdfFetch = $note->file_path;
            if (isset($_FILES['file_url']) && $_FILES['file_url']['name'] !== '') {
                $pdfFetch = file_upload();
                if ($pdfFetch === false) {
                    $pdfFetch = $note->file_path;
                }
            }

            // Check if image uploaded
            $imageFetch = $note->image;
            if (isset($_FILES['note_image']) && $_FILES['note_image']['name'] !== '') {
                $imageFetch = image_upload();
                if ($imageFetch === false) {
                    $imageFetch = $note->image;
                }
            }

            // Adjust table name and post_id field based on the table
            $post_id = urldecode($_GET['post_id']);
            $table = urldecode($_GET['tbl']);
            $table = adjust_table_name($table);
            $post_id_field = adjust_id_field($table);

            // Update database with or without image
            $query = "UPDATE $table SET title = ?, semester_id = ?, notestype = ?, subject_id = ?, body = ?, file_path = ?, image = ?, updated_at = NOW() WHERE $post_id_field = ?";
            $statement = $pdo->prepare($query);
            $statement->execute([$_POST['title'], $_POST['semester'], $noteType, $_POST['subject'], $_POST['notebody'], $pdfFetch, $imageFetch, $post_id]);

            // Redirect after updating
            admin_redirect('/pages/notes/notes.php');
        } else {
            // Redirect if semester not found
            admin_redirect('/pages/notes/notes.php');
        }
    } else {
        $error = "Note Type is Not Selected";
    }
}
