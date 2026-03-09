<?php
session_start();

// Simulação de "banco de dados" (array em memória)
if (!isset($_SESSION['usuarios'])) {
    $_SESSION['usuarios'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if ($acao === 'cadastro') {
        // Salva usuário em "sessão"
        $_SESSION['usuarios'][$email] = $senha;
        echo "<p>Cadastro realizado com sucesso!</p>";
        echo "<a href='../index.php'>Voltar</a>";

    } elseif ($acao === 'login') {
        if (isset($_SESSION['usuarios'][$email]) && $_SESSION['usuarios'][$email] === $senha) {
            echo "<p>Login realizado com sucesso!</p>";
            echo "<a href='../index.php'>Voltar</a>";
        } else {
            echo "<p>Email ou senha incorretos!</p>";
            echo "<a href='../index.php'>Tentar novamente</a>";
        }
    }
}