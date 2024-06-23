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
                    <img src="./assets/images/home.svg" alt="Image" />
                </div>
                <div class="cols col-2 grid-items">
                    <h1>BCATU</h1>
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
                    <img src="./assets/images/notes.svg" alt="Image" />
                </div>
                <div class="cols col-2 grid-items">
                    <h1>Notes <t style="color: #9CA3AF;">|</t> Presentation <t style="color: #9CA3AF;">|</t> Lab Reports</h1>
                    <div class="description">
                        BCATU offers a comprehensive notes section that includes lecture notes, presentation slides, and lab reports. This well-organized repository caters to diverse academic needs, making it easy for members to find and utilize educational materials. It supports exam preparation, project work, and general study, encouraging the sharing of knowledge and resources within the community.
                    </div>
                </div>
            </div>
        </div>

        <div class="rows row-3">
            <div class="data grid">
                <div class="cols col-1 image grid-items">
                    <img src="./assets/images/blogs.svg" alt="Image" />
                </div>
                <div class="cols col-2 grid-items">
                    <h1>Blogs <t style="color: #9CA3AF;">|</t> Articles</h1>
                    <div class="description">
                        BCATU’s blog section is a vibrant space where members can share insights, stories, and updates on a wide range of topics. From academic advice and career tips to personal anecdotes and community news, the blogs provide a platform for expression and connection. They help members stay informed, gain new perspectives, and contribute to the collective wisdom of the BCATU community.
                    </div>
                </div>
            </div>
        </div>

        <div class="rows row-4">
            <div class="data grid">
                <div class="cols col-1 image grid-items">
                    <img src="./assets/images/community.svg" alt="Image" />
                </div>
                <div class="cols col-2 grid-items">
                    <h1>Community</h1>
                    <div class="description">
                        The community aspect of BCATU is central to its mission. It brings people together through a supportive network where members can interact, share experiences, and collaborate on various initiatives. BCATU hosts events, discussions, and activities tailored to its diverse user base, fostering engagement, unity, and a sense of belonging among members.
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