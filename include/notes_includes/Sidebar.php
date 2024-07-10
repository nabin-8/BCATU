<?php
require_once 'C:/laragon/www/BCATU/config/pdo_connection.php';
require_once 'C:/laragon/www/BCATU/config/helpers.php';
?>


<!-- sidebar -->
<div id="main-sidebar-container">
    <div class="sidebar-content">
        <div>
            <a class="notes-rounded-section" href="<?= notes_url('/syllabus/syllabus.php') ?>">S</a>
        </div>
        <div>
            <a class="notes-rounded-section" href="<?= notes_url('/syllabus/syllabus.php') ?>">N</a>
        </div>
        <div>
            <a class="notes-rounded-section" href="<?= notes_url('/syllabus/syllabus.php') ?>">L</a>
        </div>
        <div>
            <a class="notes-rounded-section" href="<?= notes_url('/syllabus/syllabus.php') ?>">P</a>
        </div>
    </div>
</div>