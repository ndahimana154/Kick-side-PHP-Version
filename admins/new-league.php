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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Kickside || New League</title>
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
                            New League
                        </h1>
                        <div class="form-row">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <?php
                                if (isset($_POST['new_league'])) {
                                    $leaguename = mysqli_real_escape_string($server, $_POST['lname']);
                                    $leaguegenre = mysqli_real_escape_string($server, $_POST['lgenre']);
                                    $leaguedescription = mysqli_real_escape_string($server, $_POST['lde']);
                                    $leaguecountry = mysqli_real_escape_string($server, $_POST['lcountry']);
                                    $leagueteamscount = mysqli_real_escape_string($server, $_POST['l_t_n']);
                                    $leaguest = mysqli_real_escape_string($server, $_POST['lest']);


                                    // Check if the country,genre exists and get their IDs

                                    $checkcountry = mysqli_query($server, "SELECT * from countries
                                        WHERE country_name = '$leaguecountry'                                    
                                    ");
                                    $checkgenre = mysqli_query($server, "SELECT * from genres
                                        WHERE genre_name = '$leaguegenre'
                                    ");

                                    if (mysqli_num_rows($checkcountry) < 1) {
                                ?>
                                        <div class="errorMsg">
                                            Country is Invalid.
                                        </div>
                                    <?php
                                    } elseif (mysqli_num_rows($checkgenre) < 1) {
                                    ?>
                                        <div class="errorMsg">
                                            Invalid Genre.
                                        </div>
                                        <?php
                                    } else {
                                        $datacountry = mysqli_fetch_array($checkcountry);
                                        $datagenre = mysqli_fetch_array($checkgenre);

                                        $leaguecountry_id = $datacountry['country_id'];
                                        $leaguegenre_id = $datagenre['id'];

                                        // Check if the League doesn't exists in the same country and same genre
                                        $checkleaguecountry = mysqli_query($server, "SELECT * from league_competitions
                                            WHERE competition_name= '$leaguename'
                                            AND league_country = '$leaguecountry_id'
                                            AND league_genre = '$leaguegenre_id'
                                        ");
                                        if (mysqli_num_rows($checkleaguecountry) > 0) {
                                        ?>
                                            <div class="errorMsg">
                                                League arleady exists in '<?php echo $teamcountry; ?>'
                                            </div>
                                            <?php
                                        } else {
                                            $new = mysqli_query($server, "INSERT into league_competitions
                                                    VALUES(null,'$leaguegenre_id','$leaguename','$leaguedescription','$leaguecountry_id','$leagueteamscount','$leaguest');
                                                
                                                ");
                                            if (!$new) {
                                            ?>
                                                <div class="errorMsg">
                                                    Creating League failed.
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="successMsg">
                                                    League Creation succed.
                                                </div>
                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>
                                <p>
                                    <label for="League Name">
                                        League name
                                    </label>
                                    <textarea name="lname" placeholder="Type..." required></textarea>
                                </p>
                                <p>
                                    <label for="League Genre">
                                        league Genre
                                    </label>
                                    <input list="genres" name="lgenre">
                                    <datalist id="genres" required>
                                        <?php
                                        $get_all_genres = mysqli_query($server, "SELECT * from genres
                                            ORDER BY genre_name ASC
                                            ");
                                        if (mysqli_num_rows($get_all_genres) < 1) {
                                        ?>
                                            <option value="No genres"></option>
                                            <?php
                                        } else {
                                            while ($data_all_genres = mysqli_fetch_array($get_all_genres)) {
                                            ?>
                                                <option value="<?php echo $data_all_genres['genre_name']; ?>">
                                            <?php
                                            }
                                        }

                                            ?>
                                    </datalist>
                                </p>
                                <p>
                                    <label for="League Description">
                                        League Description
                                    </label>
                                    <textarea name="lde" placeholder="Type..." required></textarea>
                                </p>

                                <p>
                                    <label for="League Country">
                                        League Country
                                    </label>
                                    <input list="Countries" name="lcountry" required>

                                    <datalist id="Countries">
                                        <?php
                                        $getCountries = mysqli_query($server, "SELECT * from countries
                                            ORDER BY country_name ASC
                                        ");
                                        if (mysqli_num_rows($getCountries) < 1) {
                                        ?>
                                            <option value="No Country">
                                                <?php
                                            } else {
                                                while ($dataCountries = mysqli_fetch_array($getCountries)) {
                                                ?>
                                            <option value="<?php echo $dataCountries['country_name']; ?>">
                                        <?php
                                                }
                                            }
                                        ?>
                                    </datalist>
                                </p>

                                <p>
                                    <label for="League Teams Count">
                                        League Teams Count
                                    </label>
                                    <input type="number" name="l_t_n" placeholder="type..." required>
                                </p>

                                <p>
                                    <label for="League Est">
                                        League EST
                                    </label>
                                    <input type="date" name="lest" id="">
                                </p>
                                <p>
                                    <button type="submit" name="new_league">
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