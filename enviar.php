<?php
date_default_timezone_set('America/Amazonas');

require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ((isset($_POST['email']) && !empty(trim($_POST['email']))) && (isset($_POST['contato']) && !empty(trim($_POST['contato']))) &&
    (isset($_POST['mensagem']) && !empty(trim($_POST['mensagem'])))
) {

    $nome = !empty($_POST['nome']) ? $_POST['nome'] : 'Não informado';
    $email = $_POST['email'];
    $contato = $_POST['contato'];
    $assunto = !empty($_POST['assunto']) ? $_POST['assunto'] : 'Não informado';
    $mensagem = $_POST['mensagem'];
    $data = date('d/m/Y H:i:s');

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'epettersondossantos@gmail.com';
    $mail->Password = '2502santos';
    $mail->Port = 587;

    $mail->setFrom('epettersondossantos@gmail.com');
    $mail->addAddress('epettersondossantos@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = $assunto;
    $mail->Body = "Nome: {$nome}<br>
                   Email: {$email}<br>
                   Contato: {$contato}<br>
                   Mensagem: {$mensagem}<br>
                   Data/Hora: {$data}";
    if ($mail->send()) {
        echo 'Enviado com sucesso.';
    } else {
        echo 'Não enviado';
    }
} else {
    echo 'Não enviado: informar email ou contato ou a mensagem correto.';
}
