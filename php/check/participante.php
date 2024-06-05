<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    //Receber os dados do formulario
    $id_participante = $_POST['id'];
    $status          = $_POST['status'];

    //Monta update em uma string
    $consulta = "UPDATE participante SET  
                     status = :status 
                 WHERE id_participante = :id_participante ";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':id_participante', $id_participante, PDO::PARAM_STR);
    $response->bindParam(':status', $status, PDO::PARAM_STR);

    //Executa a insert 
    $response->execute();

?>