<?php

    session_start();

    //Incluir a conexao com BD
    include_once "conn/conexao.php";

    if(empty($_SESSION['token']))
    {
        header("Location: index.html");

        exit();
    }

    $menus = $_SESSION['menus'];

?>