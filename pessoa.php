<?php

session_start(); //Iniciar a sessao

//Limpar o buffer de saida
ob_start();

//Incluir a conexao com BD
include_once "conexao.php";

//Receber os dados do formulario
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//var_dump($dados);

//Verificar se o usuario clicou no botao
if(!empty($dados['cadpessoa'])){
    $query_pessoa = ("INSERT INTO pessoa 
                (nome, cpf, email,) VALUES
                (:nome, :cpf, :email)");
    $cad_pessoa = $conn->prepare($query_pessoa);
    $cad_pessoa->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
    $cad_pessoa->bindParam(':cpf', $dados['cpf'], PDO::PARAM_STR);
    $cad_pessoa->bindParam(':email', $dados['email'], PDO::PARAM_STR);
    $cad_pessoa->execute();
    //var_dump($conn->lastInsertId());
    //Recuperar o ultimo id inserido
    $id_usuario = $conn->lastInsertId();

    //Criar a variavel global para salvar a mensagem de sucesso
    $_SESSION['msg'] = "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";

    //Redirecionar o usuario
    header("Location: index.php");
}else{
    //Criar a variavel global para salvar a mensagem de erro
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não cadastrado com sucesso!</p>";

    //Redirecionar o usuario
    header("Location: index.php");
}
