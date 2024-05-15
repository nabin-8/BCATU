<?php
require_once 'C:/laragon/www/completeprojectbcatu/config/pdo_connection.php';
require_once 'C:/laragon/www/completeprojectbcatu/config/helpers.php';

$query = "SELECT user_tb.*, semester_tb.semester_name 
          FROM user_tb 
          JOIN semester_tb ON user_tb.semester_id = semester_tb.semester_id 
          WHERE user_tb.user_id = ?";
$statement = $pdo->prepare($query);
$user_id = $_COOKIE['user_cookie'];
$statement->execute([$user_id]);
$user = $statement->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes | Syllabus</title>
    <!-- <link rel="stylesheet" href="../../../assets/css/syllabus/syllabus.css"> -->
    <link rel="stylesheet" href="../../../assets/css/notes/note-sec.css">
    <link rel="stylesheet" href="../../../assets/css/header/header.css">
    <link rel="stylesheet" href="../../../assets/css/footer/footer.css">
</head>

<body>
    <!-- top navbar start -->
    <?php include 'C:/laragon/www/completeprojectbcatu/include/header/Header.php'; ?>
    <!-- top navbar end -->
    <section class="notes-container-wraper">
        <div class="notes-section-left-wraper">
            <div class="notes-section-left-contents">
                <input type="text" placeholder="Search notes,labes..." name="" id="">
            </div>
            <div class="notes-section-left-contents">
                <select name="" id="">
                    <optgroup label="Select Semester">
                        <?php
                        $query = "SELECT * FROM semester_tb;";
                        $statement = $pdo->prepare($query);
                        $statement->execute();
                        $semesters = $statement->fetchAll();
                        foreach ($semesters as $semester) : ?>
                            <option value="<?= $semester->semester_id ?>" <?= $semester->semester_id === $user->semester_id ? 'selected' : '' ?>>
                                <?= $semester->semester_name ?>
                            </option>
                        <?php endforeach; ?>
                    </optgroup>
                </select>
            </div>
            <div class="notes-section-left-contents">
                <select name="" id="">
                    <optgroup>
                        <option value="">Note</option>
                        <option value="">Lab</option>
                        <option value="">Presentation</option>
                    </optgroup>
                </select>
            </div>
            <div class="notes-section-left-contents">
                <select name="" id="">
                    <optgroup label="Select Semester">
                        <?php
                        $query = "SELECT * FROM subject_tb;";
                        $statement = $pdo->prepare($query);
                        // $statement->execute([$user_id]);
                        $statement->execute();
                        $subjects = $statement->fetchAll();
                        foreach ($subjects as $subject) : ?>
                            <option value="<?= $subject->subject_id ?>"><?= $subject->subject_name ?></option>
                            </option>
                        <?php endforeach; ?>
                    </optgroup>
                </select>
            </div>
        </div>
        <!-- notes section right bottom -->
        <div class="notes-section-right-bottom-wraper">
            <div class="notes-section-right-bottom-main">
                <div class="notes-bottom-main-contents">
                    <div class="note-bottom-sem-section">
                        <img src="https://cdn.pixabay.com/photo/2020/05/01/14/15/music-sheet-5117328_1280.jpg" alt="img">
                        <p>sem</p>
                    </div>
                    <div class="note-bottom-title-section">
                        <h4>BCA Notes</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, repellat.</p>
                    </div>
                    <div class="note-bottom-note-type-section">
                        <p>Lab</p>
                        <p>CFA</p>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- footer -->
    <?php include 'C:/laragon/www/completeprojectbcatu/include/footer/Footer.php'; ?>
</body>

</html>