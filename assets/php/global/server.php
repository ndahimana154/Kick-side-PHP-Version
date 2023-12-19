<?php
$server_name = "localhost";
$user_name = "root";
$pass_word = "";
$db_name = "kickside";
$server = mysqli_connect($server_name, $user_name, $pass_word, $db_name) or
    die("Unable to connect the database".mysqli_connect_error($server));
