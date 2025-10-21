// Aguarda o DOM carregar
document.addEventListener('DOMContentLoaded', function() {
  // Elementos dos modais
  const loginModal = document.getElementById('login-modal');
  const cadastroModal = document.getElementById('cadastro-modal');
  
  // Botões de abrir/fechar
  const openCadastroBtn = document.getElementById('open-cadastro');
  const openLoginBtn = document.getElementById('open-login');
  const closeBtns = document.querySelectorAll('.close');
  
  // Elemento da bolinha do perfil - CORREÇÃO AQUI
  const perfilBtn = document.querySelector('.perfil');
  
  // Função para abrir modal de login
  function openLoginModal() {
      cadastroModal.style.display = 'none';
      loginModal.style.display = 'block';
  }
  
  // Função para abrir modal de cadastro
  function openCadastroModal() {
      loginModal.style.display = 'none';
      cadastroModal.style.display = 'block';
  }
  
  // Função para fechar modais
  function closeModals() {
      loginModal.style.display = 'none';
      cadastroModal.style.display = 'none';
  }
  
  // Event Listeners
  
  // Abrir login quando clicar na bolinha do perfil - CORREÇÃO AQUI
  if (perfilBtn) {
      perfilBtn.addEventListener('click', function(e) {
          e.preventDefault();
          openLoginModal();
      });
  } else {
      console.log('Elemento do perfil não encontrado');
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
  
  // Prevenir submit dos formulários
  if (document.getElementById('loginForm')) {
      document.getElementById('loginForm').addEventListener('submit', function(e) {
          e.preventDefault();
          // Aqui você adicionaria a lógica de login
          console.log('Tentativa de login');
      });
  }
  
  if (document.getElementById('cadastroForm')) {
      document.getElementById('cadastroForm').addEventListener('submit', function(e) {
          e.preventDefault();
          // Aqui você adicionaria a lógica de cadastro
          console.log('Tentativa de cadastro');
      });
  }
});

// Funções globais para usar em outros lugares
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