<?php
session_start();

include 'db_connect.php';
if (isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $_SESSION['email'] = $email;

    $email_search = " select * from reg where email = '$email' and status='active' ";
    $query = mysqli_query($db_connect, $email_search);
    $emailCount = mysqli_num_rows($query);
    if($emailCount)
    {
        $email_pass = mysqli_fetch_assoc($query);
        $db_pass = $email_pass['password'];
        $_SESSION['name'] =  $email_pass['name'];
       /*  $_SESSION['email'] =  $email_pass['email']; */
        $pass_decode = password_verify($password, $db_pass);
        if ($pass_decode)
        {
            ?>
            <script>
                location.replace("send_mail.php");
            </script>
            <?php
        }
        else {
            ?>
            <script>
                alert('Wrong credentials! Try again.');
            </script>
            <?php
            }    
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/9af73e908e.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="sign-in-form">
    <form  method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <div class="heading">
            <h2> Welcome again! </h2>
            <h4> Get started with your account </h4>
        </div>
        <div class="input-icons">    
    <i class="fas fa-envelope"></i>
    <input class="input-field" type="email" name="email" placeholder="Email address" required> <br>
    <i class="fas fa-key"></i>
    <input class="input-field" type="password" name="password" placeholder="Enter your password" required> <br>
        </div>
        <div class="button">
            <button type="submit" name= "login" id="submit-button" > Login </button>
             <p > Don't have an account? <a href="Signup_Page.php" id="login-edit"> Sign Up </p>
        </div> 
    </form>  
</div>
<div style="text-align: center;" > 
        <p class="login-div"> <?php 
        if (isset($_SESSION['message']))
        {
            echo $_SESSION['message'];
        }
        else {
            echo $_SESSION['message'] = "You are logged out. Please login again.";
        }
        
         ?> </p>
        </div>
</body>
</html>