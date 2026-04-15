<?php
/* ─────────────────────────────────────────
   perfil.php — Página de Perfil Completa
   PerifaEdu
───────────────────────────────────────── */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /PerifaEdu/PerifaEdu/index.php");
    exit();
}

$idUsuario = (int) $_SESSION['usuario_id'];

// Dados do usuário
$stmt = $conn->prepare("SELECT nome_completo, email, fotoPerfil FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$result  = $stmt->get_result();
$usuario = $result->fetch_assoc();
$stmt->close();

$foto = !empty($usuario['fotoPerfil'])
    ? "/PerifaEdu/PerifaEdu/" . $usuario['fotoPerfil']
    : "/PerifaEdu/PerifaEdu/img/perfil.png";

$email = $usuario['email'] ?? ($_SESSION['usuario_email'] ?? '');

// Cursos do usuário (via email na tabela matriculas)
$cursosList = [];
if (!empty($email)) {
    $stmt2 = $conn->prepare(
        "SELECT curso_slug, curso_nome, status, criado_em FROM matriculas WHERE email = ? ORDER BY criado_em DESC"
    );
    $stmt2->bind_param("s", $email);
    $stmt2->execute();
    $res2 = $stmt2->get_result();
    while ($row = $res2->fetch_assoc()) {
        $cursosList[] = $row;
    }
    $stmt2->close();
}

$erro = $_GET['erro'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil — PerifaEdu</title>
    <meta name="description" content="Gerencie seu perfil, acompanhe seus cursos matriculados e visualize seu progresso nas apostilas na plataforma PerifaEdu.">
    <link rel="icon" href="/PerifaEdu/PerifaEdu/img/PerifaEdu-site.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../css/headerfoot.css">
    <link rel="stylesheet" href="../css/popup.css">
    <script src="../js/headerfoot.js" defer></script>
    <script src="../js/popup-login.js" defer></script>

    <style>
/* ===== RESET & TOKENS ===== */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --blue-900:  #012E71;
    --blue-700:  #023982;
    --blue-500:  #035aa8;
    --blue-400:  #1180ff;
    --blue-300:  #188EF8;
    --blue-100:  #dbeafe;
    --blue-50:   #eff6ff;
    --green:     #16a34a;
    --green-light: #dcfce7;
    --white:     #ffffff;
    --gray-50:   #f8fafc;
    --gray-100:  #f1f5f9;
    --gray-200:  #e2e8f0;
    --gray-400:  #94a3b8;
    --gray-600:  #475569;
    --gray-800:  #1e293b;
    --shadow-sm: 0 1px 3px rgba(0,0,0,.08), 0 1px 2px rgba(0,0,0,.04);
    --shadow-md: 0 4px 16px rgba(1,46,113,.12);
    --shadow-lg: 0 12px 40px rgba(1,46,113,.18);
    --radius:    16px;
    --radius-sm: 10px;
}

body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(160deg, #011f52 0%, #023982 40%, #035aa8 100%);
    min-height: 100vh;
    color: var(--gray-800);
}

/* ===== LAYOUT WRAPPER ===== */
.perfil-page {
    max-width: 1100px;
    margin: 0 auto;
    padding: 40px 24px 80px;
}

/* ===== HERO HEADER ===== */
.perfil-hero {
    background: rgba(255,255,255,.07);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,.13);
    border-radius: 24px;
    padding: 40px;
    margin-bottom: 28px;
    display: flex;
    align-items: center;
    gap: 32px;
    box-shadow: var(--shadow-lg);
    position: relative;
    overflow: hidden;
}

.perfil-hero::before {
    content: '';
    position: absolute;
    top: -80px; right: -80px;
    width: 260px; height: 260px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(24,142,248,.2) 0%, transparent 70%);
    pointer-events: none;
}

.hero-avatar {
    position: relative;
    flex-shrink: 0;
}

.hero-avatar img {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--blue-300);
    box-shadow: 0 0 0 5px rgba(24,142,248,.22), var(--shadow-md);
    display: block;
}

.hero-info {
    flex: 1;
}

.hero-label {
    font-size: .72rem;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: rgba(255,255,255,.55);
    margin-bottom: 4px;
}

.hero-name {
    font-family: 'Poppins', sans-serif;
    font-size: 1.9rem;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
    margin-bottom: 6px;
}

.hero-name span { color: var(--blue-300); }

.hero-email {
    font-size: .88rem;
    color: rgba(255,255,255,.6);
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 20px;
}

.hero-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

/* ===== BOTÕES GERAIS ===== */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 10px;
    font-family: 'Inter', sans-serif;
    font-size: .85rem;
    font-weight: 600;
    cursor: pointer;
    border: none;
    transition: all .25s ease;
    text-decoration: none;
    white-space: nowrap;
}

.btn-primary {
    background: linear-gradient(135deg, var(--blue-300), var(--blue-400));
    color: #fff;
    box-shadow: 0 4px 16px rgba(24,142,248,.35);
}
.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(24,142,248,.5); }

.btn-glass {
    background: rgba(255,255,255,.1);
    color: #fff;
    border: 1px solid rgba(255,255,255,.2);
    backdrop-filter: blur(8px);
}
.btn-glass:hover { background: rgba(255,255,255,.18); }

.btn-danger-glass {
    background: rgba(220,53,69,.1);
    color: #ff6b78;
    border: 1px solid rgba(220,53,69,.25);
}
.btn-danger-glass:hover { background: rgba(220,53,69,.22); }

/* ===== ABAS ===== */
.tabs-nav {
    display: flex;
    gap: 4px;
    background: rgba(255,255,255,.07);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,.12);
    border-radius: 14px;
    padding: 6px;
    margin-bottom: 24px;
    overflow-x: auto;
}

.tab-btn {
    flex: 1;
    min-width: 160px;
    padding: 12px 20px;
    border-radius: 10px;
    border: none;
    cursor: pointer;
    font-family: 'Inter', sans-serif;
    font-size: .88rem;
    font-weight: 600;
    color: rgba(255,255,255,.6);
    background: transparent;
    transition: all .25s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    white-space: nowrap;
}

.tab-btn:hover { color: #fff; background: rgba(255,255,255,.08); }

.tab-btn.ativo {
    background: linear-gradient(135deg, var(--blue-300), var(--blue-400));
    color: #fff;
    box-shadow: 0 4px 14px rgba(24,142,248,.4);
}

/* ===== PAINÉIS DAS ABAS ===== */
.tab-panel { display: none; }
.tab-panel.ativo { display: block; animation: fadeIn .3s ease; }

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ===== CARD BASE ===== */
.card {
    background: var(--white);
    border-radius: var(--radius);
    box-shadow: var(--shadow-md);
    overflow: hidden;
}

.card-header {
    padding: 22px 28px;
    border-bottom: 1px solid var(--gray-100);
    display: flex;
    align-items: center;
    gap: 12px;
}

.card-header-icon {
    width: 42px; height: 42px;
    border-radius: 10px;
    background: var(--blue-50);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: var(--blue-400);
    flex-shrink: 0;
}

.card-header h2 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--blue-900);
}

.card-header p {
    font-size: .8rem;
    color: var(--gray-400);
    margin-top: 2px;
}

.card-body { padding: 28px; }

/* ===== ABA 1 — DADOS PESSOAIS ===== */
.foto-section {
    display: flex;
    align-items: center;
    gap: 28px;
    padding: 24px 28px;
    background: var(--gray-50);
    border-bottom: 1px solid var(--gray-100);
}

.foto-preview-wrap {
    position: relative;
    flex-shrink: 0;
}

.foto-preview-wrap img {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--blue-300);
    box-shadow: var(--shadow-md);
}

.foto-actions { display: flex; flex-direction: column; gap: 10px; }

.btn-upload {
    background: linear-gradient(135deg, var(--blue-300), var(--blue-400));
    color: #fff;
    padding: 9px 18px;
    border-radius: 9px;
    font-size: .83rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 7px;
    transition: all .2s;
}
.btn-upload:hover { opacity: .9; transform: translateY(-1px); }

.btn-remove-foto {
    background: none;
    color: #dc2626;
    border: 1.5px solid #fca5a5;
    padding: 8px 16px;
    border-radius: 9px;
    font-size: .83rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 7px;
    transition: all .2s;
}
.btn-remove-foto:hover { background: #fee2e2; }

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    padding: 28px;
}

.info-field label {
    display: block;
    font-size: .72rem;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: var(--gray-400);
    margin-bottom: 6px;
}

.info-field .value {
    font-size: .95rem;
    font-weight: 600;
    color: var(--gray-800);
    padding: 12px 16px;
    background: var(--gray-50);
    border: 1.5px solid var(--gray-200);
    border-radius: 9px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.section-actions {
    padding: 0 28px 28px;
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.btn-senha {
    background: rgba(37,99,235,.08);
    color: var(--blue-400);
    border: 1.5px solid var(--blue-100);
    padding: 10px 20px;
    border-radius: 10px;
    font-size: .86rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all .2s;
}
.btn-senha:hover { background: var(--blue-50); border-color: var(--blue-300); }

.msg-erro-foto {
    padding: 0 28px;
    font-size: .8rem;
    color: #dc2626;
    font-weight: 600;
    min-height: 20px;
}

/* ===== ABA 2 — CURSOS ===== */
.cursos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}

.curso-card {
    background: var(--white);
    border-radius: var(--radius);
    border: 1.5px solid var(--gray-200);
    overflow: hidden;
    transition: all .3s ease;
    box-shadow: var(--shadow-sm);
}

.curso-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
    border-color: var(--blue-100);
}

.curso-card-top {
    background: linear-gradient(135deg, var(--blue-900), var(--blue-700));
    padding: 22px 24px;
    position: relative;
    overflow: hidden;
}

.curso-card-top::after {
    content: '';
    position: absolute;
    top: -30px; right: -30px;
    width: 100px; height: 100px;
    border-radius: 50%;
    background: rgba(255,255,255,.06);
}

.curso-icon {
    font-size: 2.2rem;
    margin-bottom: 10px;
    display: block;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,.3));
}

.curso-nome {
    font-family: 'Poppins', sans-serif;
    font-size: 1rem;
    font-weight: 700;
    color: #fff;
    line-height: 1.3;
}

.curso-card-body {
    padding: 20px 24px;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: .75rem;
    font-weight: 700;
    margin-bottom: 16px;
}

.status-inscrito {
    background: #dcfce7;
    color: #15803d;
}

.status-breve {
    background: #fef3c7;
    color: #92400e;
}

.btn-curso-disabled {
    width: 100%;
    padding: 11px 16px;
    background: var(--gray-100);
    color: var(--gray-400);
    border: 1.5px solid var(--gray-200);
    border-radius: 10px;
    font-size: .84rem;
    font-weight: 600;
    cursor: not-allowed;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.cursos-vazio {
    text-align: center;
    padding: 60px 20px;
    color: var(--gray-400);
}

.cursos-vazio i { font-size: 3rem; margin-bottom: 16px; display: block; opacity: .4; }
.cursos-vazio h3 { font-size: 1.1rem; color: var(--gray-600); margin-bottom: 8px; }

/* ===== ABA 3 — APOSTILAS & PROGRESSO ===== */

/* Navegação por nível */
.niveis-nav {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 28px;
}

.nivel-tab-btn {
    padding: 12px 24px;
    border-radius: 12px;
    border: 2px solid var(--gray-200);
    background: var(--white);
    font-family: 'Inter', sans-serif;
    font-size: .88rem;
    font-weight: 600;
    color: var(--blue-900);
    cursor: pointer;
    transition: all .25s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: var(--shadow-sm);
}

.nivel-tab-btn:hover {
    border-color: var(--blue-300);
    background: var(--blue-50);
    transform: translateY(-2px);
}

.nivel-tab-btn.ativo {
    background: linear-gradient(135deg, var(--blue-900), var(--blue-700));
    color: #fff;
    border-color: transparent;
    box-shadow: 0 4px 14px rgba(1,46,113,.3);
}

/* Painel do nível */
.nivel-panel { display: none; }
.nivel-panel.ativo { display: block; animation: fadeIn .3s ease; }

/* Séries (anos) */
.series-wrapper { margin-bottom: 28px; }

.serie-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 22px;
    background: linear-gradient(135deg, var(--blue-50), #fff);
    border: 1.5px solid var(--blue-100);
    border-radius: 12px;
    cursor: pointer;
    transition: all .2s ease;
    margin-bottom: 4px;
}

.serie-header:hover {
    background: linear-gradient(135deg, var(--blue-100), var(--blue-50));
    border-color: var(--blue-300);
}

.serie-header.open { border-bottom-left-radius: 0; border-bottom-right-radius: 0; margin-bottom: 0; }

.serie-title {
    font-family: 'Poppins', sans-serif;
    font-size: .98rem;
    font-weight: 700;
    color: var(--blue-900);
    display: flex;
    align-items: center;
    gap: 10px;
}

.serie-progress-info {
    font-size: .8rem;
    font-weight: 600;
    color: var(--gray-400);
    display: flex;
    align-items: center;
    gap: 10px;
}

.serie-chevron {
    color: var(--blue-400);
    transition: transform .3s ease;
}
.serie-header.open .serie-chevron { transform: rotate(180deg); }

/* Barra de progresso */
.progress-bar-wrap {
    padding: 12px 22px;
    background: #f8fafc;
    border: 1.5px solid var(--blue-100);
    border-top: none;
    border-bottom: none;
}

.progress-label {
    display: flex;
    justify-content: space-between;
    font-size: .75rem;
    font-weight: 600;
    color: var(--gray-400);
    margin-bottom: 6px;
}

.progress-bar-bg {
    width: 100%;
    height: 8px;
    background: var(--gray-200);
    border-radius: 99px;
    overflow: hidden;
}

.progress-bar-fill {
    height: 100%;
    border-radius: 99px;
    background: linear-gradient(90deg, var(--blue-300), var(--blue-400));
    transition: width .6s ease;
}

.progress-bar-fill.completo {
    background: linear-gradient(90deg, #16a34a, #22c55e);
}

/* Conteúdo da série (accordion) */
.serie-body {
    display: none;
    border: 1.5px solid var(--blue-100);
    border-top: none;
    border-radius: 0 0 12px 12px;
    overflow: hidden;
    margin-bottom: 16px;
}
.serie-body.open { display: block; }

/* Matéria */
.materia-section { border-bottom: 1px solid var(--gray-100); }
.materia-section:last-child { border-bottom: none; }

.materia-header {
    padding: 14px 20px;
    background: var(--white);
    display: flex;
    align-items: center;
    gap: 10px;
    font-family: 'Poppins', sans-serif;
    font-size: .9rem;
    font-weight: 700;
    color: var(--blue-900);
    border-bottom: 1px solid var(--gray-100);
}

.materia-icon {
    width: 34px; height: 34px;
    border-radius: 8px;
    background: var(--blue-50);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

/* Grid de apostilas */
.apostilas-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 14px;
    padding: 16px;
    background: var(--gray-50);
}

/* Card de apostila */
.apostila-card {
    background: #fff;
    border-radius: 12px;
    border: 1.5px solid var(--gray-200);
    padding: 18px;
    transition: all .25s ease;
    box-shadow: var(--shadow-sm);
}

.apostila-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(37,99,235,.12);
    border-color: var(--blue-100);
}

.apostila-card.concluida {
    border-color: #86efac;
    background: #f0fdf4;
}

.apostila-card-top {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 14px;
}

.apostila-card-icon {
    width: 40px; height: 40px;
    border-radius: 10px;
    background: var(--blue-50);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
    transition: background .2s;
}

.apostila-card.concluida .apostila-card-icon {
    background: #dcfce7;
}

.apostila-card-info { flex: 1; min-width: 0; }

.apostila-card-title {
    font-size: .88rem;
    font-weight: 700;
    color: var(--blue-900);
    line-height: 1.4;
    margin-bottom: 4px;
}

.apostila-card-meta {
    font-size: .72rem;
    color: var(--gray-400);
    font-weight: 500;
}

.apostila-check {
    color: #16a34a;
    font-size: 1rem;
    flex-shrink: 0;
    opacity: 0;
    transition: opacity .3s;
}
.apostila-card.concluida .apostila-check { opacity: 1; }

/* Botões da apostila */
.apostila-card-btns {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    margin-bottom: 10px;
}

.btn-ap {
    padding: 8px 10px;
    border-radius: 8px;
    font-size: .78rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
    transition: all .2s ease;
    text-decoration: none;
}

.btn-ap-visualizar {
    background: linear-gradient(135deg, var(--blue-300), var(--blue-400));
    color: #fff;
}
.btn-ap-visualizar:hover { opacity: .88; transform: translateY(-1px); }

.btn-ap-download {
    background: #fff;
    color: var(--blue-400);
    border: 1.5px solid var(--blue-300);
}
.btn-ap-download:hover { background: var(--blue-50); }

.btn-ap-concluir {
    grid-column: 1 / -1;
    background: #fff;
    color: var(--gray-600);
    border: 1.5px solid var(--gray-200);
    padding: 9px;
}
.btn-ap-concluir:hover:not(:disabled) {
    background: #f0fdf4;
    color: var(--green);
    border-color: #86efac;
}
.btn-ap-concluir.concluido {
    background: #f0fdf4;
    color: var(--green);
    border-color: #86efac;
    cursor: default;
}
.btn-ap-concluir:disabled { cursor: default; }

/* ===== MODAL SENHA (herdado do perfil antigo) ===== */
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.6);
    backdrop-filter: blur(4px);
    z-index: 9999;
    align-items: center;
    justify-content: center;
}
.modal-overlay.aberto { display: flex; }

.modal-box {
    background: linear-gradient(135deg, #023982 0%, #012E71 100%);
    border: 1px solid rgba(255,255,255,.15);
    border-radius: 20px;
    padding: 40px 36px;
    width: 100%;
    max-width: 420px;
    margin: 20px;
    box-shadow: 0 30px 80px rgba(0,0,0,.4);
    animation: modalIn .35s cubic-bezier(.34,1.56,.64,1) both;
    position: relative;
}
@keyframes modalIn {
    from { opacity: 0; transform: scale(.88) translateY(20px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
}

.modal-box h2 {
    color: white;
    font-family: 'Poppins', sans-serif;
    font-size: 1.1rem;
    font-weight: 800;
    text-align: center;
    margin-bottom: 6px;
}
.modal-sub {
    color: rgba(255,255,255,.55);
    font-size: .83rem;
    text-align: center;
    margin-bottom: 28px;
}

.btn-fechar-modal {
    position: absolute;
    top: 14px; right: 18px;
    background: none; border: none;
    color: rgba(255,255,255,.5);
    font-size: 22px; cursor: pointer;
    transition: color .2s; line-height: 1;
}
.btn-fechar-modal:hover { color: white; }

.campo-modal { margin-bottom: 16px; text-align: left; }
.campo-modal label {
    display: block;
    color: rgba(255,255,255,.75);
    font-size: .72rem; font-weight: 700;
    letter-spacing: .8px; text-transform: uppercase;
    margin-bottom: 8px;
}
.campo-modal input {
    width: 100%; padding: 12px 16px;
    background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.15);
    border-radius: 10px; color: white;
    font-family: 'Inter', sans-serif; font-size: .9rem;
    outline: none; transition: all .3s ease;
}
.campo-modal input::placeholder { color: rgba(255,255,255,.35); }
.campo-modal input:focus {
    border-color: #188EF8;
    background: rgba(24,142,248,.08);
    box-shadow: 0 0 0 3px rgba(24,142,248,.15);
}

.regras-senha {
    background: rgba(0,0,0,.2);
    border-radius: 10px; padding: 12px 14px;
    margin-top: 8px; margin-bottom: 16px;
}
.regras-senha p { font-size: .75rem; color: rgba(255,255,255,.5); margin: 3px 0; transition: color .2s; }
.regras-senha p.ok { color: #4ade80; }

.msg-modal {
    text-align: center; font-size: .82rem; font-weight: 600;
    min-height: 18px; margin-top: 8px;
}
.msg-modal.sucesso { color: #4ade80; }
.msg-modal.erro    { color: #ff6b78; }

.step { display: none; }
.step.ativo { display: block; }

.codigo-container {
    display: flex; justify-content: center;
    gap: 8px; margin: 20px 0;
}
.codigo-input {
    width: 44px; height: 52px;
    text-align: center; font-size: 22px; font-weight: 800;
    background: rgba(255,255,255,.08);
    border: 2px solid rgba(255,255,255,.2);
    border-radius: 10px; color: white; outline: none;
    transition: all .2s;
    font-family: 'Poppins', sans-serif;
}
.codigo-input:focus { border-color: #188EF8; background: rgba(24,142,248,.12); }

/* ===== MODAL PDF ===== */
.modal-pdf {
    display: none;
    position: fixed; inset: 0;
    background: rgba(0,0,0,.8);
    z-index: 9998;
    align-items: center; justify-content: center;
    backdrop-filter: blur(4px);
}
.modal-pdf.open { display: flex; }

.modal-pdf-content {
    position: relative;
    width: 92%; height: 90%;
    max-width: 1100px;
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,.4);
}

.modal-pdf-close {
    position: absolute;
    top: 14px; right: 14px;
    background: var(--blue-400);
    color: #fff; border: none;
    width: 38px; height: 38px;
    border-radius: 50%;
    font-size: 20px; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    z-index: 10; transition: all .2s;
}
.modal-pdf-close:hover { background: var(--blue-900); transform: scale(1.08); }

#perfil-pdf-iframe { width: 100%; height: 100%; border: none; }

/* ===== TOAST ===== */
.toast {
    position: fixed;
    bottom: 28px; right: 28px;
    background: linear-gradient(135deg, #16a34a, #22c55e);
    color: #fff;
    padding: 14px 22px;
    border-radius: 12px;
    font-weight: 600;
    font-size: .88rem;
    box-shadow: 0 8px 28px rgba(22,163,74,.4);
    display: flex;
    align-items: center;
    gap: 9px;
    transform: translateY(80px);
    opacity: 0;
    transition: all .4s cubic-bezier(.34,1.56,.64,1);
    z-index: 99999;
}
.toast.show { transform: translateY(0); opacity: 1; }

/* ===== RESPONSIVO ===== */
@media (max-width: 768px) {
    .perfil-page { padding: 20px 16px 60px; }
    .perfil-hero { flex-direction: column; text-align: center; padding: 28px 24px; gap: 20px; }
    .hero-email { justify-content: center; }
    .hero-actions { justify-content: center; }
    .hero-name { font-size: 1.5rem; }
    .hero-avatar img { width: 90px; height: 90px; }
    .tabs-nav { gap: 4px; padding: 5px; }
    .tab-btn { min-width: 120px; font-size: .78rem; padding: 10px 14px; }
    .card-body { padding: 20px; }
    .info-grid { grid-template-columns: 1fr; }
    .cursos-grid { grid-template-columns: 1fr; }
    .apostilas-grid { grid-template-columns: 1fr; }
    .foto-section { flex-direction: column; text-align: center; }
    .niveis-nav { gap: 8px; }
    .nivel-tab-btn { padding: 10px 16px; font-size: .82rem; }
}
    </style>
</head>
<body>

<?php require_once "./header.php"; ?>

<div class="perfil-page">

    <!-- ── HERO ── -->
    <div class="perfil-hero">
        <div class="hero-avatar">
            <img id="preview-hero" src="<?= $foto ?>" alt="Foto de perfil">
        </div>
        <div class="hero-info">
            <p class="hero-label">Bem-vindo de volta 👋</p>
            <h1 class="hero-name">
                <?php
                    $partes   = explode(' ', $usuario['nome_completo'] ?? 'Usuário');
                    $primeiro = $partes[0];
                    $restante = implode(' ', array_slice($partes, 1));
                    echo htmlspecialchars($primeiro);
                    if ($restante) echo ' <span>' . htmlspecialchars($restante) . '</span>';
                ?>
            </h1>
            <p class="hero-email">
                <i class="fas fa-envelope"></i>
                <?= htmlspecialchars($email ?: 'Não informado') ?>
            </p>
            <div class="hero-actions">
                <button class="btn btn-primary" onclick="irParaAba('dados')">
                    <i class="fas fa-user-edit"></i> Editar Perfil
                </button>
                <button class="btn btn-glass" onclick="irParaAba('cursos')">
                    <i class="fas fa-graduation-cap"></i> Meus Cursos
                </button>
                <button class="btn btn-glass" onclick="irParaAba('apostilas')">
                    <i class="fas fa-book-open"></i> Apostilas
                </button>
            </div>
        </div>
    </div>

    <!-- ── ABAS ── -->
    <div class="tabs-nav" role="tablist">
        <button class="tab-btn ativo" id="tab-dados" onclick="irParaAba('dados')" role="tab">
            <i class="fas fa-user"></i> Dados Pessoais
        </button>
        <button class="tab-btn" id="tab-cursos" onclick="irParaAba('cursos')" role="tab">
            <i class="fas fa-graduation-cap"></i> Meus Cursos
            <?php if (count($cursosList) > 0): ?>
                <span style="background:var(--blue-300);color:#fff;border-radius:20px;padding:1px 8px;font-size:.7rem;">
                    <?= count($cursosList) ?>
                </span>
            <?php endif; ?>
        </button>
        <button class="tab-btn" id="tab-apostilas" onclick="irParaAba('apostilas')" role="tab">
            <i class="fas fa-book-open"></i> Apostilas & Progresso
        </button>
    </div>

    <!-- ══════════════════════════════════════
         ABA 1 — DADOS PESSOAIS
    ══════════════════════════════════════ -->
    <div class="tab-panel ativo" id="panel-dados">
        <div class="card">
            <div class="card-header">
                <div class="card-header-icon"><i class="fas fa-user-circle"></i></div>
                <div>
                    <h2>Dados Pessoais</h2>
                    <p>Gerencie sua foto e informações da conta</p>
                </div>
            </div>

            <!-- Foto -->
            <form id="formFoto" action="upload_foto.php" method="POST" enctype="multipart/form-data">
                <input type="file" id="inputFoto" name="fotoPerfil" accept="image/*" style="display:none">
                <div class="foto-section">
                    <div class="foto-preview-wrap">
                        <img id="preview" src="<?= $foto ?>" alt="Foto de perfil">
                    </div>
                    <div class="foto-actions">
                        <button type="button" class="btn-upload" onclick="document.getElementById('inputFoto').click()">
                            <i class="fas fa-camera"></i> Alterar Foto
                        </button>
                        <button type="submit" class="btn-upload" style="background:rgba(37,99,235,.12);color:var(--blue-400);box-shadow:none;">
                            <i class="fas fa-upload"></i> Salvar Foto
                        </button>
                    </div>
                </div>
            </form>

            <p class="msg-erro-foto" id="erroFoto">
                <?= $erro === 'sem_foto' ? 'Você não selecionou nenhuma foto!' : '' ?>
            </p>

            <!-- Informações -->
            <div class="info-grid">
                <div class="info-field">
                    <label>Nome Completo</label>
                    <div class="value">
                        <i class="fas fa-user" style="color:var(--blue-300)"></i>
                        <?= htmlspecialchars($usuario['nome_completo'] ?? 'Não informado') ?>
                    </div>
                </div>
                <div class="info-field">
                    <label>E-mail</label>
                    <div class="value">
                        <i class="fas fa-envelope" style="color:var(--blue-300)"></i>
                        <?= htmlspecialchars($email ?: 'Não informado') ?>
                    </div>
                </div>
                <div class="info-field">
                    <label>Cursos Matriculados</label>
                    <div class="value">
                        <i class="fas fa-graduation-cap" style="color:var(--blue-300)"></i>
                        <?= count($cursosList) ?> curso(s)
                    </div>
                </div>
                <div class="info-field">
                    <label>Membro desde</label>
                    <div class="value">
                        <i class="fas fa-calendar" style="color:var(--blue-300)"></i>
                        <?php
                            if (!empty($cursosList)) {
                                $datas = array_column($cursosList, 'criado_em');
                                sort($datas);
                                echo date('d/m/Y', strtotime($datas[0]));
                            } else {
                                echo 'Explorador(a)';
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="section-actions">
                <button type="button" class="btn-senha" onclick="abrirModalSenha()">
                    <i class="fas fa-lock"></i> Trocar Senha
                </button>
                <form action="remover_foto.php" method="POST" style="display:inline">
                    <button type="submit" class="btn-senha" style="color:#dc2626;border-color:#fca5a5;">
                        <i class="fas fa-trash-alt"></i> Remover Foto
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════════
         ABA 2 — MEUS CURSOS
    ══════════════════════════════════════ -->
    <div class="tab-panel" id="panel-cursos">
        <div class="card">
            <div class="card-header">
                <div class="card-header-icon"><i class="fas fa-graduation-cap"></i></div>
                <div>
                    <h2>Meus Cursos</h2>
                    <p>Cursos técnicos nos quais você está inscrito</p>
                </div>
            </div>
            <div class="card-body">
                <?php if (empty($cursosList)): ?>
                    <div class="cursos-vazio">
                        <i class="fas fa-folder-open"></i>
                        <h3>Nenhum curso matriculado ainda</h3>
                        <p>Explore nossos cursos técnicos gratuitos e faça sua inscrição!</p>
                        <a href="cursos_tecnicos.php" class="btn btn-primary" style="margin-top:20px;">
                            <i class="fas fa-search"></i> Ver Cursos
                        </a>
                    </div>
                <?php else: ?>
                <?php
                $cursosIcones = [
                    'tecnico-de-ti'         => '💻',
                    'tecnico-de-informatica'=> '🔧',
                    'tecnico-em-adm'        => '📊',
                    'sustentabilidade'      => '🌱',
                    'edificacoes'           => '🏗️',
                    'contabilidade'         => '🧾',
                    'nutricao'              => '🥗',
                    'psicologia'            => '🧠',
                ];
                ?>
                    <div class="cursos-grid">
                        <?php foreach ($cursosList as $c): ?>
                        <?php
                            $slug      = $c['curso_slug'] ?? '';
                            $icone     = $cursosIcones[$slug] ?? '📚';
                            $nomeC     = $c['curso_nome'] ?? $slug;
                            $statusC   = $c['status'] ?? 'pendente';
                        ?>
                        <div class="curso-card">
                            <div class="curso-card-top">
                                <span class="curso-icon"><?= $icone ?></span>
                                <div class="curso-nome"><?= htmlspecialchars($nomeC) ?></div>
                            </div>
                            <div class="curso-card-body">
                                <span class="status-badge status-inscrito">
                                    <i class="fas fa-check-circle"></i> Inscrito
                                </span>
                                <br>
                                <span class="status-badge status-breve" style="margin-bottom:16px;">
                                    <i class="fas fa-clock"></i> Turmas abrirão em breve
                                </span>
                                <button class="btn-curso-disabled" disabled>
                                    <i class="fas fa-lock"></i> Acessar curso (em breve)
                                </button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════════
         ABA 3 — APOSTILAS & PROGRESSO
    ══════════════════════════════════════ -->
    <div class="tab-panel" id="panel-apostilas">
        <div class="card">
            <div class="card-header">
                <div class="card-header-icon"><i class="fas fa-book-open"></i></div>
                <div>
                    <h2>Apostilas & Progresso</h2>
                    <p>Acompanhe seu progresso por série e marque apostilas concluídas</p>
                </div>
            </div>
            <div class="card-body">

                <!-- Seleção de nível -->
                <div class="niveis-nav" id="niveis-nav">
                    <button class="nivel-tab-btn ativo" data-nivel="fundamental1" onclick="selecionarNivel('fundamental1', this)">
                        📖 Fundamental I
                    </button>
                    <button class="nivel-tab-btn" data-nivel="fundamental2" onclick="selecionarNivel('fundamental2', this)">
                        📚 Fundamental II
                    </button>
                    <button class="nivel-tab-btn" data-nivel="medio" onclick="selecionarNivel('medio', this)">
                        🎓 Ensino Médio
                    </button>
                </div>

                <!-- Painéis dos níveis -->
                <div id="nivel-fundamental1" class="nivel-panel ativo"></div>
                <div id="nivel-fundamental2" class="nivel-panel"></div>
                <div id="nivel-medio" class="nivel-panel"></div>

            </div>
        </div>
    </div>

</div><!-- /perfil-page -->

<!-- ══════════════════ MODAL SENHA ══════════════════ -->
<div class="modal-overlay" id="modalSenha">
    <div class="modal-box">
        <button class="btn-fechar-modal" onclick="fecharModalSenha()">&times;</button>

        <!-- STEP 1 -->
        <div class="step ativo" id="ms-step-email">
            <h2>TROCAR SENHA</h2>
            <p class="modal-sub">Confirme seu e-mail para continuar.</p>
            <div class="campo-modal">
                <label>E-mail</label>
                <input type="email" id="ms-email" placeholder="Insira seu e-mail">
                <p class="msg-modal erro" id="ms-erro-email"></p>
            </div>
            <button class="btn btn-primary" style="width:100%" onclick="msEnviarEmail()">
                <i class="fas fa-paper-plane"></i> Enviar Código
            </button>
            <p class="msg-modal" id="ms-msg-email"></p>
        </div>

        <!-- STEP 2 -->
        <div class="step" id="ms-step-codigo">
            <h2>CONFIRMAR CÓDIGO</h2>
            <p class="modal-sub">Digite o código de 6 dígitos enviado ao seu e-mail.</p>
            <div class="codigo-container">
                <input type="text" maxlength="1" class="codigo-input ms-codigo-input">
                <input type="text" maxlength="1" class="codigo-input ms-codigo-input">
                <input type="text" maxlength="1" class="codigo-input ms-codigo-input">
                <input type="text" maxlength="1" class="codigo-input ms-codigo-input">
                <input type="text" maxlength="1" class="codigo-input ms-codigo-input">
                <input type="text" maxlength="1" class="codigo-input ms-codigo-input">
            </div>
            <button class="btn btn-primary" style="width:100%" onclick="msVerificarCodigo()">
                <i class="fas fa-check"></i> Verificar
            </button>
            <p class="msg-modal" id="ms-msg-codigo"></p>
        </div>

        <!-- STEP 3 -->
        <div class="step" id="ms-step-senha">
            <h2>NOVA SENHA</h2>
            <p class="modal-sub">Escolha uma senha forte para sua conta.</p>
            <div class="campo-modal">
                <label>Nova Senha</label>
                <input type="password" id="ms-nova-senha" placeholder="Digite a nova senha">
                <div class="regras-senha">
                    <p id="ms-r-length">❌ Mínimo 8 caracteres</p>
                    <p id="ms-r-upper">❌ Letra maiúscula</p>
                    <p id="ms-r-lower">❌ Letra minúscula</p>
                    <p id="ms-r-number">❌ Número</p>
                    <p id="ms-r-special">❌ Caractere especial</p>
                </div>
            </div>
            <div class="campo-modal">
                <label>Confirmar Senha</label>
                <input type="password" id="ms-confirmar-senha" placeholder="Repita a nova senha">
                <p class="msg-modal erro" id="ms-erro-confirmar"></p>
            </div>
            <button class="btn btn-primary" style="width:100%" onclick="msConfirmarSenha()">
                <i class="fas fa-shield-alt"></i> Confirmar
            </button>
            <p class="msg-modal" id="ms-msg-senha"></p>
        </div>
    </div>
</div>

<!-- ══════════════════ MODAL PDF ══════════════════ -->
<div class="modal-pdf" id="modalPdf">
    <div class="modal-pdf-content">
        <button class="modal-pdf-close" onclick="fecharModalPdf()">&times;</button>
        <iframe id="perfil-pdf-iframe" src="" frameborder="0"></iframe>
    </div>
</div>

<!-- ══════════════════ TOAST ══════════════════ -->
<div class="toast" id="toast">
    <i class="fas fa-check-circle"></i>
    <span id="toast-msg">Apostila marcada como concluída!</span>
</div>

<script>
/* ════════════════════════════════════════
   DADOS DAS APOSTILAS (compartilhado com apostilas.js)
════════════════════════════════════════ */
const APOSTILAS_DATA = {
  fundamental1: {
    titulo: 'Ensino Fundamental I',
    anos: {
      '1º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Introdução às Letras', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_coletanea_atividades_aluno_1ano.pdf' },
            { titulo: 'Vogais e Consoantes', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_coletanea_atividades_aluno_1ano.pdf' },
            { titulo: 'Primeiras Palavras', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_coletanea_atividades_aluno_1ano.pdf' }
          ],
          'Matemática': [
            { titulo: 'Números de 0 a 10', url: 'https://www.computacao.unitri.edu.br/erac/index.php/erac/article/viewFile/109/75' },
            { titulo: 'Adição Simples', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' },
            { titulo: 'Subtração Básica', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Animais e Plantas', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_coletanea_atividades_aluno_1ano.pdf' },
            { titulo: 'Corpo Humano', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_coletanea_atividades_aluno_1ano.pdf' },
            { titulo: 'Estações do Ano', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_coletanea_atividades_aluno_1ano.pdf' }
          ]
        }
      },
      '2º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Leitura e Escrita', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_2ano_portugues.pdf' },
            { titulo: 'Sílabas e Palavras', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_2ano_portugues.pdf' }
          ],
          'Matemática': [
            { titulo: 'Números até 100', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' },
            { titulo: 'Multiplicação Introdução', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Seres Vivos', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_2ano_ciencias.pdf' }
          ],
          'História': [
            { titulo: 'História da Família', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_2ano_historia.pdf' }
          ]
        }
      },
      '3º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Separação de Sílabas', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_3ano_portugues.pdf' },
            { titulo: 'Pontuação Básica', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_3ano_portugues.pdf' }
          ],
          'Matemática': [
            { titulo: 'Multiplicação', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' },
            { titulo: 'Divisão Simples', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Habitat e Nicho', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_3ano_ciencias.pdf' }
          ],
          'Geografia': [
            { titulo: 'Mapa do Brasil', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_3ano_geografia.pdf' }
          ]
        }
      },
      '4º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Análise de Textos', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_4ano_portugues.pdf' },
            { titulo: 'Concordância Verbal', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_4ano_portugues.pdf' }
          ],
          'Matemática': [
            { titulo: 'Frações Básicas', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' },
            { titulo: 'Números Decimais', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Sistema Solar', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_4ano_ciencias.pdf' }
          ],
          'Geografia': [
            { titulo: 'Regiões do Brasil', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_4ano_geografia.pdf' }
          ]
        }
      },
      '5º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Gêneros Textuais', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_5ano_portugues.pdf' },
            { titulo: 'Interpretação de Textos', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_5ano_portugues.pdf' }
          ],
          'Matemática': [
            { titulo: 'Operações com Decimais', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' },
            { titulo: 'Geometria Básica', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Mudanças Climáticas', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_5ano_ciencias.pdf' }
          ],
          'Geografia': [
            { titulo: 'Continentes e Oceanos', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_5ano_geografia.pdf' }
          ]
        }
      }
    }
  },
  fundamental2: {
    titulo: 'Ensino Fundamental II',
    anos: {
      '6º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Morfologia: Classes de Palavras', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_6ano_portugues.pdf' }
          ],
          'Matemática': [
            { titulo: 'Potenciação e Radiciação', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' },
            { titulo: 'Raiz Quadrada', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Célula e Vida', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_6ano_ciencias.pdf' }
          ],
          'História': [
            { titulo: 'Pré-História Brasileira', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_6ano_historia.pdf' }
          ],
          'Geografia': [
            { titulo: 'Cartografia', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_6ano_geografia.pdf' }
          ],
          'Inglês': [
            { titulo: 'Present Simple', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_6ano_ingles.pdf' }
          ]
        }
      },
      '7º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Sintaxe da Oração', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_7ano_portugues.pdf' }
          ],
          'Matemática': [
            { titulo: 'Expressões Algébricas', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Sistema Nervoso', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_7ano_ciencias.pdf' }
          ],
          'História': [
            { titulo: 'Brasil Colonial', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_7ano_historia.pdf' }
          ],
          'Geografia': [
            { titulo: 'Clima e Vegetação', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_7ano_geografia.pdf' }
          ],
          'Inglês': [
            { titulo: 'Present Continuous', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_7ano_ingles.pdf' }
          ]
        }
      },
      '8º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Análise Sintática Completa', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_8ano_portugues.pdf' }
          ],
          'Matemática': [
            { titulo: 'Equações do 1º Grau', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Reprodução Humana', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_8ano_ciencias.pdf' }
          ],
          'História': [
            { titulo: 'Independência do Brasil', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_8ano_historia.pdf' }
          ],
          'Geografia': [
            { titulo: 'População Brasileira', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_8ano_geografia.pdf' }
          ],
          'Inglês': [
            { titulo: 'Simple Past', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_8ano_ingles.pdf' }
          ]
        }
      },
      '9º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Período Composto', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_9ano_portugues.pdf' }
          ],
          'Matemática': [
            { titulo: 'Equações do 2º Grau', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Ciências': [
            { titulo: 'Evolução e Seleção Natural', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_9ano_ciencias.pdf' }
          ],
          'História': [
            { titulo: 'República Velha', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_9ano_historia.pdf' }
          ],
          'Geografia': [
            { titulo: 'Economia Brasileira', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_9ano_geografia.pdf' }
          ],
          'Inglês': [
            { titulo: 'Present Perfect', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_9ano_ingles.pdf' }
          ]
        }
      }
    }
  },
  medio: {
    titulo: 'Ensino Médio',
    anos: {
      '1º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Literatura Portuguesa', url: 'https://educapes.capes.gov.br/bitstream/capes/560994/2/Apostila%20Literatura%20-%20Produto%20Educacional.pdf' }
          ],
          'Matemática': [
            { titulo: 'Funções Quadráticas', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Química': [
            { titulo: 'Química Geral e Inorgânica', url: 'https://educapes.capes.gov.br/bitstream/capes/205370/4/APOSTILA_QUIMICA_GERAL_E_INORGANICA.pdf' }
          ],
          'Física': [
            { titulo: 'Mecânica e Cinemática', url: 'https://educapes.capes.gov.br/bitstream/capes/178953/2/Produto_Educacional_Apostila_de_Fisica.pdf' }
          ],
          'Biologia': [
            { titulo: 'Citologia e Genética Básica', url: 'https://educapes.capes.gov.br/bitstream/capes/174064/4/PPT_Biologia%20Modular.pdf' }
          ],
          'História': [
            { titulo: 'Idade Moderna', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2020-06/historia_em_1_ano_apostila.pdf' }
          ],
          'Geografia': [
            { titulo: 'Geopolítica Mundial', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2020-06/geografia_em_1_ano_apostila.pdf' }
          ],
          'Inglês': [
            { titulo: 'Future Tense', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_9ano_ingles.pdf' }
          ]
        }
      },
      '2º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Literatura Brasileira Colonial', url: 'https://educapes.capes.gov.br/bitstream/capes/560994/2/Apostila%20Literatura%20-%20Produto%20Educacional.pdf' }
          ],
          'Matemática': [
            { titulo: 'Trigonometria', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Química': [
            { titulo: 'Química Orgânica', url: 'https://educapes.capes.gov.br/bitstream/capes/205370/4/APOSTILA_QUIMICA_GERAL_E_INORGANICA.pdf' }
          ],
          'Física': [
            { titulo: 'Termodinâmica e Ondas', url: 'https://educapes.capes.gov.br/bitstream/capes/178953/2/Produto_Educacional_Apostila_de_Fisica.pdf' }
          ],
          'Biologia': [
            { titulo: 'Ecologia e Evolução', url: 'https://educapes.capes.gov.br/bitstream/capes/174064/4/PPT_Biologia%20Modular.pdf' }
          ],
          'História': [
            { titulo: 'Iluminismo e Revoluções', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2020-06/historia_em_2_ano_apostila.pdf' }
          ],
          'Geografia': [
            { titulo: 'Sustentabilidade Global', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2020-06/geografia_em_2_ano_apostila.pdf' }
          ],
          'Inglês': [
            { titulo: 'Conditional Structures', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_9ano_ingles.pdf' }
          ]
        }
      },
      '3º ano': {
        disciplinas: {
          'Português': [
            { titulo: 'Literatura Moderna e ENEM', url: 'https://educapes.capes.gov.br/bitstream/capes/560994/2/Apostila%20Literatura%20-%20Produto%20Educacional.pdf' }
          ],
          'Matemática': [
            { titulo: 'Geometria Analítica e ENEM', url: 'https://educapes.capes.gov.br/bitstream/capes/431195/2/Produto%20Educacional%20-%20Apostila%20de%20Matem%C3%A1tica%20I.pdf' }
          ],
          'Química': [
            { titulo: 'Química para o ENEM', url: 'https://educapes.capes.gov.br/bitstream/capes/205370/4/APOSTILA_QUIMICA_GERAL_E_INORGANICA.pdf' }
          ],
          'Física': [
            { titulo: 'Eletromagnetismo', url: 'https://educapes.capes.gov.br/bitstream/capes/178953/2/Produto_Educacional_Apostila_de_Fisica.pdf' }
          ],
          'Biologia': [
            { titulo: 'Biologia Molecular e Genética', url: 'https://educapes.capes.gov.br/bitstream/capes/174064/4/PPT_Biologia%20Modular.pdf' }
          ],
          'História': [
            { titulo: 'História Contemporânea', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2020-06/historia_em_3_ano_apostila.pdf' }
          ],
          'Geografia': [
            { titulo: 'Brasil no Século XXI', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2020-06/geografia_em_3_ano_apostila.pdf' }
          ],
          'Inglês': [
            { titulo: 'Advanced Reading & ENEM', url: 'https://www.educacao.pr.gov.br/sites/default/arquivos_restritos/files/documento/2021-02/educa_juntos_atividades_9ano_ingles.pdf' }
          ]
        }
      }
    }
  }
};

const ICONES_DISCIPLINAS = {
  'Português': '📝', 'Matemática': '🔢', 'Ciências': '🔬',
  'Química': '⚗️', 'Física': '⚡', 'Biologia': '🧬',
  'História': '📖', 'Geografia': '🌍', 'Inglês': '🌐',
  'Arte': '🎨', 'Educação Física': '⚽'
};

/* ════════════════════════════════════════
   ESTADO
════════════════════════════════════════ */
let apostilasConcluidas = new Set();
let nivelAtual = 'fundamental1';
let niveisConstruidos = {};

/* ════════════════════════════════════════
   INIT
════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', () => {
    // Foto preview
    document.getElementById('inputFoto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = ev => {
                document.getElementById('preview').src = ev.target.result;
                document.getElementById('preview-hero').src = ev.target.result;
            };
            reader.readAsDataURL(file);
        }
        document.getElementById('erroFoto').innerText = '';
    });

    // Modal senha - código
    const msCodigoInputs = document.querySelectorAll('.ms-codigo-input');
    msCodigoInputs.forEach((input, i) => {
        input.addEventListener('input', () => {
            if (input.value.length === 1 && i < 5) msCodigoInputs[i + 1].focus();
        });
        input.addEventListener('keydown', e => {
            if (e.key === 'Backspace' && !input.value && i > 0) msCodigoInputs[i - 1].focus();
        });
    });

    // Modal senha - validações
    document.getElementById('ms-nova-senha').addEventListener('input', function() {
        const v = this.value;
        const set = (id, ok) => {
            const el = document.getElementById(id);
            el.className = ok ? 'ok' : '';
            el.textContent = (ok ? '✅ ' : '❌ ') + el.textContent.slice(2);
        };
        set('ms-r-length', v.length >= 8);
        set('ms-r-upper', /[A-Z]/.test(v));
        set('ms-r-lower', /[a-z]/.test(v));
        set('ms-r-number', /[0-9]/.test(v));
        set('ms-r-special', /[^A-Za-z0-9]/.test(v));
    });

    // Fechar modal PDF clicando fora
    document.getElementById('modalPdf').addEventListener('click', function(e) {
        if (e.target === this) fecharModalPdf();
    });

    // Carregar progresso e renderizar primeira aba de apostilas
    carregarProgresso();
});

/* ════════════════════════════════════════
   ABAS
════════════════════════════════════════ */
function irParaAba(aba) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('ativo'));
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('ativo'));
    document.getElementById('tab-' + aba).classList.add('ativo');
    document.getElementById('panel-' + aba).classList.add('ativo');

    if (aba === 'apostilas' && !niveisConstruidos[nivelAtual]) {
        construirNivel(nivelAtual);
    }
}

/* ════════════════════════════════════════
   APOSTILAS — NAVEGAÇÃO DE NÍVEL
════════════════════════════════════════ */
function selecionarNivel(nivel, btn) {
    document.querySelectorAll('.nivel-tab-btn').forEach(b => b.classList.remove('ativo'));
    btn.classList.add('ativo');
    nivelAtual = nivel;

    document.querySelectorAll('.nivel-panel').forEach(p => p.classList.remove('ativo'));
    document.getElementById('nivel-' + nivel).classList.add('ativo');

    if (!niveisConstruidos[nivel]) {
        construirNivel(nivel);
    }
}

/* ════════════════════════════════════════
   CONSTRUIR NÍVEL (HTML dinâmico)
════════════════════════════════════════ */
function construirNivel(nivel) {
    const container = document.getElementById('nivel-' + nivel);
    const data = APOSTILAS_DATA[nivel];
    if (!data) return;

    let html = '';
    for (const [anoNome, anoData] of Object.entries(data.anos)) {
        const anoSlug = slugify(nivel + '_' + anoNome);
        const { total, concluidas } = contarProgresso(nivel, anoNome, anoData.disciplinas);
        const pct = total > 0 ? Math.round((concluidas / total) * 100) : 0;
        const completo = pct === 100;

        html += `
        <div class="series-wrapper" data-nivel="${nivel}" data-ano="${anoNome}">
            <div class="serie-header" onclick="toggleSerie(this)" id="serie-header-${anoSlug}">
                <div class="serie-title">
                    <span>📅</span> ${anoNome}
                </div>
                <div style="display:flex;align-items:center;gap:12px;">
                    <span class="serie-progress-info" id="progress-info-${anoSlug}">
                        ${concluidas} de ${total} apostilas concluídas (${pct}%)
                    </span>
                    <i class="fas fa-chevron-down serie-chevron"></i>
                </div>
            </div>
            <div class="progress-bar-wrap" id="progress-wrap-${anoSlug}">
                <div class="progress-label">
                    <span>Progresso do ${anoNome}</span>
                    <span id="progress-pct-${anoSlug}">${pct}%</span>
                </div>
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill ${completo ? 'completo' : ''}" id="progress-bar-${anoSlug}" style="width:${pct}%"></div>
                </div>
            </div>
            <div class="serie-body" id="serie-body-${anoSlug}">
                ${construirDisciplinas(nivel, anoNome, anoData.disciplinas)}
            </div>
        </div>`;
    }

    container.innerHTML = html;
    niveisConstruidos[nivel] = true;
}

function construirDisciplinas(nivel, anoNome, disciplinas) {
    let html = '';
    for (const [materia, apostilas] of Object.entries(disciplinas)) {
        const icone = ICONES_DISCIPLINAS[materia] || '📚';
        html += `
        <div class="materia-section">
            <div class="materia-header">
                <div class="materia-icon">${icone}</div>
                ${materia}
            </div>
            <div class="apostilas-grid">
                ${apostilas.map(ap => construirCardApostila(nivel, anoNome, materia, ap)).join('')}
            </div>
        </div>`;
    }
    return html;
}

function construirCardApostila(nivel, anoNome, materia, ap) {
    const id = gerarApostilaId(nivel, anoNome, materia, ap.titulo);
    const concluida = apostilasConcluidas.has(id);
    const icone = ICONES_DISCIPLINAS[materia] || '📚';
    const safeTitulo = ap.titulo.replace(/'/g, "\\'");
    const safeUrl = ap.url.replace(/'/g, "\\'");

    return `
    <div class="apostila-card ${concluida ? 'concluida' : ''}" id="card-${id}">
        <div class="apostila-card-top">
            <div class="apostila-card-icon">${icone}</div>
            <div class="apostila-card-info">
                <div class="apostila-card-title">${ap.titulo}</div>
                <div class="apostila-card-meta">${materia} · ${anoNome}</div>
            </div>
            <i class="fas fa-check-circle apostila-check"></i>
        </div>
        <div class="apostila-card-btns">
            <button class="btn-ap btn-ap-visualizar" onclick="abrirPdfPerfil('${safeUrl}')">
                <i class="fas fa-eye"></i> Visualizar
            </button>
            <a class="btn-ap btn-ap-download" href="${ap.url}" download="${safeTitulo}">
                <i class="fas fa-download"></i> Download
            </a>
            <button class="btn-ap btn-ap-concluir ${concluida ? 'concluido' : ''}"
                    id="btn-concluir-${id}"
                    onclick="toggleConcluido('${id}', '${nivel}', '${anoNome}')">
                ${concluida ? '<i class="fas fa-check-circle"></i> Concluído ✔' : '<i class="far fa-circle"></i> Marcar como concluído'}
            </button>
        </div>
    </div>`;
}

/* ════════════════════════════════════════
   ACCORDION DAS SÉRIES
════════════════════════════════════════ */
function toggleSerie(header) {
    const anoSlug = header.id.replace('serie-header-', '');
    const body = document.getElementById('serie-body-' + anoSlug);
    const isOpen = header.classList.contains('open');

    header.classList.toggle('open', !isOpen);
    body.classList.toggle('open', !isOpen);
}

/* ════════════════════════════════════════
   PROGRESSO
════════════════════════════════════════ */
async function carregarProgresso() {
    try {
        const res  = await fetch('/PerifaEdu/PerifaEdu/pages/api_progresso.php');
        const data = await res.json();
        if (data.sucesso && Array.isArray(data.concluidas)) {
            apostilasConcluidas = new Set(data.concluidas);
        }
    } catch(e) {
        console.warn('Não foi possível carregar progresso:', e);
    }
    // Constrói nível inicial após carregar progresso
    construirNivel('fundamental1');
}

async function toggleConcluido(apostilaId, nivel, anoNome) {
    const btn  = document.getElementById('btn-concluir-' + apostilaId);
    const card = document.getElementById('card-' + apostilaId);
    if (!btn || btn.dataset.loading === '1') return;

    const jaConcluida = apostilasConcluidas.has(apostilaId);
    const acao = jaConcluida ? 'desmarcar' : 'marcar';

    // Feedback imediato
    btn.dataset.loading = '1';
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

    try {
        const body = new URLSearchParams({ acao, apostila_id: apostilaId });
        const res = await fetch('/PerifaEdu/PerifaEdu/pages/api_progresso.php', {
            method: 'POST', body
        });
        const data = await res.json();

        if (data.sucesso) {
            if (acao === 'marcar') {
                apostilasConcluidas.add(apostilaId);
                card.classList.add('concluida');
                btn.classList.add('concluido');
                btn.innerHTML = '<i class="fas fa-check-circle"></i> Concluído ✔';
                mostrarToast('Apostila marcada como concluída! 🎉');
            } else {
                apostilasConcluidas.delete(apostilaId);
                card.classList.remove('concluida');
                btn.classList.remove('concluido');
                btn.innerHTML = '<i class="far fa-circle"></i> Marcar como concluído';
                mostrarToast('Apostila desmarcada.');
            }
            atualizarProgressoSerie(nivel, anoNome);
        } else {
            // Restaura estado anterior
            btn.innerHTML = jaConcluida
                ? '<i class="fas fa-check-circle"></i> Concluído ✔'
                : '<i class="far fa-circle"></i> Marcar como concluído';
        }
    } catch(e) {
        btn.innerHTML = jaConcluida
            ? '<i class="fas fa-check-circle"></i> Concluído ✔'
            : '<i class="far fa-circle"></i> Marcar como concluído';
        console.error(e);
    } finally {
        btn.dataset.loading = '0';
    }
}

function atualizarProgressoSerie(nivel, anoNome) {
    const data = APOSTILAS_DATA[nivel];
    if (!data || !data.anos[anoNome]) return;

    const anoSlug = slugify(nivel + '_' + anoNome);
    const { total, concluidas } = contarProgresso(nivel, anoNome, data.anos[anoNome].disciplinas);
    const pct = total > 0 ? Math.round((concluidas / total) * 100) : 0;
    const completo = pct === 100;

    const infoEl = document.getElementById('progress-info-' + anoSlug);
    const pctEl  = document.getElementById('progress-pct-' + anoSlug);
    const barEl  = document.getElementById('progress-bar-' + anoSlug);

    if (infoEl) infoEl.textContent = `${concluidas} de ${total} apostilas concluídas (${pct}%)`;
    if (pctEl)  pctEl.textContent  = pct + '%';
    if (barEl) {
        barEl.style.width = pct + '%';
        barEl.className = 'progress-bar-fill' + (completo ? ' completo' : '');
    }
}

function contarProgresso(nivel, anoNome, disciplinas) {
    let total = 0, concluidas = 0;
    for (const [materia, apostilas] of Object.entries(disciplinas)) {
        for (const ap of apostilas) {
            total++;
            if (apostilasConcluidas.has(gerarApostilaId(nivel, anoNome, materia, ap.titulo))) {
                concluidas++;
            }
        }
    }
    return { total, concluidas };
}

/* ════════════════════════════════════════
   HELPERS
════════════════════════════════════════ */
function gerarApostilaId(nivel, anoNome, materia, titulo) {
    return slugify(nivel + '_' + anoNome + '_' + materia + '_' + titulo);
}

function slugify(str) {
    return str.toLowerCase()
        .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
        .replace(/[^a-z0-9]+/g, '_')
        .replace(/^_|_$/g, '');
}

function abrirPdfPerfil(url) {
    document.getElementById('perfil-pdf-iframe').src = url;
    document.getElementById('modalPdf').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function fecharModalPdf() {
    document.getElementById('modalPdf').classList.remove('open');
    document.getElementById('perfil-pdf-iframe').src = '';
    document.body.style.overflow = '';
}

let toastTimer;
function mostrarToast(msg) {
    const toast = document.getElementById('toast');
    document.getElementById('toast-msg').textContent = msg;
    toast.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => toast.classList.remove('show'), 3500);
}

/* ════════════════════════════════════════
   MODAL SENHA (herdado)
════════════════════════════════════════ */
let msEmailUsuario = '';

function abrirModalSenha() {
    document.getElementById('modalSenha').classList.add('aberto');
    msReset();
}
function fecharModalSenha() {
    document.getElementById('modalSenha').classList.remove('aberto');
}
document.getElementById('modalSenha').addEventListener('click', e => {
    if (e.target === document.getElementById('modalSenha')) fecharModalSenha();
});

function msReset() {
    msEmailUsuario = '';
    document.querySelectorAll('#modalSenha .step').forEach(s => s.classList.remove('ativo'));
    document.getElementById('ms-step-email').classList.add('ativo');
    document.getElementById('ms-email').value = '';
    document.getElementById('ms-nova-senha').value = '';
    document.getElementById('ms-confirmar-senha').value = '';
    document.querySelectorAll('.ms-codigo-input').forEach(i => i.value = '');
    ['ms-erro-email','ms-msg-email','ms-msg-codigo','ms-erro-confirmar','ms-msg-senha']
        .forEach(id => { const el = document.getElementById(id); if (el) el.innerText = ''; });
}
function msIrPara(stepId) {
    document.querySelectorAll('#modalSenha .step').forEach(s => s.classList.remove('ativo'));
    document.getElementById(stepId).classList.add('ativo');
}

function msEnviarEmail() {
    const emailInput = document.getElementById('ms-email');
    const email      = emailInput.value.trim();
    const erroEl     = document.getElementById('ms-erro-email');
    const msgEl      = document.getElementById('ms-msg-email');
    erroEl.innerText = ''; msgEl.innerText = '';

    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        erroEl.innerText = 'Digite um e-mail válido.'; return;
    }
    msEmailUsuario = email;
    msgEl.className = 'msg-modal';
    msgEl.innerText = 'Enviando...';

    fetch('/PerifaEdu/PerifaEdu/recuperar/enviar_codigo.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'email=' + encodeURIComponent(email)
    })
    .then(r => r.text())
    .then(res => {
        res = res.trim();
        const partes = res.split('|');
        if (partes[0] === 'ok') {
            msgEl.classList.add('sucesso');
            msgEl.innerText = '✔ Código enviado para ' + partes[1];
            setTimeout(() => msIrPara('ms-step-codigo'), 1500);
        } else {
            msgEl.className = 'msg-modal';
            erroEl.innerText = res;
        }
    })
    .catch(() => { erroEl.innerText = 'Erro de conexão.'; });
}

function msVerificarCodigo() {
    let codigo = '';
    document.querySelectorAll('.ms-codigo-input').forEach(i => codigo += i.value);
    const msgEl = document.getElementById('ms-msg-codigo');
    msgEl.className = 'msg-modal'; msgEl.innerText = 'Verificando...';

    fetch('/PerifaEdu/PerifaEdu/recuperar/verificar_codigo.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'codigo=' + codigo + '&email=' + encodeURIComponent(msEmailUsuario) + '&tipo=recuperar'
    })
    .then(r => r.text())
    .then(res => {
        res = res.trim();
        if (res === 'ok') {
            msgEl.classList.add('sucesso'); msgEl.innerText = '✔ Código correto!';
            setTimeout(() => msIrPara('ms-step-senha'), 1000);
        } else {
            msgEl.classList.add('erro'); msgEl.innerText = '❌ ' + res;
        }
    });
}

function msConfirmarSenha() {
    const senha     = document.getElementById('ms-nova-senha').value;
    const confirmar = document.getElementById('ms-confirmar-senha').value;
    const erroEl    = document.getElementById('ms-erro-confirmar');
    const msgEl     = document.getElementById('ms-msg-senha');
    erroEl.innerText = ''; msgEl.innerText = '';

    if (senha !== confirmar) { erroEl.innerText = '❌ As senhas não coincidem.'; return; }

    fetch('/PerifaEdu/PerifaEdu/recuperar/atualizar_senha.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'senha=' + encodeURIComponent(senha) + '&confirmar=' + encodeURIComponent(confirmar) + '&email=' + encodeURIComponent(msEmailUsuario)
    })
    .then(r => r.text())
    .then(res => {
        if (res.trim() === 'ok') {
            msgEl.className = 'msg-modal sucesso';
            msgEl.innerText = '✔ Senha alterada com sucesso!';
            setTimeout(() => fecharModalSenha(), 2000);
        } else {
            erroEl.innerText = '❌ ' + res.trim();
        }
    });
}
</script>

<?php require_once "./footer.php"; ?>
</body>
</html>