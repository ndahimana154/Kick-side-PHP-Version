<?php
include('../assets/php/global/server.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/images/favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                $getlast = mysqli_query($server, "SELECT * from news_articles,genres WHERE news_articles.article_genre  = genres.id ORDER BY article_publish_time DESC ");
                if (mysqli_num_rows($getlast) >= 1) {
                    $datalast = mysqli_fetch_array($getlast);
                    $lastid  = $datalast['article_id'];
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
                                                <img src="../assets/articles/posters/<?php echo $databreaking['article_poster']; ?>" alt="">
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
                            Today in History
                        </h2>
                        <div class="form">
                            <p>
                                <label for="Month">
                                    Month
                                </label>
                                <input type="text" id="dateInput" name="dateInput" pattern="^(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[0-2])$" required>
                                <select name="" id="">
                                    <option value="">January</option>
                                    <option value="">February</option>
                                    <option value="">March</option>
                                    <option value="">April</option>
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                    <option value=""></option>
                                </select>
                            </p>
                            <p>
                                <label for="Day">
                                    Day
                                </label>
                                <select name="" id="">
                                    <?php
                                    for ($a = 1; $a < 32; $a++) {
                                    ?>
                                        <option value="">
                                            <?php
                                            if ($a < 10) {
                                                echo "0" . $a;
                                            } else {
                                                echo $a;
                                            }
                                            ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </p>
                        </div>
                        <div class="contents-b">
                            <div class="onec">
                                <h4>
                                    Title of the event.
                                </h4>
                                <div class="img">
                                    <img src="../assets/images/KickSide - Logo.png" alt="">
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores voluptatem dolorum voluptates rem quasi labore nobis odit amet id quod vitae, aut quas iusto deleniti. Earum vero dolorem minus similique?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="podcasts">
            <div class="cont">
                <div class="pod-cont">
                    <h2>
                        Audio Haven.
                    </h2>
                    <div class="casts-row">
                        <div class="cast-box">
                            <a href="">
                                <div class="img">
                                    <img src="../assets/images/Talk Show Podcast Cover Maker with Picture copy.jpg" alt="">
                                </div>
                                <div class="info">
                                    <h4>
                                        Podcast name: Episode Name
                                    </h4>
                                    <p>
                                        Date: 31-19-2023
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="cast-box">
                            <a href="">
                                <div class="img">
                                    <img src="../assets/images/Talk Show Podcast Cover Maker with Picture copy.jpg" alt="">
                                </div>
                                <div class="info">
                                    <h4>
                                        Podcast name: Episode Name
                                    </h4>
                                    <p>
                                        Date: 31-19-2023
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="cast-box">
                            <a href="">
                                <div class="img">
                                    <img src="../assets/images/Talk Show Podcast Cover Maker with Picture copy.jpg" alt="">
                                </div>
                                <div class="info">
                                    <h4>
                                        Podcast name: Episode Name
                                    </h4>
                                    <p>
                                        Date: 31-19-2023
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="cast-box">
                            <a href="">
                                <div class="img">
                                    <img src="../assets/images/Talk Show Podcast Cover Maker with Picture copy.jpg" alt="">
                                </div>
                                <div class="info">
                                    <h4>
                                        Podcast name: Episode Name
                                    </h4>
                                    <p>
                                        Date: 31-19-2023
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fav-jou">
            <div class="cont">
                <div class="fav-jou-cont">
                    <h2>Reporter's favorites</h2>
                    <div class="fav-row">
                        <?php
                        $getreporand = mysqli_query($server, "SELECT * from journalists
                                ORDER BY rand()
                            ");
                        if (mysqli_num_rows($getreporand) > 0) {
                            while ($datareporand = mysqli_fetch_array($getreporand)) {
                                $repoid = $datareporand['id'];
                                $getrepofav = mysqli_query($server, "SELECT * from news_articles,journalists_favorites
                                        WHERE news_articles.article_id = journalists_favorites.article
                                        AND journalists_favorites.journalist = '$repoid'
                                        ORDER BY journalists_favorites.date_of_fav DESC
                                    ");
                                if (mysqli_num_rows($getrepofav) > 0) {
                                    $datarepofav = mysqli_fetch_array($getrepofav);
                        ?>
                                    reijfij
                        <?php
                                }
                            }
                        }
                        ?>

                        <div class="fav-box">
                            <div class="reporter">
                                <a href="">
                                    <img src="../assets/images/man_4140048.png" alt="Image for author">
                                    <p>
                                        Firstname Lastname
                                    </p>
                                </a>
                            </div>
                            <div class="article">
                                <a href="">
                                    <div class="info">
                                        <h4>
                                            Article title will be displayed here as
                                            i have analysed and found it could be cool to do so.
                                        </h4>

                                    </div>

                                </a>
                            </div>
                        </div>
                        <div class="fav-box">
                            <div class="reporter">
                                <a href="">
                                    <img src="../assets/images/man_4140048.png" alt="Image for author">
                                    <p>
                                        Firstname Lastname
                                    </p>
                                </a>
                            </div>
                            <div class="article">
                                <a href="">
                                    <div class="info">
                                        <h4>
                                            Article title will be displayed here as
                                            i have analysed and found it could be cool to do so.
                                        </h4>

                                    </div>

                                </a>
                            </div>
                        </div>
                        <div class="fav-box">
                            <div class="reporter">
                                <a href="">
                                    <img src="../assets/images/man_4140048.png" alt="Image for author">
                                    <p>
                                        Firstname Lastname
                                    </p>
                                </a>
                            </div>
                            <div class="article">
                                <a href="">
                                    <div class="info">
                                        <h4>
                                            Article title will be displayed here as
                                            i have analysed and found it could be cool to do so.
                                        </h4>

                                    </div>

                                </a>
                            </div>
                        </div>
                        <div class="fav-box">
                            <div class="reporter">
                                <a href="">
                                    <img src="../assets/images/man_4140048.png" alt="Image for author">
                                    <p>
                                        Firstname Lastname
                                    </p>
                                </a>
                            </div>
                            <div class="article">
                                <a href="">
                                    <div class="info">
                                        <h4>
                                            Article title will be displayed here as
                                            i have analysed and found it could be cool to do so.
                                        </h4>

                                    </div>

                                </a>
                            </div>
                        </div>
                        <div class="fav-box">
                            <div class="reporter">
                                <a href="">
                                    <img src="../assets/images/man_4140048.png" alt="Image for author">
                                    <p>
                                        Firstname Lastname
                                    </p>
                                </a>
                            </div>
                            <div class="article">
                                <a href="">
                                    <div class="info">
                                        <h4>
                                            Article title will be displayed here as
                                            i have analysed and found it could be cool to do so.
                                        </h4>

                                    </div>

                                </a>
                            </div>
                        </div>
                        <div class="fav-box">
                            <div class="reporter">
                                <a href="">
                                    <img src="../assets/images/man_4140048.png" alt="Image for author">
                                    <p>
                                        Firstname Lastname
                                    </p>
                                </a>
                            </div>
                            <div class="article">
                                <a href="">
                                    <div class="info">
                                        <h4>
                                            Article title will be displayed here as
                                            i have analysed and found it could be cool to do so.
                                        </h4>

                                    </div>

                                </a>
                            </div>
                        </div>
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