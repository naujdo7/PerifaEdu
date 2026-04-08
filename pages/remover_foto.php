<?php
session_start();
require __DIR__ . '/../config/conexao.php';

$idUsuario = $_SESSION['usuario_id'];

// buscar foto
$stmt = $conn->prepare("SELECT fotoPerfil FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $idUsuario);
$stmt->execute();

$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

$foto = $usuario['fotoPerfil'] ?? null;

// apagar
if (!empty($foto) && $foto !== 'img/perfil.png') {
    $caminho = __DIR__ . '/../' . $foto;
    if (file_exists($caminho)) {
        unlink($caminho);
    }
}

// voltar padrão
$stmt = $conn->prepare("UPDATE usuarios SET fotoPerfil='img/perfil.png' WHERE id=?");
$stmt->bind_param("i", $idUsuario);
$stmt->execute();

$_SESSION['fotoPerfil'] = 'img/perfil.png';

// 🔥 REDIRECIONA PRA INDEX
header("Location: /PerifaEdu/PerifaEdu/index.php");
exit();