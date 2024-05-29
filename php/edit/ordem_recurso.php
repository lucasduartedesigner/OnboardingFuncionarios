<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    //Receber os dados do formulario
    $id_documentos = $_POST['id_documentos'];
    $ordem         = $_POST['ordem'];

    //Monta update em uma string
    $consulta = "UPDATE documentos SET  
                     ordem = :ordem
                 WHERE id_documentos = :id_documentos ";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':id_documentos', $id_documentos, PDO::PARAM_STR);
    $response->bindParam(':ordem', $ordem, PDO::PARAM_STR);

    //Executa a insert 
    $response->execute();



?>   
