<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'vendor/autoload.php';

// Carrega as variáveis do .env
require_once __DIR__ . '/../config_env.php';

$client = new Google\Client();

$client->setClientId(GOOGLE_CLIENT_ID);
$client->setClientSecret(GOOGLE_CLIENT_SECRET);
$client->setRedirectUri('http://localhost/PerifaEdu/PerifaEdu/teste/google-callback.php');

$client->addScope("email");
$client->addScope("profile");

$pdo = new PDO(
    "mysql:host=localhost;dbname=testeperifaedu;charset=utf8",
    "root",
    "usbw",
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);