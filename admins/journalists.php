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
    <link rel="stylesheet" href="../assets/fontawesome-free-6.4.2-web/css/all.css">
    <link rel="stylesheet" href="../assets/css/back-main.css">
    <title>KickSide || Journalists</title>
</head>

<body>
    <main>
        <?php  include("../assets/php/admins/header.php");?>
        <section class="new-journ">
            <h2>
               New journalist 
            </h2>
            <?php
               if (isset($_POST['save-jour'])) {
                  $firstName  = $_POST['firstname'];
                  $lastName = $_POST['lastname'];
                  $email = $_POST['email'];
                  $phone = $_POST['phone'];
                  $passWord = md5(1234);
                  $userName = $firstName.".".$lastName;
                  $displayName = $firstName." ".$lastName;

                  // Check if the username doesn't exist 
                  $check_if_no_duplicate = mysqli_query($server,"SELECT * from
                     journalists WHERE user_name = '$userName'
                  ");
                  if (mysqli_num_rows($check_if_no_duplicate) > 0) {
                     echo "Username already exists";
                  }
                  else {
                     $new = mysqli_query($server,"INSERT into journalists
                        VALUES(null,'$firstName','$lastName','$userName','$email','$phone','$passWord','$displayName','Working')
                     ");
                     if (!$new) {
                        echo "Journalist creation failed.";
                     }
                     else {
                        echo"Journalist i created successfully";
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
        <section class="jour-list">
            <h2>
               Journalists List
            </h2>
            <table border=1>
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
                     $get_journalists = mysqli_query($server,"SELECT * from journalists
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
        </section>
    </main>
</body>

</html>