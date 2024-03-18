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
    <h1>Cadastrar Usuário</h1>

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <form method="POST" action="pessoa.php">
        <h3>Dados básicos</h3>

        <label>Nome: </label>
        <input type="text" name="nome" id="nome" placeholder="Nome "><br><br>
        <label>CPF: </label>
        <input type="text" name="cpf" id="cpf" placeholder="Senha do usuário"><br><br>
        <label> Email: </label>
        <input type="text" name="email" id="email" placeholder="E-mail"><br><br>

        <h3>Endereço</h3>
        <label>Logradouro: </label>
        <input type="text" name="logradouro" id="logradouro" placeholder="Rua, Quadra e etc... "><br><br>
        <label>Numero: </label>
        <input type="text" name="numero" id="numero" placeholder="Numero da Casa/APT"><br><br>
        <label>Cidade: </label>
        <input type="text" name="cidade" id="cidade" placeholder="Cidade"><br><br>
        <label>Estado: </label>
        <input type="text" name="estado" id="estado" placeholder="Estado"><br><br>


        <input type="submit" value="Cadastrar" name="CadUsuario">
    </form>

</body>

</html>