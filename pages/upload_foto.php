<?php
session_start();

require __DIR__ . '/../conexao.php';

if(isset($_SESSION['usuario_id'])){

    $idUsuario = $_SESSION['usuario_id'];

    $stmt = $conn->prepare("SELECT fotoPerfil FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if($user){
        $_SESSION['fotoPerfil'] = $user['fotoPerfil'];
    }
}

require __DIR__ . '/../teste/config.php';

if(isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] == 0){

    $idUsuario = $_SESSION['usuario_id'];

    // 🔥 1. BUSCAR FOTO ANTIGA
    $stmt = $pdo->prepare("SELECT fotoPerfil FROM usuarios WHERE id = ?");
    $stmt->execute([$idUsuario]);
    $usuario = $stmt->fetch();

    $fotoAntiga = $usuario['fotoPerfil'] ?? null;

    // 🔥 2. APAGAR FOTO ANTIGA (SE EXISTIR)
    if (
        !empty($fotoAntiga) &&
        $fotoAntiga !== 'img/perfil.png' &&
        file_exists(__DIR__ . '/../' . $fotoAntiga)
    ) {
        unlink(__DIR__ . '/../' . $fotoAntiga);
    }

    // 🔥 3. SALVAR NOVA FOTO
    $arquivo = $_FILES['fotoPerfil'];

    $ext = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
    $nomeArquivo = uniqid() . "." . $ext;

    $caminho = "uploads/" . $nomeArquivo;
    $destino = __DIR__ . '/../' . $caminho;

    move_uploaded_file($arquivo['tmp_name'], $destino);

    // 🔥 4. ATUALIZAR BANCO
    $stmt = $pdo->prepare("UPDATE usuarios SET fotoPerfil=? WHERE id=?");
    $stmt->execute([$caminho, $idUsuario]);

    // 🔥 5. ATUALIZAR SESSÃO
    $_SESSION['fotoPerfil'] = $caminho;

    header("Location: /PerifaEdu/PerifaEdu/index.php");
    exit();
}