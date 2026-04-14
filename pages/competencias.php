<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Explore as competências educacionais do PerifaEdu: conteúdos didáticos do Ensino Fundamental ao Médio e cursos livres de idiomas totalmente gratuitos.">
    <link rel="icon" href="../img/PerifaEdu-site.png" type="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="../css/competencias.css">
    <link rel="stylesheet" href="../css/headerfoot.css">
    <link rel="stylesheet" href="../css/popup.css">
    <script src="../js/headerfoot.js" defer></script>
    <script src="../js/popup-login.js" defer></script>
    <title>Competências Educacionais - PerifaEdu</title>
</head>

<body>
    <!--Header-->
    <?php
    require("./header.php");
    ?>
    <!--Fim do Header-->

    <!--Main-->
    <main>

        <!-- Hero Banner -->
        <div class="container-one">
            <p class="p_container-one">Competências<br>Educacionais</p>
            <div class="mini_container"></div>
        </div>

        <!-- Divisor colorido -->
        <div class="section-divider"></div>

        <!-- CONTEÚDOS DIDÁTICOS -->
        <section id="conteudos_didaticos">
            <div class="h2_conteudos-didaticos">
                <h2>Conteúdos Didáticos</h2>
            </div>

            <div class="caixas">

                <!-- Ensino Fundamental I -->
                <div class="caixa_um">
                    <div class="card-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <p class="p_caixas">Ensino Fundamental I</p>
                    <a class="link-redirecionados" href="https://basenacionalcomum.mec.gov.br/abase/#fundamental" target="_blank">1° Ano</a>
                    <a class="link-redirecionados" href="https://basenacionalcomum.mec.gov.br/abase/#fundamental" target="_blank">2° Ano</a>
                    <a class="link-redirecionados" href="https://basenacionalcomum.mec.gov.br/abase/#fundamental" target="_blank">3° Ano</a>
                    <a class="link-redirecionados" href="https://basenacionalcomum.mec.gov.br/abase/#fundamental" target="_blank">4° Ano</a>
                    <a class="link-redirecionados" href="https://basenacionalcomum.mec.gov.br/abase/#fundamental" target="_blank">5° Ano</a>
                </div>

                <!-- Ensino Fundamental II -->
                <div class="caixa_dois">
                    <div class="card-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <p class="p_caixas">Ensino Fundamental II</p>
                    <a class="link-redirecionados" href="https://basenacionalcomum.mec.gov.br/abase/#fundamental" target="_blank">6° Ano</a>
                    <a class="link-redirecionados" href="https://basenacionalcomum.mec.gov.br/abase/#fundamental" target="_blank">7° Ano</a>
                    <a class="link-redirecionados" href="https://basenacionalcomum.mec.gov.br/abase/#fundamental" target="_blank">8° Ano</a>
                    <a class="link-redirecionados" href="https://basenacionalcomum.mec.gov.br/abase/#fundamental" target="_blank">9° Ano</a>
                </div>

                <!-- Ensino Médio -->
                <div class="caixa_tres">
                    <div class="card-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <p class="p_caixas">Ensino Médio</p>
                    <a class="link-redirecionados" href="https://basenacionalcomum.mec.gov.br/abase/#medio" target="_blank">1° Ano</a>
                    <a class="link-redirecionados" href="https://basenacionalcomum.mec.gov.br/abase/#medio" target="_blank">2° Ano</a>
                    <a class="link-redirecionados" href="https://basenacionalcomum.mec.gov.br/abase/#medio" target="_blank">3° Ano</a>
                </div>

            </div>
        </section>

        <!-- CURSOS LIVRES -->
        <section id="cursos-livres">
            <h3 class="h3_cursos-livres">Cursos Livres</h3>

            <div class="caixas">

                <!-- Inglês -->
                <div class="caixa_cursos-Livres">
                    <div class="card-icon">
                        <i class="fas fa-flag-usa"></i>
                    </div>
                    <p class="p_cursos-livres">Inglês</p>
                    <span class="badge-level iniciante">Idioma</span>
                    <a class="link-redirecionados" href="https://www.bbc.co.uk/learningenglish" target="_blank">Iniciante</a>
                    <a class="link-redirecionados" href="https://www.bbc.co.uk/learningenglish" target="_blank">Médio</a>
                    <a class="link-redirecionados" href="https://www.bbc.co.uk/learningenglish" target="_blank">Avançado</a>
                </div>

                <!-- Espanhol -->
                <div class="caixa_cursos-Livres">
                    <div class="card-icon">
                        <i class="fas fa-language"></i>
                    </div>
                    <p class="p_cursos-livres">Espanhol</p>
                    <span class="badge-level medio">Idioma</span>
                    <a class="link-redirecionados" href="https://www.spanishdict.com/guide" target="_blank">Iniciante</a>
                    <a class="link-redirecionados" href="https://www.spanishdict.com/guide" target="_blank">Médio</a>
                    <a class="link-redirecionados" href="https://www.spanishdict.com/guide" target="_blank">Avançado</a>
                </div>

                <!-- Francês -->
                <div class="caixa_cursos-Livres">
                    <div class="card-icon">
                        <i class="fas fa-globe-europe"></i>
                    </div>
                    <p class="p_cursos-livres">Francês</p>
                    <span class="badge-level avancado">Idioma</span>
                    <a class="link-redirecionados" href="https://www.thefrenchexperiment.com/" target="_blank">Iniciante</a>
                    <a class="link-redirecionados" href="https://www.thefrenchexperiment.com/" target="_blank">Médio</a>
                    <a class="link-redirecionados" href="https://www.thefrenchexperiment.com/" target="_blank">Avançado</a>
                </div>

            </div>
        </section>

    </main>
    <?php
    require("./footer.php");
    ?>
</body>

</html>