<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    //include_once "../class/menu.php";

    //Receber os dados do formulario    
    $id_pessoa     = $_POST['id_pessoa'];
    $senha     = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    //Monta insert em uma string
    $consulta = "UPDATE pessoa SET senha = :senha
                WHERE id_pessoa = :id_pessoa";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':id_pessoa', $id_pessoa, PDO::PARAM_STR);
    $response->bindParam(':senha', $senha, PDO::PARAM_STR);

    //Executa a insert 
    $response->execute();

    //Verifica se existe dados para retornar
    if (!empty($matricula)) 
    {
        include_once "../class/login.php";

        $loginHandler = new LoginHandler($conn);

        $loginHandler->login($_POST['matricula'], $_POST['senha']);
    }
    else
    {
        //Mensagem caso não encontre o cadastro no banco
        echo "Tivemos problemas ao realizar a troca de senha!";
    }

?>