<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    include_once "../function/data.php";

    //Receber os dados do formulario
    $titulo         = $_POST['titulo'];
    $dt_begin       = dataHoraToUS($_POST['dt_begin']);
    $dt_end         = dataHoraToUS($_POST['dt_end']);
    $tipo_evento    = $_POST['tipo_evento'];
    $status         = (!empty($_POST['status'])) ? $_POST['status'] : 0;
    $descricao      = $_POST['descricao'];
    $link           = $_POST['link'];
    $id_responsavel = $_POST['id_responsavel'];

    //Monta insert em uma string
    $consulta = "INSERT INTO evento 
                 (titulo, dt_begin, dt_end, id_tipo_evento, status, descricao, link, id_responsavel) 
                 VALUES
                 (:titulo, :dt_begin, :dt_end, :tipo_evento, :status, :descricao, :link, :id_responsavel)";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':titulo', $titulo, PDO::PARAM_STR);
    $response->bindParam(':dt_begin', $dt_begin, PDO::PARAM_STR);
    $response->bindParam(':dt_end', $dt_end, PDO::PARAM_STR);
    $response->bindParam(':tipo_evento', $tipo_evento, PDO::PARAM_STR);
    $response->bindParam(':status', $status, PDO::PARAM_STR);
    $response->bindParam(':descricao', $descricao, PDO::PARAM_STR);
    $response->bindParam(':link', $link, PDO::PARAM_STR);
    $response->bindParam(':id_responsavel', $_SESSION['id_pessoa'], PDO::PARAM_STR);

    //Executa a insert 
    $response->execute();

    //Verifica se cadastro foi feito
    $id_evento = $conn->lastInsertId();

    //Verifica se existe dados para retornar
    if (!empty($id_evento)) 
    {
        $consulta = "INSERT INTO participante 
                     (id_pessoa, id_evento, status) 
                     VALUES
                     (:id_pessoa, :id_evento, 1)";

        //Prepara o insert para o banco
        $response = $conn->prepare($consulta);

        //Passa os parametros via bind para evitar SQL Inject
        $response->bindParam(':id_pessoa', $_SESSION['id_pessoa'], PDO::PARAM_STR);
        $response->bindParam(':id_evento', $id_evento, PDO::PARAM_STR);

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