<?php 
session_start();
include 'db_connect.php';

echo "account activation";
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
            ?>
            <script>
                window.location = "https://email-random-xkcd.herokuapp.com/Login_page.php";
                
            </script>
            <?php   
        }
        else {
            $_SESSION['message'] = "You are logged out";
            ?>
            <script>
               window.location = "https://email-random-xkcd.herokuapp.com/Login_page.php";
                                  
            </script>
            <?php
            
            
        }
    }
    else {
        $_SESSION['message'] = "Sorry! There was a problem activating your account. Please try again.";
        ?>
            <script>
               window.location = "https://email-random-xkcd.herokuapp.com/index.php";
            </script>
            <?php
            
        }
    }



?>

