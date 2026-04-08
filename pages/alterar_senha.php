<?php
session_start();
require __DIR__ . '/../config/conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo "erro";
    exit();
}

$idUsuario = $_SESSION['usuario_id'];

$senhaAtual = $_POST['senha_atual'] ?? '';
$novaSenha = $_POST['nova_senha'] ?? '';
$confirmar = $_POST['confirmar_senha'] ?? '';

if (!$senhaAtual || !$novaSenha || !$confirmar) {
    echo "Preencha todos os campos";
    exit();
}

if ($novaSenha !== $confirmar) {
    echo "As senhas não coincidem";
    exit();
}

// Buscar senha do banco
$stmt = $conn->prepare("SELECT senha FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!password_verify($senhaAtual, $user['senha'])) {
    echo "Senha atual incorreta";
    exit();
}

// Atualizar senha
$novaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
$stmt->bind_param("si", $novaHash, $idUsuario);

if ($stmt->execute()) {
    echo "ok";
} else {
    echo "Erro ao atualizar";
}