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
    <title>KickSide RW - Articles by Genre.</title>
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
                if (!isset($_GET['g'])) {
                    ?>
                    <div class="errorMsg">
                        No request sent to server.
                    </div>
                    <?php
                } else {
                    $genre = $_GET['g'];
                    $checkGenreExists = mysqli_query($server, "SELECT * from genres
                            WHERE id= '$genre'
                        ");
                    if (mysqli_num_rows($checkGenreExists) < 1) {
                        ?>
                        <div class="errorMsg">
                            Genre is not found.
                        </div>
                        <?php
                    } else {
                        $dataGenreExists = mysqli_fetch_array($checkGenreExists);
                        $genreName = $dataGenreExists['genre_name'];
                        $genreDescription = $dataGenreExists['genre_description'];
                        $genreIcon = $dataGenreExists['genre_icon'];
                        ?>
                        <div class="genre-title">
                            <div class="title">
                                <i class="fa <?php echo $genreIcon; ?>"></i>
                                <div class="title-name">
                                    <span>
                                        <?php echo $genreName; ?>
                                    </span>
                                    <p>
                                        <?php echo $genreDescription; ?>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="genres-row">
                            <?php
                            $getGenresArticles = mysqli_query($server, "SELECT * from 
                                    news_articles
                                    WHERE article_genre = '$genre'
                                    ORDER BY article_publish_time DESC
                                    
                            ");
                            if (mysqli_num_rows($getGenresArticles) < 1) {
                                ?>
                                <div class="errorMsg">
                                    No articles found.
                                </div>
                                <?php
                            } else {
                                while ($dataGenreArticles = mysqli_fetch_array($getGenresArticles)) {
                                    ?>
                                    <a href="read.php?a=<?php echo $dataGenreArticles['article_id'] ?>">
                                        <div class="img">
                                            <img src="../assets/articles/posters/<?php echo $dataGenreArticles['article_poster']; ?>"
                                                alt="Image for <?php echo $dataGenreArticles['article_title']; ?>">
                                        </div>
                                        <p>
                                            <?php echo $dataGenreArticles['article_title']; ?>
                                        </p>
                                    </a>
                                    <?php
                                }
                            }
                            ?>
                            <a href="">

                            </a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <?php
        include('../assets/php/clients/footer.php');
        ?>
    </div>
</body>

</html>