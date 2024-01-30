<?php

//include required files

require 'inc/PHPMailer.php';
require 'inc/SMTP.php';
require 'inc/Exception.php';

//Define namespaces

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\SMTP;

use PHPMailer\PHPMailer\Exception;

//Create instance of PHPMailer

$mail = new PHPmailer();

//Set mailer to use SMTP

$mail->isSMTP();

//define SMTP host
$mail->Host = "smtp-relay.sendinblue.com";

//enable SMTP authentication

$mail->SMTPAuth = "true";

//set type of encryption (TLS/SSL)

$mail->SMTPSecure = "tls";

//set port to connect SMTP

$mail->Port = 587;

//set gmail username
$mail->Username = "divinemoveofgodlibrary2021@gmail.com";

//set gmail password
$mail->Password = "jAsaWIJw5B7zfK0E";

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
