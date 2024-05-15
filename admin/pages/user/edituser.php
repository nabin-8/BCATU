<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set and not empty
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['semester']) && isset($_POST['college'])) {
        // Validate and sanitize user inputs (you may want to add more validation)
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $semester = htmlspecialchars($_POST['semester']);
        $college = htmlspecialchars($_POST['college']);

        // Update user profile in the database
        $query = "UPDATE user_tb SET username = ?, email = ?, semester = ?, college = ? WHERE user_id = ?"; // Assuming user_id is the primary key
        $statement = $pdo->prepare($query);
        $statement->execute([$name, $email, $semester, $college, $_SESSION['user_id']]); // Assuming you have user_id stored in a session variable
        // Redirect to the profile page or display a success message
        // header("Location: profile.php");
        // exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Profile</title>
    <link rel="stylesheet" href="../../assest/admincss/style.css">
    <link rel="stylesheet" href="../../assest/admincss/userprofile.css">
</head>

<body>
    <!-- top navbar start -->
    <?php include '../../include/dashboard_includes/header.php'; ?>
    <!-- top navbar end -->
    <!--sidebar starts -->
    <section id="left-sidebar-container">
        <?php include '../../include/dashboard_includes/sidebar.php'; ?>
        <div id="main-content-container">
            <div class="user-image-container">
                <div class="user-edit-image">
                    <input type="file" name="" id="">
                    <p>update image</p>
                </div>
            </div>
            <div class="user-profile-details">
                <div class="user-profile-details-main">
                    <div class="edit-profile-bottom">
                        <input type="text" placeholder="Edit Your Name">
                        <input type="text" placeholder="Email">
                    </div>
                    <div class="edit-profile-bottom">
                        <input type="text" placeholder="Semester">
                        <input type="text" placeholder="Collage">
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!--sidebar end -->
</body>

</html>