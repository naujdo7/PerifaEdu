<?php
require_once 'conexao.php';
require_once 'config_env.php';

$clientID = GOOGLE_CLIENT_ID;
$clientSecret = GOOGLE_CLIENT_SECRET;

// A URL de redirecionamento agora é construída de forma robusta usando full_url do conexao.php
$redirectUri = $full_url . "config/google_callback.php";
?>