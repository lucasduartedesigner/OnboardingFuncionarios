<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    //Receber os dados do formulario
    $nome     = $_POST['nome'];    
    $caminho_arquivo    = $_POST['caminho_arquivo'];    
    $tipo_arquivo   = $_POST['tipo_arquivo'];    
    $imagem    = $_POST['imagem'];    
    $titulo  = $_POST['titulo'];    
    $status   = (!empty($_POST['status'])) ? $_POST['status'] : 0;

    //Monta insert em uma string
    $consulta = "INSERT INTO documentos
                 (nome, caminho_arquivo, tipo_arquivo, imagem, titulo, status) 
                 VALUES
                 (:nome, :caminho_arquivo, :tipo_arquivo, :imagem, :titulo, :status)";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':nome', $nome, PDO::PARAM_STR);
    $response->bindParam(':caminho_arquivo', $caminho_arquivo, PDO::PARAM_STR);
    $response->bindParam(':tipo_arquivo', $tipo_arquivo, PDO::PARAM_STR);
    $response->bindParam(':imagem', $imagem, PDO::PARAM_STR);
    $response->bindParam(':titulo', $titulo, PDO::PARAM_STR);   
    $response->bindParam(':status', $status, PDO::PARAM_STR);

    //Executa a insert 
    $response->execute();

    //Verifica se cadastro foi feito
    $id_documentoss = $conn->lastInsertId();

    //Verifica se existe dados para retornar
    if (!empty($id_documentoss)) 
    {
        echo "Cadastro realizado com sucesso!";
    }
    else
    {
        //Mensagem caso não encontre o cadastro no banco
        echo "Tivemos problemas ao realizar cadastro!";
    }

?>