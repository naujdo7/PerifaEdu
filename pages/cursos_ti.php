<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cursos Técnicos</title>
  <link rel="icon" href="../img/PerifaEdu-site.png" type="">
  <link rel="stylesheet" href="../css/cursos_tecnicos.css">
  <link rel="stylesheet" href="../css/headerfoot.css">
  <link rel="stylesheet" href="../css/popup.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="../js/headerfoot.js" defer></script>
  <script src="../js/popup-login.js" defer></script>
  <script src="../js/pesquisa_cursos.js" defer></script>

</head>

<body>
  <?php
  require("./header.php");
  ?>
  <main class="conteudo_cursos_tecnicos">
    <div class="pesquisa-container">
      <h1>Cursos Técnicos</h1>
      <div class="search-container">
        <input id="search-input" type="text" placeholder="Pesquise pelo seu curso técnico">
      </div>
    </div>
    <div class="tags-container">
      <h1>Encontre seu curso ideal</h1>
      <div class="tags">
        <a href="./cursos_ti.php" class="tag-button">TI</a>
        <a href="./cursos_administracao.php" class="tag-button">Administração</a>
        <a href="./cursos_saude.php" class="tag-button">Saúde</a>
        <a href="./cursos_informatica.php" class="tag-button">Informática</a>
        <a href="./cursos_sustentabilidade.php" class="tag-button">Sustentabilidade</a>
        <a href="./cursos_tecnicos.php" class="tag-button active">Todos</a>
      </div>
    </div>

    <div class="conteudo__cursos">

      <h2>📚 Cursos de TI</h2>
      <div class="courses-grid">
        <div class="course-card">
          <img src="../img/curso_ti.jpg" alt="Imagem de curso de TI">
          <h3>Técnico de TI</h3>
          <p>Front End, Back End e DS</p>
          <span>Duração | 2 anos</span>
          <a href="matricula.php?curso=tecnico-de-ti" class="btn">Saiba mais</a>
        </div>

      </div>
    </div>
  </main>
  <?php
  require("./footer.php");
  ?>
</body>

</html>