<footer>
    <div class="cont">
        <div class="footer-cont">
            <div class="brand">
                <img src="../assets/images/KickSide - logo.png" alt="THe KickSide Logo">
                <a href="../clients/index.php"> KikSide Rw</a>
                <div class="sep"></div>
                <p>
                    Here to Update.
                </p>
            </div>
            <div class="row">
                <div class="impo-links">
                    <h4>
                        Quick Links
                    </h4>
                    <div class="impo-cont">
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
                                    <a href="../clients/by-genre.php?g=<?php echo $dataGenre['id']; ?>"
                                        title="<?php echo $dataGenre['genre_name'] ?>">
                                        <i class="fa <?php echo $dataGenre['genre_icon']; ?>"></i>
                                        <span>
                                            <?php echo $dataGenre['genre_name'] ?>
                                        </span>
                                    </a>
                                </li>
                                <?php
                            }
                            $getCategories = mysqli_query($server, "SELECT * from categories
                                ORDER BY category_name ASC
                            ");
                            while ($dataCategories = mysqli_fetch_array($getCategories)) {
                                ?>
                                <li>
                                    <a href="../clients/by-category.php?c=<?php echo $dataCategories['id']; ?>"
                                        title="<?php echo $dataCategories['category_name']; ?>">
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
                </div>
                <div class="about">
                    <h4>
                        About Us
                    </h4>
                    <div class="about-cont">
                        <p>
                            KickSide RW is the upcoming newspaper currently operation in Rwanda.
                            We are here to provide you with update news as our main goal.

                        </p>
                    </div>
                </div>
                <div class="contacts">
                    <h4>
                        Our Contacts
                    </h4>
                    <div class="contact-cont">
                        <ul>
                            <li>
                                <a href="">
                                    <i class="fa fa-phone"></i>
                                    <p>
                                       &nbsp;  (+250) 722 893 974
                                    </p>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-email"></i>
                                    <p>
                                        kickside466@gmail.com
                                    </p>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-address"></i>
                                    <p>
                                        Nyamasheke, Rwanda
                                    </p>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="socialncopy">
                <div class="copy">
                    &copy;
                    <?php
                    $currentYear = date("Y");
                    if ($currentYear > 2023) {
                        echo "2023 - " . $currentYear;
                    } else {
                        echo $currentYear;
                    }
                    ?>
                </div>
                <div class="sep"></div>
                <a href="https://www.instagram.com/kickside_rw" target="_blank">
                    <img src="../assets/images/instagram.png" alt="">
                </a>
                <a href="https://www.x.com/kickside_rw" target="_blank">
                    <img class="x" src="../assets/images/twitter.png" alt="">
                </a>
            </div>
        </div>
    </div>
</footer>