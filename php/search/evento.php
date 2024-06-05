<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    include_once "../function/data.php";

    //Receber os dados do formulario
    $id_evento = $_POST['id'];

    //Monta consulta em uma string
    $consulta = "SELECT e.id_evento, e.titulo, e.descricao, e.status, e.dt_begin, e.dt_end, e.id_responsavel, e.id_tipo_evento, e.link
                 FROM evento e
                 INNER JOIN participante pt ON pt.id_evento = e.id_evento 
                 INNER JOIN tipo_evento te ON te.id_tipo_evento = e.id_tipo_evento
                 WHERE e.status IS NOT NULL
                 AND e.id_evento = :id_evento
                 GROUP BY e.id_evento, e.titulo, e.descricao, e.status, e.dt_begin, e.dt_end, e.id_responsavel, e.id_tipo_evento, e.link";

    //Prepara o consulta para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':id_evento', $id_evento, PDO::PARAM_STR);

    $response->execute();

    if ($response->rowCount() > 0) 
    {
        $result = $response->fetch(PDO::FETCH_ASSOC);
        
        $result['dt_begin'] = dataHoraToBR($result['dt_begin']);
        $result['dt_end']   = dataHoraToBR($result['dt_end']);

        echo json_encode($result);
    }

?>