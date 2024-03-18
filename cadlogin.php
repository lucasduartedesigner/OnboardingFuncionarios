<?php
session_start(); //Iniciar a sessao
?>
<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Cadastro de Login </title>
</head>

<body>
    <h1>Cadastrar Usuários</h1>

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <form method="POST" action="/login.php">
        <h3>Dados básicos</h3>

        <label>Nome: </label>
        <input type="text" name="usuarios" id="usuarios" placeholder="Nome do usuário"><br><br>

        <label>Senha: </label>
        <input type="password" name="senha" id="senha" placeholder="Senha do usuário"><br><br>

        <input type="submit" value="Cadastrar" name="CadUsuario">
    </form>

</body>

</html>