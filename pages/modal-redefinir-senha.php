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
                </div>
                <button class="btn-login" id="btn-enviar-email">ENVIAR</button>
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
                <a href="#" class="reenviar-link">Não recebeu o código? Clique aqui para reenviar!</a>
                <button class="btn-login" id="btn-enviar-codigo">ENVIAR</button>
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
                </div>
                <button class="btn-login" id="btn-confirmar-senha">CONFIRMAR</button>
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


/* ENVIAR EMAIL */

document.getElementById("btn-enviar-email").onclick = function(){

let email = document.getElementById("recuperacao-email").value;

email_recuperacao = email;

fetch("recuperar/enviar_codigo.php",{

method:"POST",
headers:{
"Content-Type":"application/x-www-form-urlencoded"
},

body:"email="+email

})
.then(res=>res.text())
.then(res=>{

if(res=="ok"){

alert("Código enviado");

document.getElementById("step-email").style.display="none";
document.getElementById("step-codigo").style.display="block";

}else{

alert(res);

}

});

};



/* AUTO PULAR INPUTS */

let inputs = document.querySelectorAll(".codigo-input");

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

codigo += input.value;

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

if(res=="ok"){

document.getElementById("step-codigo").style.display="none";
document.getElementById("step-nova-senha").style.display="block";

}else{

alert("Código inválido ou expirado");

}

});

};



/* ATUALIZAR SENHA */

document.getElementById("btn-confirmar-senha").onclick=function(){

let senha = document.getElementById("nova-senha").value;
let confirmar = document.getElementById("confirmar-senha").value;

if(senha != confirmar){

alert("Senhas não coincidem");
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

if(res=="ok"){

alert("Senha alterada com sucesso!");
location.reload();

}else{

alert(res);

}

});

};
</script>