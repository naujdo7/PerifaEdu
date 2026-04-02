<!-- POPUP DE LOGIN -->
  <div id="login-modal" class="modal">
        <div class="modal-content">
            <div class="header-login">
                <span class="close">&times;</span>
                <div class="logo">
                    <img src="./img/PerifaEdu 2.png" alt="Logo PerifaEdu" />
                    <span>PERIFA<span>EDU</span></span>
                </div>
            </div>
            <h1>LOGIN</h1>

            <form id="loginForm" method="POST">
                <div class="form-group">
                    <label for="login-email" class="required">E-mail:</label>
                    <input type="text" class="caixa-texto" name="email" id="login-email" placeholder="Insira seu e-mail" required>
                </div>

                <div class="form-group">
                    <label for="login-password" class="required">Senha:</label>
                    <input type="password" class="caixa-texto" name="senha" id="login-password" placeholder="Insira sua senha" required>
                    <p id="erro-login" class="msg-erro2"></p>
                    <div class="forgot-password">
                        <a href="#">Esqueceu a senha?</a>
                    </div>
                </div>
                <button type="submit" class="btn-login">ENTRAR</button>
                <p id="msg-login" class="msg-sucesso2"></p>
            </form>

            <div class="social-login">
    <p>Fazer login com:</p>
    <div class="social-icons">
        
        <a href="/teste">
            <div class="social-icon">
                <img src="./img/apple.svg" alt="">
            </div>
        </a>
        
        <a href="/perifaedu/perifaedu/google_login.php">
            <div class="social-icon">
                <img src="./img/google.svg" alt="">
            </div>
        </a>

        <a href="/teste">
            <div class="social-icon">
                <img src="./img/Microsoft.svg" alt="">
            </div>
        </a>

    </div>
</div>

            <div class="register-link">
                <p>Não tem login? <a href="#" id="open-cadastro">Clique aqui para cadastrar-se!</a></p>
            </div>
        </div>
    </div>

<script>

const loginForm = document.getElementById("loginForm");
const loginModal = document.getElementById("login-modal");
const closeLogin = loginModal.querySelector(".close");

/* FUNÇÃO PARA RESETAR LOGIN */

function resetarLogin(){

loginForm.reset();

document.getElementById("msg-login").innerText="";
document.getElementById("erro-login").innerText="";

let btn = loginForm.querySelector(".btn-login");
btn.disabled=false;
btn.innerText="ENTRAR";

}

/* FECHAR MODAL */

closeLogin.addEventListener("click", function(){

loginModal.style.display="none";

resetarLogin();

});

/* SUBMIT LOGIN */

loginForm.addEventListener("submit", function(e){

e.preventDefault();

let btn = this.querySelector(".btn-login");

let formData = new FormData(this);

/* limpa mensagens */

document.getElementById("msg-login").innerText="";
document.getElementById("erro-login").innerText="";

/* desabilita botão */

btn.disabled = true;
btn.innerText = "Entrando...";

fetch("/perifaedu/PerifaEdu/pages/login.php",{
method:"POST",
body:formData,
credentials: "include"
})
.then(res => res.text())
.then(res => {

res = res.trim();

if(res === "ok"){

localStorage.setItem("perifaEduLogado", "true");

document.getElementById("msg-login").innerText =
"✔ Login realizado com sucesso!";

setTimeout(()=>{

location.reload();

},2000);

}else{

document.getElementById("erro-login").innerText = res;

btn.disabled=false;
btn.innerText="ENTRAR";

}

})
.catch(err => {

console.error(err);

document.getElementById("erro-login").innerText =
"❌ Erro ao realizar login.";

btn.disabled=false;
btn.innerText="ENTRAR";

});

});

</script>