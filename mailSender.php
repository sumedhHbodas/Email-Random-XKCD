<?php
 require 'vendor/autoload.php';

    /* class sendEmail {
        public static function sendMail($to, $subject, $content)
        {
            $key = 'API_KEY';
            $mail = new sendgrid\Mail\Mail();
            $mail->setFrom('shbodas28@gmail.com', "Sumedh Bodas");
            $mail->setSubject($subject);
            $mail->addTo($to);
            $mail->addContent('text/plain', $content);

            $sendgrid = new \sendgrid($key);
            try {
                $response = $sendgrid->send($mail);
                return $response;
            } catch (exception $e) {
                echo "Mail exception caught". $e->getMessage(). "\n";
                return false;
            }

        }
    } */

?>