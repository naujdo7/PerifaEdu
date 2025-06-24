// Animação para botão
function Pulso() {
 
    const pulso = document.getElementById("baixar-app");
 
    pulso.addEventListener("click", () => {
        pulso.classList.add("pulsar");  
 
        pulso.addEventListener("animationend", () => {
            pulso.classList.remove("pulsar");
        });
    });
}
Pulso();