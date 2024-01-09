<?php
include('../assets/php/global/server.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/images/favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/front-main.css">
</head>

<body>
    <div class="container">
        <?php
        include("../assets/php/clients/header.php");

        ?>
        <article class="read-article">
            <div class="cont">
                <?php
                include("../assets/php/clients/search-form.php");
                ?>
                <div class="article-cont">
                    <?php
                    if (!isset($_GET['h'])) {
                        ?>
                        <title>KickSide || Watch Haven</title>
                        <div class="errorMsg">
                            No request sent to server
                        </div>
                        <div class="related-articles">
                            <h2>
                                Explore latest Podcasts
                            </h2>
                            <div class="related-row">
                                <?php
                                $getOtherPodcasts = mysqli_query($server, "SELECT * from audio_havens
                                    ORDER BY `haven_upload date` DESC,
                                    haven_upload_time DESC
                                    LIMIT 20
                                ");
                                if (mysqli_num_rows($getOtherPodcasts) < 1) {
                                } else {
                                    $count = 1;
                                    while ($dataOtherPodcasts = mysqli_fetch_array($getOtherPodcasts)) {
                                        ?>
                                        <div class="related-box">
                                            <div>
                                                <?php echo $count++; ?>
                                            </div>
                                            <a href="watch-haven.php?h=<?php echo $dataOtherPodcasts['haven_id']; ?>">
                                                <?php echo $dataOtherPodcasts['haven_title'] ?>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    } else {
                        $haven = $_GET['h'];
                        // CHeck if the story exists still
                        $check_haven_exists = mysqli_query($server, "SELECT * from
                            audio_havens,journalists
                            WHERE audio_havens.haven_journalist = journalists.id
                            AND audio_havens.haven_id = '$haven'
                        ");
                        if (mysqli_num_rows($check_haven_exists) !== 1) {
                            ?>
                            <title>KickSide || Read: 404 - Haven not found.</title>
                            <div class="errorMsg">
                                Audio Haven is not found
                            </div>
                            <?php
                        } else {
                            // Get the data of article
                            $data_haven_exists = mysqli_fetch_array($check_haven_exists);
                            // Update the views number
                            $update_streams = mysqli_query($server, "INSERT into audio_havens_streams
                                VALUES(null,'$haven',1,CURRENT_TIMESTAMP)
                            ");
                            // Getting the current new Streams
                            $get_new_streams = mysqli_fetch_array(mysqli_query($server, "SELECT sum(streams_count) from audio_havens_streams WHERE haven = '$haven'"));
                            ?>
                            <!-- Change the title to the Article to read -->
                            <title>KickSide || Read:
                                <?php echo $data_haven_exists['haven_title']; ?>
                            </title>
                            <h3>
                                <?php echo $data_haven_exists['haven_title'] ?>
                            </h3>
                            <div class="author" title="Author: <?php echo $data_story_exists['display_name']; ?>">
                                <div class="img">
                                    <img src="../assets/images/man_4140048.png" alt="">
                                </div>
                                <div class="ainfo">
                                    <a href="">
                                        Published by
                                        <?php echo $data_haven_exists['first_name'] . " " . $data_haven_exists['last_name']; ?>
                                    </a>
                                    <p>
                                        &nbsp;
                                        on
                                        <?php
                                        $publishdate = $data_haven_exists['haven_upload date'] . " " . $data_haven_exists['haven_upload_time'];

                                        // Convert the timestamp to the desired format
                                        $formattedDate = date('D, M-d, Y', strtotime($publishdate));

                                        // Output the formatted date
                                        echo $formattedDate;
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <?php echo $data_haven_exists['haven_link']; ?>
                            <div class="article-full">
                                <div class="btnz">
                                    <span title="Views: <?php echo $get_new_views['sum(view_count)']; ?>">
                                        <i class="fa fa-headphones"></i>
                                        <?php echo $get_new_streams['sum(streams_count)']; ?>
                                    </span>
                                </div>
                                <div class="full-left" style="margin-top:10px;">
                                    <?php echo "<pre>" . trim($data_haven_exists['haven_description']) . "</pre>"; ?>
                                </div>
                            </div>
                            <div class="related-articles">
                                <h2>
                                    Other Podcasts
                                </h2>
                                <div class="related-row">
                                    <?php
                                    $getOtherPodcasts = mysqli_query($server, "SELECT * from audio_havens
                                    WHERE haven_id != '$haven'
                                    ORDER BY `haven_upload date` DESC,
                                    haven_upload_time DESC
                                    LIMIT 10
                                ");
                                    if (mysqli_num_rows($getOtherPodcasts) < 1) {
                                    } else {
                                        $count = 1;
                                        while ($dataOtherPodcasts = mysqli_fetch_array($getOtherPodcasts)) {
                                            ?>
                                            <div class="related-box">
                                                <div>
                                                    <?php echo $count++; ?>
                                                </div>
                                                <a href="watch-haven.php?h=<?php echo $dataOtherPodcasts['haven_id']; ?>">
                                                    <?php echo $dataOtherPodcasts['haven_title'] ?>
                                                </a>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </article>
    </div>

    <?php
    include('../assets/php/clients/footer.php');
    ?>
</body>

</html>