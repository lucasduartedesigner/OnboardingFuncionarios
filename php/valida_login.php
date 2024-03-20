<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../conn/conexao.php";

    //Receber os dados do formulario
    $matricula = $_POST['matricula'];
    $senha     = $_POST['senha'];

    //Monta consulta em uma string
    $consulta = "SELECT token, nome, senha, campus FROM pessoa 
                 WHERE matricula = :matricula
                 AND status IS NOT NULL ";

    //Prepara a consulta para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':matricula', $matricula, PDO::PARAM_STR);

    //Executa a consulta 
    $response->execute();

    //Verifica se existe dados para retornar
    if ($response->rowCount() > 0) 
    {
        //Coloca os dados retornados em uma variavel
        $resultado = $response->fetch(PDO::FETCH_ASSOC);
 
        if (password_verify($senha, $resultado['senha'])) 
        {
            //Inclui os dados retornado em sessão para conseguir manter usuario logado durante uso do navegador 
            $_SESSION['token']  = $resultado['token'];
            $_SESSION['nome']   = $resultado['nome'];
            $_SESSION['campus'] = $resultado['campus'];
        }
        else
        {
            echo "Senha incorreta, tente novamente!";
        }
    }
    else
    {
        //Mensagem caso não encontre o cadastro no banco
        echo "Seus dados não estão corretos.<br>Ou ainda não é cadastrado!";
    }

?>