<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    include_once "../function/data.php";

    //Receber os dados do formulario
    $id_item_tarefa = $_POST['id'];

    //Monta consulta em uma string
    $consulta = "SELECT ti.id_item_tarefa, ti.nome, ti.status, ti.dt_begin, ti.dt_end
                 FROM item_tarefa ti 
                 INNER JOIN tarefa t ON ti.id_tarefa = t.id_tarefa
                 WHERE ti.status IS NOT NULL
                 AND ti.id_item_tarefa = :id_item_tarefa
                 GROUP BY ti.id_item_tarefa, ti.nome, ti.status, ti.dt_begin, ti.dt_end";

    //Prepara o consulta para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':id_item_tarefa', $id_item_tarefa, PDO::PARAM_STR);

    $response->execute();

    if ($response->rowCount() > 0) 
    {
        $result = $response->fetch(PDO::FETCH_ASSOC);

        $result['dt_begin'] = dataToBR($result['dt_begin']);
        $result['dt_end']   = dataToBR($result['dt_end']);

        echo json_encode($result);
    }

?>