<?php

require '../conexao.php';

$email = $_POST['email'] ?? '';
$codigo = $_POST['codigo'] ?? '';

$stmt = $conn->prepare("SELECT codigo, codigo_expira, tentativas_codigo FROM usuarios WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if(!$user){
echo "erro";
exit;
}

/* VERIFICAR LIMITE DE TENTATIVAS */

if($user['tentativas_codigo'] >= 5){
echo "Muitas tentativas. Solicite um novo código.";
exit;
}

/* VERIFICAR EXPIRAÇÃO */

if(strtotime($user['codigo_expira']) < time()){
echo "Código expirado. Solicite outro.";
exit;
}

/* VERIFICAR CODIGO */

if($codigo != $user['codigo']){

$tentativas = $user['tentativas_codigo'] + 1;

$stmt = $conn->prepare("UPDATE usuarios SET tentativas_codigo=? WHERE email=?");
$stmt->bind_param("is",$tentativas,$email);
$stmt->execute();

echo "Código inválido (" . $tentativas . "/5)";
exit;

}

/* CODIGO CORRETO → ZERA TENTATIVAS */

$stmt = $conn->prepare("UPDATE usuarios SET tentativas_codigo=0 WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();

echo "ok";