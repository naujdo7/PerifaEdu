<?php
 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
 
require 'vendor/autoload.php';
 
$client = new Google\Client();
 
$client->setClientId('754906055428-q3kvt51m7kp38u282q8pn8la0nk92u0v.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/PerifaEdu/PerifaEdu/teste/google-callback.php');
 
$client->addScope("email");
$client->addScope("profile");
 
$pdo = new PDO(
    "mysql:host=localhost;dbname=testeperifaedu;charset=utf8",
    "root",
    "usbw",
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);
 