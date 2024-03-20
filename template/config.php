<?php

    session_start();

    //Incluir a conexao com BD
    include_once "conn/conexao.php";

    include_once "php/class/campus.php";

    if(empty($_SESSION['token']))
    {
        header("Location: index.html");

        exit();
    }

    $menus = $_SESSION['menus'];

    $campusManager = new CampusManager($conn);
    
    $arrayCampus = $campusManager->getCampus();

?>