<?php
session_start();
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';

$error = '';
if (
    isset($_POST['email']) && $_POST['email'] !== ''
    && isset($_POST['password']) && $_POST['password'] !== ''
) {

    $query = "SELECT * FROM user_tb WHERE email = ?;";
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['email']]);
    $user = $statement->fetch();
    if ($user !== false) {
        if (password_verify($_POST['password'], $user->password)) {
            $_SESSION['user'] =  $user->email;
            $is_admin = $user->role;
            if ($is_admin == 'admin') {
                redirect('/admin/pages/index.php');
            } else {
                $user_id = $user->user_id;
                setcookie("user_cookie", $user_id, time() + (86400 * 30), "/");
                // setcookie('user_id', $user_id, time() - 3600 * 24 * 7, '/');
                redirect('/index.php');
            }
        } else {
            $error = 'password is wrong';
        }
    } else {
        $error = 'Email is wrong';
    }
} else {
    if (!empty($_POST))
        $error = 'All fields are required';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCATU | Login</title>
    <link rel="stylesheet" href="../../assets/css/auth/login.css">
</head>

<body>
    <!-- Login Form Box -->
    <div class="main">
        <div class="container">
            <h2 class="heding">Login</h2>
            <div style="color: red;" class="message"><?php if ($error !== '') echo $error; ?></div>
            <form action="<?= url('pages/auth/Login.php') ?>" method="post">
                <div class="form-group">
                    <input class="input-form" type="email" name="email" placeholder="Email Address" />
                </div>
                <div class="form-group">
                    <input class="input-form" type="password" name="password" placeholder="Password" />
                </div>
                <button type="submit" class="login-btn">
                    Login
                </button>

                <p class="regester">
                    Don't have an account?

                    <a class="regester-link" href="Registration.php">Register</a>
                </p>
            </form>
        </div>
    </div>

</body>

</html>
</body>

</html>