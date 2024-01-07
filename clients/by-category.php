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
    <title>KickSide RW - Articles by Categories.</title>
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
                if (!isset($_GET['c'])) {
                    ?>
                    <div class="errorMsg">
                        No request sent to server.
                    </div>
                    <?php
                } else {
                    $cat = $_GET['c'];
                    $checkCatExists = mysqli_query($server, "SELECT * from categories
                            WHERE id= '$cat'
                        ");
                    if (mysqli_num_rows($checkCatExists) < 1) {
                        ?>
                        <div class="errorMsg">
                            Category is not found.
                        </div>
                        <?php
                    } else {
                        $dataCatExists = mysqli_fetch_array($checkCatExists);
                        $categoryName = $dataCatExists['category_name'];
                        $categoryIcon = $dataCatExists['category_icon'];
                        $categoryDescription = $dataCatExists['category_description'];
                        ?>
                        <div class="genre-title">
                            <div class="title">
                                <i class="fa <?php echo $categoryIcon; ?>"></i>
                                <div class="title-name">
                                    <span>
                                        <?php echo $categoryName; ?>
                                    </span>
                                    <p>
                                        <?php echo $categoryDescription; ?>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="genres-row">
                            <?php
                            $getCatArticles = mysqli_query($server, "SELECT * from 
                                    news_articles_categories,
                                    news_articles
                                    WHERE
                                    news_articles.article_id = news_articles_categories.article
                                    AND category = '$cat'
                                    ORDER BY 
                                    article_publish_time DESC
                                    LIMIT 30
                            ");
                            if (mysqli_num_rows($getCatArticles) < 1) {
                                ?>
                                <div class="errorMsg">
                                    No articles found.
                                </div>
                                <?php
                            } else {
                                while ($dataCatArticles = mysqli_fetch_array($getCatArticles)) {
                                    ?>
                                    <a href="read.php?a=<?php echo $dataCatArticles['article_id'] ?>">
                                        <div class="img">
                                            <img src="../assets/articles/posters/<?php echo $dataCatArticles['article_poster']; ?>"
                                                alt="Image for <?php echo $dataCatArticles['article_title']; ?>">
                                        </div>
                                        <p>
                                            <?php echo $dataCatArticles['article_title']; ?>
                                        </p>
                                    </a>
                                    <?php
                                }
                            }
                            ?>
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