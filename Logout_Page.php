<?php
session_start();

session_destroy();
header('location: https://email-random-xkcd.herokuapp.com/Login_page.php');
?>


