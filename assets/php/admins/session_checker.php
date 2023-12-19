<?php
    if (!isset($_SESSION['acting_admin_id'])) {
        header("location: signin.php");
    }
?>