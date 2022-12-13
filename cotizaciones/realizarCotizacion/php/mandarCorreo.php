<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../../phpmailer/src/Exception.php';
require '../../../phpmailer/src/PHPMailer.php';
require '../../../phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

$email = $_POST['correo'];
$nombre = $_POST['nombre'];
$doc = $_POST['doc'];


// C:\xampp\htdocs\ProyectoTiendaOnline\cotizaciones/realizarCotizacion/php/mandarCorreo.php
// hector.sauceda.01@gmail.com
try{
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'uasventasresearch@gmail.com';
    // $mail->Username = 'hector.sauceda.01@gmail.com';
    $mail->Password = 'pnqggavknytpkeya';
    // $mail->Password = 'pjmrzhdknmnzlire';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('uasventasresearch@gmail.com','Admin ResearchSoft');
    $mail->addAddress($email, 'Cliente');
    $mail->addStringAttachment($doc, 'Cotizacion.pdf');
    $mail->isHTML(true);
    $mail->Subject = "COTIZACION VENTAS RESEARCH $nombre";
    $mail->Body = 'Cotizacion productos';
    $mail->send();

    echo 'Correo Enviado';
}catch(Exception $e){
    echo 'Mensaje: ' . $mail->ErrorInfo;
}

