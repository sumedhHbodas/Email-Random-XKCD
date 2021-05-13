<?php
session_start();
if(!$_SESSION['name'])
{
    header('location: Login_page.php');
}
echo $_SESSION['name'];
echo "<h1> mail will be send from here </h1>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <span style="padding: 10px; border: 1px solid black;">
    <a href= "Logout_Page.php" > Logout
</span>
</body>
</html>