const profileIcon = document.getElementById('profile-icon');
const profileOptions = document.getElementById('profile-options');
const loginText = document.getElementById('login-text');
const registerText = document.getElementById('register-text');

// Mostra ou esconde o texto ao clicar na imagem
profileIcon.addEventListener('click', (e) => {
  e.stopPropagation(); // evita que o clique feche instantaneamente
  profileOptions.style.display =
    profileOptions.style.display === 'block' ? 'none' : 'block';
});

// Fecha se clicar fora
document.addEventListener('click', (e) => {
  if (!profileOptions.contains(e.target) && e.target !== profileIcon) {
    profileOptions.style.display = 'none';
  }
});

// Ações de clique
loginText.addEventListener('click', () => {
  profileOptions.style.display = 'none';
  document.getElementById('popup-login').style.display = 'flex';
});

registerText.addEventListener('click', () => {
  profileOptions.style.display = 'none';
  document.getElementById('popup-cadastro').style.display = 'flex';
});
