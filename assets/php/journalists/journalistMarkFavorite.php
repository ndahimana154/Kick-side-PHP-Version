<?php
session_start();
include("../global/server.php");
include("../journalists/session_mgt.php");
if (isset($_POST['article'])) {
    $articleId = $_POST['article'];
    $markFavorite = mysqli_query($server, "INSERT into journalists_favorites
            VALUES(null,'$acting_jou_id','$articleId',CURRENT_TIMESTAMP)
        ");
    if (!$markFavorite) {
?>
        <div class="failed">
            Failed to save the favorite. Don't worry it's our issue and you may report it.
        </div>
    <?php
    } else {
    ?>
        <div class="success">
            Saving the favorite article succed.
        </div>
<?php
    }
}
?>