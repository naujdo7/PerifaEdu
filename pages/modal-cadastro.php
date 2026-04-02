 <!-- POPUP DE CADASTRO -->
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" defer>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- idioma PT-BR -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>
    <link rel="stylesheet" href="./css/popup.css">
    <link rel="stylesheet" href="./css/reset.css">

</head>
 <div id="cadastro-modal" class="modal-cadastro">
        <div class="modal-content-cadastro">
            <div class="header-login">
                <span class="close">&times;</span>
                <div class="logo">
                    <img src="./img/PerifaEdu 2.png" alt="Logo PerifaEdu" />
                    <span>PERIFA<span>EDU</span></span>
                </div>
            </div>

            <form id="cadastroForm">
                <h1>CADASTRO</h1>
                <div class="form-group">
                    <label for="name" class="required">NOME COMPLETO:</label>
                    <input type="text" class="caixa-texto" id="name" name="nome" placeholder="Digite seu nome completo" required>
                </div>

                <div class="form-group">
                    <label for="cpf" class="required">CPF:</label>
                    <input type="text" class="caixa-texto" id="cpf" name="cpf" placeholder="Ex: 123.456.789-10" required>
                    <small id="cpf-status" style="margin-top: 3px; margin-left: 2px;"></small>
                    
                    <script>
                    const cpfInput = document.getElementById("cpf");
                    const cpfStatus = document.getElementById("cpf-status");

                    cpfInput.addEventListener("input", function(e){

                    let value = e.target.value.replace(/\D/g,"");
                    value = value.substring(0,11);

                    /* mascara */

                    if(value.length > 9){
                    value = value.replace(/(\d{3})(\d)/,"$1.$2");
                    value = value.replace(/(\d{3})(\d)/,"$1.$2");
                    value = value.replace(/(\d{3})(\d{1,2})$/,"$1-$2");
                    }
                    else if(value.length > 6){
                    value = value.replace(/(\d{3})(\d)/,"$1.$2");
                    value = value.replace(/(\d{3})(\d)/,"$1.$2");
                    }
                    else if(value.length > 3){
                    value = value.replace(/(\d{3})(\d)/,"$1.$2");
                    }

                    e.target.value = value;

                    /* validar cpf */

                    let cpf = value.replace(/\D/g,"");

                    if(cpf.length === 11){

                    if(validarCPF(cpf)){
                    cpfStatus.innerText = "CPF válido";
                    cpfStatus.style.color = "green";
                    }else{
                    cpfStatus.innerText = "CPF inválido";
                    cpfStatus.style.color = "red";
                    }

                    }else{

                    cpfStatus.innerText = "";

                    }

                    });


                    function validarCPF(cpf){

                    if(/^(\d)\1+$/.test(cpf)) return false;

                    let soma = 0;
                    let resto;

                    for(let i=1;i<=9;i++){
                    soma += parseInt(cpf.substring(i-1,i))*(11-i);
                    }

                    resto = (soma*10)%11;

                    if(resto==10 || resto==11) resto=0;

                    if(resto != parseInt(cpf.substring(9,10))) return false;

                    soma = 0;

                    for(let i=1;i<=10;i++){
                    soma += parseInt(cpf.substring(i-1,i))*(12-i);
                    }

                    resto = (soma*10)%11;

                    if(resto==10 || resto==11) resto=0;

                    if(resto != parseInt(cpf.substring(10,11))) return false;

                    return true;

                    }
                    </script>
                </div>

                <div class="form-group">
                    <label for="dataNascimento" class="required">DATA DE NASCIMENTO:</label>
                    <input type="text" class="caixa-texto" id="dataNascimento" name="data_nascimento" placeholder="DD/MM/AAAA" required>
                    <script>
                        flatpickr("#dataNascimento", {
                            dateFormat: "d/m/Y",
                            locale: "pt",
                            maxDate: "today", // impede datas futuras
                            allowInput: true // permite digitar também
                        });
                    </script>
                </div>

                <div class="form-group">
                    <label for="user" class="required">NOME DE USUÁRIO:</label>
                    <input type="text" class="caixa-texto" id="user" name="usuario" placeholder="Insira seu nome de usuário" required>
                </div>

                <div class="form-group">
                    <label for="cadastro-email" class="required">EMAIL:</label>
                    <input type="email" class="caixa-texto" id="cadastro-email" name="email" placeholder="Insira seu e-mail" required>
                </div>

                <div class="form-group">
                    <label for="cadastro-password" class="required">SENHA:</label>
                    <input type="password" class="caixa-texto" id="cadastro-password" name="senha" placeholder="Insira sua senha" required>
                    <i class="fa-solid fa-eye toggle-password" data-target="senha"></i>
                    <div class="password-rules">
                        <p id="rule-length">❌ Mínimo 8 caracteres</p>
                        <p id="rule-upper">❌ Letra minúscula</p>
                        <p id="rule-lower">❌ Letra maiúscula</p>
                        <p id="rule-number">❌ Número</p>
                        <p id="rule-special">❌ Caractere especial</p>
                    </div>
                </div>


                <style>
                /* VALIDAR SENHA */
                    .password-rules {
                        margin-top: 8px;
                        font-size: 14px;
                        display: flex;
                        flex-direction: column;
                        align-items: flex-start;
                    }

                    .password-rules p {
                        margin: 4px 0;
                        color: #888;
                        transition: 0.2s ease;
                    }

                    .password-rules .valid {
                        color: #0f9d58;
                        /* verde */
                        font-weight: 500;
                    }

                    /* MOSTRAR SENHA */
                    .password-field {
                        position: relative;
                    }

                    .password-field input {
                        width: 100%;
                        padding-right: 40px;
                    }

                    .toggle-password {
                        position: absolute;
                        right: 12px;
                        top: 50%;
                        transform: translateY(-50%);
                        cursor: pointer;
                        color: #012E71;
                        font-size: 18px;
                    }
                </style>

                <div class="form-group">
                    <label for="confirm-password" class="required">REPETIR SENHA:</label>
                    <input type="password" class="caixa-texto" id="confirm-password" name="confirmar_senha" placeholder="Repita sua senha" required>
                    <i class="fa-solid fa-eye toggle-password" data-target="senha"></i>
                    <p id="msg-cadastro-email" style="margin-top:10px;color:green;font-size:14px;"></p>
                </div>
                <button type="submit" class="btn-cadastro">CADASTRAR-SE</button>
            </form>

            <div class="register-link">
                <p>Já tem uma conta? <a href="#" id="open-login">Clique aqui para entrar!</a></p>
            </div>
        </div>
    </div>
<script>

document.getElementById("cadastroForm").addEventListener("submit", function(e){

e.preventDefault();

let form = this;
let btn = form.querySelector(".btn-cadastro");
let formData = new FormData(form);

/* desativar botão */

btn.disabled = true;
btn.innerText = "Cadastrando...";

/* salvar dados temporariamente */

sessionStorage.setItem("cadastro_nome", formData.get("nome"));
sessionStorage.setItem("cadastro_cpf", formData.get("cpf"));
sessionStorage.setItem("cadastro_data", formData.get("data_nascimento"));
sessionStorage.setItem("cadastro_usuario", formData.get("usuario"));
sessionStorage.setItem("cadastro_email", formData.get("email"));
sessionStorage.setItem("cadastro_senha", formData.get("senha"));
sessionStorage.setItem("cadastro_confirmar", formData.get("confirmar_senha"));

email_recuperacao = formData.get("email");

/* enviar código */

let dados = new URLSearchParams();

dados.append("email", formData.get("email"));
dados.append("tipo","cadastro");

fetch("./recuperar/enviar_codigo.php",{
method:"POST",
body:dados
})
.then(res=>res.text())
.then(res=>{

res = res.trim();

if(res.startsWith("ok")){

let partes = res.split("|");
let emailMascarado = partes[1];

/* MOSTRAR EMAIL MASCARADO */

let aviso = document.getElementById("msg-cadastro-email");

if(aviso){
aviso.innerText = "✔ Código enviado para " + emailMascarado;
}

/* esperar 2 segundos */

setTimeout(()=>{

/* fechar modal cadastro */

document.getElementById("cadastro-modal").style.display = "none";

/* abrir modal confirmação */

document.getElementById("recuperacao-modal").style.display = "flex";

document.getElementById("step-email").style.display = "none";
document.getElementById("step-codigo").style.display = "block";

/* iniciar contador de reenviar */

iniciarContagem();

},2000);

}else{

alert(res);

btn.disabled = false;
btn.innerText = "Cadastrar-se";

}

});

});


/* ================================= */
/* REENVIAR CÓDIGO (CADASTRO) */
/* ================================= */

document.getElementById("reenviar-codigo").onclick=function(e){

e.preventDefault();

if(email_recuperacao===""){
alert("Erro ao reenviar código.");
return;
}

let dados = new URLSearchParams();

dados.append("email", email_recuperacao);

/* verificar se é cadastro */

if(sessionStorage.getItem("cadastro_email")){
dados.append("tipo","cadastro");
}

fetch("recuperar/enviar_codigo.php",{

method:"POST",
body:dados

})
.then(res=>res.text())
.then(res=>{

res=res.trim();

let partes=res.split("|");

if(partes[0]==="ok"){

document.getElementById("contador-reenvio").innerText =
"✔ Novo código enviado";

iniciarContagem();

}else{

document.getElementById("contador-reenvio").innerText =
"❌ "+res;

}

});

};

</script>