<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    include_once "../function/data.php";

    //Receber os dados do formulario
    $resposta = $_POST['resposta'];
    $id_pessoa = $_POST['id_pessoa'];
    $id_forum_perguntas = $_POST['id_forum_perguntas'];

    $data_respostas = date('Y-m-d H:i:s');   

    //Monta insert em uma string
    $consulta = "INSERT INTO forum_respostas 
                 (resposta, id_pessoa, id_forum_perguntas, data_respostas) 
                 VALUES
                 (:resposta, :id_pessoa, :id_forum_perguntas, :data_respostas)";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':resposta', $resposta, PDO::PARAM_STR);
    $response->bindParam(':id_pessoa', $id_pessoa, PDO::PARAM_STR);
    $response->bindParam(':id_forum_perguntas', $id_forum_perguntas, PDO::PARAM_STR);
    $response->bindParam(':data_respostas', $data_respostas, PDO::PARAM_STR);

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