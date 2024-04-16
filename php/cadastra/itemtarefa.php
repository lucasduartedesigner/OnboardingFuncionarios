<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    //Receber os dados do formulario
    $id_tarefa = $_POST['id_tarefa'];
    $nome      = $_POST['nome'];
    $dt_begin  = (!empty($_POST['dt_begin'])) ? DateTime::createFromFormat('d/m/Y', $_POST['dt_begin'])->format('Y-m-d') : 'null';
    $dt_end    = (!empty($_POST['dt_end'])) ? DateTime::createFromFormat('d/m/Y', $_POST['dt_end'])->format('Y-m-d') : 'null';
    $status    = (!empty($_POST['status'])) ? $_POST['status'] : 0;

    //Monta insert em uma string
    $consulta = "INSERT INTO item_tarefa 
                 (id_tarefa, nome, dt_begin, dt_end, status) 
                 VALUES
                 (:id_tarefa, :nome, :dt_begin, :dt_end, :status)";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':id_tarefa', $id_tarefa, PDO::PARAM_STR);
    $response->bindParam(':nome', $nome, PDO::PARAM_STR);
    $response->bindParam(':dt_begin', $dt_begin, PDO::PARAM_STR);
    $response->bindParam(':dt_end', $dt_end, PDO::PARAM_STR);
    $response->bindParam(':status', $status, PDO::PARAM_STR);

    //Executa a insert 
    $response->execute();

    //Verifica se cadastro foi feito
    $id_item_tarefa = $conn->lastInsertId();

    //Verifica se existe dados para retornar
    if (!empty($id_item_tarefa)) 
    {
        echo "Cadastro realizado com sucesso!";
    }
    else
    {
        //Mensagem caso não encontre o cadastro no banco
        echo "Tivemos problemas ao realizar cadastro!";
    }

?>