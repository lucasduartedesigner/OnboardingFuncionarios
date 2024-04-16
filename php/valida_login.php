<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../conn/conexao.php";

    include_once "class/menu.php";

    include_once "class/login.php";

    $loginHandler = new LoginHandler($conn);

    $loginHandler->login($_POST['matricula'], $_POST['senha']);

?>