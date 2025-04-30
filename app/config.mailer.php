<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Inlcuir la libreria de PHPMailer
require '../assets/PHPMailer/PHPMailer.php';
require '../assets/PHPMailer/SMTP.php';
require '../assets/PHPMailer/Exception.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.sisbm.info';                     //Set the SMTP server to send through (smtp.gmail.com)
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'noreply@sisbm.info';                     //SMTP username
    $mail->Password   = '#!O[T1N^R?{[';                               //SMTP password (Contraseña de apliación)
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption (tls)
    $mail->Port       = 465;              //TCP port to connect to; use (587) if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('noreply@sisbm.info','=?UTF-8?B?'.base64_encode("Restablecer Contraseña"). "=?=");
    $mail->addAddress($email);               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();

    $msg = array("Se ha enviado un correo a $email para restablecer su contraseña", "success");
} catch (Exception $e) {
    $msg = array("Message could not be sent. Mailer Error: {$mail->ErrorInfo}","danger");
}

/* Configurar cuenta de Correo Gmail 
Activar Verificación en dos pasos 
Contraseñas de aplicaciones
Crear una contraseña de aplicación para el correo PHPMailer
https://myaccount.google.com/apppasswords?rapt=AEjHL4Ojwt_NkZIR0jwMoNqi4t0wwqgck3e729UMlFvhIiIQj0O15MA5uETJ_U4KyPdKRpIWX5sDIujQFhSQ2ShGbJ8qIyA3rLMfHr1n1pr7_aI4LSbz4b4
*/

?>