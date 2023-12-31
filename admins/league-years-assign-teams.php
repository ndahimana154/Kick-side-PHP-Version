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
    <title>KickSide || Leagues Years - Assign Teams</title>
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
                            Leagues Years - Assign Teams
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
                                            if (isset($_POST['save_l_y_teams'])) {
                                                $selected_teams = $_POST['selected_teams'];
                                                $errorsarray = [];
                                                $successarray = [];
                                                foreach ($selected_teams as $one_team) {
                                                    // Check if the team exists
                                                    $get_team_names = mysqli_query($server, "SELECT * from teams WHERE id ='$one_team'");
                                                    if (mysqli_num_rows($get_team_names) < 1) {
                                                        array_push($errorsarray, "Team with ID: $one_team is not found!");
                                                        continue;
                                                    } else {
                                                        $data_team_names = mysqli_fetch_array($get_team_names);
                                                        $aga_team_name = $data_team_names['name'];
                                                        // Again check if the team doesn't exists in the same league year
                                                        $check_team_again = mysqli_query($server, "SELECT * from league_year_teams
                                                            WHERE team = '$one_team'
                                                            AND league_year = '$l_y_id'
                                                        ");
                                                        if (mysqli_num_rows($check_team_again) > 0) {
                                                            array_push($errorsarray, "$aga_team_name is already on the league year list.");
                                                            continue;
                                                        } else {
                                                            // Check the number of teams been inserted
                                                            $check_team_in = mysqli_query($server, "SELECT * from league_year_teams WHERE 
                                                                league_year = '$l_y_id'
                                                            ");
                                                            if (mysqli_num_rows($check_team_in) > $proposed_teams) {
                                                                array_push($errorsarray, "Team number can't exceed $proposed_teams Teams");
                                                                continue;
                                                            } else {
                                                                $save_on_list = mysqli_query($server, "INSERT into league_year_teams
                                                                VALUES(null,'$l_y_id','$one_team')
                                                            ");
                                                                if (!$save_on_list) {
                                                                    array_push($errorsarray, "$aga_team_name failed to be save.");
                                                                    continue;
                                                                } else {
                                                                    array_push($successarray, "$aga_team_name saved successfully on the list");
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            ?>
                                                <h2>
                                                    Summary:
                                                </h2>
                                                <ol>
                                                    <?php
                                                    if (count($errorsarray) > 0) {
                                                        foreach ($errorsarray as $one_error) {
                                                            echo "<li class='errorMsg'>" . $one_error . "</li>";
                                                        }
                                                    } elseif (count($successarray) > 0) {
                                                        foreach ($successarray as $one_success) {
                                                            echo "<li class='successMsg'>" . $one_success . "</li>";
                                                        }
                                                    }
                                                    ?>
                                                </ol>
                                            <?php

                                            }
                                            ?>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>
                                                            Team Logo
                                                        </th>
                                                        <th>
                                                            Team name
                                                        </th>
                                                        <th>
                                                            Select
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $counter = 1;
                                                    while ($data_country_teams = mysqli_fetch_array($get_country_teams)) {
                                                        $current_team_id = $data_country_teams['id'];
                                                        // Check if it doesn't exist in the league year list
                                                        $checkl_y_t_list = mysqli_query($server, "SELECT * from league_year_teams
                                                            WHERE team = '$current_team_id'
                                                            AND league_year = '$l_y_id'
                                                        ");
                                                        if (mysqli_num_rows($checkl_y_t_list) > 0) {
                                                            continue;
                                                        }
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $counter++; ?>
                                                            </td>
                                                            <td>
                                                                <img src="../assets/teams/logos/<?php echo $data_country_teams['logo']; ?>" alt="">
                                                            </td>
                                                            <td>
                                                                <?php echo $data_country_teams['name']; ?>
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="selected_teams[]" value="<?php echo $current_team_id ?>">
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td colspan="100">
                                                            Didin't find the team you were looking for?
                                                            Click <a href="new-team.php">Add team</a> to see it on the list.
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p>
                                                <button type="submit" name="save_l_y_teams">
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