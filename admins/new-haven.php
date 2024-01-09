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
    <title>Kickside || Admins New haven</title>
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
                            New Haven
                        </h1>
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
                                    $haimagename = $_FILES['hai']['name'];
                                    
                                    $target_dir = '../assets/audio_havens/';
                                    $new_imagename = "Podcast Cover - " . $haname . ".webp";

                                    $target_file = $target_dir . $new_imagename;

                                    // Check if the history title doesn't exist
                                    $checkhaname = mysqli_query($server, "SELECT * from audio_havens
                                            WHERE haven_title = '$haname'
                                    ");
                                    if ($hajou == 'Not selected') {
                                        ?>
                                        <div class="errorMsg">
                                            Please select Journalist.
                                        </div>
                                        <?php
                                    }
                                    if (mysqli_num_rows($checkhaname) > 0) {
                                        ?>
                                        <div class="errorMsg">
                                            The Audio Haven already found.
                                        </div>
                                        <?php
                                    } elseif (move_uploaded_file($_FILES['hai']['tmp_name'], $target_file)) {
                                        $save = mysqli_query($server, "INSERT INTO `audio_havens` (`haven_id`, `haven_title`, `haven_description`, `haven_image_name`, `haven_link`, `haven_upload date`, `haven_upload_time`, `haven_journalist`, `other_participants`, `haven_status`) 
                                            VALUES (NULL, '$haname', '$hadesc', '$new_imagename','$haylink', '$hast','$hatime', '$hajou','$haop', 'Running')
                                        ");
                                        if ($save) {
                                            ?>
                                            <div class="successMsg">
                                                Saving the Audio Haven succed.
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="errorMsg">
                                                The Audio Haven saving failed.
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="errorMsg">
                                            Uploading the History image failed.
                                        </div>
                                        <?php
                                    }
                                }

                                ?>
                                <p>
                                    <label for="Audio Haven Name">
                                        Audio Haven Name
                                    </label>
                                    <textarea name="han" placeholder="Type..." required></textarea>
                                </p>
                                <p>
                                    <label for="Audio Haven Journalist">
                                        Audio Haven Journalist
                                    </label>
                                    <select name="haj">
                                        <option value="Not selected">Select Journalist</option>
                                        <?php
                                        $get_jours = mysqli_query($server, "SELECT * from journalists
                                            ORDER BY first_name ASC,
                                            last_name ASC
                                        ");
                                        if (mysqli_num_rows($get_jours) < 1) {
                                            ?>
                                            <option value="Not selected">
                                                No Journalist.
                                            </option>
                                            <?php
                                        } else {
                                            while ($dataJours = mysqli_fetch_array($get_jours)) {
                                                ?>
                                                <option value="<?php echo $dataJours['id'] ?>">
                                                    <?php echo $dataJours['first_name'] . " " . $dataJours['last_name']; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </p>
                                <p>
                                    <label for="Audio Haven Other Particpants">
                                        Audio Haven Other Participants
                                    </label>
                                    <textarea name="hop" placeholder="Type..." required></textarea>
                                </p>
                                <p>
                                    <label for="Audio Haven Upload Date">
                                        Audio Haven Upload date.
                                    </label>
                                    <input type="date" name="has" id="">
                                </p>
                                <p>
                                    <label for="Audio Haven Upload Date">
                                        Audio Haven Upload time.
                                    </label>
                                    <input type="time" name="hat" id="">
                                </p>
                                <p>
                                    <label for="Audio Haven Description">
                                        Audio Haven Description
                                    </label>
                                    <textarea name="had" placeholder="Type..." required></textarea>
                                </p>
                                <p>
                                    <label for="Audio Haven Youtube Link">
                                        Audio Haven Youtube Link
                                    </label>
                                    <textarea name="hyl" placeholder="Type..." required></textarea>
                                </p>
                                <p>
                                    <label for="Audio Haven Image">
                                        Audio Haven Image
                                    </label>
                                    <input type="file" name="hai" required>
                                </p>
                                <p>
                                    <button type="submit" name="new_haven">
                                        <i class="fa fa-save"></i>
                                        Save
                                    </button>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>
    <script src="../assets/js/journalistsToggleNav.js"></script>
</body>

</html>