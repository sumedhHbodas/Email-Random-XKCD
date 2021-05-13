<?php
session_start();

if(!$_SESSION['name'])
{
    header('location: Login_page.php');
}

if(isset($_POST['subscribe']))
{
    // Recipient 
$to = $_SESSION['email']; 
 
// Sender 
$from = 'sumedh281998@gmail.com'; 
$fromName = 'Sumedh'; 
 
// Email subject 
$subject = 'PHP Email with Attachment by Sumedh';  

$JSON_string = '{"month": "5", "num": 2462, "link": "", "year": "2021", "news": "", "safe_title": "NASA Award", "transcript": "", "alt": "The key to discovering life on Mars is to find someone who built a camera and landed it on Mars. Then you just look through the pictures for plants and dogs and stuff.", "img": "https://imgs.xkcd.com/comics/nasa_award.png", "title": "NASA Award", "day": "12"}';
    $obj = json_decode($JSON_string);
     
// Attachment file 
$file = $obj->img; 
 
// Email body content 
$htmlContent = ' 
    <h3>PHP Email with Attachment</h3> 
    <p>This email is sent from the PHP script with attachment.</p> 
    <img src="' .$obj->img . '" height="200px" width="200px">
'; 
 
// Header for sender info 
$headers = "From: $fromName"." <".$from.">"; 
 
// Boundary  
$semi_rand = md5(time());  
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
 
// Headers for attachment  
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
 
// Multipart boundary  
$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  
 
// Preparing attachment 
if(!empty($file) > 0){ 
    if(is_file($file)){ 
        $message .= "--{$mime_boundary}\n"; 
        $fp =    @fopen($file,"rb"); 
        $data =  @fread($fp,filesize($file)); 
 
        @fclose($fp); 
        $data = chunk_split(base64_encode($data)); 
        $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .  
        "Content-Description: ".basename($file)."\n" . 
        "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .  
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
    } 
} 
$message .= "--{$mime_boundary}--"; 
$returnpath = "-f" . $from; 
 
// Send email 
$mail = @mail($to, $subject, $message, $headers, $returnpath);  
 
if ($mail) 
{
    ?>
    <script>
        location.replace("Subscribe.php");
    </script>
    <?php
}
else {
    ?>
    <script>
       alert("something went wrong");
    </script>
    <?php
}

}
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
    <h1 style="text-align: center"> Welcome to XKCD comic world! </h1>
    
    <form method="post" action="" id="SUBS-UNSUBS">
    <div id="Subs-Unsubs">
        <button type="submit" name="subscribe" id="subscribe"> Subscribe</button>
        <button type="submit" name="Unsubscribe" id="Unsubscribe"> Unsubscribe </button>
    </div>
    </form>
</body>
</html>