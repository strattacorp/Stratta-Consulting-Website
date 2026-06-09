<?php
// Carrega os arquivos do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../PHPMailer/Exception.php';
require_once __DIR__ . '/../PHPMailer/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/SMTP.php';

// INCLUI O ARQUIVO DE CONFIGURAÇÃO SEGURO (caminho absoluto relativo)
require_once __DIR__ . '/../config.php';

// Validação e limpeza do formulário (o trecho que você enviou)
if(empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// Inicia a classe PHPMailer
$mail = new PHPMailer(true);

$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

try {
    // Configurações do Servidor SMTP (puxando do config.php)
    $mail->isSMTP();                                            
    $mail->Host       = SMTP_HOST;           
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = SMTP_USER;           
    $mail->Password   = SMTP_PASS;           
    // Choose encryption based on port (465 => SMTPS, 587 => STARTTLS)
    if (defined('SMTP_PORT') && intval(SMTP_PORT) === 587) {
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    } else {
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    }
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

    if ($isAjax) {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);
        echo json_encode(['status' => 'ok']);
        exit();
    } else {
        header('Location: ../thank-you.html');
        exit();
    }

} catch (Exception $e) {
    // Log minimal error to server error log (no debug output to user)
    error_log('Mail error: ' . $mail->ErrorInfo);
    if ($isAjax) {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Mail server error']);
        exit();
    } else {
        header('Location: ../contact.html?error=1');
        exit();
    }
}
?>

