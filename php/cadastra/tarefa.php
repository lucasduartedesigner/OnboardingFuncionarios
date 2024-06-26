<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    include_once "../function/data.php";

    //Receber os dados do formulario
    $nome     = $_POST['nome'];
    $dt_begin = dataToUS($_POST['dt_begin']);
    $dt_end   = dataToUS($_POST['dt_end']);
    $status   = (!empty($_POST['status'])) ? $_POST['status'] : 0;

    //Monta insert em uma string
    $consulta = "INSERT INTO tarefa 
                 (nome, dt_begin, dt_end, status) 
                 VALUES
                 (:nome, :dt_begin, :dt_end, :status)";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':nome', $nome, PDO::PARAM_STR);
    $response->bindParam(':dt_begin', $dt_begin, PDO::PARAM_STR);
    $response->bindParam(':dt_end', $dt_end, PDO::PARAM_STR);
    $response->bindParam(':status', $status, PDO::PARAM_STR);

    //Executa a insert 
    $response->execute();

    //Verifica se cadastro foi feito
    $id_tarefa = $conn->lastInsertId();

    //Verifica se existe dados para retornar
    if (!empty($id_tarefa)) 
    {
        $consulta = "INSERT INTO pessoa_tarefa 
                     (id_pessoa, id_tarefa, status) 
                     VALUES
                     (:id_pessoa, :id_tarefa, 1)";

        //Prepara o insert para o banco
        $response = $conn->prepare($consulta);

        //Passa os parametros via bind para evitar SQL Inject
        $response->bindParam(':id_pessoa', $_SESSION['id_pessoa'], PDO::PARAM_STR);
        $response->bindParam(':id_tarefa', $id_tarefa, PDO::PARAM_STR);

        //Executa a insert 
        $response->execute();

        //Verifica se cadastro foi feito
        $id_pessoa_tarefa = $conn->lastInsertId();

        echo "Cadastro realizado com sucesso!";
    }
    else
    {
        //Mensagem caso não encontre o cadastro no banco
        echo "Tivemos problemas ao realizar cadastro!";
    }

?>