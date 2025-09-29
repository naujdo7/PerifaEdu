// pega os elementos
const profileBtn = document.querySelector(".perfil"); // tua bolinha
const modal = document.getElementById("login-modal");
const closeBtn = document.querySelector(".close");

// abrir modal
profileBtn.addEventListener("click", () => {
  modal.style.display = "block";
});

// fechar modal no X
closeBtn.addEventListener("click", () => {
  modal.style.display = "none";
});

// fechar clicando fora
window.addEventListener("click", (e) => {
  if (e.target === modal) {
    modal.style.display = "none";
  }
});
