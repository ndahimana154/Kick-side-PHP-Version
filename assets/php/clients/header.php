<header>
   <div class="top">
      <div class="cont">
         <div class="logo">
            <a href="../clients/index.php">KickSide RW</a>
            <div class="sep"></div>
            <p>
               Here to Update.
            </p>
         </div>
         <div class="buttons">
            <a href="../admins/signin.php" class="signin">
               <i class="fa fa-sign-in"></i>
               Sign in
            </a>
         </div>
      </div>
   </div>
   <nav>
      <div class="cont">
         <ul>
            <li>
               <a href="../clients/index.php" title="Home">
                  <i class="fa fa-house"></i>
                  <span>Home</span>
               </a>
            </li>
            <?php
            $getGenres = mysqli_query($server, "SELECT * from genres
                  ORDER BY genre_name ASC
               ");
            while ($dataGenre = mysqli_fetch_array($getGenres)) {
               ?>
               <li>
                  <a href="../clients/by-genre.php?g=<?php echo $dataGenre['id']; ?>" title="<?php echo $dataGenre['genre_name'] ?>">
                     <i class="fa <?php echo $dataGenre['genre_icon']; ?>"></i>
                     <span>
                        <?php echo $dataGenre['genre_name'] ?>
                     </span>
                  </a>
               </li>
               <?php
            }
            $getCategories = mysqli_query($server,"SELECT * from categories
               ORDER BY category_name ASC
            ");
            while($dataCategories = mysqli_fetch_array($getCategories)) {
               ?>
               <li>
                  <a href="../clients/by-category.php?c=<?php echo $dataCategories['id'];  ?>" title="<?php echo $dataCategories['category_name']; ?>">
                     <i class="fa <?php echo $dataCategories['category_icon'] ?>"></i>
                     <span>
                        <?php echo $dataCategories['category_name']; ?>
                     </span>
                  </a>
               </li>
               <?php
            }
            ?>

         </ul>
      </div>
   </nav>
</header>