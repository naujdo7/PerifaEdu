<?php
$email = $_GET['email'];
?>

<h2>Nova Senha</h2>

<form action="atualizar_senha.php" method="POST">

<input type="hidden" name="email" value="<?php echo $email; ?>">

<input type="password" name="senha" placeholder="Nova senha" required>

<input type="password" name="confirmar" placeholder="Confirmar senha" required>

<button type="submit">Salvar</button>

</form>