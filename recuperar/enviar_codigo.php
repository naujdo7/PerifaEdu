<?php

require '../conexao.php';

require '../config_env.php';

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

$email = $_POST['email'] ?? '';

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

$stmt = $conn->prepare("SELECT id FROM usuarios WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows==0){
echo "Email não encontrado";
exit;
}

/* MASCARAR EMAIL SOMENTE SE EXISTIR */
$emailMascarado = mascararEmail($email);

$codigo = rand(100000,999999);

$expira = date("Y-m-d H:i:s", strtotime("+5 minutes"));

$stmt = $conn->prepare("UPDATE usuarios SET codigo=?, codigo_expira=? WHERE email=?");
$stmt->bind_param("sss",$codigo,$expira,$email);
$stmt->execute();

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

$mail->Body = "
<p>Olá!</p>

<p>Recebemos uma solicitação para redefinir sua senha no <strong>PerifaEdu</strong>.</p>

<p>Use o código abaixo para continuar:</p>

<h1 style='color:#003366;'>$codigo</h1>

<p>Este código expira em <strong>5 minutos</strong>.</p>

<p>Se você não solicitou a redefinição de senha, pode ignorar este email.</p>

<hr>

<p style='font-size:12px;color:gray;'>Equipe PerifaEdu</p>";

$mail->send();

echo "ok|" . $emailMascarado;