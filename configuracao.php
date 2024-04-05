<?php include_once "template/config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">

  <?php include_once "template/head.php"; ?>

  <body>

    <?php include_once "template/header.php"; ?>

    <main role="main" class="container">
        <div class="d-grid d-flex justify-content-between mb-4 mt-5">
            <h2 class="featurette-heading fw-normal lh-1">Configurações</h2>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTarefa">Adicionar</button>
        </div>

        <div class="row">
            <?php 

            $consulta = "SELECT id_grupo_acesso, nome FROM grupo_acesso";

            //Prepara a consulta para o banco
            $response = $conn->prepare($consulta);

            
            //Executa a consulta 
            $response->execute();

            //Verifica se existe dados para retornar
            if ($response->rowCount() > 0) 
            {
                //Coloca os dados retornados em uma variavel
                while ($resultado = $response->fetch(PDO::FETCH_ASSOC)) 
                {
                    
                    
            ?>
            <div class="col-4 mb-5">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><?= $resultado['nome'] ?></h5>
                  </div>
                  <ul class="list-group list-group-flush">
                    <?php
                        $sql_item = "SELECT p.nome
                                     FROM pessoa_acesso pa 
                                     LEFT JOIN pessoa p ON pa.id_pessoa = p.id_pessoa
                                     WHERE p.status IS NOT NULL
                                     AND pa.id_grupo_acesso = :id_grupo_acesso";                                      

                        //Prepara a consulta para o banco
                        $res_item = $conn->prepare($sql_item);

                        //Passa os parametros via bind para evitar SQL Inject                       
                        $res_item->bindParam(':id_grupo_acesso', $resultado['id_grupo_acesso'], PDO::PARAM_STR);

                        //Executa a consulta 
                        $res_item->execute();

                        //Verifica se existe dados para retornar
                        if ($res_item->rowCount() > 0) 
                        {
                            //Coloca os dados retornados em uma variavel
                            while ($result_item = $res_item->fetch(PDO::FETCH_ASSOC)) 
                            {
                                echo "<li class='list-group-item'>".$result_item['nome']."</li>";
                            }
                        }
                    ?>
                    <li class="list-group-item"></li>
                  </ul>
                  <div class="card-body d-grid d-flex justify-content-between">
                    <div>
                        <a data-bs-toggle="modal" data-bs-target="#modalpermissao" class="btn btn-success">Editar</a>
                        <a href="configuracao.php?id=<?= $resultado['id_grupo_acesso'] ?>" class="btn btn-success"><i class="fa-solid fa-plus"></i></a>
                    </div>                      
                  </div>
                </div>
            </div>
            <?php
                }
            } 
            ?>
        </div>
    </main>

    <?php include_once "modal/grupo_acesso.php"; ?>
    <?php include_once "modal/permissao.php"; ?>
    <?php include_once "template/footer.php"; ?>
    <?php include_once "template/js.php"; ?>

  </body>
</html>