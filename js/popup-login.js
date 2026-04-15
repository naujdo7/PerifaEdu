// =========================================================
// DETECTA RETORNO DO LOGIN GOOGLE
// =========================================================
(function () {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('loginGoogle') === 'true') {
        localStorage.setItem('perifaEduLogado', 'true');
        window.history.replaceState({}, document.title, window.location.pathname);
    }
})();

// =========================================================
// FUNÇÕES GLOBAIS DE MODAL (disponíveis antes do DOM ready)
// =========================================================
function openLogin() {
    const loginModal    = document.getElementById('login-modal');
    const cadastroModal = document.getElementById('cadastro-modal');
    if (cadastroModal) cadastroModal.style.display = 'none';
    if (loginModal)    loginModal.style.display    = 'flex';
}

function openCadastro() {
    const loginModal    = document.getElementById('login-modal');
    const cadastroModal = document.getElementById('cadastro-modal');
    if (loginModal)    loginModal.style.display    = 'none';
    if (cadastroModal) cadastroModal.style.display = 'flex';
}

function closeAllModals() {
    const loginModal    = document.getElementById('login-modal');
    const cadastroModal = document.getElementById('cadastro-modal');
    const recModal      = document.getElementById('recuperacao-modal');
    if (loginModal)    loginModal.style.display    = 'none';
    if (cadastroModal) cadastroModal.style.display = 'none';
    if (recModal)      recModal.style.display      = 'none';
}

// =========================================================
// LOGOUT CENTRALIZADO
// =========================================================
function fazerLogout() {
    localStorage.removeItem('perifaEduLogado');
    fetch('/PerifaEdu/PerifaEdu/pages/logout.php', { method: 'POST' })
        .finally(function () {
            window.location.href = '/PerifaEdu/PerifaEdu/index.php';
        });
}

// =========================================================
// DOM READY — toda lógica de interação
// =========================================================
document.addEventListener('DOMContentLoaded', function () {

    const loginModal    = document.getElementById('login-modal');
    const cadastroModal = document.getElementById('cadastro-modal');

    // ----------------------------------------------------------
    // VERIFICAR ESTADO DE LOGIN (localStorage sincronizado com PHP
    // pelo snippet inline no header — ver header.php / header1.php)
    // ----------------------------------------------------------
    const usuarioLogado = localStorage.getItem('perifaEduLogado') === 'true';
    const itensRestritos = document.querySelectorAll('.menu-restrito');

    if (usuarioLogado) {
        // Revela itens restritos
        itensRestritos.forEach(function (item) {
            item.classList.remove('menu-restrito');
        });
        // Esconde botão de login do menu mobile
        var btnLoginMobile = document.getElementById('btn-login-mobile');
        if (btnLoginMobile) btnLoginMobile.style.display = 'none';
    } else {
        // Botão ENTRAR do menu mobile → abre modal ou redireciona
        var btnLoginMobile = document.getElementById('btn-login-mobile');
        if (btnLoginMobile) {
            btnLoginMobile.addEventListener('click', function (e) {
                e.preventDefault();
                // Fecha o menu mobile
                var mobileMenu = document.querySelector('.mobile-menu');
                var menuToggle = document.querySelector('.menu-toggle');
                if (mobileMenu) mobileMenu.classList.remove('active');
                if (menuToggle) menuToggle.classList.remove('active');
                document.body.style.overflow = '';
                // Abre modal de login (se existir nesta página) ou redireciona
                if (loginModal) {
                    openLogin();
                } else {
                    window.location.href = '/PerifaEdu/PerifaEdu/index.php?abrirLogin=true';
                }
            });
        }
    }

    // ----------------------------------------------------------
    // ABRE LOGIN SE URL PEDIR (?abrirLogin=true)
    // ----------------------------------------------------------
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('abrirLogin') === 'true' && loginModal && !usuarioLogado) {
        openLogin();
    }

    // ----------------------------------------------------------
    // BOTÃO DE SAIR — mobile menu
    // ----------------------------------------------------------
    var btnSairMobile = document.getElementById('btn-sair-mobile');
    if (btnSairMobile) {
        btnSairMobile.addEventListener('click', function (e) {
            e.preventDefault();
            fazerLogout();
        });
    }

    // ----------------------------------------------------------
    // BOTÃO DE SAIR — desktop dropdown (fallback, caso header não
    // tenha seu próprio listener)
    // ----------------------------------------------------------
    var btnLogout = document.getElementById('btn-logout');
    if (btnLogout && !btnLogout.dataset.listenerSet) {
        btnLogout.dataset.listenerSet = '1';
        btnLogout.addEventListener('click', function (e) {
            e.preventDefault();
            fazerLogout();
        });
    }

    // ----------------------------------------------------------
    // ABRIR/FECHAR MODAIS — botões internos
    // ----------------------------------------------------------
    var openCadastroBtn = document.getElementById('open-cadastro');
    var openLoginBtn    = document.getElementById('open-login');
    var closeBtns       = document.querySelectorAll('.close');

    if (openCadastroBtn) openCadastroBtn.addEventListener('click', function (e) { e.preventDefault(); openCadastro(); });
    if (openLoginBtn)    openLoginBtn.addEventListener('click',    function (e) { e.preventDefault(); openLogin(); });

    closeBtns.forEach(function (btn) {
        btn.addEventListener('click', closeAllModals);
    });

    // Fechar clicando no overlay
    window.addEventListener('click', function (e) {
        if (e.target === loginModal || e.target === cadastroModal) closeAllModals();
    });

    // Fechar com ESC
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeAllModals();
    });

    // ----------------------------------------------------------
    // BOLINHA DO PERFIL (usada por popup-login.js como fallback,
    // mas o handler principal está no header inline)
    // ----------------------------------------------------------
    var perfilBtns = document.querySelectorAll('.perfil');
    var menuPerfil = document.getElementById('menu-perfil');

    if (perfilBtns.length > 0 && menuPerfil) {
        var ultimoPerfilBtn = null;

        perfilBtns.forEach(function (perfilBtn) {
            perfilBtn.addEventListener('click', function (e) {
                e.preventDefault();
                ultimoPerfilBtn = perfilBtn;

                if (localStorage.getItem('perifaEduLogado') === 'true') {
                    menuPerfil.style.display =
                        menuPerfil.style.display === 'flex' ? 'none' : 'flex';
                } else {
                    if (!window.location.pathname.includes('index.php')) {
                        window.location.href = '/PerifaEdu/PerifaEdu/index.php?abrirLogin=true';
                    } else {
                        openLogin();
                    }
                }
            });
        });

        // Fecha ao clicar fora do menu
        document.addEventListener('click', function (e) {
            if (!menuPerfil.contains(e.target) &&
                (!ultimoPerfilBtn || !ultimoPerfilBtn.contains(e.target))) {
                menuPerfil.style.display = 'none';
            }
        });
    }

    // ----------------------------------------------------------
    // ESQUECEU A SENHA
    // ----------------------------------------------------------
    var linkEsqueceuSenha = document.querySelector('.forgot-password a');
    var recuperacaoModal  = document.getElementById('recuperacao-modal');
    var closeRecuperacao  = document.querySelector('.close-recuperacao');

    if (linkEsqueceuSenha && recuperacaoModal) {
        linkEsqueceuSenha.addEventListener('click', function (e) {
            e.preventDefault();
            if (loginModal) loginModal.style.display = 'none';
            recuperacaoModal.style.display = 'flex';

            var stepEmail    = document.getElementById('step-email');
            var stepCodigo   = document.getElementById('step-codigo');
            var stepNovaSenha= document.getElementById('step-nova-senha');
            if (stepEmail)     stepEmail.style.display     = 'block';
            if (stepCodigo)    stepCodigo.style.display    = 'none';
            if (stepNovaSenha) stepNovaSenha.style.display = 'none';
        });
    }

    if (closeRecuperacao) {
        closeRecuperacao.addEventListener('click', function () {
            if (recuperacaoModal) recuperacaoModal.style.display = 'none';
        });
    }

    // Navegação por código (dígitos)
    var codigoInputs = document.querySelectorAll('.codigo-input');
    codigoInputs.forEach(function (input, index) {
        input.addEventListener('input', function () {
            if (this.value.length === 1 && index < codigoInputs.length - 1) {
                codigoInputs[index + 1].focus();
            }
        });
        input.addEventListener('keydown', function (e) {
            if (e.key === 'Backspace' && this.value === '' && index > 0) {
                codigoInputs[index - 1].focus();
            }
        });
    });
});

// =========================================================
// VALIDAÇÃO DE SENHA — funções globais reutilizáveis
// =========================================================
function toggleRule(id, isValid) {
    var el = document.getElementById(id);
    if (!el) return;
    var text = el.textContent.replace(/^[✔❌]\s*/, '');
    el.textContent = (isValid ? '✔ ' : '❌ ') + text;
    if (isValid) el.classList.add('valid');
    else         el.classList.remove('valid');
}

document.addEventListener('DOMContentLoaded', function () {
    // Senha no cadastro
    var senhaInputCad = document.getElementById('cadastro-password');
    if (senhaInputCad) {
        senhaInputCad.addEventListener('input', function () {
            var v = this.value;
            toggleRule('rule-length',  v.length >= 8);
            toggleRule('rule-upper',   /[A-Z]/.test(v));
            toggleRule('rule-lower',   /[a-z]/.test(v));
            toggleRule('rule-number',  /[0-9]/.test(v));
            toggleRule('rule-special', /[^A-Za-z0-9]/.test(v));
        });
    }

    // Senha na recuperação
    var senhaInputRec = document.getElementById('nova-senha');
    if (senhaInputRec) {
        senhaInputRec.addEventListener('input', function () {
            var v = this.value;
            toggleRule('rec-rule-length',  v.length >= 8);
            toggleRule('rec-rule-upper',   /[A-Z]/.test(v));
            toggleRule('rec-rule-lower',   /[a-z]/.test(v));
            toggleRule('rec-rule-number',  /[0-9]/.test(v));
            toggleRule('rec-rule-special', /[^A-Za-z0-9]/.test(v));
        });
    }
});