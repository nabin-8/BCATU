<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';

$error = '';

function validate_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validate_username($username)
{
    // Ensure the username is between 3 and 20 characters and contains only letters, numbers, underscores, or hyphens
    return preg_match('/^[a-zA-Z0-9_-]{3,20}$/', $username);
}

function validate_password($password)
{
    // Ensure the password is at least 6 characters long
    return strlen($password) > 5;
}

if (
    isset($_POST['email']) && $_POST['email'] !== ''
    && isset($_POST['username']) && $_POST['username'] !== ''
    && isset($_POST['college']) && $_POST['college'] !== ''
    && isset($_POST['semester_id']) && $_POST['semester_id'] !== ''
    && isset($_POST['password']) && $_POST['password'] !== ''
    && isset($_POST['confirm']) && $_POST['confirm'] !== ''
) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $college = $_POST['college'];
    $semester_id = $_POST['semester_id'];

    if (validate_email($email) && validate_username($username) && validate_password($password)) {
        if ($password === $confirm) {
            $query = "SELECT * FROM user_tb WHERE email = ?;";
            $statement = $pdo->prepare($query);
            $statement->execute([$email]);
            $user = $statement->fetch();

            if ($user === false) {
                $query = "INSERT INTO user_tb SET email = ?, username = ?, college = ?, semester_id = ?, password = ?, created_at = NOW() ;";
                $statement = $pdo->prepare($query);
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $statement->execute([$email, $username, $college, $semester_id, $hashed_password]);
                redirect('/pages/auth/Login.php');
            } else {
                $error = 'This email already exists';
            }
        } else {
            $error = 'Passwords do not match';
        }
    } else {
        if (!validate_email($email)) {
            $error = 'Invalid email format';
        } elseif (!validate_username($username)) {
            $error = 'Username must be 3-20 characters long and can contain letters, numbers, underscores, or hyphens';
        } elseif (!validate_password($password)) {
            $error = 'Password must be more than 5 characters';
        }
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
                    <input type="text" name="username" placeholder="Full Name" class="input-form" value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" />
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email Address" class="input-form" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" />
                </div>
                <div class="form-group">
                    <input type="text" name="college" placeholder="College" class="input-form" value="<?= isset($_POST['college']) ? htmlspecialchars($_POST['college']) : '' ?>" />
                </div>
                <div class="form-group">
                    <select name="semester_id" id="semester-selections">
                        <?php
                        $query = "SELECT * FROM semester_tb;";
                        $statement = $pdo->prepare($query);
                        $statement->execute();
                        $semesters = $statement->fetchAll();

                        foreach ($semesters as $semester) { ?>
                            <option value="<?= $semester->semester_id ?>" <?= (isset($_POST['semester_id']) && $_POST['semester_id'] == $semester->semester_id) ? 'selected' : '' ?>><?= $semester->semester_name ?></option>
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