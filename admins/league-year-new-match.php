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
    <title>KickSide || Leagues Years - New League Match </title>
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
                            Leagues - New Match
                        </h1>
                        <div class="form-row">
                            <?php
                            if (!isset($_GET['l_y'])) {
                            ?>
                                <div class="errorMsg">
                                    No request sent to the server!
                                </div>
                                <?php
                            } else {
                                $l_y_id = $_GET['l_y'];
                                $checkl_y_exists = mysqli_query($server, "SELECT * from 
                                    league_years,league_competitions,countries
                                        WHERE l_y_id = '$l_y_id'
                                        AND countries.country_id = league_competitions.league_country
                                        AND league_years.league_id = league_competitions.l_c_id
                                    ");
                                if (mysqli_num_rows($checkl_y_exists) < 1) {
                                ?>
                                    <div class="errorMsg">
                                        The league year requested is not found!
                                    </div>
                                    <?php
                                } else {
                                    $data_l_y = mysqli_fetch_array($checkl_y_exists);
                                    $l_ycountry_id = $data_l_y['league_country'];
                                    $l_ycountryname = $data_l_y['country_name'];
                                    $proposed_teams = $data_l_y['total_teams'];
                                    $get_country_teams = mysqli_query($server, "SELECT * from
                                            teams WHERE country = '$l_ycountry_id'
                                        ");
                                    if (mysqli_num_rows($get_country_teams) < 1) {
                                    ?>
                                        <div class="errorMsg">
                                            No teams in the country "<?php echo $l_ycountryname  ?>"
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <form action="" method="post">
                                            <?php
                                            if (isset($_POST['save_l_m'])) {
                                                $home_team = $_POST['ho_t'];
                                                $away_team = $_POST['aw_t'];
                                                $proposed_date = $_POST['propo_date'];
                                                $proposed_hour = $_POST['propo_time'];
                                                $proposed_time = $proposed_date . " " . $proposed_hour;
                                                $errorsArray = [];
                                                // Check if the teams are the same
                                                if ($home_team == $away_team) {
                                                    array_push($errorsArray, "The team can't play itself");
                                                }
                                                // Check if the teams are valid.
                                                $checkhome_valid = mysqli_query($server, "SELECT * from 
                                                    league_years,league_competitions,countries,teams,league_year_teams
                                                    WHERE l_y_id = '$l_y_id'
                                                    AND league_year_teams.team = teams.id
                                                    AND league_year_teams.league_year = league_years.l_y_id
                                                    AND countries.country_id = league_competitions.league_country
                                                    AND league_years.league_id = league_competitions.l_c_id
                                                    AND teams.name = '$home_team'
                                                ");
                                                if (mysqli_num_rows($checkhome_valid) < 1) {
                                                    array_push($errorsArray, "Home team is invalid");
                                                }
                                                $checkaway_valid = mysqli_query($server, "SELECT * from 
                                                league_years,league_competitions,countries,teams,league_year_teams
                                                WHERE l_y_id = '$l_y_id'
                                                AND league_year_teams.team = teams.id
                                                AND league_year_teams.league_year = league_years.l_y_id
                                                AND countries.country_id = league_competitions.league_country
                                                AND league_years.league_id = league_competitions.l_c_id
                                                AND teams.name = '$away_team'
                                                ");
                                                if (mysqli_num_rows($checkaway_valid) < 1) {
                                                    array_push($errorsArray, "Away team is invalid");
                                                }
                                                if (count($errorsArray) > 0) {
                                                    echo "<ul>";
                                                    foreach ($errorsArray as $one_error) {
                                                        echo "<li class='errorMsg'>" . $one_error . "</li>";
                                                    }
                                                    echo "</ul>";
                                                } else {
                                                    // Get the teams ids
                                                    $dataHome = mysqli_fetch_array($checkhome_valid);
                                                    $dataAway = mysqli_fetch_array($checkaway_valid);
                                                    $homeid = $dataHome['id'];
                                                    $awayid = $dataAway['id'];
                                                    // Check if the match doesn't exist
                                                    $checkmatchdosexists = mysqli_query($server, "SELECT * from
                                                        league_matches WHERE
                                                        home_team = '$homeid'
                                                        AND away_team = '$awayid'
                                                        AND league_year = '$l_y_id'
                                                        AND match_status != 'Postponed'
                                                    ");
                                                    if (mysqli_num_rows($checkmatchdosexists) > 0) {
                                                        array_push($errorsArray, "It looks like there is another match scheduled with dame details. Check well or conduct system support for help.
                                                        ");
                                                    }
                                                    if (count($errorsArray) > 0) {
                                                        echo "<ul>";
                                                        foreach ($errorsArray as $one_error) {
                                                            echo "<li class='errorMsg'>" . $one_error . "</li>";
                                                        }
                                                        echo "</ul>";
                                                    } else {
                                                        $savematch = mysqli_query($server, "INSERT into league_matches
                                                                VALUES(null,'$l_y_id','$homeid','$awayid','$proposed_time','Waiting')
                                                            ");
                                                        if (!$savematch) {
                                            ?>
                                                            <div class="errorMsg">
                                                                Saving match failed.
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="successMsg">
                                                                Match is saved successfully.
                                                            </div>
                                            <?php
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                            <p>
                                                <label for="League name">
                                                    League name

                                                </label>
                                                <input type="text" name="l_na" value="<?php echo $data_l_y['competition_name']; ?>" readonly>
                                            </p>
                                            <p>
                                                <label for="Home Team">
                                                    Home team
                                                </label>
                                                <input list="hometeams" name="ho_t" value="<?php if (isset($_POST['save_l_m'])) {
                                                                                                echo $_POST['ho_t'];
                                                                                            } ?>">
                                                <datalist id="hometeams">
                                                    <?php
                                                    $get_all_ttt = mysqli_query($server, "SELECT * from teams,league_years,league_competitions,league_year_teams
                                                            WHERE 
                                                            teams.id = league_year_teams.team
                                                            AND league_years.league_id = league_competitions.l_c_id
                                                            AND league_year_teams.league_year = league_years.l_y_id
                                                            AND l_y_id = '$l_y_id'
                                                            ORDER BY name ASC
                                                        ");
                                                    if (mysqli_num_rows($get_all_ttt) < 1) {
                                                    ?>
                                                        <option value="No teams">
                                                            <?php
                                                        } else {
                                                            while ($dta_all_ttt = mysqli_fetch_array($get_all_ttt)) {
                                                            ?>
                                                        <option value="<?php echo $dta_all_ttt['name']; ?>">
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </datalist>
                                            </p>
                                            <p>
                                                <label for="Away Team">
                                                    Away Team
                                                </label>
                                                <input list="awayteams" name="aw_t" value="<?php if (isset($_POST['save_l_m'])) {
                                                                                                echo $_POST['aw_t'];
                                                                                            } ?>">
                                                <datalist id="awayteams">
                                                    <?php
                                                    $get_all_ttt = mysqli_query($server, "SELECT * from teams,league_years,league_competitions,league_year_teams
                                                            WHERE 
                                                            teams.id = league_year_teams.team
                                                            AND league_years.league_id = league_competitions.l_c_id
                                                            AND league_year_teams.league_year = league_years.l_y_id
                                                            AND l_y_id = '$l_y_id'
                                                            ORDER BY name ASC
                                                        ");
                                                    if (mysqli_num_rows($get_all_ttt) < 1) {
                                                    ?>
                                                        <option value="No teams">
                                                            <?php
                                                        } else {
                                                            while ($dta_all_ttt = mysqli_fetch_array($get_all_ttt)) {
                                                            ?>
                                                        <option value="<?php echo $dta_all_ttt['name']; ?>">
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </datalist>
                                            </p>
                                            <p>
                                                <label for="Proposed date">
                                                    Proposed date
                                                </label>
                                                <input type="date" name="propo_date" value="<?php if (isset($_POST['save_l_m'])) {
                                                                                                echo $_POST['propo_date'];
                                                                                            } ?>">
                                            </p>
                                            <p>
                                                <label for="Proposed Time">
                                                    Proposed Time
                                                </label>
                                                <input type="time" name="propo_time" value="<?php if (isset($_POST['save_l_m'])) {
                                                                                                echo $_POST['propo_time'];
                                                                                            } ?>">
                                            </p>
                                            <p>
                                                <button type="submit" name="save_l_m">
                                                    <i class="fa fa-save">
                                                    </i>
                                                    Save
                                                </button>
                                            </p>
                                        </form>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="../assets/js/journalistsToggleNav.js"></script>

</body>

</html>