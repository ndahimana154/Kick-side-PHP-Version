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
    <title>KickSide || Leagues Years - Matches List</title>
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
                            Leagues Years - Match Lists
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
                                    $get_league_matches = mysqli_query($server, "SELECT * from
                                        league_matches,league_years
                                        WHERE
                                        league_matches.league_year = league_years.l_y_id
                                        AND league_years.l_y_id = '$l_y_id'
                                    ");
                                    if (mysqli_num_rows($get_league_matches) < 1) {
                                    ?>
                                        <div class="errorMsg">
                                            No matches in the League "<?php echo $data_l_y['competition_name']; ?>"
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <h3 class="successMsg" style="font-size: 22px;">
                                            <?php echo $data_l_y['competition_name']; ?>
                                            <br>
                                        </h3>
                                        <?php
                                        if (isset($_GET['m'])) {
                                            $m_d = $_GET['m'];
                                            // Check if the match exists
                                            $checkMatchExists = mysqli_query($server, "SELECT * from league_matches
                                                    WHERE l_m_id = '$m_d'
                                                ");
                                            if (mysqli_num_rows($checkMatchExists) < 1) {
                                        ?>
                                                <div class="errorMsg">
                                                    Match doesn't exists.
                                                </div>
                                                <?php
                                            } else {
                                                while ($dataMatchExists = mysqli_fetch_array($checkMatchExists));
                                                $deleteMatch = mysqli_query($server, "DELETE from league_matches 
                                                        WHERE l_m_id = '$m_d'
                                                    ");
                                                if (!$deleteMatch) {
                                                ?>
                                                    <div class="errorMsg">
                                                        Deleting the match failed.
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="successmsg">
                                                        The match is deleted successfully.
                                                        Refresh if changes not applied
                                                    </div>
                                        <?php
                                                }
                                            }
                                        }
                                        ?>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>
                                                        Date & Time
                                                    </th>
                                                    <th>
                                                        Logo
                                                    </th>
                                                    <th>
                                                        Team name
                                                    </th>
                                                    <th>
                                                        Results
                                                    </th>
                                                    <th>
                                                        Actions
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $counter = 1;
                                                while ($data_league_matches = mysqli_fetch_array($get_league_matches)) {

                                                ?>
                                                    <tr>
                                                        <td rowspan="2">
                                                            <?php echo $counter++; ?>
                                                        </td>
                                                        <td rowspan="2">
                                                            <?php echo $data_league_matches['proposed_time'] ?>
                                                        </td>
                                                        <?php
                                                        $home_id = $data_league_matches['home_team'];
                                                        $gethometeaminfo = mysqli_query($server, "SELECT * from teams WHERE id ='$home_id'");
                                                        if (mysqli_num_rows($gethometeaminfo) < 1) {
                                                            echo "Error....";
                                                        } else {
                                                            $datahometeaminfo = mysqli_fetch_array($gethometeaminfo);
                                                        ?>
                                                            <td>
                                                                <img src="../assets/teams/logos/<?php echo $datahometeaminfo['logo']; ?>" alt="">
                                                            </td>
                                                            <td>
                                                                <?php echo $datahometeaminfo['name']; ?>
                                                            </td>
                                                        <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        if ($data_league_matches['match_status'] == 'Waiting') {
                                                        ?>
                                                            <td rowspan="2">
                                                                <?php echo $data_league_matches['match_status']; ?>
                                                            </td>
                                                        <?php
                                                        }
                                                        ?>
                                                        <td rowspan="2">
                                                            <a href="?l_y=<?php echo $l_y_id ?>&m=<?php echo $data_league_matches['l_m_id']; ?>" onclick="return confirm('Are you sure to delete this match? Remember that this action is irreversible and all the match events will be lost.');" class="delete">
                                                                <i class="fa fa-trash"></i> Delete match
                                                            </a>
                                                            <a href="league-year-add-match-events.php?l_y=<?php echo $l_y_id ?>&m=<?php echo $data_league_matches['l_m_id']; ?>" title="Add match events">
                                                                <i class="fa fa-arrow-alt-circle-right"></i> Add Events 
                                                            </a>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <?php
                                                        $away_id = $data_league_matches['away_team'];
                                                        $getawayteaminfo = mysqli_query($server, "SELECT * from teams WHERE id ='$away_id'");
                                                        if (mysqli_num_rows($getawayteaminfo) < 1) {
                                                            echo "Error....";
                                                        } else {
                                                            $dataawayteaminfo = mysqli_fetch_array($getawayteaminfo);
                                                        ?>
                                                            <td>
                                                                <img src="../assets/teams/logos/<?php echo $dataawayteaminfo['logo']; ?>" alt="">
                                                            </td>
                                                            <td>
                                                                <?php echo $dataawayteaminfo['name']; ?>
                                                            </td>
                                                        <?php
                                                        }
                                                        ?>

                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                                <tr>
                                                    <td colspan="100">
                                                        Want to add new match in this league?
                                                        Click <a href="league-year-new-match.php?l_y=<?php echo $_GET['l_y'] ?>">Add to list</a> to continue.
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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