<?php
namespace App\Controllers;

use Core\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailServices extends Controller
{
    public function sendEmail($to, $subject, $body)
    {
        global $mailerConfig;

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = $mailerConfig['host'];                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = $mailerConfig['username'];                     //SMTP username
            $mail->Password = $mailerConfig['password'];                               //SMTP password
            $mail->SMTPSecure = $mailerConfig['security'];            //Enable implicit TLS encryption
            $mail->Port = $mailerConfig['port'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($mailerConfig['from_email'], $mailerConfig['from_name']);
            $mail->addAddress($to);     //Add a recipient

            //Content
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';                                 //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }
}
