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
    <title>Kickside || Admins New history</title>
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
                            New History
                        </h1>
                        <div class="form-row">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <?php

                                if (isset($_POST['new_history'])) {
                                    $htitle = mysqli_real_escape_string($server, $_POST['hti']);
                                    $hgenre = mysqli_real_escape_string($server, $_POST['h_ge']);
                                    $hdates = mysqli_real_escape_string($server, $_POST['hda']);
                                    $hdesc = mysqli_real_escape_string($server, $_POST['hde']);
                                    $himagename = $_FILES['him']['name'];

                                    $target_dir = '../assets/history/';
                                    $new_imagename = "History image - " . $htitle . ".webp";

                                    $target_file = $target_dir . $new_imagename;

                                    // Check if the history title doesn't exist
                                    $checkhtitle = mysqli_query($server, "SELECT * from history_today
                                    WHERE history_title = '$htitle'
                                ");
                                    if ($hgenre == 'Not selected') {
                                        ?>
                                        <div class="errorMsg">
                                            Please select Genre
                                        </div>
                                        <?php
                                    }
                                    if (mysqli_num_rows($checkhtitle) > 0) {
                                        ?>
                                        <div class="errorMsg">
                                            The history already found.
                                        </div>
                                        <?php
                                    } elseif (move_uploaded_file($_FILES['him']['tmp_name'], $target_file)) {
                                        $save = mysqli_query($server, "INSERT into history_today
                                    VALUES(null,'$hgenre','$htitle','$hdesc','$new_imagename','$hdates')
                                ");
                                        if ($save) {
                                            ?>
                                            <div class="successMsg">
                                                Saving the History succed
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="errorMsg">
                                                THe history saving failed.
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
                                    <label for="History title">
                                        History title
                                    </label>
                                    <textarea name="hti" placeholder="Type..." required></textarea>
                                </p>
                                <p>
                                    <label for="History title">
                                        History Genre
                                    </label>
                                    <select name="h_ge" id="">
                                        <option value="Not selected">Select genre</option>
                                        <?php
                                        $get_genres = mysqli_query($server, "SELECT * from genres
                                             ORDER By genre_name DESC
                                            ");
                                        if (mysqli_num_rows($get_genres) < 1) {
                                            ?>
                                            <option value="Not selected">
                                                No genres
                                            </option>
                                            <?php
                                        } else {
                                            while ($dataget_genres = mysqli_fetch_array($get_genres)) {
                                                ?>
                                                <option value="<?php echo $dataget_genres['id']; ?>">
                                                    <?php echo $dataget_genres['genre_name'] ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </p>
                                <p>
                                    <label for="History dates">
                                        History dates
                                    </label>
                                    <input type="date" name="hda" id="">
                                </p>
                                <p>
                                    <label for="History description">
                                        History description
                                    </label>
                                    <textarea name="hde" placeholder="Type..." required></textarea>
                                </p>
                                <p>
                                    <label for="History image">
                                        History image
                                    </label>
                                    <input type="file" name="him" required>
                                </p>
                                <p>
                                    <button type="submit" name="new_history">
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