<?php
    if (!isset($_SESSION['acting_admin_id'])) {
        header("location: signin.php");
    }
    else {
        $acting_admin_id = $_SESSION['acting_admin_id'];
        $check_admin_exists = mysqli_query($server,"SELECT * from 
            admins WHERE id = '$acting_admin_id'
        ");
        if (mysqli_num_rows($check_admin_exists) !== 1) {
            header("location: ../admins/signin.php");
        }
        else {
            $get_the_admin_info = mysqli_fetch_array($check_admin_exists);
            $acting_admin_un = $get_the_admin_info["user_name"];
            $acting_admin_email = $get_the_admin_info["email"];
            $acting_admin_phone = $get_the_admin_info["phone"];
        }
    }
?>