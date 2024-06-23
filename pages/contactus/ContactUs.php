<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';
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
    <!-- Blogg section start -->
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
                <form action="#contact-us-form-link" method="post" class="contact-form">
                    <div class="contact-form-fname">
                        <label for="contactFname">First name*</label><br />
                        <input type="text" name="contactFname" id="contactFname" required>
                    </div>

                    <div class="contact-form-lname">
                        <label for="contactLname">Last name</label><br />
                        <input type="text" name="contactLname" id="contactLname">
                    </div>

                    <div class="contact-form-email">
                        <label for="contactEmail">Email*</label><br />
                        <input type="text" name="contactEmail" id="contactEmail" required>
                    </div>

                    <div class="contact-form-msg">
                        <label for="contactMessage">What can we help you with?</label><br />
                        <textarea name="contactMessage" id="contactMessage" rows="5" required></textarea>
                    </div>

                    <div class="contact-form-submit">
                        <input type="submit" id="contactSubmit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer starts  -->
    <section><?php require_once '../../include/footer/Footer.php'; ?></section>
    <!-- Footer ends -->
</body>

</html>