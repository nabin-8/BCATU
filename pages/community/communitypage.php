<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';
if (!isset($_COOKIE['user_id'])) {
    redirect('/pages/auth/Login.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="./images/favicon.png" type="image/png" sizes="16x16">
    <title>forum</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="../../assets/css/blogcss.css">
    <link rel="stylesheet" href="../../assets/css/communitystyle.css">
</head>

<body>
    <!-- Modal -->
    <div id="ReplyModal">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Reply Question</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form name="frm1" method="post">
                        <input type="hidden" id="commentid" name="Rcommentid">
                        <div class="form-group">
                            <label for="usr">Write your name:</label>
                            <input type="text" class="form-control" name="Rname" required>
                        </div>
                        <div class="form-group">
                            <label for="comment">Write your reply:</label>
                            <textarea class="form-control" rows="5" name="Rmsg" required></textarea>
                        </div>
                        <input type="button" id="btnreply" name="btnreply" class="btn btn-primary" value="Reply">
                    </form>
                </div>
            </div>

        </div>
    </div>


    <!-- community forum section starts here -->
    <section class="Community-forun-section">
        <div class="community-forum-container">
            <h2>Community forum</h2>
            <form name="frm" method="post">
                <input type="hidden" id="commentid" name="Pcommentid" value="0">
                <div class="community-form-inputes">
                    <label for="name">Write Your name:</label>
                    <div>
                        <input type="text" name="name" required>
                    </div>
                </div>
                <div class="community-form-inputes">
                    <label for="comment">Write Your question:</label>
                    <div>
                        <textarea cols="30" rows="10" name="msg" required></textarea>
                    </div>
                </div>
                <div class="community-forum-button">
                    <button value="Send" id="butsave" name="save">Send</button>
                </div>
            </form>
        </div>
    </section>
    <!-- community forum section ends here -->

    <div id="community-bottom-pannel" class="Community-forun-section">
        <div class="community-forum-container">
            <h4>Recent questions</h4>
            <table class="table" id="MyTable">
                <tbody id="record">
                </tbody>
            </table>
        </div>
    </div>

    </div>
    <script src="main.js"></script>
</body>

</html>