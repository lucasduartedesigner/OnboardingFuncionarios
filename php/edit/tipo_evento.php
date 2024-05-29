<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    //Receber os dados do formulario
    $id_tipo_evento = $_POST['id_tipo_evento'];
    $nome           = $_POST['nome'];
    $status         = (!empty($_POST['status'])) ? $_POST['status'] : 0;

    //Monta update em uma string
    $consulta = "UPDATE tipo_evento SET  
                     nome = :nome, 
                     status = :status 
                 WHERE id_tipo_evento = :id_tipo_evento ";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':id_tipo_evento', $id_tipo_evento, PDO::PARAM_STR);
    $response->bindParam(':nome', $nome, PDO::PARAM_STR);
    $response->bindParam(':status', $status, PDO::PARAM_STR);

    //Executa a insert 
    $response->execute();

?>