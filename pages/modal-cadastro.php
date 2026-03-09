 <!-- POPUP DE CADASTRO -->
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" defer>
    <link rel="stylesheet" href="./css/popup.css">
    <link rel="stylesheet" href="./css/reset.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>

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

            <form id="cadastroForm" method="POST" action="./cadastrar.php">
                <h1>CADASTRO</h1>
                <div class="form-group">
                    <label for="name" class="required">NOME COMPLETO:</label>
                    <input type="text" class="caixa-texto" id="name" name="nome" placeholder="Digite seu nome completo" required>
                </div>

                <div class="form-group">
                    <label for="cpf" class="required">CPF:</label>
                    <input type="text" class="caixa-texto" id="cpf" name="cpf" placeholder="Ex: 123.456.789-10" required>
                    <small id="cpf-status"></small>
                    
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
                            allowInput: true,
                            maxDate: "today",
                            locale: flatpickr.l10ns.pt
                        });
                        const dataInput = document.getElementById("dataNascimento");
                        dataInput.addEventListener("input", function () {
                            let value = this.value.replace(/\D/g, "");
                            value = value.slice(0, 8);

                            if (value.length > 4) {
                                value = value.replace(/(\d{2})(\d{2})(\d{1,4})/, "$1/$2/$3");
                            } else if (value.length > 2) {
                                value = value.replace(/(\d{2})(\d{1,2})/, "$1/$2");
                            }
                            this.value = value;
                        });

                        document.getElementById("cadastroForm").addEventListener("submit", function(e){

                        e.preventDefault(); // impede recarregar página

                        let formData = new FormData(this);

                        fetch("pages/cadastrar.php",{
                        method:"POST",
                        body:formData
                        })
                        .then(res=>res.text())
                        .then(res=>{

                        if(res=="ok"){
                        alert("Cadastro realizado com sucesso!");
                        location.reload();
                        }else{
                        alert(res);
                        }

                        });

                        });
                    </script>
                    <style>
                        /* Tema Pikaday - Azul Marinho #012E71 */
                        /* ===== CALENDÁRIO PERIFAEDU ===== */

                        .flatpickr-calendar {
                            border-radius: 18px;
                            box-shadow: 0 20px 40px rgba(1, 46, 113, 0.25);
                            border: none;
                            font-family: 'Poppins', sans-serif;
                        }

                        /* Header azul principal */
                        .flatpickr-months {
                            background-color: #012E71;
                            border-radius: 18px 18px 0 0;
                        }

                        .flatpickr-current-month {
                            color: #FFFFFF;
                            font-weight: 600;
                        }

                        .flatpickr-monthDropdown-months,
                        .numInputWrapper span {
                            color: white;
                        }

                        /* Dias da semana */
                        .flatpickr-weekdays {
                            background-color: #012E71;
                        }

                        .flatpickr-weekday {
                            color: #C7D2FE;
                            font-weight: 500;
                        }

                        /* Dias padrão */
                        .flatpickr-day {
                            border-radius: 10px;
                            transition: all 0.2s ease;
                        }

                        /* Hover suave */
                        .flatpickr-day:hover {
                            background-color: rgba(1, 46, 113, 0.15);
                            color: #012E71;
                        }

                        /* Dia selecionado */
                        .flatpickr-day.selected,
                        .flatpickr-day.startRange,
                        .flatpickr-day.endRange {
                            background-color: #012E71;
                            color: white;
                            border: none;
                        }

                        /* Dia atual */
                        .flatpickr-day.today {
                            border: 2px solid #012E71;
                        }

                        /* Setas */
                        .flatpickr-prev-month svg,
                        .flatpickr-next-month svg {
                            fill: white;
                        }

                        /* Input ao focar */
                        #dataNascimento:focus {
                            border: 2px solid #012E71;
                            box-shadow: 0 0 0 3px rgba(1, 46, 113, 0.15);
                        }
                    </style>
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
                </div>
                <button type="submit" class="btn-cadastro">CADASTRAR-SE</button>
            </form>

            <div class="register-link">
                <p>Já tem uma conta? <a href="#" id="open-login">Clique aqui para entrar!</a></p>
            </div>
        </div>
    </div>