<?php
$host = "localhost";
$user = "root";
$pass = "";
$banco = "testeperifaedu";

$conn = new mysqli($host, $user, $pass, $banco);

if ($conn->connect_error) {
    die("Erro na conexão");
}

?>