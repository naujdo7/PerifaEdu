<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$nomeUsuario = $_SESSION['usuario_nome'] ?? null;
$emailUsuario = $_SESSION['usuario_email'] ?? null;
$fotoUsuario = $_SESSION['fotoPerfil'] ?? null;

?>

<header>
        <div class="logo">
            <a href="./index.php"><img src="./img/PerifaEdu 2.png" alt="Logo PerifaEdu" /></a>
            <span>PERIFA<span>EDU</span></span>
        </div>

        <!-- Botão do menu hambúrguer -->
        <button class="menu-toggle" aria-label="Abrir menu">
            <i class="fas fa-bars hamburger-icon"></i>
        </button>

        <!-- Menu Desktop -->
        <nav class="desktop-menu">
    <a href="../index.php" class="active">INÍCIO</a>
    <a href="./pages/apostilas.php" class="menu-restrito">APOSTILAS</a>
    <a href="./pages/cursos_tecnicos.php" class="menu-restrito">CURSOS</a>
    <a href="./pages/competencias.php" class="menu-restrito">COMPETÊNCIAS</a>
    <a href="./pages/como-funciona.php">COMO FUNCIONA</a>
    <a href="./pages/sobre.php">SOBRE</a>

    <div class="perfil-container">

<?php
$base = '/PerifaEdu/PerifaEdu/';

$fotoSession = $_SESSION['fotoPerfil'] ?? '';

if (!empty($fotoSession) && filter_var($fotoSession, FILTER_VALIDATE_URL)) {
    $foto = $fotoSession;
} else {
    $foto = !empty($fotoSession) 
        ? $base . $fotoSession . '?v=' . time()
        : $base . 'img/perfil.png';
}
?>

<!-- BOTÃO DO PERFIL -->
<img id="perfil-btn" class="perfil" src="<?= $foto ?>">

    <div id="menu-perfil" class="menu-perfil">
        
        <div class="perfil-header">
            <img src="<?= $foto ?>" class="foto-perfil-dropdown">

    <div class="perfil-info">
        <strong><?= $nomeUsuario ? $nomeUsuario : "Usuário"; ?></strong>
        <span><?= $emailUsuario ? htmlspecialchars($emailUsuario) : 'email@exemplo.com'; ?></span>
    </div>
</div>

        <a href="./pages/perfil.php">Meu perfil</a>

        <hr>

        <a href="#" id="btn-logout" class="logout">Sair</a>
    </div>
</div>
</nav>

        <!-- Menu mobile -->
        <nav class="mobile-menu">
            <a href="./index.php">INÍCIO</a>
            <a href="./pages/apostilas.php" class="menu-restrito">APOSTILAS</a>
            <a href="./pages/cursos_tecnicos.php" class="menu-restrito">CURSOS</a>
            <a href="./pages/competencias.php" class="menu-restrito">COMPETÊNCIAS</a>
            <a href="./pages/como-funciona.php">COMO FUNCIONA</a>
            <a href="./pages/sobre.php">SOBRE</a>
            <a href="./index.php" id="btn-sair" class="menu-restrito">SAIR</a>
            <img class="perfil" src="./img/perfil.png" alt="Logo do perfil de usuário">
        </nav>
    </header>