<?php
// Carrega os arquivos do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// INCLUI O ARQUIVO DE CONFIGURAÇÃO SEGURO
require_once 'config.php'; 

// Validação e limpeza do formulário (o trecho que você enviou)
if(empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(500);
    exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// Inicia a classe PHPMailer
$mail = new PHPMailer(true);

try {
    // Configurações do Servidor SMTP (puxando do config.php)
    $mail->isSMTP();                                            
    $mail->Host       = SMTP_HOST;           
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = SMTP_USER;           
    $mail->Password   = SMTP_PASS;           
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  
    $mail->Port       = SMTP_PORT;           

    // Remetente e Destinatários
    $mail->setFrom(SMTP_USER, 'Site Strattacorp'); // Quem envia (seu servidor autenticado)
    $mail->addAddress(SMTP_USER);                  // Quem recebe (você mesmo)
    $mail->addReplyTo($email, $name);              // Para onde vai se você clicar em "Responder"

    // Conteúdo do E-mail
    $mail->isHTML(false); 
    $mail->Subject = "$m_subject: $name";
    $mail->Body    = "Você recebeu uma nova mensagem do formulário do site.\n\n"
                   . "Detalhes:\n\n"
                   . "Nome: $name\n"
                   . "Email: $email\n"
                   . "Assunto: $m_subject\n\n"
                   . "Mensagem:\n$message";

    // Envia o e-mail
    $mail->send();
    http_response_code(200); // Sucesso!
    
} catch (Exception $e) {
    // Linha adicionada temporariamente para diagnóstico:
    echo "Erro real do servidor: " . $mail->ErrorInfo;
    
    http_response_code(500); 
}
?>

