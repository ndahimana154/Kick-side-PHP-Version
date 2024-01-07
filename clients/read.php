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
                    if (!isset($_GET['a'])) {
                        ?>
                        <title>KickSide || Read</title>
                        <div class="errorMsg">
                            No request sent to server
                        </div>
                        <?php
                    } else {
                        $article = $_GET['a'];
                        // CHeck if the story exists still
                        $check_story_exists = mysqli_query($server, "SELECT * from
                            news_articles,journalists
                            WHERE article_id = '$article'
                            AND journalists.id = news_articles.article_author
                        ");
                        if (mysqli_num_rows($check_story_exists) !== 1) {
                            ?>
                            <title>KickSide || Read: 404 - Article not found.</title>

                            <div class="errorMsg">
                                Article is not found
                            </div>
                            <?php
                        } else {
                            // Get the data of article
                            $data_story_exists = mysqli_fetch_array($check_story_exists);
                            // Update the views number
                            $update_views = mysqli_query($server, "INSERT into news_articles_views
                                VALUES(null,'$article',1,CURRENT_TIMESTAMP)
                                ");
                            // Getting thr current new views 
                            $get_new_views = mysqli_fetch_array(mysqli_query($server, "SELECT sum(view_count) from news_articles_views WHERE article = ' $article'"));
                            ?>
                            <!-- Change the title to the Article to read -->
                            <title>KickSide || Read:
                                <?php echo $data_story_exists['article_title']; ?>
                            </title>
                            <h3>
                                <?php echo $data_story_exists['article_title'] ?>
                            </h3>
                            <div class="author" title="Author: <?php echo $data_story_exists['display_name']; ?>">
                                <div class="img">
                                    <img src="../assets/images/man_4140048.png" alt="">
                                </div>
                                <div class="ainfo">
                                    <a href="">
                                        Published by
                                        <?php echo $data_story_exists['display_name']; ?>
                                    </a>
                                    <p>
                                        &nbsp;
                                        on
                                        <?php
                                        $publishdate = $data_story_exists['article_publish_time'];

                                        // Convert the timestamp to the desired format
                                        $formattedDate = date('D, M-d, Y', strtotime($publishdate));

                                        // Output the formatted date
                                        echo $formattedDate;
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="intro">
                                <div class="img-div">
                                    <img src="../assets/articles/posters/<?php echo $data_story_exists['article_poster']; ?>"
                                        alt="">
                                </div>
                                <div class="info">
                                    <pre><?php echo trim($data_story_exists['article_overview']); ?></pre>
                                </div>
                            </div>

                            <div class="article-full">
                                <div class="btnz">
                                    <span title="Views: <?php echo $get_new_views['sum(view_count)']; ?>">
                                        <i class="fa fa-eye"></i>
                                        <?php echo $get_new_views['sum(view_count)']; ?>
                                    </span>
                                </div>
                                <div class="full-left">
                                    <?php echo "<pre>" . trim($data_story_exists['article_full_details']) . "</pre>"; ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <div class="related-articles">
                        <h2>
                            Latest articles
                        </h2>
                        <div class="related-row">
                            <?php
                            $getRelated = mysqli_query($server, "SELECT * from news_articles
                                WHERE
                                article_id != '$article'
                                    ORDER BY article_publish_time DESC
                                    LIMIT 10
                                ");
                            if (mysqli_num_rows($getRelated) < 1) {
                            } else {
                                $count = 1;
                                while ($dataRelated = mysqli_fetch_array($getRelated)) {
                                    ?>
                                    <div class="related-box">
                                        <div>
                                            <?php echo $count++; ?>
                                        </div>
                                        <a href="">
                                            <?php echo $dataRelated['article_title'] ?>
                                        </a>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>

    <?php
    include('../assets/php/clients/footer.php');
    ?>
</body>

</html>