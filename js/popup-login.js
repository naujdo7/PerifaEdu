// Aguarda o DOM carregar
document.addEventListener('DOMContentLoaded', function() {
    // Elementos dos modais
    const loginModal = document.getElementById('login-modal');
    const cadastroModal = document.getElementById('cadastro-modal');
    
    // Botões de abrir/fechar
    const openCadastroBtn = document.getElementById('open-cadastro');
    const openLoginBtn = document.getElementById('open-login');
    const closeBtns = document.querySelectorAll('.close');
    
    // Elemento da bolinha do perfil
    const perfilBtn = document.querySelector('.perfil'); // Confirme se a classe é essa mesma (.perfil) ou mude aqui
    
    // =========================================================
    // NOVA LÓGICA: VERIFICAR SE ESTÁ LOGADO (Menu Restrito)
    // =========================================================
    const usuarioLogado = localStorage.getItem('perifaEduLogado') === 'true';
    const itensRestritos = document.querySelectorAll('.menu-restrito');

    if (usuarioLogado) {
        // Se estiver logado, nós removemos a classe que esconde o menu!
        itensRestritos.forEach(item => {
            item.classList.remove('menu-restrito'); 
        });
    }

    // Função para abrir modal de login
    function openLoginModal() {
        if(cadastroModal) cadastroModal.style.display = 'none';
        if(loginModal) loginModal.style.display = 'block'; // ou 'flex' dependendo do seu CSS
    }
    
    // Função para abrir modal de cadastro
    function openCadastroModal() {
        if(loginModal) loginModal.style.display = 'none';
        if(cadastroModal) cadastroModal.style.display = 'block'; // ou 'flex' dependendo do seu CSS
    }
    
    // Função para fechar modais
    function closeModals() {
        if(loginModal) loginModal.style.display = 'none';
        if(cadastroModal) cadastroModal.style.display = 'none';
    }

    // =========================================================
    // LÓGICA: Ler URL para abrir login automaticamente
    // =========================================================
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('abrirLogin') === 'true' && loginModal) {
        openLoginModal();
    }
    
    // =========================================================
    // LÓGICA: Clique na bolinha do perfil em qualquer página
    // =========================================================
    const menuPerfil = document.getElementById('menu-perfil');

if (perfilBtn && menuPerfil) {
    perfilBtn.addEventListener('click', function(e) {
        e.preventDefault();

        const usuarioLogado = localStorage.getItem('perifaEduLogado') === 'true';

        if (usuarioLogado) {
            menuPerfil.style.display =
                menuPerfil.style.display === 'flex' ? 'none' : 'flex';
        } else {
            openLoginModal();
        }
    });

const fecharMenu = document.getElementById('fechar-menu');

if (fecharMenu) {
    fecharMenu.addEventListener('click', function(e) {
        e.preventDefault();
        menuPerfil.style.display = 'none';
    });
}

// 🔥 FECHAR CLICANDO FORA
document.addEventListener('click', function (e) {
    if (!menuPerfil.contains(e.target) && e.target !== perfilBtn) {
        menuPerfil.style.display = 'none';
    }
});

    } else {
        console.log('Elemento do perfil não encontrado nesta página.');
    }
    
    // Abrir cadastro a partir do login
    if (openCadastroBtn) {
        openCadastroBtn.addEventListener('click', function(e) {
            e.preventDefault();
            openCadastroModal();
        });
    }
    
    // Abrir login a partir do cadastro
    if (openLoginBtn) {
        openLoginBtn.addEventListener('click', function(e) {
            e.preventDefault();
            openLoginModal();
        });
    }
    
    // Fechar modais com o X
    closeBtns.forEach(btn => {
        btn.addEventListener('click', closeModals);
    });
    
    // Fechar modal clicando fora
    window.addEventListener('click', function(event) {
        if (event.target === loginModal) {
            closeModals();
        }
        if (event.target === cadastroModal) {
            closeModals();
        }
    });
    
    // Fechar com ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModals();
        }
    });
});
// Funções globais para usar em outros lugares (Se precisar chamar direto no HTML)
function openLogin() {
    const loginModal = document.getElementById('login-modal');
    const cadastroModal = document.getElementById('cadastro-modal');
    if (loginModal && cadastroModal) {
        cadastroModal.style.display = 'none';
        loginModal.style.display = 'block';
    }
}

function openCadastro() {
    const loginModal = document.getElementById('login-modal');
    const cadastroModal = document.getElementById('cadastro-modal');
    if (loginModal && cadastroModal) {
        loginModal.style.display = 'none';
        cadastroModal.style.display = 'block';
    }
}

function closeAllModals() {
    const loginModal = document.getElementById('login-modal');
    const cadastroModal = document.getElementById('cadastro-modal');
    if (loginModal) loginModal.style.display = 'none';
    if (cadastroModal) cadastroModal.style.display = 'none';
}

// ESQUECEU A SENHA (1-3)
document.addEventListener("DOMContentLoaded", function() {
    // Pegando os elementos principais
    const linkEsqueceuSenha = document.querySelector('.forgot-password a');
    const loginModal = document.getElementById('login-modal');
    const recuperacaoModal = document.getElementById('recuperacao-modal');
    const closeRecuperacao = document.querySelector('.close-recuperacao');

    // Pegando os passos
    const stepEmail = document.getElementById('step-email');
    const stepCodigo = document.getElementById('step-codigo');
    const stepNovaSenha = document.getElementById('step-nova-senha');

    // Botões
    const btnEnviarEmail = document.getElementById('btn-enviar-email');
    const btnEnviarCodigo = document.getElementById('btn-enviar-codigo');

    // Só executa se os elementos existirem na tela
    if (linkEsqueceuSenha && recuperacaoModal) {
        // 1. Abrir modal de recuperação e fechar o de login
        linkEsqueceuSenha.addEventListener('click', function(e) {
            e.preventDefault();
            loginModal.style.display = 'none'; // Esconde o login
            recuperacaoModal.style.display = 'flex'; // Mostra a recuperação
            
            // Garante que sempre abra no passo 1
            stepEmail.style.display = 'block';
            stepCodigo.style.display = 'none';
            stepNovaSenha.style.display = 'none';
        });

        // Fechar modal no 'X'
        if (closeRecuperacao) {
            closeRecuperacao.addEventListener('click', function() {
                recuperacaoModal.style.display = 'none';
            });
        }

        // 4. Lógica para pular para o próximo quadradinho do código automaticamente
        const codigoInputs = document.querySelectorAll('.codigo-input');
        if (codigoInputs.length > 0) {
            codigoInputs.forEach((input, index) => {
                input.addEventListener('input', function() {
                    // Se o usuário digitou um número, pula para o próximo input
                    if (this.value.length === 1 && index < codigoInputs.length - 1) {
                        codigoInputs[index + 1].focus();
                    }
                });

                // Permite apagar e voltar para o quadradinho anterior com o Backspace
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && this.value === '' && index > 0) {
                        codigoInputs[index - 1].focus();
                    }
                });
            });
        }
    }
});

// ==========================================
// FUNÇÃO GLOBAL DE VALIDAÇÃO DE SENHA
// ==========================================
function toggleRule(id, isValid) {
    const element = document.getElementById(id);
    if (element) {
        if (isValid) {
            element.classList.add("valid");
            // Mantém apenas o texto após o símbolo (se já tiver "✔" ou "❌", não duplica)
            const textContent = element.textContent.replace(/^[✔❌]\s*/, "");
            element.textContent = "✔ " + textContent;
        } else {
            element.classList.remove("valid");
            const textContent = element.textContent.replace(/^[✔❌]\s*/, "");
            element.textContent = "❌ " + textContent;
        }
    }
}

// ==========================================
// VALIDAÇÃO SENHA "REDEFINIR SENHA"
// ==========================================
document.addEventListener("DOMContentLoaded", function() {
    const novaSenhaInput = document.getElementById("nova-senha");

    if (novaSenhaInput) {
        novaSenhaInput.addEventListener("input", function () {
            const value = this.value;

            const rules = {
                length: value.length >= 8,
                upper: /[A-Z]/.test(value),
                lower: /[a-z]/.test(value),
                number: /[0-9]/.test(value),
                special: /[^A-Za-z0-9]/.test(value)
            };

            // Chamando a função para atualizar os IDs específicos da recuperação
            toggleRule("rec-rule-length", rules.length);
            toggleRule("rec-rule-upper", rules.upper);
            toggleRule("rec-rule-lower", rules.lower);
            toggleRule("rec-rule-number", rules.number);
            toggleRule("rec-rule-special", rules.special);
        });
    }
});

// ==========================================
// VALIDAÇÃO SENHA "CADASTRO"
// ==========================================
document.addEventListener("DOMContentLoaded", function() {
    const senhaInput = document.getElementById("cadastro-password");

    if (senhaInput) {
        senhaInput.addEventListener("input", function () {
            const value = this.value;

            const rules = {
                length: value.length >= 8,
                upper: /[A-Z]/.test(value),
                lower: /[a-z]/.test(value),
                number: /[0-9]/.test(value),
                special: /[^A-Za-z0-9]/.test(value)
            };

            toggleRule("rule-length", rules.length);
            toggleRule("rule-upper", rules.upper);
            toggleRule("rule-lower", rules.lower);
            toggleRule("rule-number", rules.number);
            toggleRule("rule-special", rules.special);
        });
    }
});

// =========================================================
    // LÓGICA: BOTÃO DE SAIR (LOGOUT)
    // =========================================================
    const btnLogout = document.getElementById('btn-logout');

if (btnLogout) {
    btnLogout.addEventListener('click', function(e) {
        e.preventDefault();

        // remove login do navegador
        localStorage.removeItem('perifaEduLogado');

        // encerra sessão no PHP
        fetch('/perifaedu/PerifaEdu/pages/logout.php')
            .finally(() => {
                window.location.reload();
            });
    });
}