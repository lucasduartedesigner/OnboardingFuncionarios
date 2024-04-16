<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    //Receber os dados do formulario
    $id_item_tarefa = $_POST['id'];
    $status         = $_POST['status'];

    //Monta update em uma string
    $consulta = "UPDATE item_tarefa SET  
                     status = :status 
                 WHERE id_item_tarefa = :id_item_tarefa ";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':id_item_tarefa', $id_item_tarefa, PDO::PARAM_STR);
    $response->bindParam(':status', $status, PDO::PARAM_STR);

    //Executa a insert 
    $response->execute();

?>