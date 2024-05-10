<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../conn/conexao.php";    

    //Receber os dados do formulario
    $matricula = $_POST['matricula'];
    $email = $_POST['email'];

    //Monta consulta em uma string
    $consulta = "SELECT id_pessoa
                 FROM pessoa 
                 WHERE status IS NOT NULL
                 AND matricula = :matricula
                 AND email = :email ";

    //Prepara o consulta para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':matricula', $matricula, PDO::PARAM_STR);
    $response->bindParam(':email', $email, PDO::PARAM_STR);

    $response->execute();

    if ($response->rowCount() > 0) 
    {
        $result = $response->fetch(PDO::FETCH_ASSOC);
        
        echo json_encode($result);
    }

?>