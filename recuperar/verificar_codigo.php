<?php

require '../conexao.php';

$email = $_POST['email'] ?? '';
$codigo = $_POST['codigo'] ?? '';

$stmt = $conn->prepare("SELECT codigo, codigo_expira FROM usuarios WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if(!$user){
echo "erro";
exit;
}

if($codigo != $user['codigo']){
echo "erro";
exit;
}

if(strtotime($user['codigo_expira']) < time()){
echo "erro";
exit;
}

echo "ok";