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
                            Edit History
                        </h1>
                        <?php
                        if (!isset($_GET['h'])) {
                            ?>
                            <div class="errorMsg">
                                No history sent to the server.
                            </div>
                            <?php
                        } else {
                            $historyId = $_GET['h'];
                            $checkHistory_exists = mysqli_query($server, "SELECT * from history_today,genres
                                    WHERE ht_id = '$historyId'
                                    AND genres.id = history_today.history_genre
                                ");
                            if (mysqli_num_rows($checkHistory_exists) < 1) {
                                ?>
                                <div class="errorMsg">
                                    History article is not found
                                </div>
                                <?php
                            } else {
                                $dataHistory_exists = mysqli_fetch_array($checkHistory_exists);
                                ?>
                                <div class="form-row">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <?php
                                        if (isset($_POST['edit_history'])) {
                                            $htitle = mysqli_real_escape_string($server, $_POST['hti']);
                                            $hgenre = mysqli_real_escape_string($server, $_POST['h_ge']);
                                            $hdates = mysqli_real_escape_string($server, $_POST['hda']);
                                            $hdesc = mysqli_real_escape_string($server, $_POST['hde']);

                                            // Check if the history title doesn't exist
                                            $checkhtitle = mysqli_query($server, "SELECT * from history_today
                                                WHERE history_title = '$htitle'
                                                AND ht_id !='$historyId'
                                            ");
                                            if (mysqli_num_rows($checkhtitle) > 0) {
                                                ?>
                                                <div class="errorMsg">
                                                    The history already found.
                                                </div>
                                                <?php
                                            } else {
                                                $update = mysqli_query($server, "UPDATE history_today
                                                    SET history_genre = '$hgenre',
                                                    history_title = '$htitle',
                                                    history_description = '$hdesc',
                                                    history_date = '$hdates'
                                                    WHERE ht_id = '$historyId'
                                                ");
                                                if ($update) {
                                                    ?>
                                                    <div class="successMsg">
                                                        Updating the History succed.
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="errorMsg">
                                                        THe history updating failed.
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        }

                                        ?>
                                        <p>
                                            <label for="History title">
                                                History title
                                            </label>
                                            <textarea name="hti" placeholder="Type..."
                                                required><?php echo $dataHistory_exists['history_title']; ?></textarea>
                                        </p>
                                        <p>
                                            <label for="History title">
                                                History Genre
                                            </label>
                                            <select name="h_ge" id="">
                                                <?php
                                                $currentGenre = $dataHistory_exists['history_genre'];
                                                $getCurrentGenre = mysqli_query($server, "SELECT * from genres
                                                        WHERE id = '$currentGenre'
                                                    ");
                                                $dataCurrentGenre = mysqli_fetch_array($getCurrentGenre);
                                                ?>
                                                <option value="<?php echo $currentGenre; ?>">
                                                    <?php echo $dataCurrentGenre['genre_name'] ?>
                                                </option>
                                                <?php
                                                $getDifferentOne = mysqli_query($server, "SELECT * from genres
                                                        WHERE id != '$currentGenre'
                                                    ");
                                                if (mysqli_num_rows($getDifferentOne) > 0) {
                                                    while ($dataDifferentOne = mysqli_fetch_array($getDifferentOne)) {
                                                        ?>
                                                        <option value="<?php echo $dataDifferentOne['id']; ?>">
                                                            <?php echo $dataDifferentOne['genre_name'] ?>
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
                                            <input type="date" name="hda"
                                                value="<?php echo $dataHistory_exists['history_date']; ?>">
                                        </p>
                                        <p>
                                            <label for="History description">
                                                History description
                                            </label>
                                            <textarea name="hde" placeholder="Type..."
                                                required><?php echo $dataHistory_exists['history_description']; ?></textarea>
                                        </p>
                                        <p>
                                            <button type="submit" name="edit_history">
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