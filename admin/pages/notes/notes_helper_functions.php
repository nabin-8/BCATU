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
    $imageUpload = 'C:/laragon/www/completeprojectbcatu' . $imageFetch;

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
    $pdfUpload = 'C:/laragon/www/completeprojectbcatu' . $pdfFetch;
    $pdf_upload = move_uploaded_file($_FILES['file_url']['tmp_name'], $pdfUpload);
    if (!$pdf_upload) {
        $error = 'Failed to upload file';
        return false;
    }

    return $pdfFetch;
}

// upload file pdf

// helper function for notes

function notes_all_required($pdfFetch, $imageFetch, $pdo)
{
    $query = "INSERT INTO notes_tb (subject_id, title, description, file_path, image) VALUES (?, ?, ?, ?, ?)";
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['subject'], $_POST['title'], $_POST['notebody'], $pdfFetch, $imageFetch]);
    admin_redirect('/pages/notes/notes.php');
}

function notes_without_image($pdfFetch, $pdo)
{
    $pdfFetch = image_upload();
    $query = "INSERT INTO notes_tb (subject_id, title, description, file_path) VALUES (?, ?, ?, ?)";
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['subject'], $_POST['title'], $_POST['notebody'], $pdfFetch]);
    admin_redirect('/pages/notes/notes.php');
}

// helper function for notes


// helper function for lab

function lab_all_required($pdfFetch, $imageFetch, $pdo)
{
    $query = "INSERT INTO lab_tb (subject_id, title, description, file_path, image) VALUES (?, ?, ?, ?, ?)";
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['subject'], $_POST['title'], $_POST['notebody'], $pdfFetch, $imageFetch]);
    admin_redirect('/pages/notes/notes.php');
}

function lab_without_image($pdfFetch, $pdo)
{
    $pdfFetch = image_upload();
    $query = "INSERT INTO lab_tb (subject_id, title, description, file_path) VALUES (?, ?, ?, ?)";
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['subject'], $_POST['title'], $_POST['notebody'], $pdfFetch]);
    admin_redirect('/pages/notes/notes.php');
}

// helper function for lab


// helper function for presentation

function presentation_all_required($pdfFetch, $imageFetch, $pdo)
{
    $query = "INSERT INTO presentation_tb (subject_id, title, description, file_path, image) VALUES (?, ?, ?, ?, ?)";
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['subject'], $_POST['title'], $_POST['notebody'], $pdfFetch, $imageFetch]);
    admin_redirect('/pages/notes/notes.php');
}

function presentation_without_image($pdfFetch, $pdo)
{
    $pdfFetch = image_upload();
    $query = "INSERT INTO presentation_tb (subject_id, title, description, file_path) VALUES (?, ?, ?, ?)";
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['subject'], $_POST['title'], $_POST['notebody'], $pdfFetch]);
    admin_redirect('/pages/notes/notes.php');
}

// helper function for presentation
