<?php

session_start();
require __DIR__ . '/../conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /PerifaEdu/PerifaEdu/index.php");
    exit;
}

$idUsuario = isset($_SESSION['usuario_id']) ? (int)$_SESSION['usuario_id'] : 0;

if ($idUsuario <= 0) {
    die("Usuário não autenticado.");
}

/* ============================= */
/* UPLOAD DA FOTO */
/* ============================= */

if (isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] == 0) {

    /* 1️⃣ Buscar foto antiga */
    $stmt = $conn->prepare("SELECT fotoPerfil FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    $fotoAntiga = $usuario['fotoPerfil'] ?? null;

    /* 2️⃣ Apagar foto antiga (se não for padrão) */
    if (
        !empty($fotoAntiga) &&
        $fotoAntiga !== 'img/perfil.png' &&
        file_exists(__DIR__ . '/../' . $fotoAntiga)
    ) {
        unlink(__DIR__ . '/../' . $fotoAntiga);
    }

    /* 3️⃣ Salvar nova foto */
    $arquivo = $_FILES['fotoPerfil'];

    $ext = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
    $nomeArquivo = uniqid("user_" . $idUsuario . "_", true) . "." . $ext;

    $caminho = "uploads/" . $nomeArquivo;
    $destino = __DIR__ . '/../' . $caminho;

    move_uploaded_file($arquivo['tmp_name'], $destino);

    /* 4️⃣ Atualizar banco */
    $stmt = $conn->prepare("UPDATE usuarios SET fotoPerfil = ? WHERE id = ?");
    $stmt->bind_param("si", $caminho, $idUsuario);
    $stmt->execute();

    /* 5️⃣ Atualizar sessão */
    $_SESSION['fotoPerfil'] = $caminho;

    header("Location: /PerifaEdu/PerifaEdu/index.php");
    exit;
}