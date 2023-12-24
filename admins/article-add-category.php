<?php
session_start();
include("../assets/php/global/server.php");
include("../assets/php/admins/session_checker.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../assets/css/back-main.css">
   <link rel="shortcut icon" href="../assets/images/favicon.jpg" type="image/x-icon">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <title>KickSide || Home</title>
</head>

<body>
   <main>
      <?php include("../assets/php/admins/header.php"); ?>
      <div>
         <h2>
            Articles add category.
         </h2>
         <div>
            <?php
            if (!isset($_GET['a'])) {
               echo "No article sent to the server";
            } else {
               // Check if the article exists
               $article = $_GET['a'];
               $check_article_exists = mysqli_query($server, "SELECT * from news_articles 
                           WHERE article_id = '$article'
                     ");
               if (mysqli_num_rows($check_article_exists) < 1) {
                  echo "Article is not found.";
               } else {
                  $data_article_exists = mysqli_fetch_array($check_article_exists);
                  $article_genre = $data_article_exists['article_genre'];
            ?>
                  <form action="" method="post">
                     <?php
                     if (isset($_POST['save_cate'])) {
                        $cate_id = $_POST['category'];
                        if ($cate_id === 'Category Name') {
                           echo "please select category";
                        } else {
                           $save = mysqli_query($server, "INSERT into news_articles_categories
                                       VALUES(null,'$article','$cate_id',CURRENT_TIMESTAMP)
                                    ");

                           if (!$save) {
                              echo "Article is not saved.";
                           } else {
                              echo "Article category added succesfully.";
                           }
                        }
                     }
                     ?>
                     <p>
                        <label for="">
                           Article title
                        </label>
                        <input type="text" name="" value="<?php echo $data_article_exists['article_title'];  ?>" readonly>
                     </p>
                     <p>
                        <label for="">
                           Category
                        </label>
                        <select name="category">
                           <option>Category Name</option>
                           <?php
                           $get_categories = mysqli_query($server, "SELECT * from categories
                                       WHERE genre = '$article_genre'
                                       ORDER BY category_name ASC
                                    ");
                           while ($data_categories = mysqli_fetch_array($get_categories)) {
                           ?>
                              <option value="<?php echo $data_categories['id']; ?>">
                                 <?php
                                 echo $data_categories['category_name']
                                 ?>
                              </option>
                           <?php
                           }
                           ?>
                        </select>
                     </p>
                     <p>
                        <button type="submit" name="save_cate">
                           <i class="fa fa-save"></i>
                           Save
                        </button>
                     </p>
                  </form>
            <?php
               }
            }
            ?>
         </div>

      </div>
   </main>
   <script src="../assets/js/journalistsToggleNav.js"></script>

</body>

</html>