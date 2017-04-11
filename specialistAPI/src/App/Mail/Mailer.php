<?php

//namespace App\Mail;

class sendMail
{
    public function send(){
        $mailer = new PHPMailer;
    $mailer->isSMTP();
    $mailer->Host = 'smtp.gmail.com';  // your email host, to test I use localhost and check emails using test mail server application (catches all  sent mails)
    $mailer->SMTPAuth = true;                 // I set false for localhost
    $mailer->SMTPSecure = 'tls';              // set blank for localhost
    //$mailer->Port = 25;                           // 25 for local host
    $mailer->Username = 'girintn@gmail.com';    // I set sender email in my mailer call
    $mailer->Password = 'Ntnbhaw12';
    

    $mailer->setFrom('girintn@gmail.com', 'Nitin');
    $mailer->addAddress('parasher25@gmail.com');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    $mailer->isHTML(true);
    $mailer->Subject = 'Here is the subject';
    $mailer->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mailer->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mailer->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mailer->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
    }
}