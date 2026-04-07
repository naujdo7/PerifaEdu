// ──────────────────────────────
// Alterna visibilidade do chat
// ──────────────────────────────
function toggleChat() {
    let chat = document.getElementById("chat-container");
    chat.style.display = chat.style.display === "none" ? "flex" : "none";
}

// ──────────────────────────────
// Envia mensagem do usuário
// ──────────────────────────────
function enviar() {
    let input = document.getElementById("msg");
    let texto = input.value.trim();
    if (!texto) return;

    let chat = document.getElementById("chat-box");

    // 💬 Mensagem do usuário
    chat.innerHTML += `<div class="msg-user">${escapeHTML(texto)}</div>`;

    // ⏳ Mensagem "Digitando..."
    let typing = document.createElement("div");
    typing.className = "msg-bot";
    typing.innerText = "Digitando...";
    chat.appendChild(typing);
    chat.scrollTop = chat.scrollHeight;

    // 🔥 Envio para o PHP
    fetch("/PerifaEdu/PerifaEdu/pages/chat.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ msg: texto })
    })
    .then(res => res.json())
    .then(data => {
        setTimeout(() => {
            typing.remove();
            chat.innerHTML += `<div class="msg-bot">${escapeHTML(data.resposta)}</div>`;
            chat.scrollTop = chat.scrollHeight;
        }, 600 + Math.random() * 400); // tempo de digitação aleatório
    })
    .catch(err => {
        console.error(err);
        typing.remove();
        chat.innerHTML += `<div class="msg-bot">Erro ao conectar 😢</div>`;
        chat.scrollTop = chat.scrollHeight;
    });

    input.value = "";
}

// ──────────────────────────────
// Escapa HTML para evitar scripts ou quebras
// ──────────────────────────────
function escapeHTML(str) {
    return str.replace(/[&<>"']/g, tag => ({
        "&": "&amp;",
        "<": "&lt;",
        ">": "&gt;",
        '"': "&quot;",
        "'": "&#39;"
    }[tag]));
}

// ──────────────────────────────
// Enter envia mensagem
// ──────────────────────────────
document.getElementById("msg").addEventListener("keypress", function(e) {
    if (e.key === "Enter") {
        e.preventDefault();
        enviar();
    }
});

// ──────────────────────────────
// Scroll automático ao abrir chat
// ──────────────────────────────
document.getElementById("chat-container").addEventListener("transitionend", () => {
    let chat = document.getElementById("chat-box");
    chat.scrollTop = chat.scrollHeight;
});