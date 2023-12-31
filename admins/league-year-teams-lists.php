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
    <title>KickSide || Leagues Years - Teams List</title>
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
                            Leagues Years - Teams List
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
                                        if (isset($_GET['t'])) {
                                            $t_d_id = $_GET['t'];
                                            // First get the team details
                                            $getTeam_info = mysqli_query($server, "SELECt * from teams
                                                WHERE id = '$t_d_id'
                                            ");
                                            if (mysqli_num_rows($getTeam_info) < 1) {
                                        ?>
                                                <div class="errorMsg">
                                                    Team doesn't exist on the teams list.
                                                </div>
                                                <?php
                                            } else {
                                                // Check if the things to delete exist
                                                $check_if_things_exists = mysqli_query($server, "SELECT * from league_year_teams
                                                    WHERE league_year = '$l_y_id'
                                                    AND team = '$t_d_id'
                                                ");
                                                if (mysqli_num_rows($check_if_things_exists) < 1) {
                                                ?>
                                                    <div class="errorMsg">
                                                        It looks like the Team to delete doesn't exists on the current list of teams in this year.
                                                    </div>
                                                    <?php
                                                } else {
                                                    $delete_the_things = mysqli_query($server, "DELETE from league_year_teams
                                                        WHERE league_year = '$l_y_id'
                                                        AND team = '$t_d_id'
                                                    ");
                                                    if (!$delete_the_things) {
                                                    ?>
                                                        <div class="errorMsg">
                                                            Deleting team failed.
                                                        </div>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <div class="successMsg">
                                                            The team is deleted successfully.
                                                        </div>
                                        <?php
                                                    }
                                                }
                                            }
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
                                                        Actions
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
                                                    if (mysqli_num_rows($checkl_y_t_list) < 1) {
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
                                                            <a href="?l_y=<?php echo $l_y_id ?>&t=<?php echo $current_team_id; ?>" onclick="return confirm('Are you sure to delete this team on the year list? Remember that the action is irreversible and all the years records will be lost.');" class="delete">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                                <tr>
                                                    <td colspan="100">
                                                        Didin't find the your team on the list?
                                                        Click <a href="league-years-assign-teams.php?l_y=<?php echo $_GET['l_y'] ?>">Add to list</a> to continue.
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