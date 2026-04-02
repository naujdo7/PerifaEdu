function toggleChat(){
    let chat = document.getElementById("chat-container");
    chat.style.display = chat.style.display === "none" ? "flex" : "none";
}

function enviar(){

    let input = document.getElementById("msg");
    let texto = input.value;

    if(!texto) return;

    let chat = document.getElementById("chat-box");

    chat.innerHTML += `<div class="msg-user">${texto}</div>`;

    let typing = document.createElement("div");
    typing.className = "msg-bot";
    typing.innerText = "Digitando...";
    chat.appendChild(typing);

    chat.scrollTop = chat.scrollHeight;

    fetch("pages/chat.php",{
        method:"POST",
        headers:{
            "Content-Type":"application/x-www-form-urlencoded"
        },
        body:"msg=" + encodeURIComponent(texto)
    })
    .then(res => res.text())
    .then(res => {

        setTimeout(() => {
            typing.remove();
            chat.innerHTML += `<div class="msg-bot">${res}</div>`;
            chat.scrollTop = chat.scrollHeight;
        }, 800);

    });

    input.value = "";
}