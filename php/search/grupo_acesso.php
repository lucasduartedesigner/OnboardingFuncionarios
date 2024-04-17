<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    include_once "../function/data.php";

    //Receber os dados do formulario
    $id_grupo_acesso = $_POST['id'];

    //Monta consulta em uma string
    $consulta = "SELECT id_grupo_acesso, nome, status 
                 FROM grupo_acesso 
                 WHERE status IS NOT NULL
                 AND id_grupo_acesso = :id_grupo_acesso ";

    //Prepara o consulta para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':id_grupo_acesso', $id_grupo_acesso, PDO::PARAM_STR);

    $response->execute();

    if ($response->rowCount() > 0) 
    {
        $result = $response->fetch(PDO::FETCH_ASSOC);

        echo json_encode($result);
    }

?>