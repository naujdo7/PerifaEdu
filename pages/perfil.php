<?php
session_start();
require __DIR__ . '/../config/conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /PerifaEdu/PerifaEdu/index.php");
    exit();
}

$idUsuario = $_SESSION['usuario_id'];
$stmt = $conn->prepare("SELECT nome_completo, fotoPerfil FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

$foto = !empty($usuario['fotoPerfil'])
    ? "/PerifaEdu/PerifaEdu/" . $usuario['fotoPerfil']
    : "/PerifaEdu/PerifaEdu/img/perfil.png";

$erro = $_GET['erro'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - PerifaEdu</title>
    <link rel="icon" href="/PerifaEdu/PerifaEdu/img/PerifaEdu-site.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ===== RESET & BASE ===== */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Montserrat', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #012E71 0%, #023982 60%, #035aa8 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Fundo decorativo */
        body::before {
            content: '';
            position: fixed;
            top: -200px; right: -200px;
            width: 600px; height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(24,142,248,0.15) 0%, transparent 70%);
            pointer-events: none;
        }
        body::after {
            content: '';
            position: fixed;
            bottom: -150px; left: -150px;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(24,142,248,0.1) 0%, transparent 70%);
            pointer-events: none;
        }

        /* ===== BOTÃO VOLTAR ===== */
        .btn-voltar {
            position: fixed;
            top: 24px;
            left: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.1);
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s ease;
            z-index: 100;
        }
        .btn-voltar:hover {
            background: rgba(24,142,248,0.35);
            border-color: #188EF8;
            transform: translateX(-3px);
        }
        .btn-voltar i { font-size: 15px; }

        /* ===== CARD PRINCIPAL ===== */
        .card-perfil {
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 24px;
            padding: 50px 40px 40px;
            width: 100%;
            max-width: 480px;
            text-align: center;
            box-shadow: 0 25px 60px rgba(0,0,0,0.25);
            animation: fadeUp 0.5s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ===== SAUDAÇÃO ===== */
        .saudacao {
            color: rgba(255,255,255,0.6);
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .nome-usuario {
            color: #fff;
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 32px;
            line-height: 1.3;
        }
        .nome-usuario span {
            color: #188EF8;
        }

        /* ===== FOTO DE PERFIL ===== */
        .foto-wrapper {
            position: relative;
            width: 140px;
            height: 140px;
            margin: 0 auto 28px;
        }
        .foto-wrapper img {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #188EF8;
            box-shadow: 0 0 0 4px rgba(24,142,248,0.2), 0 8px 30px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
            display: block;
        }
        .foto-wrapper:hover img {
            box-shadow: 0 0 0 6px rgba(24,142,248,0.35), 0 12px 36px rgba(0,0,0,0.35);
        }

        /* ===== BOTÕES DE AÇÃO ===== */
        .acoes {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 8px;
        }

        .btn {
            width: 100%;
            padding: 13px 20px;
            border-radius: 12px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.4px;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        /* Primário - azul sólido */
        .btn-primary {
            background: linear-gradient(135deg, #188EF8 0%, #0d73d6 100%);
            color: white;
            box-shadow: 0 4px 18px rgba(24,142,248,0.35);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(24,142,248,0.5);
        }

        /* Secundário - outline */
        .btn-outline {
            background: rgba(255,255,255,0.06);
            color: white;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .btn-outline:hover {
            background: rgba(255,255,255,0.12);
            border-color: rgba(255,255,255,0.4);
            transform: translateY(-2px);
        }

        /* Perigo - vermelho */
        .btn-danger {
            background: rgba(220,53,69,0.12);
            color: #ff6b78;
            border: 1px solid rgba(220,53,69,0.25);
        }
        .btn-danger:hover {
            background: rgba(220,53,69,0.22);
            border-color: rgba(220,53,69,0.5);
            transform: translateY(-2px);
        }

        input[type="file"] { display: none; }

        /* Mensagem de erro */
        .msg-erro {
            color: #ff6b78;
            font-size: 13px;
            margin-top: 4px;
            min-height: 18px;
            font-weight: 600;
        }

        /* Divisor */
        .divisor {
            width: 100%;
            height: 1px;
            background: rgba(255,255,255,0.1);
            margin: 8px 0;
        }

        /* ===== MODAL DE REDEFINIR SENHA ===== */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
            z-index: 999;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.aberto { display: flex; }

        .modal-box {
            background: linear-gradient(135deg, #023982 0%, #012E71 100%);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 20px;
            padding: 40px 36px;
            width: 100%;
            max-width: 420px;
            margin: 20px;
            box-shadow: 0 30px 80px rgba(0,0,0,0.4);
            animation: modalIn 0.35s cubic-bezier(.34,1.56,.64,1) both;
            position: relative;
        }
        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.88) translateY(20px); }
            to   { opacity: 1; transform: scale(1) translateY(0); }
        }

        .modal-box h2 {
            color: white;
            font-size: 18px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 6px;
            letter-spacing: 0.5px;
        }
        .modal-box .modal-sub {
            color: rgba(255,255,255,0.55);
            font-size: 13px;
            text-align: center;
            margin-bottom: 28px;
        }

        .btn-fechar-modal {
            position: absolute;
            top: 16px; right: 20px;
            background: none;
            border: none;
            color: rgba(255,255,255,0.5);
            font-size: 22px;
            cursor: pointer;
            transition: color 0.2s;
            line-height: 1;
        }
        .btn-fechar-modal:hover { color: white; }

        /* Campos do modal */
        .campo-modal {
            margin-bottom: 18px;
            text-align: left;
        }
        .campo-modal label {
            display: block;
            color: rgba(255,255,255,0.75);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .campo-modal input {
            width: 100%;
            padding: 12px 16px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 10px;
            color: white;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
        }
        .campo-modal input::placeholder { color: rgba(255,255,255,0.35); }
        .campo-modal input:focus {
            border-color: #188EF8;
            background: rgba(24,142,248,0.08);
            box-shadow: 0 0 0 3px rgba(24,142,248,0.15);
        }

        /* Regras de senha no modal */
        .regras-senha {
            background: rgba(0,0,0,0.2);
            border-radius: 10px;
            padding: 12px 14px;
            margin-top: 8px;
            margin-bottom: 16px;
        }
        .regras-senha p {
            font-size: 12px;
            color: rgba(255,255,255,0.5);
            margin: 3px 0;
            transition: color 0.2s;
        }
        .regras-senha p.ok { color: #4ade80; }

        .msg-modal {
            text-align: center;
            font-size: 13px;
            font-weight: 600;
            min-height: 18px;
            margin-top: 8px;
        }
        .msg-modal.sucesso { color: #4ade80; }
        .msg-modal.erro    { color: #ff6b78; }

        /* Steps do modal de senha */
        .step { display: none; }
        .step.ativo { display: block; }

        /* Código de verificação no modal */
        .codigo-container {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin: 20px 0;
        }
        .codigo-input {
            width: 44px; height: 52px;
            text-align: center;
            font-size: 22px;
            font-weight: 800;
            background: rgba(255,255,255,0.08);
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 10px;
            color: white;
            outline: none;
            transition: all 0.2s;
            font-family: 'Montserrat', sans-serif;
        }
        .codigo-input:focus {
            border-color: #188EF8;
            background: rgba(24,142,248,0.12);
        }

        /* ===== RESPONSIVO ===== */
        @media (max-width: 520px) {
            .card-perfil { padding: 40px 24px 32px; }
            .nome-usuario { font-size: 18px; }
            .btn-voltar span { display: none; }
            .btn-voltar { padding: 10px 14px; }
        }
    </style>
</head>
<body>

    <!-- Botão voltar -->
    <a href="/PerifaEdu/PerifaEdu/index.php" class="btn-voltar">
        <i class="fas fa-arrow-left"></i>
        <span>Início</span>
    </a>

    <!-- Card de perfil -->
    <div class="card-perfil">

        <!-- Saudação -->
        <p class="saudacao">Olá 👋</p>
        <h1 class="nome-usuario">
            <?php
                $partes = explode(' ', $usuario['nome_completo']);
                $primeiro = $partes[0];
                $restante = implode(' ', array_slice($partes, 1));
                echo htmlspecialchars($primeiro) . ($restante ? ' <span>' . htmlspecialchars($restante) . '</span>' : '');
            ?>
        </h1>

        <!-- Foto -->
        <div class="foto-wrapper">
            <img id="preview" src="<?= $foto ?>" alt="Foto de perfil">
        </div>

        <!-- Formulário de foto -->
        <form id="formFoto" action="upload_foto.php" method="POST" enctype="multipart/form-data">
            <input type="file" id="inputFoto" name="fotoPerfil" accept="image/*">

            <div class="acoes">
                <button type="button" class="btn btn-primary" onclick="document.getElementById('inputFoto').click()">
                    <i class="fas fa-camera"></i>
                    Alterar Foto
                </button>

                <button type="submit" class="btn btn-outline">
                    <i class="fas fa-upload"></i>
                    Salvar Foto
                </button>

                <p class="msg-erro" id="erroFoto">
                    <?= $erro === 'sem_foto' ? 'Você não selecionou nenhuma foto!' : '' ?>
                </p>
            </div>
        </form>

        <div class="divisor"></div>

        <div class="acoes">
            <!-- Trocar senha -->
            <button type="button" class="btn btn-outline" onclick="abrirModalSenha()">
                <i class="fas fa-lock"></i>
                Trocar Senha
            </button>

            <!-- Remover foto -->
            <form action="remover_foto.php" method="POST">
                <button type="submit" class="btn btn-danger" style="width:100%">
                    <i class="fas fa-trash-alt"></i>
                    Remover Foto
                </button>
            </form>
        </div>

    </div><!-- /card-perfil -->


    <!-- ===== MODAL REDEFINIR SENHA ===== -->
    <div class="modal-overlay" id="modalSenha">
        <div class="modal-box">
            <button class="btn-fechar-modal" onclick="fecharModalSenha()">&times;</button>

            <!-- STEP 1: E-mail -->
            <div class="step ativo" id="ms-step-email">
                <h2>TROCAR SENHA</h2>
                <p class="modal-sub">Confirme seu e-mail para continuar.</p>

                <div class="campo-modal">
                    <label>E-mail</label>
                    <input type="email" id="ms-email" placeholder="Insira seu e-mail">
                    <p class="msg-modal erro" id="ms-erro-email"></p>
                </div>

                <button class="btn btn-primary" onclick="msEnviarEmail()">
                    <i class="fas fa-paper-plane"></i>
                    Enviar Código
                </button>
                <p class="msg-modal" id="ms-msg-email"></p>
            </div>

            <!-- STEP 2: Código -->
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

                <button class="btn btn-primary" onclick="msVerificarCodigo()">
                    <i class="fas fa-check"></i>
                    Verificar
                </button>
                <p class="msg-modal" id="ms-msg-codigo"></p>
            </div>

            <!-- STEP 3: Nova senha -->
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

                <button class="btn btn-primary" onclick="msConfirmarSenha()">
                    <i class="fas fa-shield-alt"></i>
                    Confirmar
                </button>
                <p class="msg-modal" id="ms-msg-senha"></p>
            </div>

        </div>
    </div><!-- /modal -->


    <script>
    /* ===== FOTO PREVIEW ===== */
    document.getElementById("inputFoto").addEventListener("change", function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = ev => document.getElementById("preview").src = ev.target.result;
            reader.readAsDataURL(file);
        }
        document.getElementById("erroFoto").innerText = "";
    });

    document.getElementById("formFoto").addEventListener("submit", function(e) {
        const input = document.getElementById("inputFoto");
        if (!input.files || input.files.length === 0) {
            e.preventDefault();
            document.getElementById("erroFoto").innerText = "Você não selecionou nenhuma foto!";
        }
    });

    /* ===== MODAL SENHA ===== */
    let msEmailUsuario = "";

    function abrirModalSenha() {
        document.getElementById("modalSenha").classList.add("aberto");
        msReset();
    }

    function fecharModalSenha() {
        document.getElementById("modalSenha").classList.remove("aberto");
    }

    // Fechar clicando fora
    document.getElementById("modalSenha").addEventListener("click", function(e) {
        if (e.target === this) fecharModalSenha();
    });

    function msReset() {
        msEmailUsuario = "";
        document.querySelectorAll("#modalSenha .step").forEach(s => s.classList.remove("ativo"));
        document.getElementById("ms-step-email").classList.add("ativo");
        document.getElementById("ms-email").value = "";
        document.getElementById("ms-nova-senha").value = "";
        document.getElementById("ms-confirmar-senha").value = "";
        document.querySelectorAll(".ms-codigo-input").forEach(i => i.value = "");
        ["ms-erro-email","ms-msg-email","ms-msg-codigo","ms-erro-confirmar","ms-msg-senha"]
            .forEach(id => document.getElementById(id).innerText = "");
    }

    function msIrPara(stepId) {
        document.querySelectorAll("#modalSenha .step").forEach(s => s.classList.remove("ativo"));
        document.getElementById(stepId).classList.add("ativo");
    }

    /* STEP 1 – Enviar e-mail */
    function msEnviarEmail() {
        const emailInput = document.getElementById("ms-email");
        const email = emailInput.value.trim();
        const erroEl = document.getElementById("ms-erro-email");
        const msgEl  = document.getElementById("ms-msg-email");

        erroEl.innerText = "";
        msgEl.innerText  = "";

        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            erroEl.innerText = "Digite um e-mail válido.";
            return;
        }

        msEmailUsuario = email;
        msgEl.className = "msg-modal";
        msgEl.innerText = "Enviando...";

        fetch("/PerifaEdu/PerifaEdu/recuperar/enviar_codigo.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "email=" + encodeURIComponent(email)
        })
        .then(r => r.text())
        .then(res => {
            res = res.trim();
            const partes = res.split("|");
            if (partes[0] === "ok") {
                msgEl.classList.add("sucesso");
                msgEl.innerText = "✔ Código enviado para " + partes[1];
                setTimeout(() => msIrPara("ms-step-codigo"), 1500);
            } else {
                msgEl.className = "msg-modal";
                erroEl.innerText = res;
            }
        })
        .catch(() => { erroEl.innerText = "Erro de conexão. Tente novamente."; });
    }

    /* STEP 2 – Verificar código */
    const msCodigoInputs = document.querySelectorAll(".ms-codigo-input");
    msCodigoInputs.forEach((input, i) => {
        input.addEventListener("input", function() {
            if (this.value.length === 1 && i < 5) msCodigoInputs[i + 1].focus();
        });
        input.addEventListener("keydown", function(e) {
            if (e.key === "Backspace" && !this.value && i > 0) msCodigoInputs[i - 1].focus();
        });
    });

    function msVerificarCodigo() {
        let codigo = "";
        msCodigoInputs.forEach(i => codigo += i.value);
        const msgEl = document.getElementById("ms-msg-codigo");
        msgEl.className = "msg-modal";
        msgEl.innerText = "Verificando...";

        fetch("/PerifaEdu/PerifaEdu/recuperar/verificar_codigo.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "codigo=" + codigo + "&email=" + encodeURIComponent(msEmailUsuario) + "&tipo=recuperar"
        })
        .then(r => r.text())
        .then(res => {
            res = res.trim();
            if (res === "ok") {
                msgEl.classList.add("sucesso");
                msgEl.innerText = "✔ Código correto!";
                setTimeout(() => msIrPara("ms-step-senha"), 1000);
            } else {
                msgEl.classList.add("erro");
                msgEl.innerText = "❌ " + res;
            }
        });
    }

    /* STEP 3 – Nova senha */
    document.getElementById("ms-nova-senha").addEventListener("input", function() {
        const v = this.value;
        const set = (id, ok) => {
            const el = document.getElementById(id);
            el.className = ok ? "ok" : "";
            el.textContent = (ok ? "✅ " : "❌ ") + el.textContent.slice(2);
        };
        set("ms-r-length",  v.length >= 8);
        set("ms-r-upper",   /[A-Z]/.test(v));
        set("ms-r-lower",   /[a-z]/.test(v));
        set("ms-r-number",  /[0-9]/.test(v));
        set("ms-r-special", /[^A-Za-z0-9]/.test(v));
    });

    function msConfirmarSenha() {
        const senha     = document.getElementById("ms-nova-senha").value;
        const confirmar = document.getElementById("ms-confirmar-senha").value;
        const erroEl    = document.getElementById("ms-erro-confirmar");
        const msgEl     = document.getElementById("ms-msg-senha");

        erroEl.innerText = "";
        msgEl.innerText  = "";

        if (senha !== confirmar) {
            erroEl.innerText = "❌ As senhas não coincidem.";
            return;
        }

        fetch("/PerifaEdu/PerifaEdu/recuperar/atualizar_senha.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "senha=" + encodeURIComponent(senha)
                + "&confirmar=" + encodeURIComponent(confirmar)
                + "&email=" + encodeURIComponent(msEmailUsuario)
        })
        .then(r => r.text())
        .then(res => {
            if (res.trim() === "ok") {
                msgEl.className = "msg-modal sucesso";
                msgEl.innerText = "✔ Senha alterada com sucesso!";
                setTimeout(() => fecharModalSenha(), 2000);
            } else {
                erroEl.innerText = "❌ " + res.trim();
            }
        });
    }
    </script>

</body>
</html>