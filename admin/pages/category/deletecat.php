<?php
require_once '../../config/helpers.php';
require_once '../../config/pdo_connection.php';


$errorMsg = '';
if (isset($_GET['cat_id']) && $_GET['cat_id'] !== '') {
    $cat_id = $_GET['cat_id'];


    $check_query = "SELECT COUNT(*) AS blog_count FROM blogs_tb WHERE cat_id = ?";
    $check_statement = $pdo->prepare($check_query);
    $check_statement->execute([$cat_id]);
    $result = $check_statement->fetch(PDO::FETCH_ASSOC);

    $blog_count = $result['blog_count'];

    if ($blog_count > 0) {

        $errorMsg = "Cannot delete category: there are $blog_count blogs associated with it. You must delete or reassign the blogs first.";
    } else {

        $delete_query = "DELETE FROM blog_categories_tb WHERE blog_cat_id = ?";
        $delete_statement = $pdo->prepare($delete_query);
        $delete_statement->execute([$cat_id]);


        $deleted = $delete_statement->rowCount();

        if ($deleted > 0) {

            $errorMsg = "Category deleted successfully.";
            admin_redirect('/pages/category/category.php');
        } else {

            $errorMsg = "Failed to delete category. Please try again.";
        }
    }
}

if (isset($errorMsg)) {
?>
    <p><?= $errorMsg ?></p>
    <a href="<?= admin_url('/pages/category/category.php'); ?>">Back</a>
<?php
}

?>