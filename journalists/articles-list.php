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
                                            Article Title 
                                        </th>
                                        <th>
                                            Article Overview
                                        </th>
                                        <th>
                                            Article Category
                                        </th>
                                        <th>
                                            Actions 
                                        </th>
                                    </tr>
                                </thead>
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