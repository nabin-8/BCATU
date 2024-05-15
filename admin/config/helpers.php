<?php

//config
define('BASE_URL', 'http://localhost/completeprojectbcatu');
define('BLOG_URL', 'http://localhost/completeprojectbcatu/pages/blog');
define('CSS_URL', 'http://localhost/completeprojectbcatu/assetes/css');
define('ADMIN_URL', 'http://localhost/completeprojectbcatu/admin');
define('NOTES_URL', 'http://localhost/completeprojectbcatu/pages/notes');

function redirect($url)
{
     header('Location: ' . trim(BASE_URL, '/ ')  . '/' . trim($url, '/'));
     exit;
}
// header('Location: index.php');
// redirect('index.php');

function asset($file)
{
     return trim(BASE_URL, '/ ') . '/' . trim($file, '/');
}
// echo asset('assets/css/style.css');

function url($url)
{
     return trim(BASE_URL, '/ ') . '/' . trim($url, '/');
}
function blog_url($url)
{
     return trim(BLOG_URL, '/ ') . '/' . trim($url, '/');
}
function css_url($url)
{
     return trim(CSS_URL, '/ ') . '/' . trim($url, '/');
}
function admin_url($url)
{
     return trim(ADMIN_URL, '/ ') . '/' . trim($url, '/');
}

function admin_redirect($url)
{
     header('Location: ' . trim(ADMIN_URL, '/ ')  . '/' . trim($url, '/'));
     exit;
}
// echo url('create.php');

function dd($var)
{
     echo '<pre>';
     var_dump($var);
     exit;
}
// function imageAsset($file)
// {
//      return trim('http://localhost/', '/ ') . '/' . trim($file, '/');
// }
