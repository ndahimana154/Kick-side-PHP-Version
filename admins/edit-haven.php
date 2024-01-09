<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../assets/php/global/server.php");
include("../assets/php/admins/session_checker.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/back-main.css">
    <link rel="icon" href="../assets/images/favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Kickside || Admins Edit haven</title>
</head>

<body>
    <main>
        <section class="main-section">
            <?php include("../assets/php/admins/header.php"); ?>
            <div class="hero">
                <?php include("../assets/php/admins/left-nav.php") ?>
                <div class="dashboard">
                    <div class="dashboard-cont">
                        <h1>
                            Edit Audio Haven
                        </h1>
                        <?php
                        if (!isset($_GET['h'])) {
                            ?>
                            <div class="errorMsg">
                                No request sent to the server.
                            </div>
                            <?php
                        } else {
                            $havenId = $_GET['h'];
                            // Check if the Haven exists
                            $checkHavenExists = mysqli_query($server, "SELECT * from 
                                    audio_havens,journalists
                                    WHERE audio_havens.haven_journalist = journalists.id
                                    AND audio_havens.haven_id = '$havenId'
                                ");
                            if (mysqli_num_rows($checkHavenExists) < 1) {
                                ?>
                                <div class="errorMsg">
                                    Audio Haven doesn't exists.
                                </div>
                                <?php
                            } else {
                                $dataHavenExists = mysqli_fetch_array($checkHavenExists);
                                ?>
                                <div class="form-row">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <?php

                                        if (isset($_POST['new_haven'])) {
                                            $haname = mysqli_real_escape_string($server, $_POST['han']);
                                            $hajou = mysqli_real_escape_string($server, $_POST['haj']);
                                            $hast = mysqli_real_escape_string($server, $_POST['has']);
                                            $hatime = mysqli_real_escape_string($server, $_POST['hat']);
                                            $hadesc = mysqli_real_escape_string($server, $_POST['had']);
                                            $haylink = mysqli_real_escape_string($server, $_POST['hyl']);
                                            $haop = mysqli_real_escape_string($server, $_POST['hop']);

                                            // Check if the history title doesn't exist
                                            $checkhaname = mysqli_query($server, "SELECT * from audio_havens
                                                    WHERE haven_title = '$haname'
                                                    AND haven_id != '$havenId'
                                            ");

                                            if (mysqli_num_rows($checkhaname) > 0) {
                                                ?>
                                                <div class="errorMsg">
                                                    The Audio Haven already found.
                                                </div>
                                                <?php
                                            }
                                            $update = mysqli_query($server, "UPDATE `audio_havens` SET 
                                                `haven_title`='$haname', 
                                                `haven_description`='$hadesc', 
                                                `haven_link`='$haylink', 
                                                `haven_upload date`='$hast', 
                                                `haven_upload_time`='$hatime', 
                                                `haven_journalist`='$hajou', 
                                                `other_participants`='$haop'
                                                WHERE haven_id = '$havenId'
                                                ");
                                            if ($update) {
                                                ?>
                                                <div class="successMsg">
                                                    Updating the Audio Haven succed.
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="errorMsg">
                                                    The Audio Haven updating failed.
                                                </div>
                                                <?php

                                            }
                                        }

                                        ?>
                                        <p>
                                            <label for="Audio Haven Name">
                                                Audio Haven Name
                                            </label>
                                            <textarea name="han" placeholder="Type..."
                                                required><?php echo $dataHavenExists['haven_title'] ?></textarea>
                                        </p>
                                        <p>
                                            <label for="Audio Haven Journalist">
                                                Audio Haven Journalist
                                            </label>
                                            <select name="haj">
                                                <option value="<?php echo $journalstId = $dataHavenExists['id'] ?>">
                                                    <?php
                                                    echo $dataHavenExists['first_name'] . " " . $dataHavenExists['last_name'];
                                                    ?>
                                                </option>
                                                <?php
                                                $get_jours = mysqli_query($server, "SELECT * from journalists
                                                    WHERE id != '$journalistId'
                                                    ORDER BY first_name ASC,
                                                    last_name ASC
                                                ");
                                                while ($dataJours = mysqli_fetch_array($get_jours)) {
                                                    ?>
                                                    <option value="<?php echo $dataJours['id'] ?>">
                                                        <?php echo $dataJours['first_name'] . " " . $dataJours['last_name']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </p>
                                        <p>
                                            <label for="Audio Haven Other Particpants">
                                                Audio Haven Other Participants
                                            </label>
                                            <textarea name="hop" placeholder="Type..."
                                                required><?php echo $dataHavenExists['other_participants'] ?></textarea>
                                        </p>
                                        <p>
                                            <label for="Audio Haven Upload Date">
                                                Audio Haven Upload date.
                                            </label>
                                            <input type="date" name="has"
                                                value="<?php echo $dataHavenExists['haven_upload date'] ?>">
                                        </p>
                                        <p>
                                            <label for="Audio Haven Upload Date">
                                                Audio Haven Upload time.
                                            </label>
                                            <input type="time" name="hat"
                                                value="<?php echo $dataHavenExists['haven_upload_time'] ?>">
                                        </p>
                                        <p>
                                            <label for="Audio Haven Description">
                                                Audio Haven Description
                                            </label>
                                            <textarea name="had" placeholder="Type..."
                                                required><?php echo $dataHavenExists['haven_description'] ?></textarea>
                                        </p>
                                        <p>
                                            <label for="Audio Haven Youtube Link">
                                                Audio Haven Youtube Link
                                            </label>
                                            <textarea name="hyl" placeholder="Type..."
                                                required><?php echo $dataHavenExists['haven_link'] ?></textarea>
                                        </p>

                                        <p>
                                            <button type="submit" name="new_haven">
                                                <i class="fa fa-save"></i>
                                                Save
                                            </button>
                                        </p>
                                    </form>
                                </div>
                                <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </section>


    </main>
    <script src="../assets/js/journalistsToggleNav.js"></script>
</body>

</html>