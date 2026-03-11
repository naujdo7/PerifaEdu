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
                    <div class="forgot-password">
                        <a href="#">Esqueceu a senha?</a>
                    </div>
                </div>
                <button type="submit" class="btn-login">ENTRAR</button>
            </form>

            <div class="social-login">
                <p>Fazer login com:</p>
                <div class="social-icons">
                    <div class="social-icon"> <img src="./img/apple.svg" alt=""></div>
                    <div class="social-icon"> <img src="./img/google.svg" alt=""></div>
                    <div class="social-icon"> <img src="./img/Microsoft.svg" alt=""></div>
                </div>
            </div>

            <div class="register-link">
                <p>Não tem login? <a href="#" id="open-cadastro">Clique aqui para cadastrar-se!</a></p>
            </div>
        </div>
    </div>

    <script>

document.getElementById("loginForm").addEventListener("submit", function(e){

e.preventDefault();

let formData = new FormData(this);

fetch("/perifaedu/PerifaEdu/pages/login.php",{
method:"POST",
body:formData
})
.then(res => res.text())
.then(res => {

console.log("Resposta:", res);

if(res.trim() === "ok"){

// salva que o usuário está logado
localStorage.setItem("perifaEduLogado", "true");

alert("Login realizado!");
location.reload();

}else{

alert(res);

}

})
.catch(err => console.error(err));

});

</script>