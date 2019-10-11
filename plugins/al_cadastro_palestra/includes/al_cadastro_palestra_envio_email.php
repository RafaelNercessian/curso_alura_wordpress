<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'tls://smtp.gmail.com:587';
    $mail->SMTPAuth = true;
    $mail->Username = $_POST['destinatario'];
    $mail->Password = $_POST['senha'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    //Recipients
    $mail->setFrom(trim($_POST['email-contato']));
    $mail->addAddress(trim($_POST['destinatario']));

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Cadastro Palestra';
    $mail->Body = 'Um novo contato com email ' . trim($_POST['email-contato']) . ' tem interesse na palestra. Entre em contato com ele / ela o mais rápido possível';
    $mail->send();
    header('Location: /alura/palestra?envio=sucesso');
    die;
} catch (Exception $e) {
    error_log("Problema ao enviar email " . print_r($e->getMessage(), 1));
    header('Location: /alura/palestra?envio=erro');
    die;
}