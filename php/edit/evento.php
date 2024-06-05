<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    include_once "../function/data.php";

    //Receber os dados do formulario
    $id_evento   = $_POST['id_evento'];
    $titulo      = $_POST['titulo'];
    $dt_begin    = dataHoraToUS($_POST['dt_begin']);
    $dt_end      = dataHoraToUS($_POST['dt_end']);
    $tipo_evento = $_POST['tipo_evento'];
    $status      = (!empty($_POST['status'])) ? $_POST['status'] : 0;
    $descricao   = $_POST['descricao'];
    $link        = $_POST['link'];

    //Monta update em uma string
    $consulta = "UPDATE evento SET
                     titulo = :titulo, 
                     dt_begin = :dt_begin, 
                     dt_end = :dt_end,
                     id_tipo_evento = :tipo_evento,
                     status = :status,
                     descricao = :descricao,
                     link = :link
                 WHERE id_evento = :id_evento ";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':id_evento', $id_evento, PDO::PARAM_STR);
    $response->bindParam(':titulo', $titulo, PDO::PARAM_STR);
    $response->bindParam(':dt_begin', $dt_begin, PDO::PARAM_STR);
    $response->bindParam(':dt_end', $dt_end, PDO::PARAM_STR);
    $response->bindParam(':tipo_evento', $tipo_evento, PDO::PARAM_STR);
    $response->bindParam(':status', $status, PDO::PARAM_STR);
    $response->bindParam(':descricao', $descricao, PDO::PARAM_STR);
    $response->bindParam(':link', $link, PDO::PARAM_STR);

    //Executa a insert 
    $response->execute();

?>