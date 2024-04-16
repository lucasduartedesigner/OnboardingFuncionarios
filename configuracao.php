<?php include_once "template/config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">

  <?php include_once "template/head.php"; ?>

  <body>

    <?php include_once "template/header.php"; ?>

    <main role="main" class="container">
        <div class="d-grid d-flex justify-content-between mb-4 mt-5">
            <h2 class="featurette-heading fw-normal lh-1">Configurações</h2>
        </div>

        <div class="row">
            <?php 

            $consulta = "SELECT titulo, url, ordem, descricao FROM menu WHERE status = 2 ORDER BY ordem";

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
                    <h5 class="card-title"><?= $resultado['titulo'] ?></h5>
                    <p class="mt-4"><?= $resultado['descricao'] ?></p>
                    <div class="mt-4">
                        <a href="<?= $resultado['url'] ?>" class="btn btn-success">Acessar</a>
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

    <?php include_once "template/footer.php"; ?>
    <?php include_once "template/js.php"; ?>

  </body>
</html>