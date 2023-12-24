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
    <title>KickSide || New Journalist</title>
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
                            New Journalist
                        </h1>
                        <div class="form-row">
                            <?php
                            if (isset($_POST['save-jour'])) {
                                $firstName  = $_POST['firstname'];
                                $lastName = $_POST['lastname'];
                                $email = $_POST['email'];
                                $phone = $_POST['phone'];
                                $passWord = md5(1234);
                                $userName = $firstName . "." . $lastName;
                                $displayName = $firstName . " " . $lastName;

                                // Check if the username doesn't exist 
                                $check_if_no_duplicate = mysqli_query($server, "SELECT * from
                                    journalists WHERE user_name = '$userName'
                                ");
                                if (mysqli_num_rows($check_if_no_duplicate) > 0) {
                                    ?>
                                    <div class="errorMsg">
                                        Username already exists.
                                    </div>
                                    <?php
                                } else {
                                    $new = mysqli_query($server, "INSERT into journalists
                                        VALUES(null,'$firstName','$lastName','$userName','$email','$phone','$passWord','$displayName','Working')
                                    ");
                                    if (!$new) {
                                        ?>
                                        <div class="errorMsg">
                                            Creating Journalist failed
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="successMsg">
                                            Journalist is created successfully.
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            <form action="" method="post">
                                <p>
                                    <label for="">
                                        Firstname
                                    </label>
                                    <input type="text" name="firstname" placeholder="Type..." required>
                                </p>
                                <p>
                                    <label for="">
                                        Lastname
                                    </label>
                                    <input type="text" name="lastname" placeholder="Type..." required>
                                </p>
                                <p>
                                    <label for="">
                                        Email
                                    </label>
                                    <input type="email" name="email" placeholder="Type..." required>
                                </p>
                                <p>
                                    <label for="">
                                        Phone number
                                    </label>
                                    <input type="phone" name="phone" placeholder="Type..." required>
                                </p>
                                <p>
                                    <button type="submit" name="save-jour">
                                        <i class="fa fa-save"></i> Save
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