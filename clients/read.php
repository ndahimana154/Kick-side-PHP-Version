<?php
    include('../assets/php/global/server.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/images/favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/front-main.css">
</head>
<body>
    <main>
        <?php
            include("../assets/php/clients/header.php")
        ?>
       <article class="read-article">
            <div class="article-cont">
                <?php
                    if (!isset($_GET['a'])) {
                        ?>
                        <title>KickSide || Read</title>
                        <div class="errorMsg">
                            No request sent to server
                        </div>
                        <?php
                    }
                    else {
                        $article = $_GET['a'];
                        // CHeck if the story exists still
                        $check_story_exists = mysqli_query($server,"SELECT * from
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
                        }
                        else {
                            // Get the data of article
                            $data_story_exists = mysqli_fetch_array($check_story_exists);
                            // Update the views number
                            $update_views = mysqli_query($server,"INSERT into news_articles_views
                                VALUES(null,'$article',1,CURRENT_TIMESTAMP)
                                ");
                            // Getting thr current new views 
                            $get_new_views = mysqli_fetch_array(mysqli_query($server,"SELECT sum(view_count) from news_articles_views WHERE article = ' $article'"));
                            ?>
                            <!-- Change the title to the Article to read -->
                            <title>KickSide || Read: <?php echo $data_story_exists['article_title']; ?></title>
                            <h3>
                                <?php echo $data_story_exists['article_title'] ?>
                            </h3>
                            <div class="intro">
                                <div class="img-div">
                                    <img src="../assets/articles/posters/<?php echo $data_story_exists['article_poster']; ?>" alt="">
                                </div>
                                <div class="info">
                                    <p>
                                        <?php echo $data_story_exists['article_overview']; ?>
                                    </p>
                                    <div class="author" title="Author: <?php echo $data_story_exists['display_name']; ?>">
                                        <a href="">
                                        <i class="fa fa-user"></i>
                                        <?php echo $data_story_exists['display_name']; ?>
                                        </a>
                                    </div>
                                    <div class="btnz">
                                        <span title="Views: <?php echo $get_new_views['sum(view_count)']; ?>">
                                            <i class="fa fa-eye"></i>
                                            <?php echo $get_new_views['sum(view_count)']; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="article-full">
                                <div class="full-left">
                                    <?php echo"<pre>".$data_story_exists['article_full_details']."</pre>"; ?>
                                </div>
                                <div class="trendingz">
                                    <!-- trendingz -->
                                </div>
                            </div>
                            <?php
                        }
                    }
                ?>
                
            </div>
       </article>
    </main>
</body>
</html>