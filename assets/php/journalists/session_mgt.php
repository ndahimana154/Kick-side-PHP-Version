<?php
    if (!isset($_SESSION['acting_journalist_id'])) {
        header("location: ../admins/signin.php");
    }
    else {
        $acting_jou_id = $_SESSION['acting_journalist_id'];
        $check_jou_exists = mysqli_query($server,"SELECT * from journalists
            WHERE id = '$acting_jou_id'
        ");
        if (mysqli_num_rows($check_jou_exists) !==1) {
            header("location: ../admins/signin.php");
        }
        else {
            $get_the_journalist_info =  mysqli_fetch_array(mysqli_query($server,"SELECT * from journalists 
                WHERE id = '$acting_jou_id'
            "));
            $acting_jou_un = $get_the_journalist_info['user_name'];
            $acting_jou_firstname = $get_the_journalist_info['first_name'];
            $acting_jou_lastname = $get_the_journalist_info['last_name'];
            $acting_jou_email = $get_the_journalist_info['email'];
            $acting_jou_phone = $get_the_journalist_info['phone_number'];
            $acting_jou_username = $get_the_journalist_info['user_name'];
            $acting_jou_displayname = $get_the_journalist_info['display_name'];

        }
    }
?>
<br>