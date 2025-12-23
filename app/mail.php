<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($email,$name,$title,$message){
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = HOSTMAIL;
        $mail->SMTPAuth   = true;
        $mail->Username   = USERMAIL;
        $mail->Password   = PASSMAIL;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('nano@mfwks.com', 'NanoFramework');
        $mail->addAddress($email, $name);

        $mail->CharSet = 'UTF-8';
        $mail->Subject = $title;
        $mail->Body    = $message;
        error_log("E-mail enviado para $name ($email) com sucesso!");
        return $mail->send();
    } catch (Exception $e) {
        error_log("Erro ao enviar e-mail para $name ($email): {$mail->ErrorInfo}");
        return false;
    }
}
