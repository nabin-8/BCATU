<?php
session_start();
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';

session_destroy();
// setcookie('user_id', '', time() - 3600, '/');
setcookie('user_cookie', '', time() - (86400 * 30), "/");
redirect('/index.php');
