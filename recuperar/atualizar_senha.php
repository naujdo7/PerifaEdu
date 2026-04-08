<?php

require __DIR__ . '/../config/conexao.php';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$confirmar = $_POST['confirmar'] ?? '';

if($senha != $confirmar){
echo "Senhas não coincidem";
exit;
}

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE usuarios 
SET senha=?, codigo=NULL, codigo_expira=NULL 
WHERE email=?");
$stmt->bind_param("ss",$senha_hash,$email);
$stmt->execute();

echo "ok";