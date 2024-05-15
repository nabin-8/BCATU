<?php
require_once 'file:///C:/laragon/www/completeprojectbcatu/config/pdo_connection.php';
require_once 'file:///C:/laragon/www/completeprojectbcatu/config/helpers.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCATU | WELCOME YOU</title>
    <!-- <link rel="stylesheet" href="./assets/css/blog/blogcss.css">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="./assets/css/header/header.css">
    <link rel="stylesheet" href="./assets/css/footer/footer.css"> -->
    <link rel="stylesheet" href="./assets/css/blog/blogcss.css">
    <link rel="stylesheet" href="./assets/css/blog/addblog.css">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="./assets/css/header/header.css">
    <link rel="stylesheet" href="./assets/css/footer/footer.css">
</head>

<body>
    <!-- header css end -->
    <?php
    include_once './include/header/Header.php';
    ?>
    <!-- header css start -->
    <div class="main">
        <div class="rows row-1">
            <div class="data grid">
                <div class="cols col-1 grid-items">
                    <img src="./assets/images/book_reading_1.png" alt="Image" />
                </div>
                <div class="cols col-2 grid-items">
                    <h1>Create an invite-only place where you belong</h1>
                    <div class="description">
                        BCATU is a place where you can belong
                        to a school club, a college group, or a
                        neighborhood meeting. A place that you
                        can call your own. A place that you can
                        call home.
                    </div>
                </div>
            </div>
        </div>

        <div class="rows row-2">
            <div class="data grid">
                <div class="cols col-1 image grid-items">
                    <img src="./assets/images/book_reading_1.png" alt="Image" />
                </div>
                <div class="cols col-2 grid-items">
                    <h1>Create an invite-only place where you belong</h1>
                    <div class="description">
                        BCATU is a place where you can belong
                        to a school club, a college group, or a
                        neighborhood meeting. A place that you
                        can call your own. A place that you can
                        call home.
                    </div>
                </div>
            </div>
        </div>

        <div class="rows row-3">
            <div class="data grid">
                <div class="cols col-1 image grid-items">
                    <img src="./assets/images/book_reading_1.png" alt="Image" />
                </div>
                <div class="cols col-2 grid-items">
                    <h1>Create an invite-only place where you belong</h1>
                    <div class="description">
                        BCATU is a place where you can belong
                        to a school club, a college group, or a
                        neighborhood meeting. A place that you
                        can call your own. A place that you can
                        call home.
                    </div>
                </div>
            </div>
        </div>

        <div class="rows row-4">
            <div class="data grid">
                <div class="cols col-1 image grid-items">
                    <img src="./assets/images/book_reading_1.png" alt="Image" />
                </div>
                <div class="cols col-2 grid-items">
                    <h1>Create an invite-only place where you belong</h1>
                    <div class="description">
                        BCATU is a place where you can belong
                        to a school club, a college group, or a
                        neighborhood meeting. A place that you
                        can call your own. A place that you can
                        call home.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer css end -->
    <?php require_once './include/footer/Footer.php'; ?>
    <!-- footer css start -->
</body>

</html>