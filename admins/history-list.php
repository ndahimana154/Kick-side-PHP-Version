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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>KickSide || History List</title>
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
                            History list
                        </h1>
                        <div class="form-row">
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            History date
                                        </th>
                                        <th>
                                            History title
                                        </th>
                                        <th>
                                            History description
                                        </th>
                                        <th>
                                            History Image
                                        </th>
                                        <th>
                                            actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $get_All_articles = mysqli_query($server, "SELECT * from 
                                            history_today
                                            ORDER BY history_date DESC
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
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $counter++; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data_All_articles['history_date']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data_All_articles['history_title']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $data_All_articles['history_description']; ?>
                                                </td>
                                                <td>
                                                    <img src="../assets/history/<?php echo $data_All_articles['history_image']; ?>"
                                                        width="100px">
                                                </td>
                                                <td>
                                                    <button class="deleteHistoryButton delete"
                                                        value="<?php echo $data_All_articles['ht_id'] ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

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
                <div class="modal" id="deleteHistory-modal">
                    <div class="deleteArticle-cont">
                        <div class="title">
                            <h4>
                                Delete history.
                            </h4>
                            <button id="closeDeleHistoryModal" title="Close">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>
                        <div class="deleteHistory-Contents" style="padding 10px;">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="../assets/js/jQuery.min.js"></script>
    <script src="../assets/js/deleteHistory.js"></script>
    <script src="../assets/js/journalistsToggleNav.js"></script>

</body>

</html>