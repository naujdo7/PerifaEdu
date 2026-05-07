<?php
require __DIR__ . '/../config/config_env.php';

$exclusaoUrl = APP_URL . 'pages/exclusao-de-dados.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../img/PerifaEdu-site.png" type="">
  <title>Politica de Privacidade | PerifaEdu</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      color: #333;
      max-width: 900px;
      margin: 0 auto;
      padding: 40px 20px;
      line-height: 1.6;
    }

    h1,
    h2 {
      color: #023982;
    }

    h1 {
      font-size: 32px;
      margin-bottom: 10px;
    }

    h2 {
      font-size: 24px;
      margin-top: 40px;
    }

    p {
      margin-bottom: 20px;
    }

    footer {
      margin-top: 50px;
      font-size: 14px;
      text-align: center;
      color: #777;
    }
  </style>
</head>

<body>

  <h1>Politica de Privacidade - PerifaEdu</h1>

  <p>Esta pagina nao coleta dados pessoais, nao possui formularios e nao utiliza cookies de rastreamento. A navegacao e livre e nao requer identificacao.</p>

  <p>O tratamento de dados pessoais, como nome, e-mail e progresso educacional, ocorre exclusivamente dentro do aplicativo PerifaEdu, de forma segura e conforme a Lei Geral de Protecao de Dados.</p>

  <p>As informacoes coletadas pelo app sao utilizadas apenas para personalizar a experiencia de aprendizado e nao sao compartilhadas com terceiros, exceto quando exigido por obrigacao legal.</p>

  <p>Para mais detalhes sobre como os dados sao tratados, consulte a politica de privacidade diretamente dentro do aplicativo PerifaEdu.</p>

  <h2>Exclusao de Dados</h2>
  <p>Para solicitar a exclusao dos dados pessoais vinculados a sua conta, acesse: <a href="<?= htmlspecialchars($exclusaoUrl) ?>"><?= htmlspecialchars($exclusaoUrl) ?></a></p>

  <h2>Contato</h2>
  <p>Para duvidas sobre esta politica, entre em contato com a equipe do PerifaEdu: <a href="perifaedu@gmail.com">perifaedu@gmail.com</a></p>

  <footer>
    &copy; 2026 PerifaEdu. Todos os direitos reservados.
  </footer>

</body>

</html>