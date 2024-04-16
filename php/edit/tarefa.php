<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    //Receber os dados do formulario
    $id_tarefa = $_POST['id_tarefa'];
    $nome      = $_POST['nome'];
    $dt_begin  = $_POST['dt_begin'];
    $dt_end    = $_POST['dt_end'];
    $status    = (!empty($_POST['status'])) ? $_POST['status'] : 0;

    //Monta update em uma string
    $consulta = "UPDATE tarefa SET
                     nome = :nome, 
                     dt_begin = :dt_begin, 
                     dt_end = :dt_end,
                     status = :status
                 WHERE id_tarefa = :id_tarefa ";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':id_tarefa', $id_tarefa, PDO::PARAM_STR);
    $response->bindParam(':nome', $nome, PDO::PARAM_STR);
    $response->bindParam(':dt_begin', $dt_begin, PDO::PARAM_STR);
    $response->bindParam(':dt_end', $dt_end, PDO::PARAM_STR);
    $response->bindParam(':status', $status, PDO::PARAM_STR);

    //Executa a insert 
    $response->execute();

?>