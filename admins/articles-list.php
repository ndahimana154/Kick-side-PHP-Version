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
    <title>KickSide || Home</title>
</head>

<body>
    <main>
        <?php  include("../assets/php/admins/header.php");?>
        <div>
         <h2>
            Articles list
         </h2>
         <table border=1>
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
                  $get_All_articles = mysqli_query($server,"SELECT * from 
                  news_articles,genres,journalists
                  WHERE
                  news_articles.article_genre = genres.id
                  AND news_articles.article_author = journalists.id
                  
                  ");
                  if (mysqli_num_rows($get_All_articles)< 1) {
                     echo"No articles found";
                  }
                  else {
                     $counter =1;
                     while ($data_All_articles=mysqli_fetch_array($get_All_articles)) {
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
                                 $check_if_categories_exists = mysqli_query($server,"SELECT * from 
                                 news_articles_categories,categories
                                    WHERE article = '$article_id'
                                    AND news_articles_categories.category = categories.id
                                 ");
                                 if (mysqli_num_rows($check_if_categories_exists) < 1) {
                                    ?>
                                    <a href="article-add-category.php?a=<?php echo $data_All_articles['article_id']; ?>">Add category</a>
                                    <?php
                                 }
                                 else {
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
    </main>
</body>

</html>