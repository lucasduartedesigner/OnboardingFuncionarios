<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    include_once "../function/data.php";

    //Receber os dados do formulario
    $titulo_pergunta     = $_POST['titulo_pergunta'];
    $id_pessoa     = $_POST['id_pessoa'];
    $id_departamento     = $_POST['id_departamento'];
    $descricao_pergunta     = $_POST['descricao_pergunta'];
    

    //Monta insert em uma string
    $consulta = "INSERT INTO forum_perguntas 
                 (titulo_pergunta, id_pessoa, id_departamento, descricao_pergunta) 
                 VALUES
                 (:titulo_pergunta, :id_pessoa, :id_departamento, :descricao_pergunta)";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':titulo_pergunta', $titulo_pergunta, PDO::PARAM_STR);
    $response->bindParam(':id_pessoa', $id_pessoa, PDO::PARAM_STR);
    $response->bindParam(':id_departamento', $id_departamento, PDO::PARAM_STR);
    $response->bindParam(':descricao_pergunta', $descricao_pergunta, PDO::PARAM_STR);


    //Executa a insert 
    $response->execute();

    //Verifica se cadastro foi feito
    $id_forum_perguntas = $conn->lastInsertId();

    //Verifica se existe dados para retornar
    if (!empty($id_forum_perguntas)) 
    {
        echo "Cadastro realizado com sucesso!";
    }
    else
    {
        //Mensagem caso não encontre o cadastro no banco
        echo "Tivemos problemas ao realizar cadastro!";
    }

?>