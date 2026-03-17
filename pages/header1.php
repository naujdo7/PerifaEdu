<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$nomeUsuario = $_SESSION['usuario_nome'] ?? null;
$usuario = $_SESSION['usuario_user'] ?? null;

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
    <img id="perfil-btn" class="perfil" src="/PerifaEdu/PerifaEdu/img/perfil.png">

    <div id="menu-perfil" class="menu-perfil">
        
        <div class="perfil-header">
            <img src="/PerifaEdu/PerifaEdu/img/perfil.png" class="perfil-foto-menu">

            <div class="perfil-info">
                <strong>
                    <?php echo $nomeUsuario ? $nomeUsuario : "Usuário"; ?>
                </strong>
                <span>
                    <?php echo isset($usuario) ? '@' . htmlspecialchars($usuario) : '@usuario'; ?>
                </span>
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