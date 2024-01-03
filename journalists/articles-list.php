<?php
session_start();
include("../assets/php/global/server.php");
include("../assets/php/journalists/session_mgt.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/back-main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Kickside || Journalists New article</title>
</head>

<body>
    <main>
        <section class="main-section">
            <?php
            include('../assets/php/journalists/header.php')
            ?>
            <div class="hero">
                <?php include("../assets/php/journalists/left-nav.php") ?>
                <div class="dashboard">
                    <div class="dashboard-cont">
                        <h1>
                            Articles List
                        </h1>
                        <div class="form-row">
                            <table>
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            Article Genre
                                        </th>
                                        <th>
                                            Article Title
                                        </th>
                                        <th>
                                            Publish time.
                                        </th>
                                        <th>
                                            Article Views
                                        </th>

                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getArticles = mysqli_query($server, "SELECT * from 
                                            news_articles,genres
                                            WHERE 
                                            news_articles.article_genre = genres.id AND
                                            article_author = '$acting_jou_id'
                                            ORDER BY article_publish_time DESC
                                        ") or die(mysqli_error($conn));
                                    if (mysqli_num_rows($getArticles) < 1) {
                                    ?>
                                        <tr>
                                            <td colspan="20">
                                                No values found...
                                            </td>
                                        </tr>
                                        <?php
                                    } else {
                                        $count = 1;
                                        while ($rowArticles = mysqli_fetch_assoc($getArticles)) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php echo $count++ ?>
                                                </td>
                                                <td>
                                                    <?php echo $rowArticles["genre_name"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $rowArticles["article_title"]; ?>
                                                </td>
                                                <td>
                                                    <?php echo $rowArticles["article_publish_time"]; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $articleId = $rowArticles["article_id"];
                                                    $getViewsCount = mysqli_query($server, "SELECT * from news_articles_views
                                                                WHERE article = '$articleId'
                                                            ");
                                                    echo mysqli_num_rows($getViewsCount);
                                                    ?>
                                                </td>

                                                <td>
                                                    <a href="edit-article.php?a=<?php echo $articleId; ?>" class="edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button class="markFav" value="<?php echo $articleId; ?>" title="Mark Article as favorite">
                                                        <i class="fa fa-heart" style="color: red;"></i>
                                                    </button>
                                                    <a href="../clients/read.php?a=<?php echo $rowArticles['article_id']; ?>" target="_blank" title="Watch the article live.">
                                                        <i class="fa fa-eye"></i>
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
                <div class="modal" id="favorite-modal">
                    <div class="favorite-cont">
                        <div class="title">
                            <h4>
                                Mark favorite article.
                            </h4>
                            <button id="closeMarkFav" title="Close">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>
                        <div class="favorite-content">
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>
    <script src="../assets/js/jQuery.min.js"></script>
    <script src="../assets/js/journalistsToggleNav.js"></script>
    <script src="../assets/js/journalistFav-Article.js"></script>
    < /body>

        < /html>