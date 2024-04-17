<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    include_once "../function/data.php";

    //Receber os dados do formulario
    $id_tarefa = $_POST['id'];

    //Monta consulta em uma string
    $consulta = "SELECT t.id_tarefa, t.nome, t.status, t.dt_begin, t.dt_end
                 FROM tarefa t 
                 WHERE t.status IS NOT NULL
                 AND t.id_tarefa = :id_tarefa
                 GROUP BY t.id_tarefa, t.nome, t.status, t.dt_begin, t.dt_end";

    //Prepara o consulta para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':id_tarefa', $id_tarefa, PDO::PARAM_STR);

    $response->execute();

    if ($response->rowCount() > 0) 
    {
        $result = $response->fetch(PDO::FETCH_ASSOC);
        
        $result['dt_begin'] = dataToBR($result['dt_begin']);
        $result['dt_end']   = dataToBR($result['dt_end']);

        echo json_encode($result);
    }

?>