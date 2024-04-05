<?php

    $host = "127.0.0.1";
    $user = "root";
    $pass = "";
    $db   = "portalfuncionarios";
    $port = 3306;

    try
    {
        //Conexão com a porta
        $conn = new PDO("mysql:host=$host;port=$port;dbname=" . $db, $user, $pass);

        //echo "Conexão com banco de dados realizado com sucesso!";
    }  
    catch(PDOException $err)
    {
        echo "Erro: Conexão com banco de dados não realizado com sucesso. Erro gerado " . $err->getMessage();
    }

?>