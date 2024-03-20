<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    //Receber os dados do formulario
    $matricula = $_POST['matricula'];
    $nome      = $_POST['nome'];
    $campus    = $_POST['campus'];
    $email     = $_POST['email'];
    $senha     = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $dataHoraAtual = date("Y-m-d H:i:s");

    // Concatena a matrícula do usuário com a data e hora atual
    $dadosParaToken = $matricula . $dataHoraAtual;

    // Gera o token usando a função hash
    $token = hash('sha256', $dadosParaToken);

    //Monta insert em uma string
    $consulta = "INSERT INTO pessoa 
                 (matricula, nome, status, campus, email, token, senha) 
                 VALUES
                 (:matricula, :nome, 1, :campus, :email, :token, :senha)";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':matricula', $matricula, PDO::PARAM_STR);
    $response->bindParam(':nome', $nome, PDO::PARAM_STR);
    $response->bindParam(':campus', $campus, PDO::PARAM_STR);
    $response->bindParam(':email', $email, PDO::PARAM_STR);
    $response->bindParam(':token', $token, PDO::PARAM_STR);
    $response->bindParam(':senha', $senha, PDO::PARAM_STR);

    //Executa a insert 
    $response->execute();

    //Verifica se cadastro foi feito
    $id_usuario = $conn->lastInsertId();

    //Verifica se existe dados para retornar
    if (!empty($id_usuario)) 
    {
        //Inclui os dados retornado em sessão para conseguir manter usuario logado durante uso do navegador 
        $_SESSION['token']  = $token;
        $_SESSION['nome']   = $nome;
        $_SESSION['campus'] = $campus;
    }
    else
    {
        //Mensagem caso não encontre o cadastro no banco
        echo "Tivemos problemas ao realizar cadastro!";
    }

?>