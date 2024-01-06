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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                        <?php
                        if (!isset($_GET['a'])) {
                            ?>
                            <div class="errorMsg">
                                No request sent to the server.
                            </div>
                            <?php
                        } else if (isset($_GET['a'])) {
                            $articleId = $_GET['a'];
                            $checkArticleExists = mysqli_query($server, "SELECT * from
                                    news_articles,genres 
                                    WHERE 
                                    news_articles.article_genre = genres.id AND
                                    article_id = '$articleId'
                                ");
                            if (mysqli_num_rows($checkArticleExists) != 1) {
                                ?>
                                    <div class="errorMsg">
                                        Article is not found.
                                    </div>
                                <?php
                            } else {
                                while ($dataCheckArticles = mysqli_fetch_array($checkArticleExists)) {
                                    ?>
                                        <h1>
                                            Edit article
                                        </h1>
                                        <div class="form-row">
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                <?php
                                                if (isset($_POST['post_article'])) {
                                                    $genre = mysqli_real_escape_string($server, $_POST['genre']);
                                                    $title = mysqli_real_escape_string($server, $_POST['title']);
                                                    $overview = mysqli_real_escape_string($server, $_POST['overview']);
                                                    $details = mysqli_real_escape_string($server, $_POST['details']);
                                                    $author = mysqli_real_escape_string($server, $acting_jou_id);
                                                    //   Check if the same title exists
                                                    $check_title = mysqli_query($server, "SELECT * from news_articles
                                                        WHERE article_title = '$title'
                                                    ");
                                                    if ($genre === 'Select genre') {
                                                        ?>
                                                        <div class="errorMsg">
                                                            Please select genre.
                                                        </div>
                                                    <?php
                                                    }
                                                    if (mysqli_num_rows($check_title) > 1) {
                                                        ?>
                                                        <div class="errorMsg">
                                                            Article already exists in the database.
                                                        </div>
                                                    <?php
                                                    } else {
                                                        $update = mysqli_query($server, "UPDATE news_articles
                                                            SET 
                                                            article_title = '$title',
                                                            article_overview = '$overview',
                                                            article_full_details = '$details',
                                                            article_genre = '$genre'
                                                            WHERE article_id = '$articleId'
                                                        ");
                                                        if (!$update) {
                                                            ?>
                                                            <div class="errormsg">
                                                                Updating article failed.
                                                            </div>
                                                        <?php
                                                        } else {
                                                            ?>
                                                            <div class="successMsg">
                                                                Article is saved successfully.
                                                            </div>
                                                        <?php
                                                        }
                                                    }


                                                }
                                                ?>
                                                <p>
                                                    <label for="Article Genre">
                                                        Article Genre
                                                    </label>
                                                    <select name="genre">
                                                        <option value="<?php echo $dataCheckArticles['article_genre']; ?>">
                                                        <?php echo $dataGenre = $dataCheckArticles['genre_name'] ?>
                                                        </option>
                                                        <?php
                                                        $get_all_genres = mysqli_query($server, "SELECT * from genres
                                                            WHERE genre_name != '$dataGenre'
                                                            ORDER BY genre_name ASC
                                                            ");
                                                        while ($data_all_genres = mysqli_fetch_array($get_all_genres)) {
                                                            ?>
                                                            <option value="<?php echo $data_all_genres['id']; ?>">
                                                            <?php echo $data_all_genres['genre_name']; ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </p>
                                                <p>
                                                    <label for="Article title">
                                                        Article Title
                                                    </label>
                                                    <textarea name="title" placeholder="Type..."
                                                        required><?php echo $dataCheckArticles['article_title']; ?></textarea>
                                                </p>

                                                <p>
                                                    <label for="Article Overview">
                                                        Article Overview
                                                    </label>
                                                    <textarea name="overview" placeholder="Type..."
                                                        required><?php echo $dataCheckArticles['article_overview']; ?></textarea>
                                                </p>
                                                <p>
                                                    <label for="Article Overview">
                                                        Article in Details
                                                    </label>
                                                    <textarea name="details" placeholder="Type..." class="full"
                                                        required><?php echo $dataCheckArticles['article_full_details']; ?></textarea>
                                                </p>
                                                <p>
                                                    <button type="submit" name="post_article">
                                                        Post
                                                    </button>
                                                </p>
                                            </form>
                                        </div>
                                    <?php
                                }
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </section>


    </main>
    <script src="../assets/js/journalistsToggleNav.js"></script>
</body>

</html>