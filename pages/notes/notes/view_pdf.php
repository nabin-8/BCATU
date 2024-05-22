<?php
require_once 'C:/laragon/www/completeprojectbcatu/config/helpers.php';
if (isset($_GET['file'])) {
    $file1 = urldecode($_GET['file']);

    header('Content-type:application/pdf');
    header('Content-Description:inline; filename=" ' . asset($file1) . '"');
    header('Content-Transfer-Encoding:binary');
    header('Accept-Ranges:bytes');
    @readfile($file1);
}
