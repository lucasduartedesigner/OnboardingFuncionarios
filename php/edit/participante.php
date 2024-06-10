<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    include_once "../function/data.php";

    //Receber os dados do formulario
    $id_participante = $_POST['id_participante'];
    $id_evento       = $_POST['id_evento'];
    $id_pessoa       = $_POST['id_pessoa'];
    $status          = (!empty($_POST['status'])) ? $_POST['status'] : 0;

    //Monta update em uma string
    $consulta = "UPDATE participante SET
                     id_evento = :id_evento, 
                     id_pessoa = :id_pessoa,
                     status = :status
                 WHERE id_participante = :id_participante ";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':id_participante', $id_participante, PDO::PARAM_STR);
    $response->bindParam(':id_evento', $id_evento, PDO::PARAM_STR);
    $response->bindParam(':id_pessoa', $id_pessoa, PDO::PARAM_STR);
    $response->bindParam(':status', $status, PDO::PARAM_STR);

    //Executa a insert 
    $response->execute();

?>