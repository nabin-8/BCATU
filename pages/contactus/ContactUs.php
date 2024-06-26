<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function validate_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

$errMail = '';
$errFname = '';
$errLname = '';
$errMsg = '';

if (isset($_POST['send'])) {
    $fname = validate_input($_POST['contactFname']);
    $lname = validate_input($_POST['contactLname']);
    $email = validate_input($_POST['contactEmail']);
    $msg = validate_input($_POST['contactMessage']);

    $errors = 0;

    // Validate first name
    if (!preg_match("/^[a-zA-Z\s]+$/", $fname)) {
        $errFname = "First name can only contain letters and spaces.";
        $errors += 1;
    }

    // Validate last name (optional)
    if (!empty($lname) && !preg_match("/^[a-zA-Z\s]+$/", $lname)) {
        $errLname = "Last name can only contain letters and spaces.";
        $errors += 1;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errMail = "Invalid email format.";
        $errors += 1;
    }

    // Validate message
    if (empty($msg)) {
        $errMsg = "Message cannot be empty.";
        $errors += 1;
    }

    if ($errors === 0) {
        // Load Composer's autoloader
        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';

        // Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            // Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'nabin74000@gmail.com';                     // SMTP username
            $mail->Password   = 'tzjimovysavupwsx';                               // SMTP password 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
            $mail->Port       = 465;                                    // TCP port to connect to

            // Recipients
            $mail->setFrom('nabin74000@gmail.com', 'Contact Form');
            $mail->addAddress('librarycode1@gmail.com', 'BCATU');     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Test Contact Form';
            $mail->Body    = "Sender Name: $fname $lname <br> Sender Email: $email <br> Message: $msg";

            $mail->send();
            echo "<div class='success'>Success: Mail Has Been Sent!</div>";
        } catch (Exception $e) {
            echo "<div class='failed'>Failed: Unable to send mail!</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCATU | Contact Us</title>
    <link rel="stylesheet" href="../../assets/css/header/header.css">
    <link rel="stylesheet" href="../../assets/css/footer/footer.css">
    <link rel="stylesheet" href="../../assets/css/contactus/contactus.css">
</head>

<body>
    <?php require_once '../../include/header/Header.php'; ?>
    <div class="contact-main">
        <div class="contact-row">
            <div class="contact-cols contact-col-1">
                <h1 class="contact-heading">Contact Us</h1>
                <div class="contact-desc">
                    Need to get in touch with us? Either fill out the form
                    with your inquiry or find the
                    <a href="#contact-email-here" class="contact-email-link">
                        <t style="color: #9CA3AF;  text-decoration:none; ">department email</t>
                    </a>
                    you'd like to contact below.
                </div>
            </div>
            <div class="contact-cols contact-col-2">
                <form action="ContactUs.php" method="post" class="contact-form">
                    <div class="contact-form-fname">
                        <label for="contactFname">First name*</label><br />
                        <input type="text" name="contactFname" id="contactFname" required>
                        <?= !empty($errFname) ? '<span class="error">' . $errFname . '</span>' : '' ?>
                    </div>
                    <div class="contact-form-lname">
                        <label for="contactLname">Last name</label><br />
                        <input type="text" name="contactLname" id="contactLname">
                        <?= !empty($errLname) ? '<span class="error">' . $errLname . '</span>' : '' ?>
                    </div>
                    <div class="contact-form-email">
                        <label for="contactEmail">Email*</label><br />
                        <input type="text" name="contactEmail" id="contactEmail" required>
                        <?= !empty($errMail) ? '<span class="error">' . $errMail . '</span>' : '' ?>
                    </div>
                    <div class="contact-form-msg">
                        <label for="contactMessage">What can we help you with?</label><br />
                        <textarea name="contactMessage" id="contactMessage" rows="5" required></textarea>
                        <?= !empty($errMsg) ? '<span class="error">' . $errMsg . '</span>' : '' ?>
                    </div>
                    <div class="contact-form-submit">
                        <input name="send" type="submit" id="contactSubmit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <section><?php require_once '../../include/footer/Footer.php'; ?></section>
</body>

</html>