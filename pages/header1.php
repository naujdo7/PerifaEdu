<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$nomeUsuario  = $_SESSION['usuario_nome']  ?? null;
$emailUsuario = $_SESSION['usuario_email'] ?? null;
$fotoSession  = $_SESSION['fotoPerfil']    ?? 'img/perfil.png';
$base         = '/PerifaEdu/PerifaEdu/';
$foto         = $base . $fotoSession . '?v=' . time();
?>

<header>
    <div class="logo">
        <a href="./index.php">
            <img src="./img/PerifaEdu 2.png" alt="Logo PerifaEdu" />
        </a>
        <span>PERIFA<span>EDU</span></span>
    </div>

    <!-- Botão hambúrguer -->
    <button class="menu-toggle" aria-label="Abrir menu">
        <i class="fas fa-bars hamburger-icon"></i>
    </button>

    <!-- Menu Desktop -->
    <nav class="desktop-menu">
        <a href="/Perifaedu/Perifaedu" class="active">INÍCIO</a>
        <a href="./pages/apostilas.php"       class="menu-restrito">APOSTILAS</a>
        <a href="./pages/cursos_tecnicos.php" class="menu-restrito">CURSOS</a>
        <a href="./pages/competencias.php"    class="menu-restrito">COMPETÊNCIAS</a>
        <a href="./pages/como-funciona.php">COMO FUNCIONA</a>
        <a href="./pages/sobre.php">SOBRE</a>

        <!-- Perfil dropdown -->
        <div class="perfil-container">
            <img id="perfil-btn" class="perfil" src="<?= $foto ?>" alt="Meu perfil">

            <div id="menu-perfil" class="menu-perfil">

                <!-- Cabeçalho -->
                <div class="perfil-header">
                    <img src="<?= $foto ?>" class="foto-perfil-dropdown" alt="Foto de perfil">
                    <div class="perfil-info">
                        <strong><?= $nomeUsuario ? htmlspecialchars($nomeUsuario) : 'Usuário' ?></strong>
                        <span><?= $emailUsuario ? htmlspecialchars($emailUsuario) : 'email@exemplo.com' ?></span>
                    </div>
                </div>

                <!-- Links -->
                <a href="./pages/perfil.php">
                    <i class="fas fa-user"></i>
                    Meu Perfil
                </a>

                <hr>

                <a href="#" id="btn-logout" class="logout">
                    <i class="fas fa-right-from-bracket"></i>
                    Sair
                </a>

            </div><!-- /menu-perfil -->
        </div><!-- /perfil-container -->
    </nav>

    <!-- Menu Mobile -->
    <nav class="mobile-menu">
        <a href="./index.php">INÍCIO</a>
        <a href="./pages/apostilas.php"       class="menu-restrito">APOSTILAS</a>
        <a href="./pages/cursos_tecnicos.php" class="menu-restrito">CURSOS</a>
        <a href="./pages/competencias.php"    class="menu-restrito">COMPETÊNCIAS</a>
        <a href="./pages/como-funciona.php">COMO FUNCIONA</a>
        <a href="./pages/sobre.php">SOBRE</a>
        <a href="./pages/perfil.php"          class="menu-restrito">MEU PERFIL</a>
        <!-- Login: visivel quando nao logado -->
        <a href="#" id="btn-login-mobile" class="btn-mobile-login">&#128274; ENTRAR</a>
        <!-- Sair: visivel quando logado -->
        <a href="#" id="btn-sair-mobile" class="menu-restrito">SAIR</a>
    </nav>
</header>

<!-- Sincroniza localStorage com sessão PHP real -->
<script>
(function(){
    var logadoPHP = <?= ($nomeUsuario ? 'true' : 'false') ?>;
    if (logadoPHP) {
        localStorage.setItem('perifaEduLogado', 'true');
    } else {
        localStorage.removeItem('perifaEduLogado');
    }
})();
</script>

<script>
(function () {
    /* ── Perfil dropdown ── */
    const btn    = document.getElementById('perfil-btn');
    const menu   = document.getElementById('menu-perfil');
    const logout = document.getElementById('btn-logout');

    if (btn && menu) {
        btn.addEventListener('click', function () {
            const aberto = menu.classList.toggle('aberto');
            btn.classList.toggle('ativo', aberto);
        });

        document.addEventListener('click', function (e) {
            if (btn.contains(e.target)) return;
            if (!menu.contains(e.target)) {
                menu.classList.remove('aberto');
                btn.classList.remove('ativo');
            }
        }, true);
    }

    /* ── Logout (desktop + mobile) ── */
    function fazerLogout() {
        localStorage.removeItem('perifaEduLogado');
        fetch('/PerifaEdu/PerifaEdu/pages/logout.php', { method: 'POST' })
            .finally(() => window.location.href = '/PerifaEdu/PerifaEdu/index.php');
    }

    if (logout) logout.addEventListener('click', function (e) { e.preventDefault(); fazerLogout(); });

    /* ── Logout (mobile menu) ── */
    const btnSairMobile = document.getElementById('btn-sair-mobile');
    if (btnSairMobile) btnSairMobile.addEventListener('click', function (e) { e.preventDefault(); fazerLogout(); });
})();
</script>