<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apostilas — PerifaEdu</title>
  <meta name="description" content="Acesse apostilas gratuitas organizadas por nível escolar: Ensino Fundamental I, II e Médio. Marque suas apostilas concluídas e acompanhe seu progresso.">
  <link rel="icon" href="../img/PerifaEdu-site.png" type="image/png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/apostilas.css">
  <link rel="stylesheet" href="../css/headerfoot.css">
  <link rel="stylesheet" href="../css/popup.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="../js/headerfoot.js" defer></script>
  <script src="../js/popup-login.js" defer></script>
  <script src="../js/apostilas.js" defer></script>
</head>

<body>
  <?php
  require("./header.php");
  ?>

  <main class="conteudo_apostilas">
    <!-- Banner principal -->
    <div class="banner-apostilas">
      <div class="banner-particles">
        <span></span><span></span><span></span><span></span><span></span>
      </div>
      <h1>📚 Apostilas</h1>
      <p>Materiais educativos gratuitos organizados por nível escolar</p>
      <div class="banner-stats">
        <div class="stat-item"><span class="stat-num">3</span><span class="stat-label">Níveis</span></div>
        <div class="stat-sep"></div>
        <div class="stat-item"><span class="stat-num">12</span><span class="stat-label">Séries</span></div>
        <div class="stat-sep"></div>
        <div class="stat-item"><span class="stat-num">60+</span><span class="stat-label">Apostilas</span></div>
      </div>
    </div>

    <!-- Navegação por níveis -->
    <section class="niveis-section">
      <h2>Selecione o nível escolar</h2>
      <div class="niveis-container">
        <button class="nivel-btn" data-nivel="fundamental1" id="nivel-btn-fundamental1">
          <span class="nivel-icon">📖</span>
          <div class="nivel-info">
            <span class="nivel-name">Fundamental I</span>
            <span class="nivel-sub">1º ao 5º ano</span>
          </div>
          <span class="nivel-arrow"><i class="fas fa-arrow-right"></i></span>
        </button>
        <button class="nivel-btn" data-nivel="fundamental2" id="nivel-btn-fundamental2">
          <span class="nivel-icon">📚</span>
          <div class="nivel-info">
            <span class="nivel-name">Fundamental II</span>
            <span class="nivel-sub">6º ao 9º ano</span>
          </div>
          <span class="nivel-arrow"><i class="fas fa-arrow-right"></i></span>
        </button>
        <button class="nivel-btn" data-nivel="medio" id="nivel-btn-medio">
          <span class="nivel-icon">🎓</span>
          <div class="nivel-info">
            <span class="nivel-name">Ensino Médio</span>
            <span class="nivel-sub">1º ao 3º ano</span>
          </div>
          <span class="nivel-arrow"><i class="fas fa-arrow-right"></i></span>
        </button>
      </div>
    </section>

    <!-- Seleção de anos -->
    <section class="anos-section" id="anos-section" style="display: none;">
      <div class="anos-header">
        <h2 id="anos-titulo">Selecione o ano</h2>
        <button class="btn-voltar-nivel" id="btn-voltar-nivel">
          <i class="fas fa-arrow-left"></i> Voltar
        </button>
      </div>
      <div class="anos-container" id="anos-container">
        <!-- Preenchido dinamicamente -->
      </div>
    </section>

    <!-- Grid de disciplinas -->
    <section class="disciplinas-section" id="disciplinas-section" style="display: none;">
      <div class="disciplinas-header">
        <h2 id="titulo-disciplinas"></h2>
        <button class="btn-voltar-nivel" id="btn-voltar-ano">
          <i class="fas fa-arrow-left"></i> Voltar aos anos
        </button>
      </div>
      <div class="disciplinas-grid" id="disciplinas-grid">
        <!-- Preenchido dinamicamente -->
      </div>
    </section>

    <!-- Modal de visualização de PDF -->
    <div id="modal-pdf" class="modal-pdf" style="display: none;">
      <div class="modal-pdf-content">
        <button class="modal-close" id="modal-close">&times;</button>
        <iframe id="pdf-iframe" src="" frameborder="0"></iframe>
      </div>
    </div>

    <!-- Toast de conclusão -->
    <div class="apostilas-toast" id="apostilas-toast">
      <i class="fas fa-check-circle"></i>
      <span id="apostilas-toast-msg">Apostila concluída!</span>
    </div>
  </main>

  <?php
  require("./footer.php");
  ?>
</body>

</html>
