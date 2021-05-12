<?php
session_start();
if(!$_SESSION['name'])
{
    header('location:Login_Page.php');
}

echo $_SESSION['name'];
echo "<h1> mail will be send from here </h1>"

                
           
            

?>

