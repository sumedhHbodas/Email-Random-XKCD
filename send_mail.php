<?php
session_start();
if(!$_SESSION['name'])
{
    header('location: Login_page.php');
}
/* echo "<h1> mail will be send from here  </h1>"; */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body id="send_mail_body">
    
    <div class="navbar">   
    <ul>
    <li id="username-edit">
    <?php
        echo "Welcome, " . $_SESSION['name'] ;
    ?>  
    </li>
    <li> <a href= "Logout_Page.php"  >  Logout </a>  </li>
    <ul>
    </div>

</body>
</html>