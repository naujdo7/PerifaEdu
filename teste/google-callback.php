<?php
ini_set('session.cookie_path', '/');
session_start();

require 'config.php';

// gerar cpf aleatório
$cpf = '';
for($i = 0; $i < 11; $i++){
    $cpf .= mt_rand(0, 9);
}

if(isset($_GET['code'])){

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    $google_service = new Google\Service\Oauth2($client);
    $data = $google_service->userinfo->get();

    $name = $data->name;
    $email = $data->email;

    // 🔥 NÃO USAM A FOTO DO GOOGLE
    // $picture = $data->picture;

    // verificar se usuário existe
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if(!$user){

        // 🔥 cria usuário SEM foto
        $stmt = $pdo->prepare("
            INSERT INTO usuarios (nome_completo, usuario, email, cpf) 
            VALUES (?,?,?,?)
        ");
        $stmt->execute([$name, $name, $email, $cpf]);

        $user_id = $pdo->lastInsertId();

        // 🔥 define foto padrão
        $fotoPerfil = 'img/perfil.png';

    } else {

        $user_id = $user['id'];

        // 🔥 usa foto do banco se existir
        $fotoPerfil = !empty($user['fotoPerfil']) 
            ? $user['fotoPerfil'] 
            : 'img/perfil.png';
    }

    // 🔥 SESSÃO
    $_SESSION['usuario_id'] = $user_id;
    $_SESSION['usuario_nome'] = $name;
    $_SESSION['usuario_email'] = $email;
    $_SESSION['fotoPerfil'] = $fotoPerfil;

    header("Location: /PerifaEdu/PerifaEdu/index.php?loginGoogle=true");
    exit();
}