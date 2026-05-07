<?php
// Detecção de ambiente
$host_atual = $_SERVER['HTTP_HOST'] ?? 'localhost';
$is_localhost = ($host_atual == 'localhost' || $host_atual == '127.0.0.1' || strpos($host_atual, '192.168.') !== false);

if ($is_localhost) {
    // Configurações Locais
    $host = "localhost";
    $user = "root";
    $pass = "";
    $banco = "testeperifaedu";
    
    $port = 3307;
    
    // Caminho no XAMPP (ajuste se a pasta for diferente)
    if (!defined('BASE_URL')) define("BASE_URL", "/PerifaEdu/");
} else {
    // Configurações InfinityFree (Produção)
    $host = "sql100.infinityfree.com";
    $user = "if0_41688825";          
    $pass = "96ZezF7MTkeqm";          
    $banco = "if0_41688825_perifaedu";
    $port = 3306;
    
    if (!defined('BASE_URL')) define("BASE_URL", "/");
}

$conn = new mysqli($host, $user, $pass, $banco, $port);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

// Variáveis úteis para outros scripts
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://";
if ($is_localhost) $protocol = "http://"; // Forçar http no local se não tiver SSL
$full_url = $protocol . $host_atual . BASE_URL;
?>