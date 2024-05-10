<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    $table = $_POST['table'];
    $id    = $_POST['id'];

    $consulta = "UPDATE $table SET STATUS = null WHERE id_$table = :id ";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':id', $id, PDO::PARAM_STR);

    //Executa a insert 
    $response->execute();

?>