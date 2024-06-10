<?php

    session_start();

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    if(!empty($_POST['item']))
    {
        $cond = " AND pt.id_pessoa != :id_pessoa ";
    }
    else
    {
        $cond = "";
    }

    $sql_nome = "SELECT p.id_pessoa, p.nome
                 FROM pessoa p
                 WHERE p.status = 1
                 AND NOT EXISTS (
                                  SELECT 1 
                                  FROM participante pt 
                                  WHERE pt.id_pessoa = p.id_pessoa
                                  AND pt.id_evento = :id_evento
                                  $cond
                                )
                 ORDER BY p.nome ";

    //Prepara a consulta para o banco
    $res_nome = $conn->prepare($sql_nome);

    $res_nome->bindParam(':id_evento', $_POST['id'], PDO::PARAM_STR);

    if(!empty($_POST['item']))
    {
        $res_nome->bindParam(':id_pessoa', $_POST['item'], PDO::PARAM_STR);
    }

    //Executa a consulta 
    $res_nome->execute();

    //Verifica se existe dados para retornar
    if ($res_nome->rowCount() > 0) 
    {
        //Coloca os dados retornados em uma variavel
        while ($result_nome = $res_nome->fetch(PDO::FETCH_ASSOC)) 
        {
            extract($result_nome);

            $selected = ($id_pessoa == $_POST['item']) ? 'selected' : '';

            echo "<option value='$id_pessoa' $selected>$nome</option>";
        }
    }

?>
