<?php
session_start();
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';

$error = '';

function validate_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

if (
    isset($_POST['email']) && $_POST['email'] !== ''
    && isset($_POST['password']) && $_POST['password'] !== ''
) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (validate_email($email)) {
        $query = "SELECT * FROM user_tb WHERE email = ?;";
        $statement = $pdo->prepare($query);
        $statement->execute([$email]);
        $user = $statement->fetch();

        if ($user !== false) {
            if (password_verify($password, $user->password)) {
                $_SESSION['user'] =  $user->email;
                $is_admin = $user->role;
                if ($is_admin == 'admin') {
                    $_SESSION['is_admin'] = true;
                    redirect('/admin/pages/index.php');
                } else {
                    $user_id = $user->user_id;
                    setcookie("user_cookie", $user_id, time() + (86400 * 30), "/");
                    redirect('/index.php');
                }
            } else {
                $error = 'Password is incorrect';
            }
        } else {
            $error = 'Email is incorrect';
        }
    } else {
        $error = 'Invalid email format';
    }
} else {
    if (!empty($_POST)) {
        $error = 'All fields are required';
    }
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
                    <input class="input-form" type="email" name="email" placeholder="Email Address" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" />
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