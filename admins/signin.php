<?php
session_start();
include("../assets/php/global/server.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.4.2-web/css/all.css">
    <link rel="stylesheet" href="../assets/css/front-main.css">
    <link rel="stylesheet" href="../assets/css/back-main.css">
    <title>KickSide || Login</title>
</head>

<body>
    <main>
        <?php
            include("../assets/php/clients/header.php");
        ?>
        <div class="login-cont">
            <div class="login">
                <h2>
                    KickSide Signin
                </h2>
                <form action="" method="post" id="signInForm">
                    <?php
                    // echo md5(12345);
                    if (isset($_POST['signIn'])) {
                        $un = $_POST['userN'];
                        $pw = md5($_POST['passW']);
                        $check_credentials = mysqli_query($server, "SELECT * from admins
                                WHERE (user_name = '$un' OR email = '$un')
                                AND password = '$pw'
                            ");
                        if (mysqli_num_rows($check_credentials) < 1) {
                            $check_journalist = mysqli_query($server,"SELECT * from journalists
                                WHERE (user_name = '$un' OR email = '$un')
                                AND password = '$pw'
                            ");
                            if (mysqli_num_rows($check_journalist) < 1) {
                                ?>
                                <div class="errorMsg">
                                    Invalid Credentials.
                                </div>
                                <?php
                            }
                            else {
                                $data_check_journalists = mysqli_fetch_array($check_journalist);
                                $_SESSION['acting_journalist_id'] = $data_check_journalists['id'];
                                ?>
                                <div class="successMsg">
                                    Login Succed. <a href="../journalists/home.php">Go home</a>
                                </div>
                                <?php
                            }
                    
                        } else {
                            $data_check_credentials = mysqli_fetch_array($check_credentials);
                            $_SESSION['acting_admin_id'] = $data_check_credentials['id'];
                            ?>
                            <div class="successMsg">
                                Login Succed. <a href="./home.php">Go home</a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <div class="errorMsg">

                    </div>
                    <p>
                        <label for="Username">
                            Username or Email
                        </label>
                        <input type="text" name="userN" id="" placeholder="type..." value = "<?php if(isset($_POST['signIn'])) { echo $_POST['userN'];} ?>">
                    </p>
                    <p>
                        <label for="Password">
                            Password
                        </label>
                        <input type="password" name="passW" id="" placeholder="type...">
                    </p>
                    <p>
                        <button type="submit" name="signIn" id="signInButton">
                            Signin
                        </button>
                    </p>
                </form>
            </div>
        </div>
    </main>
    <script src="../assets/js/admin-signInValidator.js"></script>
</body>

</html>