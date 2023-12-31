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
    <title>KickSide || Leagues Years - Add Match Events </title>
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
                            Leagues - Add Match Events
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
                                    if (!isset($_GET['m'])) {
                                    ?>
                                        <div class="errorMsg">
                                            No match sent to the server.
                                        </div>
                                        <?php
                                    } else {
                                        $match_id = $_GET['m'];
                                        // Check if the match exists
                                        $get_match_info = mysqli_query($server, "SELECT * from league_matches
                                            WHERE league_year = '$l_y_id'
                                            AND l_m_id ='$match_id'
                                        ");
                                        if (mysqli_num_rows($get_match_info) < 1) {
                                        ?>
                                            <div class="errorMsg">
                                                Match doesn't appear to exist on the match list.
                                            </div>
                                        <?php
                                        } else {
                                            $data_match_info = mysqli_fetch_array($get_match_info);
                                        ?>
                                            <form action="" method="post">
                                                <p>
                                                    <label for="League name">
                                                        League name

                                                    </label>
                                                    <input type="text" name="l_na" value="<?php echo $data_l_y['competition_name']; ?>" readonly>
                                                </p>
                                            </form>
                                            <table style="margin-top: 20px;">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <?php
                                                            $home_id = $data_match_info['home_team'];
                                                            $gethomeinfo = mysqli_fetch_array(mysqli_query($server, "SELECT * from teams WHERE id='$home_id'"));
                                                            ?>
                                                            <img src="../assets/teams/logos/<?php echo $gethomeinfo['logo']; ?>" alt="">
                                                            <?php ?>
                                                        </th>
                                                        <th>
                                                            <?php echo $gethomeinfo['name']; ?>
                                                        </th>
                                                        <th>
                                                            VS
                                                        </th>
                                                        <th>
                                                            <?php
                                                            $away_id = $data_match_info['away_team'];
                                                            $getawayinfo = mysqli_fetch_array(mysqli_query($server, "SELECT * from teams WHERE id='$away_id'"));
                                                            ?>
                                                            <img src="../assets/teams/logos/<?php echo $getawayinfo['logo']; ?>" alt="">
                                                            <?php ?>
                                                        </th>
                                                        <th>
                                                            <?php echo $getawayinfo['name']; ?>
                                                        </th>
                                                        <th>
                                                            <?php
                                                            $check_start_to_goal = mysqli_query($server, "SELECT * from league_match_events
                                                                WHERE BINARY league_match = '$match_id'
                                                                AND BINARY event_name =  'Start'
                                                            ");
                                                            if (mysqli_num_rows($check_start_to_goal) < 1) {
                                                            ?>
                                                                Match not yet started.
                                                            <?php
                                                            } else {
                                                                $findhomegoals = mysqli_query($server, "SELECT * from league_match_goals
                                                                    WHERE match_id = '$match_id'
                                                                    AND team_id = '$home_id'
                                                                ");
                                                                $findawaygoals = mysqli_query($server, "SELECT * from league_match_goals
                                                                    WHERE match_id = '$match_id'
                                                                    AND team_id = '$away_id'
                                                                ");
                                                                echo mysqli_num_rows($findhomegoals) . " - " . mysqli_num_rows($findawaygoals);
                                                            }
                                                            ?>
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <div class="form-buttons">
                                                <a href="?l_y=<?php echo $l_y_id; ?>&m=<?php echo $match_id; ?>&ms">
                                                    Match Start
                                                </a>
                                                <a href="">
                                                    Halftime
                                                </a>
                                                <a href="?l_y=<?php echo $l_y_id; ?>&m=<?php echo $match_id; ?>&goal">
                                                    Goal
                                                </a>
                                                <a href="">
                                                    Full time
                                                </a>
                                            </div>
                                            <?php
                                            if (isset($_GET['ms'])) {
                                            ?>
                                                <form action="" method="post">
                                                    <?php
                                                    if (isset($_POST['save_ms'])) {
                                                        $event_name = "Start";
                                                        $starting_date = $_POST['st_date'];
                                                        $starting_time  = $_POST['st_time'];
                                                        $starting_full = $starting_date . " " . $starting_time;

                                                        // Check if the match have not already started
                                                        $check_no_started = mysqli_query($server, "SELECT * from league_match_events
                                                                WHERE BINARY league_match = '$match_id'
                                                                AND BINARY event_name =  '$event_name'
                                                            ");
                                                        if (mysqli_num_rows($check_no_started) > 0) {
                                                    ?>
                                                            <div class="errorMsg">
                                                                Looks like the match already started!
                                                            </div>
                                                            <?php
                                                        } else {
                                                            $mark_start = mysqli_query($server, "INSERT into league_match_events
                                                                    VALUES(null,'$match_id','$event_name',DEFAULT,'$starting_full','Done')
                                                                ");
                                                            if (!$mark_start) {
                                                            ?>
                                                                <div class="errorMsg">
                                                                    Event is not saved.
                                                                </div>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <div class="successMsg">
                                                                    Event is Saved successfully.
                                                                </div>
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <h2 style="margin-top:20px;">
                                                        Mark the starting time.
                                                    </h2>
                                                    <p>

                                                        Enter Starting date.
                                                        </label>
                                                        <input type="date" name="st_date" value="<?php echo date('Y-m-d'); ?>" placeholder="Type...">

                                                    </p>
                                                    <p>
                                                        Enter Starting Time.
                                                        </label>
                                                        <input type="time" name="st_time" placeholder="Type..." required>

                                                    </p>
                                                    <p>
                                                        <button type="submit" name="save_ms">
                                                            <i class="fa fa-save"></i>
                                                            Save
                                                        </button>
                                                    </p>
                                                    <p>
                                                        Note: You must remember to use the time on GMT, not your local Time
                                                    </p>
                                                </form>
                                            <?php
                                            }
                                            if (isset($_GET['goal'])) {
                                            ?>
                                                <form action="" method="post">
                                                    <h2 style="margin-top: 20px;">
                                                        Mark the goal
                                                    </h2>
                                                    <?php
                                                        if (isset($_POST['save_goal'])) {
                                                            $gminute = mysqli_real_escape_string($server,$_POST['gm']);
                                                            $gteam = mysqli_real_escape_string($server,$_POST['gt']);
                                                            $gtype = mysqli_real_escape_string($server,$_POST['gty']);
                                                            $gowner = mysqli_real_escape_string($server,$_POST['go']);
                                                            $gassist = mysqli_real_escape_string($server,$_POST['ga']);

                                                            // check if the team is valid
                                                            if ($gteam !== $home_name & $gteam !== $away_name) {
                                                                # code..
                                                            }
                                                        }
                                                    ?>
                                                    <p>
                                                        <label for="Goal time">
                                                            The Goal minute
                                                        </label>
                                                        <input type="number" name="gm" placeholder="Type...">
                                                    </p>
                                                    <p>
                                                        <label for="Team Won">
                                                            Team
                                                        </label>
                                                        <input list="teams" name="gt" placeholder="Type...">
                                                        <datalist id="teams">
                                                            <option value="<?php echo $home_name = $gethomeinfo['name']; ?>">
                                                            <option value="<?php echo $away_name = $getawayinfo['name']; ?>">
                                                        </datalist>
                                                    </p>
                                                    <p>
                                                        <label for="Goal Type">
                                                            Type of Goal
                                                        </label>
                                                        <input list="goal_types" name="gty" placeholder="Type...">
                                                        <datalist id="goal_types">
                                                            <option value="Free Kick">
                                                            <option value="Penalty">
                                                            <option value="Usual Goal">
                                                            <option value="Corner Kick">
                                                        </datalist>
                                                    </p>
                                                    <p>
                                                        <label for="Goal owner">
                                                            Who won?
                                                        </label>
                                                        <input list="players" name="go" placeholder="Type...">
                                                        <datalist id="players">
                                                            <?php
                                                                $get_all_players = mysqli_query($server,"SELECT * from players
                                                                    ORDER BY player_fullnames ASC
                                                                ");
                                                                while ($data_all_player = mysqli_fetch_array($get_all_players)) {
                                                                    ?>
                                                                    <option value="<?php echo $data_all_player['player_fullnames']; ?>">
                                                                    <?php
                                                                }
                                                            ?>
                                                        </datalist>
                                                    </p>
                                                    <p>
                                                        <label for="Assit owner">
                                                            Assit Owner <br>
                                                            <span class="errorMsg">If no assist, Select no assist</span>
                                                        </label>
                                                        <input list="asplayers" name="ga" placeholder="Type...">
                                                        <datalist id="asplayers">
                                                            <option value="No assist">
                                                            <?php
                                                                $get_all_players = mysqli_query($server,"SELECT * from players
                                                                    ORDER BY player_fullnames ASC
                                                                ");
                                                                while ($data_all_player = mysqli_fetch_array($get_all_players)) {
                                                                    ?>
                                                                    <option value="<?php echo $data_all_player['player_fullnames']; ?>">
                                                                    <?php
                                                                }
                                                            ?>
                                                        </datalist>
                                                    </p>
                                                    <p>
                                                        <button type="submit" name="save_goal">
                                                            <i class="fa fa-save"></i>
                                                            Save 
                                                        </button>
                                                    </p>
                                                </form>
                                            <?php
                                            }
                                            ?>
                                        <?php
                                        }
                                    }

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