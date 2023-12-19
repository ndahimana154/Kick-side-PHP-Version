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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                            New Article
                        </h1>
                        <div class="form-row">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <?php
                                if (isset($_POST['post_article'])) {
                                    $genre = mysqli_real_escape_string($server,$_POST['genre']);
                                    $title = mysqli_real_escape_string($server,$_POST['title']);
                                    $postername = $_FILES['poster']['name'];
                                    $overview = mysqli_real_escape_string($server,$_POST['overview']);
                                    $details = mysqli_real_escape_string($server,$_POST['details']);
                                    $author = $acting_jou_id;

                                    $target_dir = "../assets/articles/posters/";
                                    $target_file = $target_dir . basename($_FILES['poster']['name']);
                                    
                                //   Check if the same title exists
                                    $check_title = mysqli_query($server,"SELECT * from news_articles
                                        WHERE article_title = '$title'
                                    ");
                                    if ($genre === 'Select genre') {
                                        ?>
                                        <div class="errorMsg">
                                            Please select genre.
                                        </div>
                                        <?php
                                    }
                                    if (mysqli_num_rows($check_title) > 0) {
                                        ?>
                                        <div class="errorMsg">
                                            Article already exists in the database.
                                        </div>
                                        <?php
                                    }
                                    else {
                                        if (move_uploaded_file($_FILES['poster']['tmp_name'], $target_file)) {
                                        $new = mysqli_query($server,"INSERT into news_articles 
                                            VALUES(null,'$title','$overview','$postername','$details','$author','$genre',CURRENT_TIMESTAMP)
                                        ");
                                        if (!$new) {
                                                ?>
                                                <div class="errormsg">
                                                    Saving article failed.
                                                </div>
                                                <?php
                                        }
                                        else {
                                            ?>
                                            <div class="successMsg">
                                                Article is saved successfully.
                                            </div>
                                            <?php
                                        }
                                        } else {
                                            ?>
                                            <div class="errorMsg">
                                                Updloading failed
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
                                    <select name="genre" id="">
                                        <option value="Select genre">Select genre</option>
                                        <?php
                                            $get_all_genres = mysqli_query($server,"SELECT * from genres
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
                                    <textarea name="title" placeholder="Type..." required></textarea>
                                </p>
                                <p>
                                    <label for="Article poster">
                                        Article Poster
                                    </label>
                                    <input type="file" name="poster" required>
                                </p>
                                <p>
                                    <label for="Article Overview">
                                        Article Overview
                                    </label>
                                    <textarea name="overview"  placeholder="Type..." required></textarea>
                                </p>
                                <p>
                                    <label for="Article Overview">
                                        Article in Details
                                    </label>
                                    <textarea name="details"  placeholder="Type..." required></textarea>
                                </p>
                                <p>
                                    <button type="submit" name="post_article">
                                        Post
                                    </button>
                                </p>
                            </form>
                        </div>
                    </div>
               </div>
            </div> 
        </section>
        
        
    </main>
    <script src="../assets/js/journalistsToggleNav.js"></script>
</body>
</html>