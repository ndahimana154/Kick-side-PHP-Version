<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
include("../global/server.php");
include("../admins/session_checker.php");
if (isset($_POST['history'])) {
    $history_id = $_POST['history'];
    $checkifhistoryexists = mysqli_query($server, "SELECT * from history_today
        WHERE ht_id = '$history_id'
    ");
    if (mysqli_num_rows($checkifhistoryexists) < 1) {
        ?>
        <div class="failed">
            The history article is not found.
        </div>
        <?php
    } else {
        $delete = mysqli_query($server, "DELETE from history_today
            WHERE ht_id = '$history_id'
        ");
        if (!$delete) {
            ?>
            <div class="failed">
                The History today is not deleted. You may contact IT support.
            </div>
            <?php
        } else
        ?>
        <div class="success">
            The History today article is deleted successfully.
        </div>
        <?php
    }
}

?>