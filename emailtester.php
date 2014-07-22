<?php
include_once("Classes/classes.php");
    include_once("Classes/noticesclass.php");
    include_once("Classes/documentsclass.php");
    include_once("Classes/sectionsclass.php");
    include_once("Classes/groupsclass.php");
require 'Classes/class.phpmailer.php';

$mail = new PHPMailer;

$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mandrillapp.com';                 // Specify main and backup server
$mail->Port = 587;                                    // Set the SMTP port
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = MANDRILL_USERNAME;                // SMTP username
$mail->Password = MANDRILL_APIKEY;                  // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = 'jason@jnhconsulting.co.uk';
$mail->FromName = 'jason';
$mail->AddAddress('jason@hayhurst.co');               // Name is optional

$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <strong>in bold!</strong>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->Send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

echo 'Message has been sent';