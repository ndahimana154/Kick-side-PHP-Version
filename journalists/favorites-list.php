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
    <title>Kickside || Journalists Favorites List</title>
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
                            Favorites List
                        </h1>
                        <?php
                        if (isset($_GET['delete'])) {
                            $fa = $_GET['delete'];
                            $checkifexists = mysqli_query($server, "SELECT * from journalists_favorites
                                    WHERE article = '$fa'
                                ");
                            $checkifowns = mysqli_query($server, "SELECT * from news_articles WHERE
                                    article_author = '$acting_jou_id'
                                ");
                            if (mysqli_num_rows($checkifexists) < 1) {
                        ?>
                                <div class="errorMsg">
                                    The article doesn't look to be on the favorites list.
                                </div>
                            <?php
                            } elseif (mysqli_num_rows($checkifowns) < 1) {
                            ?>
                                <div class="errorMsg">
                                    It looks like you don't own this article. If it's a misunderstaning please contact system support.
                                </div>
                                <?php
                            } else {
                                $delete = mysqli_query($server, "DELETE from journalists_favorites
                                        WHERE article = '$fa'
                                        AND journalist = '$acting_jou_id'
                                    ");
                                if (!$delete) {
                                ?>
                                    <div class="errorMsg">
                                        Deleting the article from favorites failed.
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="successMsg">
                                        Deleting the article from favorites succed.
                                    </div>
                        <?php
                                }
                            }
                        }
                        ?>
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
                                            Date of Favorite
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getArticles = mysqli_query($server, "SELECT * from 
                                            news_articles,genres,journalists_favorites
                                            WHERE 
                                            news_articles.article_genre = genres.id AND
                                            article_author = '$acting_jou_id'
                                            AND journalists_favorites.article = news_articles.article_id 
                                         
                                            ORDER BY article_publish_time DESC
                                        ");
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
                                                    <?php echo $rowArticles["date_of_fav"]; ?>
                                                </td>
                                                <td>
                                                    <a onclick="return confirm('Are you sure to delete the article from the Favorites.')" href="?delete=<?php echo $rowArticles['article_id']; ?>" class="delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
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
                            <div class="failed">dsoi onionion</div>
                            <div class="success">In idsn indnsss </div>
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