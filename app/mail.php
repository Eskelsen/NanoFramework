<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($email,$name,$title,$message){
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = HOSTMAIL;
        $mail->SMTPAuth   = true;
        $mail->Username   = USERMAIL;
        $mail->Password   = PASSMAIL;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom(HOSTMAIL, NAMEMAIL);
        $mail->addAddress($email, $name);

        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);
        $mail->Subject = $title;
        $mail->Body    = $message;
        
        $u = $mail->send();
        $status = $u ? 'Sucesso' : 'Falha';
        error_log("$status ao enviar e-mail para $name ($email)!");
        return $u;
    } catch (Exception $e) {
        error_log("Erro ao enviar e-mail para $name ($email): {$e->getMessage()}");
        return false;
    }
}
