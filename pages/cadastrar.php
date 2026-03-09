<?php

require "../conexao.php";

$nome = $_POST['nome'];
$cpf = preg_replace('/[^0-9]/', '', $_POST['cpf']);
$data = $_POST['data_nascimento'];
$usuario = $_POST['usuario'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirmar = $_POST['confirmar_senha'];

if($senha != $confirmar){
echo "As senhas não coincidem";
exit;
}

/* VERIFICAR DUPLICADOS */

$stmt = $conn->prepare("SELECT id FROM usuarios WHERE email=? OR usuario=? OR cpf=?");
$stmt->bind_param("sss",$email,$usuario,$cpf);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
echo "Email, usuário ou CPF já cadastrado";
exit;
}

/* CRIPTOGRAFAR SENHA */

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

/* CONVERTER A DATA */
$data = $_POST['data_nascimento'];

$data_formatada = date("Y-m-d", strtotime($data));

/* INSERIR USUÁRIO */

$stmt = $conn->prepare("INSERT INTO usuarios 
(nome_completo, cpf, data_nascimento, usuario, email, senha)
VALUES (?,?,?,?,?,?)");

$stmt->bind_param("ssssss", $nome, $cpf, $data_formatada, $usuario, $email, $senhaHash);

$stmt->execute();

echo "ok";

?>