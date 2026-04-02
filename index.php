<?php
ini_set('session.cookie_path', '/');

session_start();
$nomeUsuario = $_SESSION['usuario_nome'] ?? null;

require("./pages/modal-cadastro.php");
require("./pages/modal-login.php");
require("./pages/modal-redefinir-senha.php");

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./img/PerifaEdu-site.png" type="">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/headerfoot.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/popup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./js/headerfoot.js" defer></script>
    <script src="./js/popup-login.js" defer></script>
    <title>PerifaEdu - Educação Gratuita e de Qualidade</title>
    <meta name="description" content="PerifaEdu: Educação transforma. Aprenda no seu ritmo, onde e quando quiser. Totalmente grátis. Certificado garantido.">
</head>

<body>

    <?php
    require("./pages/header1.php");
    ?>

    <main>
        <!-- Hero Section -->
        <section class="S_educacao">
            <div id="text_ED">
                <p class="p_educacao">Educação que transforma. Direto da quebrada para você!</p>
                <p id="p-aprenda">Aprenda no seu ritmo, onde e quando quiser. Totalmente grátis.</p>
                <button class="btn-baixar">Baixe o App Agora</button>
            </div>
            <img src="./img/Kael.png" alt="Mascote Kael" id="Kaell">
        </section>

        <!-- Features Section -->
        <section class="orion">
            <p class="p_sobre">
                Sobre o Perifa <span>Edu</span><br>
                Certificado garantido <br>
                Apoio de mentores <br>
                Conteúdo livre para todos!
            </p>
            <img src="./img/Orion.png" alt="Mascote Orion" id="orion_img">
        </section>

        <!-- About Section -->
        <section>
            <div class="sobre">
                <img src="./img/cell2.png" alt="Celular mostrando o aplicativo" class="cell">
                <div class="text">
                    <h1 class="sobre_T">Sobre o PerifaEdu</h1>
                    <p>O PerifaEdu incentiva o aprendizado através do conforto de casa, facilitando quem não tem tempo ou acesso aos estudos.</p>
                    <p>Com PerifaEdu, os estudos são garantidos.</p>
                    <p>Aliás, todos temos direito de estudar sem gastar um tostão. Fique por dentro!</p>
                </div>
            </div>


            <!-- Benefícios Section -->
            <section class="beneficios-section">
                <h2 class="beneficios-title">Por que escolher PerifaEdu?</h2>
                <div class="beneficios-grid">
                    <div class="beneficio-card">
                        <div class="beneficio-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="beneficio-title">Ensino de Qualidade</h3>
                        <p class="beneficio-desc">Conteúdo elaborado por educadores experientes e atualizado constantemente.</p>
                    </div>
                    <div class="beneficio-card">
                        <div class="beneficio-icon">
                            <i class="fas fa-lock-open"></i>
                        </div>
                        <h3 class="beneficio-title">100% Gratuito</h3>
                        <p class="beneficio-desc">Sem taxas ocultas ou cobranças. Educação acessível para todos.</p>
                    </div>
                    <div class="beneficio-card">
                        <div class="beneficio-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="beneficio-title">Comunidade Ativa</h3>
                        <p class="beneficio-desc">Conecte-se com outros estudantes e mentores no mesmo caminho.</p>
                    </div>
                    <div class="beneficio-card">
                        <div class="beneficio-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h3 class="beneficio-title">Certificados</h3>
                        <p class="beneficio-desc">Receba certificados reconhecidos ao completar os cursos.</p>
                    </div>
                </div>
            </section>

            <!-- Stats Section -->
            <section class="stats-section">
                <div class="stats-container">
                    <div class="stat-item">
                        <div class="stat-number">10K+</div>
                        <div class="stat-label">Alunos Ativos</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">150+</div>
                        <div class="stat-label">Cursos Disponíveis</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Horas de Aula</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">95%</div>
                        <div class="stat-label">Satisfação</div>
                    </div>
                </div>
            </section>

            <!-- Metodologia Section -->
            <section class="metodologia-section">
                <h2 class="metodologia-title">Nossa Metodologia</h2>
                <div class="metodologia-content">
                    <div class="metodologia-text">
                        <p>O PerifaEdu utiliza uma abordagem inovadora e inclusiva para educação, baseada em tecnologias modernas e práticas pedagógicas comprovadas.</p>
                        <p>Nós acreditamos que a educação é um direito fundamental e deve ser acessível a todos, independentemente de localização ou situação econômica.</p>
                        <p>Nossa plataforma foi desenvolvida com foco na experiência do usuário, garantindo aprendizado eficaz e engajador.</p>
                    </div>
                    <div class="metodologia-list">
                        <div class="metodologia-item">
                            <div class="metodologia-check">✓</div>
                            <div class="metodologia-text-item">Conteúdo adaptativo ao seu ritmo de aprendizagem</div>
                        </div>
                        <div class="metodologia-item">
                            <div class="metodologia-check">✓</div>
                            <div class="metodologia-text-item">Videoaulas interativas com exemplos práticos</div>
                        </div>
                        <div class="metodologia-item">
                            <div class="metodologia-check">✓</div>
                            <div class="metodologia-text-item">Exercícios e avaliações contínuas</div>
                        </div>
                        <div class="metodologia-item">
                            <div class="metodologia-check">✓</div>
                            <div class="metodologia-text-item">Suporte de mentores experientes 24/7</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Final Section -->
            <section class="cta-final-section">
                <div class="cta-content">
                    <h2 class="cta-title">Pronto para transformar sua vida?</h2>
                    <p class="cta-description">Junte-se a milhares de estudantes que já estão mudando suas vidas através da educação. Comece agora mesmo, é totalmente grátis!</p>
                    <div class="cta-buttons">
                        <button class="btn-primary">Comece Agora</button>
                        <button class="btn-secondary">Saiba Mais</button>
                    </div>
                </div>
            </section>
    </main>
    <?php
    require("./pages/footer.php");
    ?>
    <script>
        // Menu Toggle
        const menuToggle = document.querySelector('.menu-toggle');
        const mobileMenu = document.querySelector('.mobile-menu');

        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                menuToggle.classList.toggle('active');
                mobileMenu.classList.toggle('active');
            });

            // Fechar menu ao clicar em um link
            const mobileLinks = document.querySelectorAll('.mobile-menu a');
            mobileLinks.forEach(link => {
                link.addEventListener('click', () => {
                    menuToggle.classList.remove('active');
                    mobileMenu.classList.remove('active');
                });
            });
        }

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {

        const href = this.getAttribute('href');

        if (href === "#") return;

        e.preventDefault();

        const target = document.querySelector(href);

        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});
    </script>
</body>

</html>