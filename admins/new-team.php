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
    <title>Kickside || Journalists New Team</title>
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
                            New Team
                        </h1>
                        <div class="form-row">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <?php
                                if (isset($_POST['new_team'])) {
                                    $teamname = mysqli_real_escape_string($server, $_POST['tname']);
                                    $akaname = mysqli_real_escape_string($server, $_POST['aka']);
                                    $teamlogoname  = $_FILES['logo']['name'];
                                    $teamdescription = mysqli_real_escape_string($server, $_POST['descr']);

                                    $teamgenre = mysqli_real_escape_string($server, $_POST['tgenre']);
                                    $teamcountry = mysqli_real_escape_string($server, $_POST['tcountry']);
                                    $teamest = mysqli_real_escape_string($server, $_POST['est']);
                                    $teamarena = mysqli_real_escape_string($server, $_POST['tarena']);

                                    $target_dir = "../assets/teams/logos/";
                                    $newTeamLogoName = $teamcountry . " - " . $teamname . ".png";
                                    $target_file = $target_dir . $newTeamLogoName;


                                    // Check if the country,Arena and Genre exists and get their IDs
                                    $checkgenre = mysqli_query($server, "SELECT * from genres
                                        WHERE genre_name = '$teamgenre'
                                    ");
                                    $checkcountry = mysqli_query($server, "SELECT * from countries
                                        WHERE country_name = '$teamcountry'                                    
                                    ");
                                    $checkarena = mysqli_query($server, "SELECT * from arenas
                                        WHERE arena_name = '$teamarena'
                                    ");
                                    if (mysqli_num_rows($checkgenre) < 1) {
                                ?>
                                        <div class="errorMsg">
                                            Genre is not found.
                                        </div>
                                    <?php
                                    } elseif (mysqli_num_rows($checkcountry) < 1) {
                                    ?>
                                        <div class="errorMsg">
                                            Country is Invalid.
                                        </div>
                                    <?php
                                    } elseif (mysqli_num_rows($checkarena) < 1) {
                                    ?>
                                        <div class="errorMsg">
                                            invalid Arena.
                                        </div>
                                        <?php
                                    } else {
                                        $datagenre = mysqli_fetch_array($checkgenre);
                                        $datacountry = mysqli_fetch_array($checkcountry);
                                        $datarena = mysqli_fetch_array($checkarena);

                                        $teamgenre_id = $datagenre['id'];
                                        $teamcountry_id = $datacountry['country_id'];
                                        $teamarena_id = $datarena['arena_id'];

                                        // Check if the team doesn't exists in the same country
                                        $checkteamincountry = mysqli_query($server, "SELECT * from teams
                                            WHERE name= '$teamname'
                                            AND country = '$teamcountry_id'
                                        ");
                                        if (mysqli_num_rows($checkteamincountry) > 0) {
                                        ?>
                                            <div class="errorMsg">
                                                Team arleady exists in '<?php echo $teamcountry; ?>'
                                            </div>
                                            <?php
                                        } else {
                                            if (move_uploaded_file($_FILES['logo']['tmp_name'], $target_file)) {
                                                $new = mysqli_query($server, "INSERT into teams 
                                                    VALUES(null,'$teamname','$teamdescription','$akaname','$newTeamLogoName','$teamcountry_id','$teamgenre_id','$teamarena_id','$teamest')
                                                ");
                                                if (!$new) {
                                            ?>
                                                    <div class="errorMsg">
                                                        Creating the team failed.
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="successMsg">
                                                        Team creation succed.
                                                    </div>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="errorMsg">
                                                    Uploading the file failed.
                                                </div>
                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>
                                <p>
                                    <label for="Team Name">
                                        Team name
                                    </label>
                                    <textarea name="tname" placeholder="Type..." required></textarea>
                                </p>
                                <p>
                                    <label for="A.K.A Name">
                                        A.K.A Name
                                    </label>
                                    <textarea name="aka" placeholder="Type..." required></textarea>
                                </p>
                                <p>
                                    <label for="Team Genre">
                                        Team Genre
                                    </label>
                                    <input list="genres" name="tgenre">
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
                                    <label for="Team Country">
                                        Country
                                    </label>
                                    <input list="Countries" name="tcountry" required>

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
                                    <label for="Team Country">
                                        Arena
                                    </label>
                                    <input list="Arenas" name="tarena" required>

                                    <datalist id="Arenas">
                                        <?php
                                        $getArenas = mysqli_query($server, "SELECT * from arenas
                                            ORDER BY arena_name ASC
                                        ");
                                        if (mysqli_num_rows($getArenas) < 1) {
                                        ?>
                                            <option value="No Arena">
                                                <?php
                                            } else {
                                                while ($dataArenas = mysqli_fetch_array($getArenas)) {
                                                ?>
                                            <option value="<?php echo $dataArenas['arena_name']; ?>">
                                        <?php
                                                }
                                            }
                                        ?>
                                    </datalist>
                                </p>



                                <p>
                                    <label for="Team Description">
                                        Team description
                                    </label>
                                    <textarea name="descr" placeholder="Type..." required></textarea>
                                </p>
                                <p>
                                    <label for="Team Logo">
                                        Team Logo
                                    </label>
                                    <input type="file" name="logo" required>
                                </p>
                                <p>
                                    <label for="Team Est">
                                        Team EST
                                    </label>
                                    <input type="date" name="est" id="">
                                </p>
                                <p>
                                    <button type="submit" name="new_team">
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