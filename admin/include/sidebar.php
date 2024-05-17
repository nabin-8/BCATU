<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';
?>


<!-- sidebar -->
<div id="main-sidebar-container">
    <div class="sidebar-content">
        <a href="<?= admin_url('/pages/index.php') ?>">Panel</a>
        <a href="<?= admin_url('/pages/user/user.php') ?>">User</a>
        <a href="<?= admin_url('/pages/blogs/blogs.php') ?>">Blogs</a>
        <a href="<?= admin_url('/pages/notes/notes.php') ?>">Notes</a>
        <a href="<?= admin_url('/pages/category/category.php') ?>">Category</a>
        <a href="<?= admin_url('/pages/notes/addnotes.php') ?>">Add Notes</a>
    </div>
</div>