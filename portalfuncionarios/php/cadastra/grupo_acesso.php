<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    //Receber os dados do formulario
    $nome     = $_POST['nome'];    
    $status   = (!empty($_POST['status'])) ? $_POST['status'] : 0;

    //Monta insert em uma string
    $consulta = "INSERT INTO grupo_acesso s
                 (nome, status) 
                 VALUES
                 (:nome, :status)";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':nome', $nome, PDO::PARAM_STR);    
    $response->bindParam(':status', $status, PDO::PARAM_STR);

    //Executa a insert 
    $response->execute();

    //Verifica se cadastro foi feito
    $id_grupo_acesso = $conn->lastInsertId();

    //Verifica se existe dados para retornar
    if (!empty($id_grupo_acesso)) 
    {
        echo "Cadastro realizado com sucesso!";
    }
    else
    {
        //Mensagem caso não encontre o cadastro no banco
        echo "Tivemos problemas ao realizar cadastro!";
    }

?>