<?php
require_once'php/core/init.php';

$override = new OverideData();
$email = new Email();
$user = new User();

use PHPMailer\PHPMailer\PHPMailer;
$mail = new PHPMailer();

$mail->Host = "smtp.zoho.com";
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Username = "info@exit-tb.org";
$mail->Password = "Server@admin1";
$mail->SMTPSecure = "ssl"; //TLS
$mail->Port = 465; //587

$mail->addAddress('frdrck33@gmail.com');
$mail->setFrom('info@exit-tb.org','EXIT-TB');
$mail->Subject = 'Test Email';
$mail->isHTML(true);
$mail->Body = 'Hello World';

if ($mail->send()){
    $msg = "Your email has been sent, thank you!";
}
else{
    $msg = "Please try again!";
}
