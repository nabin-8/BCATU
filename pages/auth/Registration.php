<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';

$error = '';
if (
    isset($_POST['email']) && $_POST['email'] !== ''
    && isset($_POST['username']) && $_POST['username'] !== ''
    && isset($_POST['college']) && $_POST['college'] !== ''
    && isset($_POST['semester_id']) && $_POST['semester_id'] !== ''
    && isset($_POST['password']) && $_POST['password'] !== ''
    && isset($_POST['confirm']) && $_POST['confirm'] !== ''
) {

    if ($_POST['password'] === $_POST['confirm']) {
        if (strlen($_POST['password']) > 5) {
            $query = "SELECT * FROM user_tb WHERE email = ?;";
            $statement = $pdo->prepare($query);
            $statement->execute([$_POST['email']]);
            $user = $statement->fetch();
            if ($user === false) {
                $query = "INSERT INTO user_tb SET email = ?, username = ?, college = ?,semester_id=?, password = ?, created_at = NOW() ;";
                $statement = $pdo->prepare($query);
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $statement->execute([$_POST['email'], $_POST['username'],  $_POST['college'], $_POST['semester_id'], $password]);
                redirect('/pages/auth/Login.php');
            } else {
                $error = 'This email already exists';
            }
        } else {
            $error = 'Password must be more than 5 characters';
        }
    } else {
        $error = 'Password does not match the certificate';
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
    <title>BCATU | Registration</title>
    <link rel="stylesheet" href="../../assets/css/auth/login.css">
</head>

<body>
    <!-- Registration Form Box -->
    <div class="main">
        <div class="container">
            <h2 class="heding">Register</h2>
            <div style="color: red;" class="message"><?php if ($error !== '') echo $error; ?></div>
            <form action="<?= url('pages/auth/Registration.php') ?>" method="post">
                <div class="form-group">
                    <input type="text" name="username" placeholder="Full Name" class="input-form" />
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email Address" class="input-form" />
                </div>
                <div class="form-group">
                    <input type="text" name="college" placeholder="college" class="input-form" />
                </div>
                <div class="form-group">
                    <select name="semester_id" id="semester-selections">
                        <?php

                        $query = "SELECT * FROM semester_tb;";
                        $statement = $pdo->prepare($query);
                        $statement->execute();
                        $semesters = $statement->fetchAll();

                        foreach ($semesters as $semester) { ?>
                            <option value="<?= $semester->semester_id ?>"><?= $semester->semester_name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" class="input-form" />
                </div>
                <div class="form-group">
                    <input type="password" name="confirm" placeholder="Confirm Password" class="input-form" />
                </div>
                <button type="submit" class="login-btn">
                    Register
                </button>

                <p class="regester">
                    Already have an account?
                    <a class="regester-link" href="Login.php">Login</a>
                </p>
            </form>
        </div>
</body>

</html>