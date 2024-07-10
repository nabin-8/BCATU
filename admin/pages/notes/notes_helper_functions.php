<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';

// upload image
function image_upload()
{
    global $error, $imageFetch, $image_upload;
    $allowedMimes = ['png', 'jpg', 'gif', 'jpeg', 'svg'];
    $imageMime = pathinfo($_FILES['note_image']['name'], PATHINFO_EXTENSION); // Changed input name
    if (!in_array($imageMime, $allowedMimes)) {
        $error = 'Only PNG, JPG, GIF, and JPEG, svg images are allowed';
        return false;
    }
    $imageFetch = '/assets/images/notes/' . date('Y_m_d_H_i_s') . '.' . $imageMime;
    $imageUpload = 'C:/laragon/www/BCATU' . $imageFetch;

    $image_upload = move_uploaded_file($_FILES['note_image']['tmp_name'], $imageUpload);
    if (!$image_upload) {
        $error = 'Failed to upload image';
        return false;
    }

    return $imageFetch;
}
// upload image


// upload file pdf

function file_upload()
{
    global $error, $pdfFetch, $pdf_upload;
    $allowedMimes = ['pdf'];
    $imageMime = pathinfo($_FILES['file_url']['name'], PATHINFO_EXTENSION); // Changed input name
    if (!in_array($imageMime, $allowedMimes)) {
        $error = 'Only PDF files are allowed';
        return false;
    }

    $pdfFetch = '/assets/uploads/' . date('Y_m_d_H_i_s') . '.' . $imageMime;
    $pdfUpload = 'C:/laragon/www/BCATU' . $pdfFetch;
    $pdf_upload = move_uploaded_file($_FILES['file_url']['tmp_name'], $pdfUpload);
    if (!$pdf_upload) {
        $error = 'Failed to upload file';
        return false;
    }

    return $pdfFetch;
}

// upload file pdf

// helper function for notes, presentation, lab


function upload_notes_all_required($pdfFetch, $imageFetch, $noteType, $pdo)
{
    $table = checkNoteType($noteType);
    if ($table) {
        $query = "INSERT INTO $table (subject_id, title, description, file_path, image) VALUES (?, ?, ?, ?, ?)";
        $statement = $pdo->prepare($query);
        $statement->execute([$_POST['subject'], $_POST['title'], $_POST['notebody'], $pdfFetch, $imageFetch]);
        admin_redirect('/pages/notes/notes.php');
    }
}

function upload_notes_without_image($pdfFetch, $noteType, $pdo)
{
    $table = checkNoteType($noteType);
    if ($table) {
        $query = "INSERT INTO $table (subject_id, title, description, file_path) VALUES (?, ?, ?, ?)";
        $statement = $pdo->prepare($query);
        $statement->execute([$_POST['subject'], $_POST['title'], $_POST['notebody'], $pdfFetch]);
        admin_redirect('/pages/notes/notes.php');
    }
}

function checkNoteType($noteType)
{
    $tables = [
        'note' => 'notes_tb',
        'presentation' => 'presentation_tb',
        'lab' => 'lab_tb'
    ];

    return $tables[$noteType] ?? '';
}
