<?php
// Arquivo temporário para testar o erro real na tela
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require_once 'config.php'; 

// Habilita a exibição de erros brutos do PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$mail = new PHPMailer(true);

try {
    // Força o PHPMailer a mostrar o passo a passo da conversa com o servidor
    $mail->SMTPDebug = 2;                                       
    
    $mail->isSMTP();                                            
    $mail->Host       = SMTP_HOST;           
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = SMTP_USER;           
    $mail->Password   = SMTP_PASS;           
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  
    $mail->Port       = SMTP_PORT;           

    $mail->setFrom(SMTP_USER, 'Teste Local XAMPP');
    $mail->addAddress(SMTP_USER);                  

    $mail->isHTML(false); 
    $mail->Subject = "Teste de Conexao SMTP";
    $mail->Body    = "Se voce ler isso, o XAMPP enviou o e-mail com sucesso!";

    $mail->send();
    echo "<br><br><strong style='color:green;'>SUCESSO! O e-mail foi enviado sem problemas.</strong>";
    
} catch (Exception $e) {
    echo "<br><br><strong style='color:red;'>ERRO ENCONTRADO:</strong> <br>" . $mail->ErrorInfo;
}
?>
