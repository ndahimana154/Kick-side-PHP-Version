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
   <title>KickSide || Journalists</title>
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
                     Journalists List
                  </h1>
                  <div class="form-row">
                     <table>
                        <thead>
                           <tr>
                              <th>
                                 #
                              </th>
                              <th>
                                 Fullnames
                              </th>
                              <th>
                                 Email
                              </th>
                              <th>
                                 Phone number
                              </th>
                              <th>
                                 Username
                              </th>
                              <th>
                                 Status
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           $get_journalists = mysqli_query($server, "SELECT * from journalists
                              ORDER BY display_name ASC
                           ");
                           if (mysqli_num_rows($get_journalists) < 1) {
                           ?>
                              <tr>
                                 <td colspan="100">
                                    No values found
                                 </td>
                              </tr>
                           <?php
                           }
                           $counter = 1;
                           while ($data_get_journalists = mysqli_fetch_array($get_journalists)) {
                           ?>
                              <tr>
                                 <td>
                                    <?php echo $counter++ ?>
                                 </td>
                                 <td>
                                    <?php echo $data_get_journalists['display_name']; ?>
                                 </td>
                                 <td>
                                    <?php echo $data_get_journalists['email']; ?>
                                 </td>
                                 <td>
                                    <?php echo $data_get_journalists['phone_number']; ?>
                                 </td>
                                 <td>
                                    <?php echo $data_get_journalists['user_name']; ?>
                                 </td>
                                 <td>
                                    <?php echo $data_get_journalists['status']; ?>
                                 </td>
                              </tr>
                           <?php
                           }
                           ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>

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
               echo "Username already exists";
            } else {
               $new = mysqli_query($server, "INSERT into journalists
                        VALUES(null,'$firstName','$lastName','$userName','$email','$phone','$passWord','$displayName','Working')
                     ");
               if (!$new) {
                  echo "Journalist creation failed.";
               } else {
                  echo "Journalist i created successfully";
               }
            }
         }
         ?>
         <form action="" method="post">
            <p>
               <label for="">
                  Firstname
               </label>
               <input type="text" name="firstname">
            </p>
            <p>
               <label for="">
                  Lastname
               </label>
               <input type="text" name="lastname">
            </p>
            <p>
               <label for="">
                  Email
               </label>
               <input type="text" name="email">
            </p>
            <p>
               <label for="">
                  Phone number
               </label>
               <input type="text" name="phone">
            </p>
            <p>
               <button type="submit" name="save-jour">
                  <i class="fa fa-save"></i> Save
               </button>
            </p>
         </form>
      </section>
   </main>
   <script src="../assets/js/journalistsToggleNav.js"></script>

</body>

</html>