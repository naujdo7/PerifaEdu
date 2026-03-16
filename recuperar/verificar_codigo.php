<?php

require '../conexao.php';

session_start();

$email = $_POST['email'] ?? '';
$codigo = $_POST['codigo'] ?? '';
$tipo = $_POST['tipo'] ?? '';

if($email=="" || $codigo==""){
echo "Código inválido, tente novamente!";
exit;
}

/* ============================= */
/* VERIFICAÇÃO PARA CADASTRO */
/* ============================= */

if($tipo == "cadastro"){

/* sessão existe */

if(!isset($_SESSION['codigo_cadastro'])){
echo "Sessão expirada. Solicite outro código.";
exit;
}

/* iniciar tentativas se não existir */

if(!isset($_SESSION['tentativas_codigo'])){
$_SESSION['tentativas_codigo'] = 0;
}

/* limite de tentativas */

if($_SESSION['tentativas_codigo'] >= 5){
echo "Muitas tentativas. Solicite um novo código.";
exit;
}

/* verificar expiração */

if(strtotime($_SESSION['codigo_expira']) < time()){
echo "Código expirado. Solicite outro.";
exit;
}

/* verificar código */

if($codigo != $_SESSION['codigo_cadastro']){

$_SESSION['tentativas_codigo']++;

echo "Código inválido, tente novamente! (" . $_SESSION['tentativas_codigo'] . "/5)";
exit;

}

/* código correto */

$_SESSION['tentativas_codigo'] = 0;

unset($_SESSION['codigo_cadastro']);
unset($_SESSION['codigo_expira']);

echo "ok";
exit;

}

/* ============================= */
/* RECUPERAÇÃO DE SENHA */
/* ============================= */

$stmt = $conn->prepare("SELECT codigo, codigo_expira, tentativas_codigo FROM usuarios WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if(!$user){
echo "Código inválido, tente novamente!";
exit;
}

/* limite de tentativas */

if($user['tentativas_codigo'] >= 5){
echo "Muitas tentativas. Solicite um novo código.";
exit;
}

/* expiração */

if(strtotime($user['codigo_expira']) < time()){
echo "Código expirado. Solicite outro.";
exit;
}

/* código incorreto */

if($codigo != $user['codigo']){

$tentativas = $user['tentativas_codigo'] + 1;

$stmt = $conn->prepare("UPDATE usuarios SET tentativas_codigo=? WHERE email=?");
$stmt->bind_param("is",$tentativas,$email);
$stmt->execute();

echo "Código inválido, tente novamente! (" . $tentativas . "/5)";
exit;

}

/* código correto */

$stmt = $conn->prepare("
UPDATE usuarios 
SET tentativas_codigo=0,
codigo=NULL,
codigo_expira=NULL
WHERE email=?
");

$stmt->bind_param("s",$email);
$stmt->execute();

echo "ok";