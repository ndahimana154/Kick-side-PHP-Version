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
    <title>Kickside || New League Year</title>
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
                            New League Year
                        </h1>
                        <div class="form-row">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <?php
                                if (isset($_POST['new_league'])) {
                                    $leaguename = mysqli_real_escape_string($server, $_POST['lyn']);
                                    $startingdate = new DateTime(mysqli_real_escape_string($server, $_POST['lysd']));
                                    $startingdate = $startingdate->format('Y-m-d');
                                    $proposedenddate = new DateTime(mysqli_real_escape_string($server, $_POST['lyed']));
                                    $proposedenddate = $proposedenddate->format('Y-m-d');
                                    $totalmatchdays = mysqli_real_escape_string($server, $_POST['lynumber']);
                                    $totalteams = mysqli_real_escape_string($server, $_POST['lytnumber']);
                                    $status = mysqli_real_escape_string($server, $_POST['lystatus']);

                                    $statuses_array = ['Not Started', 'Progressing', 'Postponed', 'Awarded'];

                                    // Check if the league_competition exists and get their IDs

                                    $checkleague = mysqli_query($server, "SELECT  * from league_competitions
                                        WHERE competition_name = '$leaguename'
                                    ");

                                    if (mysqli_num_rows($checkleague) < 1) {
                                ?>
                                        <div class="errorMsg">
                                            League is Invalid.
                                        </div>
                                    <?php
                                    } elseif (!in_array($status, $statuses_array)) {
                                    ?>
                                        <div class="errorMsg">
                                            Invalid Status.
                                        </div>
                                        <?php
                                    } else {
                                        $dataleague = mysqli_fetch_array($checkleague);

                                        $league_id = $dataleague['l_c_id'];

                                        if ($startingdate > $proposedenddate) {
                                        ?>
                                            <div class="errorMsg">
                                                Starting date can't be greater than end date
                                            </div>
                                            <?php
                                        } else {
                                            // $startingdate = strval($startingdate);
                                            // $proposedenddate = strval($proposedenddate);
                                            $new = mysqli_query($server, "INSERT into league_years
                                                    VALUES(null,'$league_id','$startingdate','$proposedenddate','$totalteams','$totalmatchdays','$status');
                                                
                                                ");
                                            if (!$new) {
                                            ?>
                                                <div class="errorMsg">
                                                    Creating League Year failed.
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="successMsg">
                                                    League Year Creation succed.
                                                </div>
                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>

                                <p>
                                    <label for="League Name">
                                        League Name
                                    </label>
                                    <input list="Leagues" name="lyn" required>

                                    <datalist id="Leagues">
                                        <?php
                                        $getleagues = mysqli_query($server, "SELECT * from league_competitions
                                            ORDER BY competition_name ASC
                                        ");
                                        if (mysqli_num_rows($getleagues) < 1) {
                                        ?>
                                            <option value="No League">
                                                <?php
                                            } else {
                                                while ($dataleauges = mysqli_fetch_array($getleagues)) {
                                                ?>
                                            <option value="<?php echo $dataleauges['competition_name']; ?>">
                                        <?php
                                                }
                                            }
                                        ?>
                                    </datalist>
                                </p>

                                <p>
                                    <label for="League Teams Count">
                                        Starting date
                                    </label>
                                    <input type="date" name="lysd" placeholder="type..." required>
                                </p>

                                <p>
                                    <label for="League Est">
                                        Proposed end date
                                    </label>
                                    <input type="date" name="lyed" id="">
                                </p>
                                <p>
                                    <label for="League Est">
                                        Total team numbers
                                    </label>
                                    <input type="number" name="lytnumber" id="">
                                </p>
                                <p>
                                    <label for="League Est">
                                        Total match days
                                    </label>
                                    <input type="number" name="lynumber" id="">
                                </p>
                                <p>
                                    <label for="League Est">
                                        Status
                                    </label>
                                    <input list="Statuses" name="lystatus" required>
                                    <datalist id="Statuses">
                                        <option value="Not started">
                                        <option value="Progressing">
                                        <option value="Postponed">
                                        <option value="Awarded">
                                    </datalist>
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