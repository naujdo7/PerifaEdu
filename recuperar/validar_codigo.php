<?php

require __DIR__ . '/../config/conexao.php';

$email = $_POST['email'];
$codigo_digitado = $_POST['codigo'];

$stmt = $conn->prepare("SELECT codigo, codigo_expira FROM usuarios WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if(!$user){
    die("Usuário não encontrado.");
}

if($codigo_digitado != $user['codigo']){
    die("Código incorreto.");
}

if(strtotime($user['codigo_expira']) < time()){
    die("Código expirado.");
}

// código correto → vai para redefinir senha
header("Location: redefinir_senha.php?email=".$email);
exit;