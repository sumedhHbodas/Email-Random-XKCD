<?php 
session_start();
include 'db_connect.php';

if (isset($_GET['token']))
{
    $token = $_GET['token'];
    $Update_status = "update reg set status='active' where token='$token' ";
    $query = mysqli_query($db_connect, $Update_status);
    if ($query)
    {
        if(isset($_SESSION['message']))
        {
            $_SESSION['message'] = "Account activated successfully!";
            header('location:Login_Page.php');
        }
        else {
            $_SESSION['message'] = "You are logged out";
            header('location:Login_Page.php');
        }
    }
    else {
        $_SESSION['message'] = "Sorry! There was a problem activating your account. Please try again.";
            header('location:Signup_Page.php');
        }
    }



?>

