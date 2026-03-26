<?php
session_start();
require __DIR__ . '/../conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /PerifaEdu/PerifaEdu/index.php");
    exit();
}

$idUsuario = $_SESSION['usuario_id'];

$stmt = $conn->prepare("SELECT nome_completo, fotoPerfil FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $idUsuario);
$stmt->execute();

$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

$foto = !empty($usuario['fotoPerfil']) 
    ? "/PerifaEdu/PerifaEdu/" . $usuario['fotoPerfil'] 
    : "/PerifaEdu/PerifaEdu/img/perfil.png";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Perfil</title>

<style>
body{
    font-family: Arial;
    text-align: center;
    margin-top: 50px;
}

img{
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #333;
}

button{
    padding: 10px 15px;
    margin: 10px;
    cursor: pointer;
}

input[type="file"]{
    display: none;
}
</style>
</head>

<body>

<h2>Meu Perfil</h2>

<!-- 🔥 IMAGEM -->
<img id="preview" src="<?= $foto ?>">

<p><?= htmlspecialchars($usuario['nome_completo']) ?></p>

<!-- 🔥 FORM -->
<form id="formFoto" action="upload_foto.php" method="POST" enctype="multipart/form-data">
    
    <!-- input escondido -->
    <input type="file" id="inputFoto" name="fotoPerfil" accept="image/*">

    <!-- botão fake -->
    <button type="button" onclick="abrirSeletor()">Alterar Foto</button>

    <br>

    <!-- botão enviar -->
    <button type="submit">Enviar Foto</button>
</form>

<!-- 🔥 REMOVER FOTO -->
<form action="remover_foto.php" method="POST">
    <button type="submit">Remover Foto</button>
</form>

<script>
// 🔥 abre seletor
function abrirSeletor(){
    document.getElementById("inputFoto").click();
}

// 🔥 preview da imagem
document.getElementById("inputFoto").addEventListener("change", function(event){
    const file = event.target.files[0];

    if(file){
        const reader = new FileReader();

        reader.onload = function(e){
            document.getElementById("preview").src = e.target.result;
        }

        reader.readAsDataURL(file);
    }
});
</script>

</body>
</html>