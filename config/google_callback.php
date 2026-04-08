<?php
ini_set('session.cookie_path', '/');

session_start();
session_unset(); // limpa sessão antiga
session_regenerate_id(true); // gera nova sessão segura

require __DIR__ . '/conexao.php';

require __DIR__ . '/config_env.php';

$redirectUri = "http://localhost/PerifaEdu/PerifaEdu/config/google_callback.php";

/* ============================= */
/* 1️⃣ Verificar retorno do Google */
/* ============================= */

if (!isset($_GET['code'])) {
    die("Erro no login com Google");
}

/* ============================= */
/* 2️⃣ Trocar code por access_token */
/* ============================= */

$token = file_get_contents("https://oauth2.googleapis.com/token", false, stream_context_create([
    'http' => [
        'method'  => 'POST',
        'header'  => "Content-type: application/x-www-form-urlencoded",
        'content' => http_build_query([
            'code' => $_GET['code'],
            'client_id' => GOOGLE_CLIENT_ID,
            'client_secret' => GOOGLE_CLIENT_SECRET,
            'redirect_uri' => $redirectUri,
            'grant_type' => 'authorization_code'
        ])
    ]
]));

$tokenData = json_decode($token, true);

if (!isset($tokenData['access_token'])) {
    die("Erro ao gerar token");
}

$accessToken = $tokenData['access_token'];

/* ============================= */
/* 3️⃣ Buscar dados do usuário */
/* ============================= */

$userInfo = file_get_contents(
    "https://www.googleapis.com/oauth2/v2/userinfo?access_token=" . $accessToken
);

$user = json_decode($userInfo, true);

if (!$user || !isset($user['email'])) {
    die("Erro ao obter dados do usuário");
}

$nome = $user['name'];
$email = $user['email'];
$usuario = explode("@", $email)[0];

/* ============================= */
/* 4️⃣ Verificar se já existe no banco */
/* ============================= */

$stmt = $conn->prepare("SELECT id, nome_completo FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {

    /* ============================= */
    /* 5️⃣ Criar usuário novo (Google) */
    /* ============================= */

    $tipo_login = "google";
    $senha = NULL;
    $cpf = NULL;
    $data_nascimento = NULL;
    $fotoPerfil = "img/perfil.png"; // FOTO PADRÃO

    $stmt = $conn->prepare("
        INSERT INTO usuarios 
        (nome_completo, cpf, data_nascimento, usuario, email, fotoPerfil, senha, tipo_login) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "ssssssss",
        $nome,
        $cpf,
        $data_nascimento,
        $usuario,
        $email,
        $fotoPerfil,
        $senha,
        $tipo_login
    );

    $stmt->execute();

    $usuario_id = $stmt->insert_id;

} else {

    /* ============================= */
    /* 6️⃣ Usuário já existe */
    /* ============================= */

    $dados = $result->fetch_assoc();
    $usuario_id = $dados['id'];
    $nome = $dados['nome_completo'];
}

/* ============================= */
/* 7️⃣ Criar sessão (IGUAL login normal) */
/* ============================= */

$_SESSION['usuario_id'] = $usuario_id;
$_SESSION['usuario_nome'] = $nome;
$_SESSION['usuario_email'] = $email;

/* Buscar foto real do banco */
$stmt = $conn->prepare("SELECT fotoPerfil FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$dadoFoto = $result->fetch_assoc();

$_SESSION['fotoPerfil'] = $dadoFoto['fotoPerfil'] ?? 'img/perfil.png';

/* ============================= */
/* 8️⃣ Redirecionar */
/* ============================= */

header("Location: ../index.php?loginGoogle=true");
exit;