<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    //Receber os dados do formulario
    $id_campus = $_POST['id_campus'];
    $nome      = $_POST['nome'];
    $imagem    = $_POST['imagem'];
    $texto     = $_POST['texto'];
    $missao    = $_POST['missao'];
    $visao     = $_POST['visao'];
    $valores   = $_POST['valores'];
    $status   = (!empty($_POST['status'])) ? $_POST['status'] : 0;

    //Monta update em uma string
    $consulta = "UPDATE campus SET  
                     nome = :nome, 
                     imagem = :imagem, 
                     texto = :texto, 
                     missao = :missao, 
                     visao = :visao, 
                     valores = :valores, 
                     status = :status 
                 WHERE id_campus = :id_campus ";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':id_campus', $id_campus, PDO::PARAM_STR);
    $response->bindParam(':nome', $nome, PDO::PARAM_STR);
    $response->bindParam(':imagem', $imagem, PDO::PARAM_STR);
    $response->bindParam(':texto', $texto, PDO::PARAM_STR);
    $response->bindParam(':missao', $missao, PDO::PARAM_STR);
    $response->bindParam(':visao', $visao, PDO::PARAM_STR);
    $response->bindParam(':valores', $valores, PDO::PARAM_STR);
    $response->bindParam(':status', $status, PDO::PARAM_STR);

    //Executa a insert 
    $response->execute();

?>