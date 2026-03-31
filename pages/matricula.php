<?php
    require_once("./header.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Matrícula – PerifaEdu</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/headerfoot.css">
  <link rel="stylesheet" href="../css/popup.css">
  <script src="../js/headerfoot.js" defer></script>
  <script src="../js/popup-login.js" defer></script>
  <style>
    /* ── Reset & Base ── */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --blue-dark:  #1a3a6b;
      --blue-mid:   #2563eb;
      --blue-light: #dbeafe;
      --bg:         #f0f6ff;
      --white:      #ffffff;
      --gray-100:   #f3f4f6;
      --gray-300:   #d1d5db;
      --gray-500:   #6b7280;
      --gray-700:   #374151;
      --green:      #16a34a;
      --red:        #dc2626;
      --shadow:     0 4px 24px rgba(37,99,235,.12);
      --radius:     14px;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--bg);
      color: var(--gray-700);
      min-height: 100vh;
    }

    /* ── Hero do Curso ── */
    .course-hero {
      background: linear-gradient(135deg, var(--blue-dark) 0%, #1e4db7 60%, #2563eb 100%);
      padding: 52px 32px 40px;
      color: #fff;
    }
    .course-hero .breadcrumb {
      font-size: .82rem;
      opacity: .7;
      margin-bottom: 18px;
    }
    .course-hero .breadcrumb a { color: #93c5fd; text-decoration: none; }
    .course-hero .breadcrumb a:hover { text-decoration: underline; }

    .course-hero-inner {
      max-width: 900px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr auto;
      gap: 32px;
      align-items: center;
    }
    .course-tag {
      display: inline-block;
      background: rgba(255,255,255,.18);
      border: 1px solid rgba(255,255,255,.3);
      border-radius: 20px;
      font-size: .78rem;
      font-weight: 600;
      letter-spacing: .5px;
      padding: 4px 14px;
      margin-bottom: 14px;
      text-transform: uppercase;
    }
    .course-hero h1 {
      font-family: 'Poppins', sans-serif;
      font-size: 2.1rem;
      font-weight: 700;
      line-height: 1.2;
      margin-bottom: 14px;
      color: white;
      text-align: justify;
    }
    .course-hero p.desc {
      font-size: 1rem;
      line-height: 1.7;
      opacity: .88;
      max-width: 580px;
    }

    .course-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-top: 26px;
    }
    .meta-item {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }
    .meta-item .label {
      font-size: .72rem;
      font-weight: 600;
      letter-spacing: .8px;
      text-transform: uppercase;
      opacity: .65;
    }
    .meta-item .value {
      font-size: .95rem;
      font-weight: 600;
    }

    .course-badge {
      background: rgba(255,255,255,.12);
      border: 2px solid rgba(255,255,255,.25);
      border-radius: 20px;
      padding: 28px 32px;
      text-align: center;
      backdrop-filter: blur(8px);
      min-width: 180px;
    }
    .course-badge .icon { font-size: 3rem; margin-bottom: 8px; }
    .course-badge .badge-label {
      font-size: .8rem;
      opacity: .7;
      font-weight: 500;
    }
    .course-badge .badge-value {
      font-family: 'Poppins', sans-serif;
      font-size: 1.15rem;
      font-weight: 700;
      margin-top: 4px;
    }

    /* ── Módulos / O que você vai aprender ── */
    .section-info {
      max-width: 900px;
      margin: 40px auto;
      padding: 0 24px;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
    }
    .info-card {
      background: var(--white);
      border-radius: var(--radius);
      padding: 28px;
      box-shadow: var(--shadow);
    }
    .info-card h3 {
      font-family: 'Poppins', sans-serif;
      font-size: 1rem;
      font-weight: 700;
      color: var(--blue-dark);
      margin-bottom: 16px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .info-card ul { list-style: none; display: flex; flex-direction: column; gap: 10px; }
    .info-card ul li {
      font-size: .9rem;
      display: flex;
      align-items: flex-start;
      gap: 10px;
      line-height: 1.5;
    }
    .info-card ul li::before {
      content: '✓';
      color: var(--green);
      font-weight: 700;
      flex-shrink: 0;
      margin-top: 1px;
    }
    .req-list li::before { content: '◆'; color: var(--blue-mid); font-size: .7rem; margin-top: 4px; }

    /* ── Divisor ── */
    .divider {
      max-width: 900px;
      margin: 8px auto 32px;
      padding: 0 24px;
    }
    .divider hr { border: none; border-top: 2px solid var(--blue-light); }
    .divider-title {
      font-family: 'Poppins', sans-serif;
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--blue-dark);
      margin-bottom: 6px;
    }
    .divider-sub { font-size: .9rem; color: var(--gray-500); }

    /* ── Formulário ── */
    .form-wrapper {
      max-width: 900px;
      margin: 0 auto 60px;
      padding: 0 24px;
    }
    .form-card {
      background: var(--white);
      border-radius: var(--radius);
      padding: 40px 48px;
      box-shadow: var(--shadow);
    }

    .form-section-title {
      font-family: 'Poppins', sans-serif;
      font-size: .85rem;
      font-weight: 700;
      color: var(--blue-mid);
      text-transform: uppercase;
      letter-spacing: 1px;
      margin: 28px 0 16px;
      padding-bottom: 8px;
      border-bottom: 2px solid var(--blue-light);
    }
    .form-section-title:first-child { margin-top: 0; }

    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }
    .form-group {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }
    .form-group.full { grid-column: 1 / -1; }

    label {
      font-size: .82rem;
      font-weight: 600;
      color: var(--gray-700);
    }
    label .req { color: var(--red); margin-left: 2px; }

    input[type="text"],
    input[type="date"],
    input[type="number"],
    select,
    textarea {
      width: 100%;
      padding: 11px 14px;
      border: 1.5px solid var(--gray-300);
      border-radius: 9px;
      font-family: 'Inter', sans-serif;
      font-size: .9rem;
      color: var(--gray-700);
      background: var(--gray-100);
      transition: border-color .2s, box-shadow .2s, background .2s;
      outline: none;
    }
    input:focus, select:focus, textarea:focus {
      border-color: var(--blue-mid);
      background: #fff;
      box-shadow: 0 0 0 3px rgba(37,99,235,.12);
    }
    input.error, select.error { border-color: var(--red); }

    .field-error {
      font-size: .75rem;
      color: var(--red);
      display: none;
    }
    .field-error.show { display: block; }

    /* ── Upload ── */
    /* .upload-area {
      border: 2px dashed var(--gray-300);
      border-radius: 12px;
      padding: 32px 20px;
      text-align: center;
      cursor: pointer;
      transition: border-color .2s, background .2s;
      background: var(--gray-100);
      position: relative;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
    }
    .upload-area:hover, .upload-area.drag { border-color: var(--blue-mid); background: var(--blue-light); }
    .upload-area input[type="file"] {
      position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
    }
    .upload-icon { font-size: 2.4rem; margin-bottom: 10px; }
    .upload-area p { font-size: .88rem; color: var(--gray-500); line-height: 1.6; }
    .upload-area strong { color: var(--blue-mid); }
    .upload-preview {
      display: none;
      align-items: center;
      gap: 12px;
      background: #eff6ff;
      border: 1.5px solid #93c5fd;
      border-radius: 10px;
      padding: 12px 16px;
      margin-top: 12px;
    }
    .upload-preview.show { display: flex; }
    .upload-preview .file-icon { font-size: 1.8rem; }
    .upload-preview .file-info { flex: 1; text-align: left; }
    .upload-preview .file-name { font-size: .85rem; font-weight: 600; color: var(--blue-dark); }
    .upload-preview .file-size { font-size: .75rem; color: var(--gray-500); margin-top: 2px; }
    .upload-preview .remove-file {
      background: none; border: none; cursor: pointer; font-size: 1.1rem; color: var(--gray-500);
    }
    .upload-preview .remove-file:hover { color: var(--red); }
    .upload-hint {
      font-size: .78rem;
      color: var(--gray-500);
      margin-top: 8px;
    } */

    /* ── Checkbox termos ── */
    .checkbox-group {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      margin-top: 8px;
    }
    .checkbox-group input[type="checkbox"] {
      width: 18px; height: 18px; flex-shrink: 0; margin-top: 2px;
      accent-color: var(--blue-mid);
    }
    .checkbox-group label {
      font-size: .85rem;
      font-weight: 400;
      color: var(--gray-500);
      line-height: 1.5;
    }
    .checkbox-group label a { color: var(--blue-mid); text-decoration: none; }

    /* ── Botão submit ── */
    .btn-submit {
      width: 100%;
      padding: 15px;
      background: linear-gradient(135deg, var(--blue-mid), #1d4ed8);
      color: #fff;
      font-family: 'Poppins', sans-serif;
      font-size: 1rem;
      font-weight: 700;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: opacity .2s, transform .1s;
      margin-top: 28px;
      letter-spacing: .3px;
    }
    .btn-submit:hover { opacity: .93; }
    .btn-submit:active { transform: scale(.99); }
    .btn-submit:disabled { opacity: .6; cursor: not-allowed; }

    /* ── Mensagens ── */
    .alert {
      padding: 16px 20px;
      border-radius: 10px;
      font-size: .9rem;
      font-weight: 500;
      display: none;
      margin-top: 20px;
      align-items: flex-start;
      gap: 12px;
    }
    .alert.show { display: flex; }
    .alert-success { background: #dcfce7; border: 1.5px solid #86efac; color: #15803d; }
    .alert-error   { background: #fee2e2; border: 1.5px solid #fca5a5; color: #b91c1c; }
    .alert-icon { font-size: 1.3rem; flex-shrink: 0; }
    .alert-text p { line-height: 1.6; }
    .alert-text strong { display: block; margin-bottom: 4px; }

    /* ── Responsive ── */
    @media (max-width: 720px) {
      .course-hero { padding: 36px 20px 28px; }
      .course-hero-inner { grid-template-columns: 1fr; }
      .course-badge { display: none; }
      .course-hero h1 { font-size: 1.5rem; }
      .section-info { grid-template-columns: 1fr; padding: 0 16px; }
      .form-wrapper { padding: 0 16px; }
      .form-card { padding: 28px 20px; }
      .form-row { grid-template-columns: 1fr; }
      .divider { padding: 0 16px; }
    }
  </style>
</head>
<body>
<?php
/* ─────────────────────────────────────────
   DADOS DOS CURSOS
   Para adicionar/editar cursos: modifique o array abaixo.
   O link "Saiba mais" do cursos_tecnicos.php deve apontar para:
   matricula.php?curso=SLUG_DO_CURSO
───────────────────────────────────────── */
$cursos = [
  'tecnico-de-ti' => [
    'nome'       => 'Técnico de TI',
    'area'       => 'Tecnologia da Informação',
    'icone'      => '💻',
    'duracao'    => '2 anos',
    'turno'      => 'Noturno',
    'vagas'      => '40 vagas',
    'certificado'=> 'Diploma Técnico Federal',
    'desc'       => 'Forme-se como profissional de TI capaz de desenvolver soluções web, analisar dados e gerenciar infraestrutura digital. Um curso para quem quer transformar o futuro através da tecnologia.',
    'modulos'    => ['Lógica de programação e algoritmos', 'Desenvolvimento Front-End (HTML, CSS, JS)', 'Back-End com PHP e banco de dados', 'Redes de computadores e segurança', 'Data Science e análise de dados', 'Projetos práticos e portfólio'],
    'requisitos' => ['Ensino Médio completo ou cursando', 'Noções básicas de informática', 'Interesse em tecnologia e resolução de problemas'],
  ],
  'tecnico-de-informatica' => [
    'nome'       => 'Técnico de Informática',
    'area'       => 'Hardware & Manutenção',
    'icone'      => '🔧',
    'duracao'    => '1,5 anos',
    'turno'      => 'Noturno',
    'vagas'      => '35 vagas',
    'certificado'=> 'Diploma Técnico Federal',
    'desc'       => 'Aprenda a montar, configurar e dar manutenção em computadores e equipamentos eletrônicos. Habilidades práticas para o mercado de trabalho em TI.',
    'modulos'    => ['Arquitetura de computadores', 'Manutenção preventiva e corretiva em bancada', 'Sistemas operacionais Windows e Linux', 'Hardware: memória, placa-mãe, periféricos', 'Redes locais e cabeamento estruturado', 'Suporte técnico e atendimento ao cliente'],
    'requisitos' => ['Ensino Fundamental completo', 'Disposição para trabalho prático', 'Nenhum conhecimento prévio necessário'],
  ],
  'tecnico-em-adm' => [
    'nome'       => 'Técnico em Administração',
    'area'       => 'Administração & Gestão',
    'icone'      => '📊',
    'duracao'    => '1 ano',
    'turno'      => 'Noturno',
    'vagas'      => '50 vagas',
    'certificado'=> 'Diploma Técnico Federal',
    'desc'       => 'Desenvolva competências em liderança, economia e marketing para atuar em empresas de todos os setores. O profissional de administração é essencial em qualquer organização.',
    'modulos'    => ['Fundamentos de administração e gestão', 'Liderança e dinâmica de equipes', 'Economia, finanças e contabilidade básica', 'Marketing digital e estratégico', 'Recursos humanos e legislação trabalhista', 'Empreendedorismo e plano de negócios'],
    'requisitos' => ['Ensino Médio completo ou cursando', 'Boa comunicação e perfil de liderança', 'Interesse em gestão e negócios'],
  ],
  'sustentabilidade' => [
    'nome'       => 'Técnico em Sustentabilidade',
    'area'       => 'Meio Ambiente & Gestão',
    'icone'      => '🌱',
    'duracao'    => '1,5 anos',
    'turno'      => 'Noturno',
    'vagas'      => '30 vagas',
    'certificado'=> 'Diploma Técnico Federal',
    'desc'       => 'Atue na vanguarda das questões ambientais e urbanas. Forme-se para trabalhar com gestão ambiental, resíduos, energias renováveis e projetos de impacto social.',
    'modulos'    => ['Gestão ambiental e legislação', 'Sustentabilidade na indústria e no urbanismo', 'Energias renováveis e eficiência energética', 'Gestão de resíduos sólidos', 'Projetos socioambientais', 'Educação ambiental e engajamento comunitário'],
    'requisitos' => ['Ensino Médio completo ou cursando', 'Interesse em meio ambiente', 'Perfil proativo e colaborativo'],
  ],
  'edificacoes' => [
    'nome'       => 'Técnico em Edificações',
    'area'       => 'Construção Civil',
    'icone'      => '🏗️',
    'duracao'    => '2,5 anos',
    'turno'      => 'Noturno',
    'vagas'      => '30 vagas',
    'certificado'=> 'Diploma Técnico Federal',
    'desc'       => 'Aprenda a planejar, executar e fiscalizar obras. Do projeto ao canteiro, você dominará as técnicas da construção civil moderna, incluindo AutoCAD e leitura de plantas.',
    'modulos'    => ['Leitura e interpretação de projetos', 'AutoCAD e desenho técnico', 'Materiais de construção e orçamento', 'Topografia e terraplanagem', 'Fiscalização e controle de obras', 'Normas técnicas ABNT e segurança do trabalho'],
    'requisitos' => ['Ensino Médio completo ou cursando', 'Raciocínio espacial e matemático', 'Disposição para atividades em campo'],
  ],
  'contabilidade' => [
    'nome'       => 'Técnico em Contabilidade',
    'area'       => 'Finanças & Contabilidade',
    'icone'      => '🧾',
    'duracao'    => '1 ano',
    'turno'      => 'Noturno',
    'vagas'      => '40 vagas',
    'certificado'=> 'Diploma Técnico Federal',
    'desc'       => 'Domine finanças, auditorias e obrigações fiscais. Profissionais de contabilidade estão entre os mais demandados no mercado e atuam em todos os segmentos da economia.',
    'modulos'    => ['Contabilidade geral e empresarial', 'Escrituração fiscal e tributária', 'Impostos: IRPJ, ICMS, ISS, PIS/COFINS', 'Auditoria e controle interno', 'Departamento pessoal e folha de pagamento', 'Softwares contábeis e Excel avançado'],
    'requisitos' => ['Ensino Médio completo ou cursando', 'Atenção a detalhes e gosto por números', 'Interesse em finanças e impostos'],
  ],
  'nutricao' => [
    'nome'       => 'Técnico em Nutrição',
    'area'       => 'Saúde & Bem-estar',
    'icone'      => '🥗',
    'duracao'    => '1,5 anos',
    'turno'      => 'Noturno',
    'vagas'      => '35 vagas',
    'certificado'=> 'Diploma Técnico Federal',
    'desc'       => 'Aprenda sobre alimentação saudável, nutrição clínica e dietética. Atue em clínicas, hospitais, escolas e programas comunitários promovendo saúde e qualidade de vida.',
    'modulos'    => ['Anatomia e fisiologia do sistema digestivo', 'Nutrição clínica e dietoterapia', 'Higiene e vigilância sanitária de alimentos', 'Elaboração de cardápios e dietas', 'Nutrição esportiva e funcional', 'Educação nutricional e saúde pública'],
    'requisitos' => ['Ensino Médio completo ou cursando', 'Interesse em saúde e alimentação', 'Empatia e cuidado com as pessoas'],
  ],
  'psicologia' => [
    'nome'       => 'Técnico em Psicologia',
    'area'       => 'Saúde Mental & Comportamento',
    'icone'      => '🧠',
    'duracao'    => '2,5 anos',
    'turno'      => 'Noturno',
    'vagas'      => '30 vagas',
    'certificado'=> 'Diploma Técnico Federal',
    'desc'       => 'Explore o comportamento humano e os processos mentais. Atue como auxiliar em clínicas psicológicas, instituições sociais e empresas na área de saúde mental e bem-estar.',
    'modulos'    => ['Fundamentos de psicologia e teorias comportamentais', 'Psicologia do desenvolvimento', 'Saúde mental e transtornos psicológicos', 'Dinâmicas de grupo e relações humanas', 'Psicologia organizacional', 'Ética profissional e legislação em saúde'],
    'requisitos' => ['Ensino Médio completo ou cursando', 'Empatia, escuta ativa e equilíbrio emocional', 'Interesse em comportamento humano'],
  ],
];

// Pega o slug da URL, com fallback para o primeiro curso
$slug = isset($_GET['curso']) ? $_GET['curso'] : '';
$curso = isset($cursos[$slug]) ? $cursos[$slug] : null;

// Se não encontrou, usa dados genéricos
if (!$curso) {
  $slug  = 'tecnico-de-ti';
  $curso = $cursos[$slug];
}
?>

<!-- ── HEADER ── -->


<!-- ── HERO DO CURSO ── -->
<section class="course-hero">
  <div style="max-width:900px;margin:0 auto;">
    <div class="breadcrumb">
      <a href="../index.php">Início</a> › <a href="cursos_tecnicos.php">Cursos Técnicos</a> › <?= htmlspecialchars($curso['nome']) ?>
    </div>
    <div class="course-hero-inner">
      <div>
        <span class="course-tag"><?= htmlspecialchars($curso['area']) ?></span>
        <h1><?= htmlspecialchars($curso['nome']) ?></h1>
        <p class="desc"><?= htmlspecialchars($curso['desc']) ?></p>
        <div class="course-meta">
          <div class="meta-item">
            <span class="label">Duração</span>
            <span class="value">⏱ <?= htmlspecialchars($curso['duracao']) ?></span>
          </div>
          <div class="meta-item">
            <span class="label">Turno</span>
            <span class="value">🌙 <?= htmlspecialchars($curso['turno']) ?></span>
          </div>
          <div class="meta-item">
            <span class="label">Vagas</span>
            <span class="value">👥 <?= htmlspecialchars($curso['vagas']) ?></span>
          </div>
          <div class="meta-item">
            <span class="label">Certificado</span>
            <span class="value">🎓 <?= htmlspecialchars($curso['certificado']) ?></span>
          </div>
        </div>
      </div>
      <div class="course-badge">
        <div class="icon"><?= $curso['icone'] ?></div>
        <div class="badge-label">Curso Técnico</div>
        <div class="badge-value"><?= htmlspecialchars($curso['nome']) ?></div>
      </div>
    </div>
  </div>
</section>

<!-- ── INFO CARDS: O QUE VOCÊ VAI APRENDER + REQUISITOS ── -->
<div class="section-info">
  <div class="info-card">
    <h3>📚 O que você vai aprender</h3>
    <ul>
      <?php foreach($curso['modulos'] as $m): ?>
        <li><?= htmlspecialchars($m) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <div class="info-card">
    <h3>📋 Requisitos para inscrição</h3>
    <ul class="req-list">
      <?php foreach($curso['requisitos'] as $r): ?>
        <li><?= htmlspecialchars($r) ?></li>
      <?php endforeach; ?>
    </ul>
    <div style="margin-top:24px;padding:16px;background:#eff6ff;border-radius:10px;">
      <p style="font-size:.82rem;color:#1e40af;line-height:1.6;">
        <strong style="display:block;margin-bottom:4px;">💡 Sobre o comprovante de renda</strong>
        A renda familiar será usada para garantir acesso prioritário a candidatos de baixa renda. O curso é <strong>gratuito</strong>. Documentos aceitos: holerite, declaração de IR, extrato do CRAS ou declaração informal assinada.
      </p>
    </div>
  </div>
</div>

<!-- ── DIVISOR ── -->
<div class="divider">
  <p class="divider-title">Formulário de Matrícula</p>
  <p class="divider-sub">Preencha todos os campos obrigatórios (<span style="color:var(--red)">*</span>) para concluir sua inscrição em <strong><?= htmlspecialchars($curso['nome']) ?></strong>.</p>
  <hr style="margin-top:16px;">
</div>

<!-- ── FORMULÁRIO ── -->
<div class="form-wrapper">
  <div class="form-card">
    <form id="matriculaForm"  novalidate>
      <!-- Campo oculto com o curso selecionado -->
      <input type="hidden" name="curso" value="<?= htmlspecialchars($slug) ?>">
      <input type="hidden" name="curso_nome" value="<?= htmlspecialchars($curso['nome']) ?>">

      <!-- 1. Dados Pessoais -->
      <p class="form-section-title">👤 Dados Pessoais</p>
      <div class="form-row">
        <div class="form-group full">
          <label for="nome_completo">Nome Completo <span class="req">*</span></label>
          <input type="text" id="nome_completo" name="nome_completo" placeholder="Seu nome completo" maxlength="120">
          <span class="field-error" id="err_nome">Por favor, informe seu nome completo.</span>
        </div>

        <div class="form-group">
          <label for="cpf">CPF <span class="req">*</span></label>
          <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" maxlength="14">
          <span class="field-error" id="err_cpf">CPF inválido. Use o formato 000.000.000-00.</span>
        </div>

        <div class="form-group">
          <label for="data_nascimento">Data de Nascimento <span class="req">*</span></label>
          <input type="date" id="data_nascimento" name="data_nascimento">
          <span class="field-error" id="err_data">Data de nascimento inválida.</span>
        </div>

        <div class="form-group">
          <label for="idade">Idade <span class="req">*</span></label>
          <input type="number" id="idade" name="" placeholder="Ex: 22" min="14" max="99" readonly style="background:#e9effd;cursor:not-allowed;">
          <span class="field-error" id="err_idade">Você deve ter pelo menos 14 anos.</span>
        </div>

        <div class="form-group">
          <label for="telefone">Telefone / WhatsApp <span class="req">*</span></label>
          <input type="text" id="telefone" name="telefone" placeholder="(11) 99999-9999" maxlength="15">
          <span class="field-error" id="err_tel">Telefone inválido.</span>
        </div>

        <div class="form-group full">
          <label for="email">E-mail <span class="req">*</span></label>
          <input type="text" id="email" name="email" placeholder="seuemail@email.com">
          <span class="field-error" id="err_email">E-mail inválido.</span>
        </div>
      </div>

      <!-- 2. Filiação -->
      <p class="form-section-title">👨‍👩‍👧 Filiação</p>
      <div class="form-row">
        <div class="form-group">
          <label for="nome_mae">Nome da Mãe <span class="req">*</span></label>
          <input type="text" id="nome_mae" name="nome_mae" placeholder="Nome completo da mãe" maxlength="120">
          <span class="field-error" id="err_mae">Informe o nome da mãe.</span>
        </div>
        <div class="form-group">
          <label for="nome_pai">Nome do Pai</label>
          <input type="text" id="nome_pai" name="nome_pai" placeholder="Nome completo do pai (opcional)" maxlength="120">
        </div>
      </div>

      <!-- 3. Escolaridade -->
      <p class="form-section-title">🎓 Escolaridade</p>
      <div class="form-row">
        <div class="form-group">
          <label for="escolaridade">Nível de Escolaridade <span class="req">*</span></label>
          <select id="escolaridade" name="escolaridade">
            <option value="">Selecione...</option>
            <option value="fundamental_incompleto">Fundamental Incompleto (interrompido)</option>
            <option value="fundamental_incompleto">Fundamental Incompleto (cursando)</option>
            <option value="fundamental_completo">Fundamental Completo</option>
            <option value="medio_incompleto">Médio Incompleto (interrompido)</option>
            <option value="medio_incompleto">Médio Incompleto (cursando)</option>
            <option value="medio_completo">Médio Completo</option>
            <option value="superior_incompleto">Superior Incompleto (interrompido)</option>
            <option value="superior_incompleto">Superior Incompleto (cursando)</option>
            <option value="superior_completo">Superior Completo</option>
          </select>
          <span class="field-error" id="err_esc">Selecione seu nível de escolaridade.</span>
        </div>
        <div class="form-group">
          <label for="escola">Escola / Instituição de origem <span class="req">*</span></label>
          <input type="text" id="escola" name="escola" placeholder="Nome da escola onde estudou/estuda" maxlength="150">
          <span class="field-error" id="err_escola">Informe a escola de origem.</span>
        </div>
      </div>

      <!-- 4. Endereço -->
      <p class="form-section-title">📍 Endereço</p>
      <div class="form-row">
        <div class="form-group">
          <label for="cep">CEP <span class="req">*</span></label>
          <input type="text" id="cep" name="cep" placeholder="00000-000" maxlength="9">
          <span class="field-error" id="err_cep">CEP inválido.</span>
        </div>
        <div class="form-group">
          <label for="bairro">Bairro <span class="req">*</span></label>
          <input type="text" id="bairro" name="bairro" placeholder="Seu bairro" maxlength="100">
          <span class="field-error" id="err_bairro">Informe o bairro.</span>
        </div>
        <div class="form-group full">
          <label for="endereco">Endereço completo <span class="req">*</span></label>
          <input type="text" id="endereco" name="endereco" placeholder="Rua, número, complemento" maxlength="200">
          <span class="field-error" id="err_endereco">Informe o endereço completo.</span>
        </div>
        <div class="form-group">
          <label for="cidade">Cidade <span class="req">*</span></label>
          <input type="text" id="cidade" name="cidade" placeholder="Sua cidade" maxlength="100">
          <span class="field-error" id="err_cidade">Informe a cidade.</span>
        </div>
        <div class="form-group">
          <label for="estado">Estado <span class="req">*</span></label>
          <select id="estado" name="estado">
            <option value="">UF...</option>
            <option>AC</option><option>AL</option><option>AP</option><option>AM</option>
            <option>BA</option><option>CE</option><option>DF</option><option>ES</option>
            <option>GO</option><option>MA</option><option>MT</option><option>MS</option>
            <option>MG</option><option>PA</option><option>PB</option><option>PR</option>
            <option>PE</option><option>PI</option><option>RJ</option><option>RN</option>
            <option>RS</option><option>RO</option><option>RR</option><option selected>SP</option>
            <option>SC</option><option>SE</option><option>TO</option>
          </select>
          <span class="field-error" id="err_uf">Selecione o estado.</span>
        </div>
      </div>

      <!-- 5. Comprovante de Renda
      <p class="form-section-title">📄 Comprovante de Renda Familiar</p>
      <div class="form-group full">
        <label>Envie seu comprovante de renda <span class="req">*</span></label>
        <div class="upload-area" id="uploadArea">
          <input type="file" id="comprovante" name="comprovante" accept=".pdf,.jpg,.jpeg,.png">
          <div class="upload-icon">☁️</div>
          <p><strong>Clique para selecionar</strong> ou arraste o arquivo aqui</p>
          <p>Formatos aceitos: PDF, JPG, PNG · Tamanho máximo: 5 MB</p>
        </div>
        <div class="upload-preview" id="uploadPreview">
          <span class="file-icon" id="previewIcon">📄</span>
          <div class="file-info">
            <p class="file-name" id="previewName"></p>
            <p class="file-size" id="previewSize"></p>
          </div>
          <button type="button" class="remove-file" id="removeFile" title="Remover arquivo">✕</button>
        </div>
        <p class="upload-hint">💡 Documentos aceitos: holerite, extrato do CRAS, declaração de IR ou declaração informal assinada. Renda familiar até 3 salários mínimos tem prioridade.</p>
        <span class="field-error" id="err_upload">Anexe um comprovante de renda válido (PDF, JPG ou PNG, até 5 MB).</span>
      </div> -->

      <!-- 6. Informações Adicionais -->
      <p class="form-section-title">ℹ️ Informações Adicionais</p>
      <div class="form-row">
        <div class="form-group">
          <label for="como_conheceu">Como conheceu o PerifaEdu?</label>
          <select id="como_conheceu" name="como_conheceu">
            <option value="">Selecione...</option>
            <option value="instagram">Instagram</option>
            <option value="facebook">Facebook</option>
            <option value="whatsapp">WhatsApp / grupo</option>
            <option value="amigo">Indicação de amigo/familiar</option>
            <option value="escola">Escola / professor</option>
            <option value="google">Google</option>
            <option value="outro">Outro</option>
          </select>
        </div>
        <div class="form-group">
          <label for="deficiencia">Possui alguma deficiência ou necessidade especial?</label>
          <select id="deficiencia" name="deficiencia">
            <option value="nao">Não</option>
            <option value="visual">Visual</option>
            <option value="auditiva">Auditiva</option>
            <option value="motora">Motora</option>
            <option value="intelectual">Intelectual</option>
            <option value="outra">Outra</option>
          </select>
        </div>
        <div class="form-group full">
          <label for="observacoes">Observações (opcional)</label>
          <textarea id="observacoes" name="observacoes" rows="3" placeholder="Alguma informação importante que queira adicionar à sua inscrição..."></textarea>
        </div>
      </div>

      <!-- Termos -->
      <div class="checkbox-group" style="margin-top:20px;">
        <input type="checkbox" id="termos" name="termos">
        <label for="termos">
          Declaro que as informações fornecidas são verdadeiras e concordo com os
          <a href="#">Termos de Uso</a> e a <a href="#">Política de Privacidade</a> do PerifaEdu.
          Estou ciente de que dados falsos implicam no cancelamento da matrícula.
        </label>
      </div>
      <span class="field-error" id="err_termos" style="margin-top:6px;">Você precisa aceitar os termos para continuar.</span>

      <button type="submit" class="btn-submit" id="btnSubmit">
        ✅ Enviar Inscrição
      </button>

      <!-- Alertas -->
      <div class="alert alert-success" id="alertSuccess">
        <span class="alert-icon">🎉</span>
        <div class="alert-text">
          <strong>Inscrição enviada com sucesso!</strong>
          <p>Recebemos sua matrícula para o curso <strong><?= htmlspecialchars($curso['nome']) ?></strong>. Você receberá um e-mail de confirmação em breve. Fique de olho na caixa de entrada e no spam.</p>
        </div>
      </div>
      <div class="alert alert-error" id="alertError">
        <span class="alert-icon">⚠️</span>
        <div class="alert-text">
          <strong>Erro ao enviar.</strong>
          <p id="alertErrorMsg">Verifique os campos e tente novamente.</p>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
/* ═══════════════════════════════════════
   MÁSCARAS
═══════════════════════════════════════ */
function maskCPF(v) {
  v = v.replace(/\D/g,'').slice(0,11);
  return v.replace(/(\d{3})(\d)/,'$1.$2').replace(/(\d{3})(\d)/,'$1.$2').replace(/(\d{3})(\d{1,2})$/,'$1-$2');
}
function maskPhone(v) {
  v = v.replace(/\D/g,'').slice(0,11);
  if(v.length<=10) return v.replace(/(\d{2})(\d{4})(\d+)/,'($1) $2-$3');
  return v.replace(/(\d{2})(\d{5})(\d{4})/,'($1) $2-$3');
}
function maskCEP(v) {
  v = v.replace(/\D/g,'').slice(0,8);
  return v.replace(/(\d{5})(\d)/,'$1-$2');
}

document.getElementById('cpf').addEventListener('input', function(){
  this.value = maskCPF(this.value);
});
document.getElementById('telefone').addEventListener('input', function(){
  this.value = maskPhone(this.value);
});
document.getElementById('cep').addEventListener('input', function(){
  this.value = maskCEP(this.value);
});

/* Calcula idade ao mudar a data */
document.getElementById('data_nascimento').addEventListener('change', function(){
  const dob = new Date(this.value);
  const today = new Date();
  let age = today.getFullYear() - dob.getFullYear();
  const m = today.getMonth() - dob.getMonth();
  if(m < 0 || (m === 0 && today.getDate() < dob.getDate())) age--;
  document.getElementById('idade').value = age > 0 ? age : '';
});

/* ═══════════════════════════════════════
   UPLOAD
═══════════════════════════════════════ */
const uploadArea = document.getElementById('uploadArea');
const fileInput  = document.getElementById('comprovante');
const preview    = document.getElementById('uploadPreview');
const previewName= document.getElementById('previewName');
const previewSize= document.getElementById('previewSize');
const previewIcon= document.getElementById('previewIcon');
const removeBtn  = document.getElementById('removeFile');

function showPreview(file) {
  previewName.textContent = file.name;
  previewSize.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
  previewIcon.textContent = file.name.endsWith('.pdf') ? '📋' : '🖼️';
  preview.classList.add('show');
  uploadArea.style.display = 'none';
}
function clearUpload() {
  fileInput.value = '';
  preview.classList.remove('show');
  uploadArea.style.display = '';
}

fileInput.addEventListener('change', function(){
  if(this.files[0]) showPreview(this.files[0]);
});
removeBtn.addEventListener('click', clearUpload);

// Drag & drop
uploadArea.addEventListener('dragover', e => { e.preventDefault(); uploadArea.classList.add('drag'); });
uploadArea.addEventListener('dragleave', () => uploadArea.classList.remove('drag'));
uploadArea.addEventListener('drop', e => {
  e.preventDefault();
  uploadArea.classList.remove('drag');
  const file = e.dataTransfer.files[0];
  if(file) { fileInput.files = e.dataTransfer.files; showPreview(file); }
});

/* ═══════════════════════════════════════
   VALIDAÇÃO
═══════════════════════════════════════ */
function showErr(id, show) {
  const el = document.getElementById(id);
  if(!el) return;
  el.classList.toggle('show', show);
}
function markField(fieldId, valid) {
  const el = document.getElementById(fieldId);
  if(!el) return;
  el.classList.toggle('error', !valid);
}
function validCPF(cpf) {
  cpf = cpf.replace(/\D/g,'');
  if(cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;
  let sum=0; for(let i=0;i<9;i++) sum+=parseInt(cpf[i])*(10-i);
  let r = 11-(sum%11); if(r>=10) r=0; if(r!=parseInt(cpf[9])) return false;
  sum=0; for(let i=0;i<10;i++) sum+=parseInt(cpf[i])*(11-i);
  r = 11-(sum%11); if(r>=10) r=0; return r==parseInt(cpf[10]);
}

document.getElementById('matriculaForm').addEventListener('submit', function(e){
  e.preventDefault();
  let ok = true;

  const nome = document.getElementById('nome_completo').value.trim();
  const nomeOk = nome.length >= 5 && nome.split(' ').length >= 2;
  markField('nome_completo', nomeOk); showErr('err_nome', !nomeOk);
  if(!nomeOk) ok = false;

  const cpfVal = document.getElementById('cpf').value.trim();
  const cpfOk  = validCPF(cpfVal);
  markField('cpf', cpfOk); showErr('err_cpf', !cpfOk);
  if(!cpfOk) ok = false;

  const dob   = document.getElementById('data_nascimento').value;
  const idade = parseInt(document.getElementById('idade').value);
  const dataOk = dob && idade >= 14;
  markField('data_nascimento', dataOk); showErr('err_data', !dataOk);
  if(!dataOk) ok = false;

  const tel   = document.getElementById('telefone').value.replace(/\D/g,'');
  const telOk = tel.length >= 10;
  markField('telefone', telOk); showErr('err_tel', !telOk);
  if(!telOk) ok = false;

  const email  = document.getElementById('email').value.trim();
  const emailOk= /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  markField('email', emailOk); showErr('err_email', !emailOk);
  if(!emailOk) ok = false;

  const mae   = document.getElementById('nome_mae').value.trim();
  const maeOk = mae.length >= 4;
  markField('nome_mae', maeOk); showErr('err_mae', !maeOk);
  if(!maeOk) ok = false;

  const esc   = document.getElementById('escolaridade').value;
  const escOk = esc !== '';
  markField('escolaridade', escOk); showErr('err_esc', !escOk);
  if(!escOk) ok = false;

  const escola   = document.getElementById('escola').value.trim();
  const escolaOk = escola.length >= 3;
  markField('escola', escolaOk); showErr('err_escola', !escolaOk);
  if(!escolaOk) ok = false;

  const cep   = document.getElementById('cep').value.replace(/\D/g,'');
  const cepOk = cep.length === 8;
  markField('cep', cepOk); showErr('err_cep', !cepOk);
  if(!cepOk) ok = false;

  const bairro   = document.getElementById('bairro').value.trim();
  const bairroOk = bairro.length >= 2;
  markField('bairro', bairroOk); showErr('err_bairro', !bairroOk);
  if(!bairroOk) ok = false;

  const end   = document.getElementById('endereco').value.trim();
  const endOk = end.length >= 5;
  markField('endereco', endOk); showErr('err_endereco', !endOk);
  if(!endOk) ok = false;

  const cidade   = document.getElementById('cidade').value.trim();
  const cidadeOk = cidade.length >= 2;
  markField('cidade', cidadeOk); showErr('err_cidade', !cidadeOk);
  if(!cidadeOk) ok = false;

  const uf   = document.getElementById('estado').value;
  const ufOk = uf !== '';
  markField('estado', ufOk); showErr('err_uf', !ufOk);
  if(!ufOk) ok = false;

  // Upload validação
  const file = fileInput.files[0];
  let uploadOk = false;
  if(file) {
    const allowed = ['application/pdf','image/jpeg','image/png'];
    const maxSize = 5 * 1024 * 1024;
    uploadOk = allowed.includes(file.type) && file.size <= maxSize;
  }
  showErr('err_upload', !uploadOk);
  if(!uploadOk) ok = false;

  const termos   = document.getElementById('termos').checked;
  showErr('err_termos', !termos);
  if(!termos) ok = false;

  if(!ok) {
    // Scroll pro primeiro erro
    const firstErr = document.querySelector('.error, .field-error.show');
    if(firstErr) firstErr.scrollIntoView({ behavior: 'smooth', block: 'center' });
    return;
  }

  // ── Simula envio (substitua pelo fetch para seu backend PHP) ──
  const btn = document.getElementById('btnSubmit');
  btn.disabled = true;
  btn.textContent = '⏳ Enviando...';

fetch('processar_matricula.php', { method: 'POST', body: new FormData(e.target) })
  .then(res => res.json())
  .then(data => {
    if (data.sucesso) {
      document.getElementById('alertSuccess').classList.add('show');
      document.getElementById('alertSuccess').scrollIntoView({ behavior: 'smooth', block: 'center' });
      btn.textContent = '✅ Inscrição enviada!';
    } else {
      document.getElementById('alertErrorMsg').textContent = data.mensagem || 'Erro ao enviar.';
      document.getElementById('alertError').classList.add('show');
      btn.disabled = false;
      btn.textContent = '✅ Enviar Inscrição';
    }
  })
  .catch(() => {
    document.getElementById('alertErrorMsg').textContent = 'Erro de conexão. Tente novamente.';
    document.getElementById('alertError').classList.add('show');
    btn.disabled = false;
    btn.textContent = '✅ Enviar Inscrição';
  });
});
</script>
</body>
</html>
