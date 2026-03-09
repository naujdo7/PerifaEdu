function abrirPopup(tipo) {
  document.getElementById('popup-' + tipo).style.display = 'flex';
}

function fecharPopup(tipo) {
  document.getElementById('popup-' + tipo).style.display = 'none';
}

function trocarPopup(atual, proximo) {
  fecharPopup(atual);
  abrirPopup(proximo);
}