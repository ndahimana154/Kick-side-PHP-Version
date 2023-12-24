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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <link rel="stylesheet" href="../assets/css/back-main.css">
   <title>Add article</title>
</head>

<body>
   <main>
      <section class="main-section">
         <?php include("../assets/php/journalists/header.php"); ?>

         <div class="hero">
            <?php include("../assets/php/journalists/left-nav.php") ?>

            <div class="dashboard">
               <div class="dashboard-cont">
                  <h1>
                     Settings
                  </h1>
                  <div class="form-row">
                     <div class="forms">
                        <div class="left">
                           <h2>
                              Update profile info
                           </h2>
                           <form action="" method="post">

                              <?php
                              // echo md5(12345);
                              if (isset($_POST['save-cogs-changes'])) {
                                 $firstname = $_POST['firstname'];
                                 $lastname  = $_POST['lastname'];
                                 $username  = $_POST['username'];
                                 $displayName = $_POST['displayname'];

                                 $check_username_exists = mysqli_query($server, "SELECT * from
                                    journalists WHERE user_name = '$username'
                                    AND id != '$acting_jou_id'
                                 ");
                                 if (mysqli_num_rows($check_username_exists) > 0) {
                              ?>
                                    <div class="errorMsg">
                                       Username already exists!
                                    </div>
                                    <?php
                                 } else {
                                    // Update the profile
                                    $update  = mysqli_query($server, "UPDATE journalists
                                       SET 
                                       first_name = '$firstname',
                                       last_name = '$lastname',
                                       user_name = '$username',
                                       display_name = '$displayName'
                                       WHERE id = '$acting_jou_id'
                                    ");
                                    if (!$update) {
                                    ?>
                                       <div class="errorMsg">
                                          Updating the profile failed.
                                       </div>
                                    <?php
                                    } else {
                                    ?>
                                       <div class="successMsg">
                                          Profile updated successfully
                                       </div>
                              <?php
                                    }
                                 }
                              }
                              ?>
                              <p>
                                 <label for="">
                                    Firstname
                                 </label>
                                 <input type="text" name="firstname" value="<?php echo $acting_jou_firstname; ?>" placeholder="type.." required>
                              </p>
                              <p>
                                 <label for="">
                                    Lastname
                                 </label>
                                 <input type="text" name="lastname" value="<?php echo $acting_jou_lastname; ?>" placeholder="type.." required>
                              </p>
                              <p>
                                 <label for="">
                                    Display name
                                 </label>
                                 <input type="text" name="displayname" value="<?php echo $acting_jou_displayname; ?>" placeholder="type.." required>
                              </p>
                              <p>
                                 <label for="">
                                    Username
                                 </label>
                                 <input type="text" name="username" value="<?php echo $acting_jou_username; ?>" placeholder="type.." required>
                              </p>
                              <p>
                                 <button type="submit" name="save-cogs-changes">
                                    <i class="fa fa-save"></i>
                                    Save changes
                                 </button>
                              </p>
                           </form>
                        </div>
                        <div class="right">
                           <h2>
                              Update password
                           </h2>
                           <form action="" method="post">

                              <?php
                              if (isset($_POST['save_new_pw'])) {
                                 $current = md5($_POST['current']);
                                 $newpw = $_POST['new'];
                                 $confirm = $_POST['cfn'];
                                 $check_current = mysqli_query($server, "SELECT * from
                                    journalists WHERE id = '$acting_jou_id'
                                    AND password = '$current'
                                 ");
                                 if (mysqli_num_rows($check_current) !== 1) {
                                    ?>
                                    <div class="errorMsg">
                                       Current Password is Invalid!
                                    </div>
                                    <?php
                                 } elseif ($newpw !== $confirm) {
                                 ?>
                                 <div class="errorMsg">
                                       New passwords doesn't match
                                 </div>
                                 <?php
                                 } elseif (strlen($newpw) < 4) {
                                 ?>
                                 <div class="errorMsg">
                                       Length must be atleast 4 characters
                                 </div>
                                 <?php
                                 } else {
                                    $newpw = md5($newpw);
                                    $confirm = md5($confirm);
                                    $update_password = mysqli_query($server, "UPDATE journalists
                                       SET password = '$newpw'
                                       WHERE id ='$acting_jou_id'
                                    ");
                                    if (!$update_password) {
                                       ?>
                                       <div class="errorMsg">
                                          Updating the password failed. 
                                       </div>
                                       <?php
                                    } else {
                                       ?>
                                       <div class="successMsg">
                                          Updating the password succed.
                                       </div>
                                       <?php
                                    }
                                 }
                              }
                              ?>
                              <p>
                                 <label for="">
                                    Current Password.
                                 </label>
                                 <input type="password" name="current" placeholder="type.." required>
                              </p>
                              <p>
                                 <label for="">
                                    New Password.
                                 </label>
                                 <input type="password" name="new" placeholder="type.." required>
                              </p>
                              <p>
                                 <label for="">
                                    Confirm Password.
                                 </label>
                                 <input type="password" name="cfn" placeholder="type.." required>
                              </p>
                              <p>
                                 <button type="submit" name="save_new_pw">
                                    <i class="fa fa-save"></i>
                                    Save password
                                 </button>
                              </p>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </main>
</body>

</html>