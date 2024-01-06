<?php
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>KickSide || Haven List</title>
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
                            Haven list
                        </h1>
                        <div class="form-row">
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            Haven Title
                                        </th>
                                        <th>
                                            Haven Description
                                        </th>
                                        <th>
                                            Haven Starting Date
                                        </th>
                                        <th>
                                            Haven Journalist
                                        </th>
                                        <th>
                                            Haven Cover Image
                                        </th>
                                        <th>
                                            actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $get_All_articles = mysqli_query($server, "SELECT * from 
                                            audio_havens,journalists
                                            WHERE journalists.id = audio_havens.haven_journalist
                                            ORDER BY haven_starting_date DESC
                                        ");
                                    if (mysqli_num_rows($get_All_articles) < 1) {
                                        ?>
                                        <tr>
                                            <td colspan="100">
                                                No values found
                                            </td>
                                        </tr>
                                        <?php
                                    } else {
                                        $counter = 1;
                                        while ($data_All_articles = mysqli_fetch_array($get_All_articles)) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $counter++; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data_All_articles['haven_title']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data_All_articles['haven_description']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data_All_articles['haven_starting_date']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data_All_articles['first_name'] . " " . $data_All_articles['last_name']; ?>
                                                </td>
                                                <td>
                                                    <img src="../assets/podcasts/<?php echo $data_All_articles['haven_image_name']; ?>"
                                                        width="100px">
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($data_All_articles['haven_status'] == 'Running') {
                                                        ?>
                                                        <button class="disableAudioHavenButton delete"
                                                            value="<?php echo $data_All_articles['haven_id'] ?>">
                                                            <i class="fa fa-ban"></i>
                                                        </button>
                                                        <?php
                                                    }
                                                    else {
                                                        ?>
                                                        <button class="enableAudioHavenButton"
                                                            value="<?php echo $data_All_articles['haven_id'] ?>">
                                                            <i class="fa fa-ban"></i>
                                                        </button>
                                                        <?php
                                                    }
                                                    ?>

                                                    <a href="edit-history.php?h=<?php echo $data_All_articles['haven_id'] ?>"
                                                        class="edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
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
                <div class="modal" id="disableAudioHaven-modal">
                    <div class="deleteArticle-cont">
                        <div class="title">
                            <h4>
                                Disable/Enable the Audio Haven.
                            </h4>
                            <button id="closeDisableAudioHavenModal" title="Close">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>
                        <div class="disableAudioHaven-Contents" style="padding 10px;">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="../assets/js/jQuery.min.js"></script>
    <script src="../assets/js/disableAudioHaven.js"></script>
    <script src="../assets/js/enableAudioHavenButton.js"></script>
    <script src="../assets/js/journalistsToggleNav.js"></script>

</body>

</html>