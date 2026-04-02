<?php
$host = "localhost";
$user = "root";
$pass = "usbw";
$banco = "testeperifaedu";

$conn = new mysqli($host, $user, $pass, $banco);

if ($conn->connect_error) {
    die("Erro na conexão");
}

$conn->set_charset("utf8mb4");

?>