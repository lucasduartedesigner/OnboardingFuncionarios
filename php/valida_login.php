<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../conn/conexao.php";

    include_once "class/menu.php";

    //Receber os dados do formulario
    $matricula = $_POST['matricula'];
    $senha     = $_POST['senha'];

    //Monta consulta em uma string
    $consulta = "SELECT p.token, p.nome, p.senha, p.id_campus, c.nome campus, c.titulo, c.texto, c.url, c.imagem 
                 FROM pessoa p
                 INNER JOIN campus c ON p.id_campus = c.id_campus
                 WHERE p.matricula = :matricula
                 AND p.status IS NOT NULL ";

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
            $_SESSION['token']     = $resultado['token'];
            $_SESSION['nome']      = $resultado['nome'];
            $_SESSION['id_campus'] = $resultado['id_campus'];
            $_SESSION['campus']    = $resultado['campus'];
            $_SESSION['titulo']    = $resultado['titulo'];
            $_SESSION['texto']     = $resultado['texto'];
            $_SESSION['url']       = $resultado['url'];
            $_SESSION['imagem']    = $resultado['imagem'];

            $menuManager = new MenuManager($conn);

            $_SESSION['menus'] = $menuManager->getMenus();
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