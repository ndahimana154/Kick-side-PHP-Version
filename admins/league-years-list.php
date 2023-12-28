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
    <title>KickSide || Leagues Years List</title>
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
                            Leagues Years List
                        </h1>
                        <div class="form-row">
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            Starting date
                                        </th>
                                        <th>
                                            League name
                                        </th>
                                        <th>
                                            Ending date
                                        </th>
                                        <th>
                                            Total teams
                                        </th>
                                        <th>
                                            Total matchdays
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $get_all_league_years = mysqli_query($server, "SELECT * from 
                                        league_competitions,countries,genres,league_years
                                        WHERE 
                                        league_years.league_id = league_competitions.l_c_id
                                        AND league_competitions.league_country = countries.country_id
                                        AND league_competitions.league_genre = genres.id
                                        ORDER BY starting_date DESC,
                                        competition_name ASC
                                    ");
                                    if (mysqli_num_rows($get_all_league_years) < 1) {
                                    ?>
                                        <tr>
                                            <td colspan="100">
                                                No values found
                                            </td>
                                        </tr>
                                        <?php
                                    } else {
                                        $counter = 1;
                                        while ($data_all_leagues = mysqli_fetch_array($get_all_league_years)) {
                                            $league_id = $data_all_leagues['l_c_id'];
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $counter++; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data_all_leagues['starting_date']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data_all_leagues['competition_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data_all_leagues['end_date']; ?>
                                                </td>

                                                <td>
                                                    <?php echo $data_all_leagues['total_teams'] . " Teams"; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data_all_leagues['total_match_days'] . " Days"; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data_all_leagues['status']; ?>
                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="../assets/js/journalistsToggleNav.js"></script>

</body>

</html>