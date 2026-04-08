<?php

require __DIR__ . '/../config/conexao.php';

require __DIR__ . '/../config/config_env.php';

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

$email = $_POST['email'] ?? '';
$tipo = $_POST['tipo'] ?? 'recuperar';

function mascararEmail($email){

$partes = explode("@",$email);

$nome = $partes[0];
$dominio = $partes[1];

$inicio = substr($nome,0,2);

return $inicio . "***@" . $dominio;

}

if($email==""){
echo "Email não enviado";
exit;
}

/* VERIFICAR EMAIL APENAS NA RECUPERAÇÃO */

if($tipo == "recuperar"){

$stmt = $conn->prepare("SELECT id FROM usuarios WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows==0){
echo "Email não encontrado";
exit;
}

}

/* MASCARAR EMAIL */
$emailMascarado = mascararEmail($email);

/* GERAR CÓDIGO */
$codigo = rand(100000,999999);

$expira = date("Y-m-d H:i:s", strtotime("+5 minutes"));

/* SALVAR CÓDIGO */

if($tipo == "recuperar"){

$stmt = $conn->prepare("UPDATE usuarios SET codigo=?, codigo_expira=? WHERE email=?");
$stmt->bind_param("sss",$codigo,$expira,$email);
$stmt->execute();

}else{

/* salvar temporariamente na sessão para cadastro */

session_start();

$_SESSION['codigo_cadastro'] = $codigo;
$_SESSION['codigo_email'] = $email;
$_SESSION['codigo_expira'] = $expira;
$_SESSION['tentativas_codigo'] = 0;

}

/* ENVIAR EMAIL */

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = EMAIL_USER;
$mail->Password = EMAIL_PASS;
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('perifaedu@gmail.com','PerifaEdu');
$mail->addAddress($email);

$mail->isHTML(true);

$mail->Subject = 'PerifaEdu - Recupere sua senha';

if ($tipo == 'cadastro') {

    $mail->Subject = 'PerifaEdu - Confirme seu cadastro';

    $mail->Body = "
    <p>Olá!</p>
    <p>Obrigado por se cadastrar no <strong>PerifaEdu</strong>! 🎉</p>
    <p>Para confirmar seu e-mail e ativar sua conta, use o código abaixo:</p>
    <h1 style='color:#003366;'>$codigo</h1>
    <p>Este código expira em <strong>5 minutos</strong>.</p>
    <p>Se você não realizou esse cadastro, pode ignorar este e-mail.</p>
    <hr>
    <p style='font-size:12px;color:gray;'>Equipe PerifaEdu</p>
    ";

} else {

    $mail->Body = "
    <p>Olá!</p>
    <p>Recebemos uma solicitação para redefinir sua senha no <strong>PerifaEdu</strong></p>
    <p>Use o código abaixo para continuar:</p>
    <h1 style='color:#003366;'>$codigo</h1>
    <p>Este código expira em <strong>5 minutos</strong>.</p>
    <p>Se você não solicitou a redefinição de senha, pode ignorar este email.</p>
    <hr>
    <p style='font-size:12px;color:gray;'>Equipe PerifaEdu</p>
    ";

}

$mail->send();

echo "ok|" . $emailMascarado;