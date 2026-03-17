<?php

ini_set('session.cookie_path', '/');

session_start();
require "../conexao.php";

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if(empty($email) || empty($senha)){
echo "Preencha email e senha";
exit;
}

/* procurar usuario */

$stmt = $conn->prepare("
SELECT id, nome_completo, usuario, senha
FROM usuarios
WHERE email = ?
");

$stmt->bind_param("s",$email);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows == 0){
echo "Email não encontrado";
exit;
}

$user = $result->fetch_assoc();

/* verificar senha */

if(!password_verify($senha,$user['senha'])){
echo "Senha incorreta";
exit;
}

/* criar sessão */

$_SESSION['usuario_id'] = $user['id'];
$_SESSION['usuario_nome'] = $user['nome_completo'];
$_SESSION['usuario_user'] = $user['usuario'];

echo "ok";