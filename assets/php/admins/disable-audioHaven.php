<div style="padding:10px">
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    session_start();
    include("../global/server.php");
    include("../admins/session_checker.php");
    if (isset($_POST['haven'])) {
        $havenId = $_POST['haven'];
        $checkIfHavenExists = mysqli_query($server, "SELECT * from audio_havens
                WHERE haven_id = '$havenId'
            ");
        if (mysqli_num_rows($checkIfHavenExists) < 1) {
            ?>
            <div class="failed">
                Haven id doesn't exists.
            </div>
            <?php
        } else {
            $disable = mysqli_query($server, "UPDATE audio_havens
                    SET haven_status = 'Disabled'
                    WHERE haven_id = '$havenId'
                ");
            if (!$disable) {
                ?>
                <div class="failed">
                    The Audio Haven failed to be disabled.
                </div>
                <?php
            } else {
                ?>
                <div class="success">
                    The audio haven is disabled successfully.
                </div>
                <?php
            }
        }
    }
    ?>
</div>