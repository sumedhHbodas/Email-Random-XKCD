<?php
session_start();

include 'db_connect.php';
include 'mailSender.php';

if (isset($_POST['submit']))
{
    $username = mysqli_real_escape_string ($db_connect, $_POST['name'] ) ;
    $email = mysqli_real_escape_string ($db_connect, $_POST['email']);
    $mobile_number = mysqli_real_escape_string ($db_connect, $_POST['mobile_number']);
    $password = mysqli_real_escape_string ($db_connect, $_POST['password']);
    $confirm_password = mysqli_real_escape_string ($db_connect, $_POST['confirm_password']);
    

    $pass = password_hash($password, PASSWORD_BCRYPT);
    $confirm_pass = password_hash($confirm_password, PASSWORD_BCRYPT);
    $token = bin2hex(random_bytes(15)) ;

    $emailQuery = "select * from reg where email = '$email'";
    $query = mysqli_query($db_connect, $emailQuery);
    $emailCount = mysqli_num_rows($query);
    $_SESSION['email'] = $email;
    $_SESSION['message'] = "Please check your email to activate your account $email";

    if ($emailCount > 0)
    {
        ?>
         <script> 
            alert('Seems like you visited again! Please Login.')
            </script>
        <?php
        
    }
    else {
        if ($password === $confirm_password)
        {
            $insertQuery = " insert into reg (name, email, mobile_number, password, confirm_password, token, status)
             values ('$username', '$email', '$mobile_number', '$pass', '$confirm_pass', '$token', 'inactive')";

             $intoDatabase = mysqli_query($db_connect, $insertQuery);
             

             if ($intoDatabase)
            {
                require 'vendor/autoload.php';

                // $key = 'API_KEY';  API_KEY hidden due to security issues. This can be uncommented to make it work
                $email = new \SendGrid\Mail\Mail();
               $email->setFrom("sumedhb28@outlook.com", "Sumedh");
               $email->setSubject("Account activation");
               $email->addTo($_SESSION['email'], "Example User");
               $email->addContent("text/plain", "Hi, $username. Click this link to activate your account https://email-random-xkcd.herokuapp.com/acc_Activation_Page.php?token=$token");
               
               $sendgrid = new \SendGrid($key);
               
                if ($sendgrid->send($email))
                {
                   // $_SESSION['message'] = "Please check your email to activate your account $email";
                   echo $_SESSION['message'];
                    ?>
                    <script>
                        window.location = "https://email-random-xkcd.herokuapp.com/Login_page.php";
                    </script>
                    <?php
                    /* header('location:Login_Page.php'); */
                } else {
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    echo "Email sending failed...";
                }
            }
            else {
                ?>
                <script> 
                alert('Unable to sign up! Please enter your details properly.')
                </script>
                <?php
            }
        }
        else {
            echo "Password mismatched!";
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
    <div id="container">
    <div class="sign-in-form">
    <form  method="POST" action="">
        <div class="heading">
            <h2> Create an account </h2>
            <h4> Get started with your account </h4>  
        </div>
        <div class="input-icons">
    <i class="fas fa-user"></i> 
    <input class="input-field" type="text" name="name" placeholder="Full name" required> <br>
    <i class="fas fa-envelope"></i>
    <input class="input-field" type="email" name="email" placeholder="Email address" required> <br>
    <i class="fas fa-phone"></i>
    <input class="input-field" type="text" name="mobile_number" placeholder="Mobile number" required> <br>
    <i class="fas fa-key"></i>
    <input class="input-field" type="password" name="password" placeholder="New password" required> <br>
    <i class="fas fa-key"></i>
    <input class="input-field" type="password" name="confirm_password" placeholder="Confirm password" required> <br>
        </div>
        <div class="button">
            <button type="submit" name= "submit" id="submit-button" >Create Account </button>
             <p > Have an account? <a href="https://email-random-xkcd.herokuapp.com/Login_page.php"  id="login-edit"> Login  </p>
        </div>
    </form>  
</div>

</div>
</body>
</html>
