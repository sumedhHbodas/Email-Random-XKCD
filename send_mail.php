<?php
session_start();

if(!$_SESSION['name'])
{
    header('location: Login_page.php');
}

if(isset($_POST['subscribe']))
{
    require_once('xkcd_API/xkcd.php');
        $xkcd = new xkcd();
        $comic = $xkcd->random(); //get the comic #327, Exploits of a Mom.
        /* echo '<h1>'.$comic->safe_title.' - xkcd</h1>'; */ //prints the title
        /* echo "<img src=\"{$comic->img}\" title=\"{$comic->alt}\"/>"; */ //prints the image (don't miss the hover text!)
        /* echo '<h2>Transcript</h2><pre>'.$comic->transcript.'</pre>';
        echo "<h2>Full version</h2><a href=\"{$comic->url}\">{$comic->url}</a>"; */

    // Recipient 
$to = $_SESSION['email']; 
 
// Sender 
$from = 'shbodas28@gmail.com'; 
$fromName = 'Sumedh'; 
 
// Email subject 
$subject = 'PHP Email with Attachment by Sumedh';  
 
// Attachment file 
$file = $comic->img; 
 
// Email body content 
$htmlContent = ' 
    <h3>PHP Email with Attachment</h3> 
    <p>This email is sent from the PHP script with attachment.</p> 
    <img style="max-width:100%; height: auto;" src="' .$comic->img . '" height="300px" width="350px">
    "<h2>Transcript</h2><pre>'.$comic->transcript.'</pre>" '; 
 
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
        echo "Welcome, " . $_SESSION['name'],"!" ;
    ?>  
    </li>
    <li> <a href= "Logout_Page.php"  >  Logout </a>  </li>
    <ul>
    </div>
    <h1 style="text-align: center; "> Welcome to XKCD comic world! </h1>
    <h4 style="text-align: center; "> Please click on "RANDOM" to see a random comic image </h4>
    
    <form method="post" action="" id="SUBS-UNSUBS">
    <div id="random-arrange">
        <button type="submit" name="random" id="random"> Random</button>
    </div>
    <div id="xkcd">
        <?php
        if(isset($_POST['random']))
        {
            require_once('xkcd_API/xkcd.php');
        $xkcd = new xkcd();
        $comic = $xkcd->random(); //get the comic #327, Exploits of a Mom.
        /* echo '<h1>'.$comic->safe_title.' - xkcd</h1>'; */ //prints the title
        echo '<img style="max-width:100%; height: auto;" src="' .$comic->img . '" height="300px" width="350px">' ;
         //prints the image (don't miss the hover text!)
        
        /* echo '<h2>Transcript</h2><pre>'.$comic->transcript.'</pre>';
        echo "<h2>Full version</h2><a href=\"{$comic->url}\">{$comic->url}</a>"; */
        }
        ?>
        </div>
        <h4 style="text-align: center; "> Wanna explore more such awesome comic images? Why wait! consider subscribing. It's FREE!! </h4>
        <h4 style="text-align: center; "> Hit the subscribe button below. </h4>
    <div id="Subs-Unsubs">
        <button type="submit" name="subscribe" id="subscribe"> Subscribe</button>
        <button type="submit" name="Unsubscribe" id="Unsubscribe"> Unsubscribe </button>
    </div>
    <div class="instruction">
    <p > *You will receive an image along with it's content after every 5 minutes. </p>
    <p> *You can always unsubscribe to this by clicking the link in your email. We won't bother you further :( </p>
    </div>

    </form>
</body>
</html>