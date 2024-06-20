<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    include_once "../function/data.php";

    //Receber os dados do formulario
    $avaliacao          = $_POST['avaliacao'];
    $titulo_feedback    = $_POST['titulo_feedback'];
    $id_pessoa          = $_POST['id_pessoa'];
    $id_departamento    = $_POST['id_departamento'];
    $descricao_feedback = $_POST['descricao_feedback'];
    

    //Monta insert em uma string
    $consulta = "INSERT INTO feedback 
                 (avaliacao, titulo_feedback, id_pessoa, id_departamento, descricao_feedback) 
                 VALUES
                 (:avaliacao, :titulo_feedback, :id_pessoa, :id_departamento, :descricao_feedback)";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':avaliacao', $avaliacao, PDO::PARAM_STR);
    $response->bindParam(':titulo_feedback', $titulo_feedback, PDO::PARAM_STR);
    $response->bindParam(':id_pessoa', $id_pessoa, PDO::PARAM_STR);
    $response->bindParam(':id_departamento', $id_departamento, PDO::PARAM_STR);
    $response->bindParam(':descricao_feedback', $descricao_feedback, PDO::PARAM_STR);

    //Executa a insert 
    $response->execute();

    //Verifica se cadastro foi feito
    $id_feedback  = $conn->lastInsertId();

    //Verifica se existe dados para retornar
    if (!empty($id_feedback)) 
    {
        echo "Cadastro realizado com sucesso!";
    }
    else
    {
        //Mensagem caso não encontre o cadastro no banco
        echo "Tivemos problemas ao realizar cadastro!";
    }

?>