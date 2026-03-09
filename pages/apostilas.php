<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apostilas - PerifaEdu</title>
  <link rel="icon" href="../img/PerifaEdu-site.png" type="">
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
      <h1>📚 Apostilas</h1>
      <p>Materiais de estudo organizados por nível escolar</p>
    </div>

    <!-- Navegação por níveis -->
    <section class="niveis-section">
      <h2>Selecione o nível escolar</h2>
      <div class="niveis-container">
        <button class="nivel-btn" data-nivel="fundamental1">
          <span class="nivel-icon">📖</span>
          <span>Fundamental I</span>
        </button>
        <button class="nivel-btn" data-nivel="fundamental2">
          <span class="nivel-icon">📚</span>
          <span>Fundamental II</span>
        </button>
        <button class="nivel-btn" data-nivel="medio">
          <span class="nivel-icon">🎓</span>
          <span>Ensino Médio</span>
        </button>
      </div>
    </section>

    <!-- Seleção de anos -->
    <section class="anos-section" id="anos-section" style="display: none;">
      <h2>Selecione o ano</h2>
      <div class="anos-container" id="anos-container">
        <!-- Preenchido dinamicamente -->
      </div>
    </section>

    <!-- Grid de disciplinas -->
    <section class="disciplinas-section" id="disciplinas-section" style="display: none;">
      <h2 id="titulo-disciplinas"></h2>
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
  </main>

  <?php
  require("./footer.php");
  ?>
</body>

</html>
