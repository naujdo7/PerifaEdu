<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PerifaEdu</title>
</head>
<body>
<div id="recuperacao-modal" class="modal" style="display: none;">
        <div class="modal-content-senha">
            <div class="header-login">
                <span class="close-recuperacao close">&times;</span>
                <div class="logo">
                    <img src="./img/PerifaEdu 2.png" alt="Logo PerifaEdu" />
                    <span>PERIFA<span>EDU</span></span>
                </div>
            </div>
    
            <div id="step-email" class="recuperacao-step">
                <h2>RECUPERAÇÃO DE SENHA</h2>
                <p class="subtitle">Digite seu e-mail para poder redefinir sua senha.</p>
                <div class="form-group">
                    <label for="recuperacao-email" class="required">E-MAIL:</label>
                    <input type="email" class="caixa-texto" id="recuperacao-email" placeholder="Insira seu e-mail" required>
                    <p id="erro-email" style="color:red; font-size:14px; padding-top:5px; padding-left:5px;"></p>
                </div>
                <button type="button" class="btn-login" id="btn-enviar-email">ENVIAR</button>
                <p id="msg-email" class="msg-sucesso"></p>
            </div>

            <div id="step-codigo" class="recuperacao-step" style="display: none;">
                <h2>CONFIRMAÇÃO DE E-MAIL</h2>
                <p class="subtitle">Enviamos um código de 6 dígitos para confirmar seu e-mail.<br>Verifique sua caixa de entrada ou spam.</p>
                
                <div class="codigo-container">
                    <input type="text" maxlength="1" class="codigo-input">
                    <input type="text" maxlength="1" class="codigo-input">
                    <input type="text" maxlength="1" class="codigo-input">
                    <input type="text" maxlength="1" class="codigo-input">
                    <input type="text" maxlength="1" class="codigo-input">
                    <input type="text" maxlength="1" class="codigo-input">
                </div>
                <a href="#" class="reenviar-link" id="reenviar-codigo">Não recebeu o código? Clique aqui para reenviar!</a>
                <p id="contador-reenvio" style="font-size:13px;color:gray;"></p>

                <button type="button" class="btn-login" id="btn-enviar-codigo">ENVIAR</button>
            </div>

            <div id="step-nova-senha" class="recuperacao-step" style="display: none;">
                <h2 id="titulo-redefinir-senha">REDEFINIÇÃO DE SENHA</h2>
                <div class="form-group">
                    <label for="nova-senha" class="required">NOVA SENHA:</label>
                    <input type="password" class="caixa-texto" id="nova-senha" placeholder="Digite sua nova senha" required>
                    
                    <div class="password-rules">
                        <p id="rec-rule-length">❌ Mínimo 8 caracteres</p>
                        <p id="rec-rule-upper">❌ Letra maiúscula</p>
                        <p id="rec-rule-lower">❌ Letra minúscula</p>
                        <p id="rec-rule-number">❌ Número</p>
                        <p id="rec-rule-special">❌ Caractere especial</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirmar-senha" class="required">CONFIRMAR SENHA:</label>
                    <input type="password" class="caixa-texto" id="confirmar-senha" placeholder="Digite sua senha igual a anterior" required>
                    <p id="erro-confirmar-senha" class="msg-erro"></p>
                </div>
                <button type="button" class="btn-login" id="btn-confirmar-senha">CONFIRMAR</button>
                <p id="msg-senha" class="msg-sucesso"></p>
            </div>
    
        </div>
    </div>

    <style>
        /* Estilos gerais para os textos dos novos modais */
.modal-content-senha {
    background: white;
    margin: 10% auto;
    width: 600px;
    height: 60%;
    border-radius: 8px;
    text-align: center;
  }
.recuperacao-step h2 {
    text-align: center;
    margin-bottom: 10px;
    padding-top: 120px; 
    font-size: 1.7rem; 
    font-weight: bold;

}

#titulo-redefinir-senha
{
    text-align: center;
    margin-bottom: 10px;
    padding-top: 50px; 
    font-size: 1.5rem; 
    font-weight: bold;

}

.recuperacao-step .subtitle {
    text-align: center;
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 20px;
}

/* Container dos 6 quadradinhos */
.codigo-container {
    display: flex;
    justify-content: center;
    gap: 10px; /* Espaço entre os quadrados */
    margin-bottom: 15px;
}

/* O input individual do código */
.codigo-input {
    width: 11%;
    height: 55px;
    text-align: center;
    font-size: 24px;
    font-weight: bold;
    border: 2px solid #003366; /* Sua cor azul */
    border-radius: 8px;
    background-color: #e0e0e0; /* Fundo cinza claro igual da foto */
    color: #333;
}

/* Tira a borda padrão de foco e coloca uma mais destacada */
.codigo-input:focus {
    outline: none;
    border-color: #00509e;
    background-color: #fff;
}

.reenviar-link {
    display: block;
    text-align: center;
    font-size: 0.85rem;
    color: #00aaff;
    margin-bottom: 20px;
    text-decoration: underline;
}
    </style>

<script>

let email_recuperacao = "";

/* CONTADOR DE REENVIO */

let tempoRestante = 30;
let intervaloContador;

function iniciarContagem(){

const contador = document.getElementById("contador-reenvio");
const botao = document.getElementById("reenviar-codigo");

tempoRestante = 30;

botao.style.pointerEvents = "none";
botao.style.opacity = "0.5";

contador.innerText = "Reenviar código em " + tempoRestante + "s";

intervaloContador = setInterval(()=>{

tempoRestante--;

contador.innerText = "Reenviar código em " + tempoRestante + "s";

if(tempoRestante <= 0){

clearInterval(intervaloContador);

contador.innerText = "";

botao.style.pointerEvents = "auto";
botao.style.opacity = "1";

}

},1000);

}

/* RESETAR MODAL */

function resetarRecuperacao(){

document.getElementById("erro-email").innerText="";
document.getElementById("msg-email").innerText="";
document.getElementById("erro-confirmar-senha").innerText="";
document.getElementById("msg-senha").innerText="";
document.getElementById("contador-reenvio").innerText="";

document.getElementById("recuperacao-email").value="";
document.getElementById("nova-senha").value="";
document.getElementById("confirmar-senha").value="";

document.querySelectorAll(".codigo-input").forEach(input=>{
input.value="";
});

document.getElementById("step-email").style.display="block";
document.getElementById("step-codigo").style.display="none";
document.getElementById("step-nova-senha").style.display="none";

let btn=document.getElementById("btn-enviar-email");
btn.disabled=false;
btn.innerText="ENVIAR";

email_recuperacao="";

}

/* FECHAR MODAL */

document.querySelector(".close-recuperacao").onclick=function(){

document.getElementById("recuperacao-modal").style.display="none";

resetarRecuperacao();

};

/* FECHAR CLICANDO FORA */

window.onclick=function(event){

let modal=document.getElementById("recuperacao-modal");

if(event.target==modal){

modal.style.display="none";

resetarRecuperacao();

}

};

/* ENVIAR EMAIL */

document.getElementById("btn-enviar-email").onclick=function(){

let btn=document.getElementById("btn-enviar-email");

let email=document.getElementById("recuperacao-email").value.trim();

if(email===""){
document.getElementById("erro-email").innerText="Digite um email válido";
return;
}

let regex=/^[^\s@]+@[^\s@]+\.[^\s@]+$/;

if(!regex.test(email)){
document.getElementById("erro-email").innerText="Digite um email válido";
return;
}

email_recuperacao=email;

btn.disabled=true;
btn.innerText="Enviando...";

fetch("recuperar/enviar_codigo.php",{

method:"POST",
headers:{
"Content-Type":"application/x-www-form-urlencoded"
},

body:"email="+encodeURIComponent(email)

})
.then(res=>res.text())
.then(res=>{

res=res.trim();

let partes=res.split("|");

if(partes[0]==="ok"){

let emailMascarado=partes[1];

document.getElementById("msg-email").innerText=
"✔ Código enviado para "+emailMascarado;

document.getElementById("erro-email").innerText="";

setTimeout(()=>{

document.getElementById("step-email").style.display="none";
document.getElementById("step-codigo").style.display="block";

},2000);

iniciarContagem();

}else{

document.getElementById("erro-email").innerText=res;

btn.disabled=false;
btn.innerText="ENVIAR";

}

});

};

/* AUTO PULAR INPUTS */

let inputs=document.querySelectorAll(".codigo-input");

inputs.forEach((input,index)=>{

input.addEventListener("input",function(){

if(this.value.length==1 && index<5){

inputs[index+1].focus();

}

});

});

/* VERIFICAR CODIGO */

document.getElementById("btn-enviar-codigo").onclick=function(){

let codigo="";

document.querySelectorAll(".codigo-input").forEach(input=>{
codigo+=input.value;
});

fetch("recuperar/verificar_codigo.php",{

method:"POST",
headers:{
"Content-Type":"application/x-www-form-urlencoded"
},

body:"codigo="+codigo+"&email="+email_recuperacao

})
.then(res=>res.text())
.then(res=>{

res=res.trim();

if(res==="ok"){

document.getElementById("step-codigo").style.display="none";
document.getElementById("step-nova-senha").style.display="block";

}else{

document.getElementById("contador-reenvio").innerText=
"❌ "+res;

}

});

};

/* REENVIAR CODIGO */

document.getElementById("reenviar-codigo").onclick=function(e){

e.preventDefault();

if(email_recuperacao===""){
alert("Digite o email primeiro");
return;
}

fetch("recuperar/enviar_codigo.php",{

method:"POST",
headers:{
"Content-Type":"application/x-www-form-urlencoded"
},

body:"email="+email_recuperacao

})
.then(res=>res.text())
.then(res=>{

res=res.trim();

let partes=res.split("|");

if(partes[0]==="ok"){

document.getElementById("contador-reenvio").innerText=
"✔ Novo código enviado";

iniciarContagem();

}else{

document.getElementById("contador-reenvio").innerText=
"❌ "+res;

}

});

};

/* ATUALIZAR SENHA */

document.getElementById("btn-confirmar-senha").onclick=function(){

let senha=document.getElementById("nova-senha").value;
let confirmar=document.getElementById("confirmar-senha").value;

if(senha!=confirmar){

document.getElementById("erro-confirmar-senha").innerText=
"❌ As senhas não coincidem";

return;

}

fetch("recuperar/atualizar_senha.php",{

method:"POST",
headers:{
"Content-Type":"application/x-www-form-urlencoded"
},

body:"senha="+senha+"&confirmar="+confirmar+"&email="+email_recuperacao

})
.then(res=>res.text())
.then(res=>{

if(res==="ok"){

document.getElementById("erro-confirmar-senha").innerText="";

document.getElementById("msg-senha").innerText=
"✔ Senha alterada com sucesso!";

setTimeout(()=>{
location.reload();
},2000);

}else{

document.getElementById("erro-confirmar-senha").innerText=
"❌ "+res;

}

});

};

</script>