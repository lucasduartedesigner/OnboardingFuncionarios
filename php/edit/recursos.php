<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    //Receber os dados do formulario
    $id_documentos    = $_POST['id_documentos'];
    $nome            = $_POST['nome'];
    $imagem          = $_POST['imagem'];
    $caminho_arquivo = $_POST['caminho_arquivo'];
    $tipo_arquivo    = $_POST['tipo_arquivo'];
    $titulo          = $_POST['titulo'];
    $status          = (!empty($_POST['status'])) ? $_POST['status'] : 0;

    //Monta update em uma string
    $consulta = "UPDATE documentos SET  
                     nome = :nome, 
                     imagem = :imagem, 
                     caminho_arquivo = :caminho_arquivo, 
                     tipo_arquivo = :tipo_arquivo, 
                     titulo = :titulo, 
                     status = :status 
                 WHERE id_documentos = :id_documentos ";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':id_documentos', $id_documentos, PDO::PARAM_STR);
    $response->bindParam(':nome', $nome, PDO::PARAM_STR);
    $response->bindParam(':imagem', $imagem, PDO::PARAM_STR);
    $response->bindParam(':caminho_arquivo', $caminho_arquivo, PDO::PARAM_STR);
    $response->bindParam(':tipo_arquivo', $tipo_arquivo, PDO::PARAM_STR);
    $response->bindParam(':titulo', $titulo, PDO::PARAM_STR);
    $response->bindParam(':status', $status, PDO::PARAM_STR);


    //Executa a insert 
    $response->execute();



?>   
