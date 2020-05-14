<?php
   require 'phpmailer/PHPMailerAutoload.php';

   // php mailer
   $mail = new PHPMailer;
   $mail->isSMTP();
 //  $mail->SMTPDebug = 4;
   $mail->Host='smtp.gmail.com';
   $mail->Port=587;
   $mail->SMTPSecure='tls';
   $mail->SMTPAuth=true;
   

   $mail->Username='Your Email address';
   $mail->Password='Password of your email';

   $mail->setFrom('Your Email address', 'Title of the email');
   $mail->addAddress('Email address of whom to send');
   $mail->addReplyTo('Your Email address');

   $mail->isHTML(true);
   $mail->Subject='Subject of the email';
   $message_body = 'Body of the email';
   $mail->MsgHTML($message_body);

   if(!$mail->send())
   {
      echo "Sorry!";
   }
   else 
   {
   	echo "Successful!";
   }

?>
