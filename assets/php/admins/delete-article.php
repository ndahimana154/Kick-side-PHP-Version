<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../global/server.php");
include("../admins/session_checker.php");
if (isset($_POST['article'])) {
    $articleId = $_POST['article'];
    $checkExist = mysqli_query($server, "SELECT * from news_articles WHERE
        article_id = '$articleId'
    ");
    if (mysqli_num_rows($checkExist) < 1) {
?>
        <div class="errorMsg">
            The article doesn't even exist.
        </div>
<?php
    } else {
        $delete = mysqli_query($server, "DELETE from news_articles WHERE
            article_id = '$articleId'
        ");
        if(!$delete) {
            ?>
            <div class="errorMsg">
                Deleting the article failed. 
            </div>
            <?php
        }
        else {
            ?>
            <div class="successMsg">
                Article is deleted succesfully.
            </div>
            <?php

        }
    }
}
