<?php


namespace Controllers;
use View\View;
use Models\User;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class UserController
{
    public function signUp()
    {
        if(!empty($_POST)) {
            try{
                $user = User::signUp($_POST);
                $mail = new PHPMailer(true);

                try {
                    //Server settings
//                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = '7395836@gmail.com';                     // SMTP username
                    $mail->Password   = 'Dm8Ky04m';                               // SMTP password
                    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    //Recipients
                    $mail->setFrom('7395836@gmail.com', 'Andrey');
                    $mail->addAddress('7395836@gmail.com');     // Add a recipient
//                    $mail->addAddress('ellen@example.com');               // Name is optional
//                    $mail->addReplyTo('info@example.com', 'Information');
//                    $mail->addCC('cc@example.com');
//                    $mail->addBCC('bcc@example.com');



                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Here is the subject';
                    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

            }
            catch (\Exceptions\InvalidParamException $e) {
                View::render('users/signUp', ['errors' => $e->getMessage()]);
                return;
            }
        }
        View::render('users/signUp');
    }
}