<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    //Receber os dados do formulario
    $nome     = $_POST['nome'];    
    $texto    = $_POST['texto'];    
    $missao   = $_POST['missao'];    
    $visao    = $_POST['visao'];    
    $valores  = $_POST['valores'];    
    $status   = (!empty($_POST['status'])) ? $_POST['status'] : 0;

    //Monta insert em uma string
    $consulta = "INSERT INTO campus
                 (nome, texto, missao, visao, valores, status) 
                 VALUES
                 (:nome, :texto, :missao, :visao, :valores, :status)";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':nome', $nome, PDO::PARAM_STR);
    $response->bindParam(':texto', $texto, PDO::PARAM_STR);
    $response->bindParam(':missao', $missao, PDO::PARAM_STR);
    $response->bindParam(':visao', $visao, PDO::PARAM_STR);
    $response->bindParam(':valores', $valores, PDO::PARAM_STR);   
    $response->bindParam(':status', $status, PDO::PARAM_STR);

    //Executa a insert 
    $response->execute();

    //Verifica se cadastro foi feito
    $id_campus = $conn->lastInsertId();

    //Verifica se existe dados para retornar
    if (!empty($id_campus)) 
    {
        echo "Cadastro realizado com sucesso!";
    }
    else
    {
        //Mensagem caso não encontre o cadastro no banco
        echo "Tivemos problemas ao realizar cadastro!";
    }

?>