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
    <title>Kickside || New Arena</title>
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
                            New Arena
                        </h1>
                        <div class="form-row">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <?php
                                if (isset($_POST['new_arena'])) {
                                    $arenaname = mysqli_real_escape_string($server,$_POST['aname']);
                                    $arenadescription = mysqli_real_escape_string($server,$_POST['ade']);
                                    $arenacountry = mysqli_real_escape_string($server,$_POST['acountry']);
                                    $arenacity = mysqli_real_escape_string($server,$_POST['acity']);
                                    $arenacapacity = mysqli_real_escape_string($server,$_POST['acapacity']);
                                    $arenaest = mysqli_real_escape_string($server,$_POST['aest']);

                                    // Check if the country exists and get their IDs
                                
                                    $checkcountry = mysqli_query($server, "SELECT * from countries
                                        WHERE country_name = '$arenacountry'                                    
                                    ");
                                   
                                    if (mysqli_num_rows($checkcountry) < 1) {
                                    ?>
                                        <div class="errorMsg">
                                            Country is Invalid.
                                        </div>
                                    <?php
                                    } else {
                                        $datacountry = mysqli_fetch_array($checkcountry);

                                        $arenacountry_id = $datacountry['country_id'];

                                        // Check if the arena doesn't exists in the same country
                                        $checkarenacountry = mysqli_query($server, "SELECT * from arenas
                                            WHERE arena_name= '$arenaname'
                                            AND country = '$arenacountry_id'
                                        ");
                                        if (mysqli_num_rows($checkarenacountry) > 0) {
                                        ?>
                                            <div class="errorMsg">
                                                Arena  arleady exists in '<?php echo $teamcountry; ?>'
                                            </div>
                                            <?php
                                        } else {
                                                $new = mysqli_query($server, "INSERT into arenas
                                                    VALUES(null,'$arenaname','$arenadescription','$arenacountry_id','$arenacity','$arenacapacity','$arenaest');
                                                
                                                ");
                                                if (!$new) {
                                            ?>
                                                    <div class="errorMsg">
                                                        Creating the Arena failed.
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="successMsg">
                                                        Arena creation succed.
                                                    </div>
                                                <?php
                                                }
                                           
                                        }
                                    }
                                }
                                ?>
                                <p>
                                    <label for="Arena Name">
                                        Arena name
                                    </label>
                                    <textarea name="aname" placeholder="Type..." required></textarea>
                                </p>
                                <p>
                                    <label for="Arena Description">
                                        Arena Description
                                    </label>
                                    <textarea name="ade" placeholder="Type..." required></textarea>
                                </p>
                                
                                <p>
                                    <label for="Arena Country">
                                        Country
                                    </label>
                                    <input list="Countries" name="acountry" required>

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
                                    <label for="Arena City">
                                        Arena City
                                    </label>
                                    <input type="text" name="acity" placeholder="type..." required>
                                </p>
                                <p>
                                    <label for="Arena Capacity">
                                        Arena Capacity
                                    </label>
                                    <input type="number" name="acapacity" placeholder="type..." required>
                                </p>
                            
                                <p>
                                    <label for="Arena Est">
                                        Arena EST
                                    </label>
                                    <input type="date" name="aest" id="">
                                </p>
                                <p>
                                    <button type="submit" name="new_arena">
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