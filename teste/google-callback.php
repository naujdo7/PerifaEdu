<?php
ini_set('session.cookie_path', '/');

require 'config.php';

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
    $picture = $data->picture;

    // verificar se usuário existe
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if(!$user){
	
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome_completo, usuario, email, fotoPerfil, cpf) VALUES (?,?,?,?,?)");
        $stmt->execute([$name, $name, $email, $picture, $cpf]);


        $user_id = $pdo->lastInsertId();

    } else {

        $user_id = $user['id'];
    }

    $_SESSION['usuario_id'] = $user_id;
    $_SESSION['usuario_nome'] = $name;
    $_SESSION['usuario_email'] = $email;
    $_SESSION['picture'] = $picture;

    header("Location: /PerifaEdu/PerifaEdu/index.php?loginGoogle=true");
    exit();
}