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
    <link rel="icon" href="../assets/images/favicon.jpg" type="image/x-icon">      
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>KickSide || Home</title>
</head>

<body>
   <main>
      <section class="main-section">
         <?php include("../assets/php/admins/header.php"); ?>
         <div class="hero">
            <?php include("../assets/php/admins/left-nav.php") ?>
            <div class="dashboard">
               <div class="dashboard-cont">
                  <h1>
                     Articles list
                  </h1>
                  <div class="form-row">
                     <table>
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>
                                 Article title
                              </th>
                              <th>
                                 Article Overview
                              </th>
                              <th>
                                 Article Author
                              </th>
                              <th>
                                 Article publish time
                              </th>
                              <th>
                                 Article genre
                              </th>
                              <th>
                                 Article categories
                              </th>
                              <th>
                                 Article actions
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $get_All_articles = mysqli_query($server, "SELECT * from 
                              news_articles,genres,journalists
                              WHERE
                              news_articles.article_genre = genres.id
                              AND news_articles.article_author = journalists.id
                              ORDER BY article_publish_time DESC
                           ");
                           if (mysqli_num_rows($get_All_articles) < 1) {
                              ?>
                              <tr>
                                 <td colspan="100">
                                    No values found
                                 </td>
                              </tr>
                              <?php
                           } else {
                              $counter = 1;
                              while ($data_All_articles = mysqli_fetch_array($get_All_articles)) {
                                 $article_id = $data_All_articles['article_id'];
                           ?>
                                 <tr>
                                    <td>
                                       <?php echo $counter++; ?>
                                    </td>
                                    <td>
                                       <?php echo $data_All_articles['article_title']; ?>
                                    </td>
                                    <td>
                                       <?php echo $data_All_articles['article_overview']; ?>
                                    </td>
                                    <td>
                                       <?php echo $data_All_articles['display_name']; ?>
                                    </td>
                                    <td>
                                       <?php echo $data_All_articles['article_publish_time']; ?>
                                    </td>
                                    <td>
                                       <?php echo $data_All_articles['genre_name']; ?>
                                    </td>
                                    <td>
                                       <?php
                                       $check_if_categories_exists = mysqli_query($server, "SELECT * from 
                                             news_articles_categories,categories
                                             WHERE article = '$article_id'
                                             AND news_articles_categories.category = categories.id
                                       ");
                                       if (mysqli_num_rows($check_if_categories_exists) < 1) {
                                       ?>
                                          <a href="article-add-category.php?a=<?php echo $data_All_articles['article_id']; ?>">Add category</a>
                                       <?php
                                       } else {
                                          $data_if_cateogry_exists = mysqli_fetch_array($check_if_categories_exists);
                                          echo $data_if_cateogry_exists['category_name'];
                                       }
                                       ?>
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
         </div>
      </section>
   </main>
   <script src="../assets/js/journalistsToggleNav.js"></script>

</body>

</html>