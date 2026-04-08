<?php

ini_set('session.cookie_path', '/');

session_start();
require __DIR__ . '/../config/conexao.php';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($email) || empty($senha)) {
    echo "Preencha email e senha";
    exit;
}

/* procurar usuario */

$stmt = $conn->prepare("
SELECT id, nome_completo, usuario, senha, fotoPerfil, tipo_login
FROM usuarios
WHERE email = ?
");

$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Email não encontrado";
    exit;
}

$user = $result->fetch_assoc();

/* 🔥 NOVA VALIDAÇÃO (IMPORTANTE) */

// Se for conta Google
if ($user['tipo_login'] === 'google') {
    echo "Use o login com Google";
    exit;
}

// Se não tiver senha (evita erro do password_verify)
if (empty($user['senha'])) {
    echo "Conta sem senha. Use outro método de login.";
    exit;
}

/* verificar senha */

if (!password_verify($senha, $user['senha'])) {
    echo "Senha incorreta";
    exit;
}

/* criar sessão */

$_SESSION['usuario_id'] = $user['id'];
$_SESSION['usuario_nome'] = $user['nome_completo'];
$_SESSION['usuario_email'] = $email;
$_SESSION['fotoPerfil'] = $user['fotoPerfil'];

echo "ok";