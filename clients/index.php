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
    <title>KickSide RW - Home</title>
</head>

<body>
    <div class="container">
        <?php
        include('../assets/php/clients/header.php');
        ?>

        <div class="hero">
            <div class="cont">
                <?php
                include("../assets/php/clients/search-form.php");
                $getlast = mysqli_query($server, "SELECT * from news_articles,genres WHERE news_articles.article_genre  = genres.id ORDER BY article_publish_time DESC ");
                if (mysqli_num_rows($getlast) >= 1) {
                    $datalast = mysqli_fetch_array($getlast);
                    $lastid = $datalast['article_id'];
                    ?>
                    <div class="box">
                        <a href="read.php?a=<?php echo $datalast['article_id'] ?>">
                            <div class="img">
                                <img src="../assets/articles/posters/<?php echo $datalast['article_poster'] ?>" alt="">
                            </div>
                            <div class="info">
                                <p>
                                    <span>

                                        <?php echo $datalast['genre_name']; ?>
                                    </span>
                                    &nbsp;
                                    <?php
                                    echo "- " . $datalast['article_publish_time'];
                                    ?>
                                </p>
                                <h2>
                                    <?php echo $datalast['article_title'] ?>
                                </h2>
                            </div>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="lower">
            <div class="cont">

                <div class="bnews">
                    <div class="bn-cont">
                        <h2>
                            Breaking News
                        </h2>
                        <div class="b-row">
                            <?php
                            $getbreaking = mysqli_query($server, "SELECT * from news_articles,categories,news_articles_categories,journalists WHERE news_articles.article_id = news_articles_categories.article
                                AND news_articles_categories.category  = categories.id
                                AND categories.category_name = 'Breaking News'
                                AND news_articles.article_id != '$lastid'
                                AND news_articles.article_author = journalists.id
                                ORDER BY date_of_exclusiveness DESC
                                LIMIT 10
                            ");
                            if (mysqli_num_rows($getbreaking) > 0) {
                                while ($databreaking = mysqli_fetch_array($getbreaking)) {
                                    ?>
                                    <div class="b-box">
                                        <a href="read.php?a=<?php echo $databreaking['article_id']; ?>">
                                            <div class="img">
                                                <img src="../assets/articles/posters/<?php echo $databreaking['article_poster']; ?>"
                                                    alt="">
                                            </div>
                                            <div class="info">
                                                <h3>
                                                    <?php echo $databreaking['article_title']; ?>
                                                </h3>
                                                <p>
                                                    <i class="fa fa-user"></i>
                                                    <?php echo $databreaking['first_name'] . " " . $databreaking['last_name']; ?>
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                    <div class="bn-cont">
                        <h2>
                            Transfer Rumors
                        </h2>
                        <div class="b-row" style="background: #fff;">
                            <?php
                            $getbreaking = mysqli_query($server, "SELECT * from news_articles,categories,news_articles_categories,journalists WHERE news_articles.article_id = news_articles_categories.article
                                AND news_articles_categories.category  = categories.id
                                AND categories.category_name = 'Transfer Rumors'
                                AND news_articles.article_id != '$lastid'
                                AND news_articles.article_author = journalists.id
                                ORDER BY date_of_exclusiveness DESC
                                LIMIT 10
                            ");
                            if (mysqli_num_rows($getbreaking) > 0) {
                                while ($databreaking = mysqli_fetch_array($getbreaking)) {
                                    ?>
                                    <div class="b-box">
                                        <a href="read.php?a=<?php echo $databreaking['article_id']; ?>">
                                            <div class="img">
                                                <img src="../assets/articles/posters/<?php echo $databreaking['article_poster']; ?>"
                                                    alt="">
                                            </div>
                                            <div class="info">
                                                <h3>
                                                    <?php echo $databreaking['article_title']; ?>
                                                </h3>
                                                <p>
                                                    <i class="fa fa-user"></i>
                                                    <?php echo $databreaking['first_name'] . " " . $databreaking['last_name']; ?>
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="today">
                    <div class="t-cont">
                        <h2>
                            What's in History?
                        </h2>
                        <div class="form">
                            <p>
                                <label for="">
                                    Today
                                    <?php echo date('D, d-M-Y') ?>
                                </label>
                            </p>
                        </div>
                        <div class="contents-b">
                            <?php
                            $current_date = date('m-d');
                            $get_today = mysqli_query($server, "SELECT * from history_today
                                    WHERE history_date LIKE '%$current_date'
                                    ORDER BY history_date DESC
                                ");
                            if (mysqli_num_rows($get_today) < 1) {
                                ?>
                                <div class="onec">
                                    <h4>
                                        No history found.
                                    </h4>
                                </div>
                                <?php
                            } else {
                                while ($data_today = mysqli_fetch_array($get_today)) {
                                    ?>
                                    <div class="onec">
                                        <h4>
                                            <?php echo $data_today['history_title']; ?>
                                        </h4>

                                        <div class="img">
                                            <img src="../assets/history/<?php echo $data_today['history_image']; ?>"
                                                alt="Image for: <?php echo $data_today['history_title']; ?>">
                                        </div>
                                        <p>
                                        <div class="date">
                                            <?php
                                            $history_date = new DateTime($data_today['history_date']);
                                            $current_date = new DateTime();
                                            $interval = $current_date->diff($history_date);
                                            echo $interval->y . ' years ago';
                                            ?>
                                        </div>
                                        <?php echo $data_today['history_description']; ?>
                                        </p>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="podcasts">
            <div class="cont">
                <?php
                $gethavens = mysqli_query($server, "SELECT * from audio_havens,journalists
                        WHERE
                        audio_havens.haven_journalist = journalists.id
                        ORDER BY `haven_upload date` DESC,
                        haven_upload_time DESC
                        LIMIT 12
                    ");
                if (mysqli_num_rows($gethavens) > 0) {
                    ?>
                    <div class="pod-cont">
                        <h2>
                            Podcasts
                        </h2>
                        <div class="casts-row">
                            <?php
                            while ($dataHavens = mysqli_fetch_array($gethavens)) {
                                ?>
                                <div class="cast-box">
                                    <a href="watch-haven.php?h=<?php echo $dataHavens['haven_id']; ?>">
                                        <div class="img">
                                            <img src="../assets/audio_havens/<?php echo $dataHavens['haven_image_name']; ?>"
                                                alt="">
                                        </div>
                                        <div class="info">
                                            <h4>
                                                <?php echo $dataHavens['haven_title'] ?>
                                            </h4>
                                            <p>
                                            <i class="fa fa-user"></i>
                                            <?php echo $dataHavens['first_name']." ".$dataHavens['last_name']; ?>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="fav-jou">
            <div class="cont">
                <div class="fav-jou-cont">
                    <h2>Journalist's Picks</h2>
                    <div class="fav-row">
                        <?php
                        $getreporand = mysqli_query($server, "SELECT * from journalists
                                ORDER BY rand()
                                LIMIT 10
                            ");
                        if (mysqli_num_rows($getreporand) > 0) {
                            while ($datareporand = mysqli_fetch_array($getreporand)) {
                                $repoid = $datareporand['id'];
                                $getrepofav = mysqli_query($server, "SELECT * from news_articles,journalists_favorites,journalists
                                        WHERE news_articles.article_id = journalists_favorites.article
                                        AND journalists_favorites.journalist = '$repoid'
                                        AND journalists.id = news_articles.article_author
                                        ORDER BY journalists_favorites.date_of_fav DESC
                                    ");
                                if (mysqli_num_rows($getrepofav) > 0) {
                                    $datarepofav = mysqli_fetch_array($getrepofav);
                                    ?>
                                    <div class="fav-box">
                                        <div class="reporter">
                                            <!-- <a href=""> -->
                                            <!-- <img src="../assets/images/man_4140048.png" alt="Image for author"> -->
                                            <p>
                                                <?php echo $datarepofav['first_name'] . " " . $datarepofav['last_name']; ?>
                                            </p>
                                            <!-- </a> -->
                                        </div>
                                        <div class="article">
                                            <a href="read.php?a=<?php echo $datarepofav['article_id']; ?>">
                                                <div class="info">
                                                    <h4>
                                                        <?php echo $datarepofav['article_title'] ?>
                                                    </h4>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <?php
        include('../assets/php/clients/footer.php');
        ?>
    </div>
</body>
</html>