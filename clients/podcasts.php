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
    <title>KickSide RW - Podcasts.</title>
</head>
<body>
    <div class="container">
        <?php
        include('../assets/php/clients/header.php');
        ?>
        <div class="g-container">
            <div class="cont">
                <?php
                include("../assets/php/clients/search-form.php");
                ?>
                <div class="genre-title">
                    <div class="title">
                        <i class="fa fa-podcast"></i>
                        <div class="title-name">
                            <span>
                                Podcasts
                            </span>
                            <p>
                                This is the Podcasts page.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="genres-row">
                    <?php
                    $getPodcasts = mysqli_query($server, "SELECT * from 
                        audio_havens,journalists
                        WHERE 
                        journalists.id = audio_havens.haven_journalist 
                        ORDER BY `haven_upload date` DESC,
                        haven_upload_time DESC
                        
                    ");
                    if (mysqli_num_rows($getPodcasts) < 1) {
                        ?>
                        <div class="errorMsg">
                            No articles found.
                        </div>
                        <?php
                    } else {
                        while ($dataPodcasts = mysqli_fetch_array($getPodcasts)) {
                            ?>
                            <a href="watch-haven.php?h=<?php echo $dataPodcasts['haven_id'] ?>">
                                <div class="img">
                                    <img src="../assets/audio_havens/<?php echo $dataPodcasts['haven_image_name']; ?>"
                                        alt="Image for <?php echo $dataPodcasts['haven_title']; ?>">
                                </div>
                                <p>
                                    <?php echo $dataPodcasts['haven_title']; ?>
                                </p>
                                <h4 style="font-weight:bold;text-align:center;">
                                <i class="fa fa-user"></i>    
                                <?php echo $dataPodcasts['first_name']." ".$dataPodcasts['last_name']; ?>
                                </h4>
                            </a>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        include('../assets/php/clients/footer.php');
        ?>
    </div>
</body>

</html>