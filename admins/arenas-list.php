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
    <title>KickSide || Arenas List</title>
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
                            Arenas List
                        </h1>
                        <div class="form-row">
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>

                                        <th>
                                            Country
                                        </th>
                                        <th>
                                            City
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Description
                                        </th>
                                       
                                        <th>
                                            EST
                                        </th>
                                        <th>
                                            Capacity
                                        </th>
                                        <th>
                                            Home teams
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $get_all_arenas = mysqli_query($server, "SELECT * from 
                                        arenas,countries
                                        WHERE arenas.country = countries.country_id 
                                        ORDER BY country_name ASC,
                                        arena_name ASC
                                    ");
                                    if (mysqli_num_rows($get_all_arenas) < 1) {
                                    ?>
                                        <tr>
                                            <td colspan="100">
                                                No values found
                                            </td>
                                        </tr>
                                        <?php
                                    } else {
                                        $counter = 1;
                                        while ($data_All_arenas = mysqli_fetch_array($get_all_arenas)) {
                                            $arena_id = $data_All_arenas['arena_id'];
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $counter++; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data_All_arenas['country_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data_All_arenas['city']; ?>
                                                </td>

                                                <td>
                                                    <?php echo $data_All_arenas['arena_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data_All_arenas['description']; ?>
                                                </td>

                                                
                                                <td>
                                                    <?php echo date_diff(new DateTime($data_All_arenas['est_date']), new DateTime())->y . " Years";  ?>
                                                </td>
                                                <td>
                                                    <?php echo $data_All_arenas['capacity']; ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $get_arena_teams = mysqli_query($server,"SELECT * from teams WHERE 
                                                            arena='$arena_id'
                                                        ");
                                                        if (mysqli_num_rows($get_arena_teams) < 1) {
                                                            echo"No team";
                                                        }
                                                        else {
                                                            $teams_count = mysqli_num_rows($get_arena_teams);
                                                            $countz =1;
                                                            while ($data_arena_teams = mysqli_fetch_array($get_arena_teams)) {
                                                                echo $data_arena_teams['name'];
                                                                echo $countz<$teams_count?", ":" ";
                                                            }
                                                        }
                                                    ?>
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