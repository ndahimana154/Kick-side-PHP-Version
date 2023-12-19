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
    <title>KickSide || Home</title>
</head>
<body>
    <main>
        <?php
            include("../assets/php/clients/header.php")
        ?>
        <!-- <section class="match-high">
            <div class="match-high-cont">
                <h2>
                    Match Highlights
                </h2>
                <div class="matches-row">
                    <div class="match-box">
                        <div class="names-box">
                            <div class="one-team">
                                Home Team
                            </div>
                            <div class="results">
                                2-1 
                            </div>
                            <div class="vs">
                                VS
                            </div>
                            <div class="one-team">
                                Away Team
                            </div>
                        </div>
                        <div class="match-time">
                            20.November.2023
                        </div>
                    </div>
                    <div class="match-box">
                        <div class="names-box">
                            <div class="one-team">
                                Home Team
                            </div>
                            <div class="results">
                                2-1 
                            </div>
                            <div class="vs">
                                VS
                            </div>
                            <div class="one-team">
                                Away Team
                            </div>
                        </div>
                        <div class="match-time">
                            20.November.2023
                        </div>
                    </div>
                    <div class="match-box">
                        <div class="names-box">
                            <div class="one-team">
                                Home Team
                            </div>
                            <div class="results">
                                2-1 
                            </div>
                            <div class="vs">
                                VS
                            </div>
                            <div class="one-team">
                                Away Team
                            </div>
                        </div>
                        <div class="match-time">
                            20.November.2023
                        </div>
                    </div>
                    <div class="match-box">
                        <div class="names-box">
                            <div class="one-team">
                                Home Team
                            </div>
                            <div class="results">
                                2-1 
                            </div>
                            <div class="vs">
                                VS
                            </div>
                            <div class="one-team">
                                Away Team
                            </div>
                        </div>
                        <div class="match-time">
                            20.November.2023
                        </div>
                    </div>
                   
                </div>
            </div>
        </section> -->
        <section class="hero">
            <?php
                
                $get_week_trend = mysqli_query($server,"SELECT * from 
                news_articles,news_articles_categories,genres,journalists,categories
                WHERE
                news_articles.article_id = news_articles_categories.article
                AND news_articles.article_genre = genres.id
                AND news_articles.article_author = journalists.id
                AND news_articles_categories.category = categories.id
                ORDER BY 
                news_articles_categories.date_of_exclusiveness DESC
                LIMIT 5
                ");
                if (mysqli_num_rows($get_week_trend) < 1) {
                    ?>
                    <div class="errorMsg">
                        No articles found
                    </div>
                    <?php
                }
                else {
                    $data_weekly_trends = mysqli_fetch_array($get_week_trend);
                    $hero_article = $data_weekly_trends['article_id'];
                    ?>
                    <a href="read.php?a=<?php echo $data_weekly_trends['article_id']; ?>" title="<?php echo $data_weekly_trends['article_title'] ?>">
                        <div class="hero-cont">
                            <div class="hero-image">
                                <img src="../assets/articles/posters/<?php echo $data_weekly_trends['article_poster']; ?>" alt="IMAGE FOR: <?php echo $data_weekly_trends['article_title'] ?>">
                            </div>
                            <div class="hero-description">
                                <div class="types">
                                    <span class="category">
                                        <?php echo $data_weekly_trends['category_name'] ?>
                                    </span>
                                    <span>
                                        <?php echo $data_weekly_trends['genre_name'] ?>
                                    </span>
                                </div>
                                <h2>
                                    <?php echo $data_weekly_trends['article_title']; ?>
                                </h2>
                                <div class="author">
                                    <i class="fa fa-user"></i>
                                    <p>
                                        <?php echo $data_weekly_trends['display_name']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
            ?>
        </section>
        <section class="below-hero">
            <div class="below-hero-cont">
                <?php
                    if (isset($hero_article)) {
                    
                    
                        $get_latest = mysqli_query($server,"SELECT * from news_articles,genres
                            WHERE
                            news_articles.article_genre = genres.id
                            AND news_articles.article_id != $hero_article
                            ORDER By article_publish_time DESC
                            LIMIT 9
                        ");
                        if (mysqli_num_rows($get_latest) < 1) {
                            ?>
                            <div class="errorMsg">
                                <!-- No article found! -->
                            </div>
                            <?php
                        }
                        while ($data_latest = mysqli_fetch_array($get_latest)) {
                            ?>
                            <a href="read.php?a=<?php echo $data_latest['article_id']; ?>" title="<?php echo $data_latest['article_title']; ?>">
                                <div class="below-box">
                                    <div class="below-img">
                                        <img src="../assets/articles/posters/<?php echo $data_latest['article_poster']; ?>" alt="">
                                    </div>
                                    <div class="below-text">
                                        <div class="types">
                                            <span>
                                                <?php echo $data_latest['genre_name'] ?>
                                            </span>
                                        </div>
                                        <h3>
                                            <?php echo $data_latest['article_title'] ?>
                                        </h3>
                                    </div>
                                </div>
                            </a>
                            <?php
                        }
                    }
                ?>
              
               
            </div>
        </section>
        <!-- <section class="trendings">
            <div class="trendings-cont">
                <h1>
                    AlongSide
                </h1>
                <div class="trendings-box">

                </div>
            </div>
        </section> -->
    </main>
</body>
</html>