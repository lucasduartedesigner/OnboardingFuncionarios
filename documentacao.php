<?php include_once "template/config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">

  <?php include_once "template/head.php"; ?>

  <body>

    <?php include_once "template/header.php"; ?>

<main>

  <section class="py-1 text-center container">
    <div class="row py-lg-2">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light"><b>Recursos e Documentação</b></h1>
        <p class="lead text-body-secondary">Seja bem-vindo aos documentos e recursos! Neste espaço, você terá acesso a todo o conteúdo inicial! Seja bem-vindo!</p>
        <p>
        <a href="documentacao.php" class="btn btn-success">Todos</a>
        <?php 
        $consulta = "SELECT * FROM tipo_arquivo ";

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
            <a href="documentacao.php?tipo_arquivo=<?= $resultado['formato'] ?>" class="btn btn-success"><?= $resultado['descricao'] ?></a>
        <?php
            }
        } 
        ?>
        </p>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-body-tertiary">
    <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

    <?php 
        if(!empty($_GET['tipo_arquivo']))
        {
            $tipo_arquivo = $_GET['tipo_arquivo'];
            $cond_arquivo = "AND tipo_arquivo = :tipo_arquivo";
        }
        else
        {
            $tipo_arquivo = null;
            $cond_arquivo = "";
        }

        $consulta = "SELECT nome, titulo, caminho_arquivo, tipo_arquivo, imagem 
        FROM documentos 
        WHERE status = 1 
        $cond_arquivo
        ORDER BY ordem ";

        //Prepara a consulta para o banco
        $response = $conn->prepare($consulta);

        if(!empty($_GET['tipo_arquivo']))
        {
            $response->bindParam(':tipo_arquivo', $tipo_arquivo, PDO::PARAM_STR);
        }

        //Executa a consulta 
        $response->execute();

        //Verifica se existe dados para retornar
        if ($response->rowCount() > 0) 
        {
            //Coloca os dados retornados em uma variavel
            while ($resultado = $response->fetch(PDO::FETCH_ASSOC)) 
            {  
    ?>

            <div class="col">
              <div class="card shadow-sm">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="0" xmlns="http://www.w3.org/2000/svg"role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><text x="50%" y="50%" fill="#eceeef" dy=".3em">
                  <img src="<?= $resultado['imagem'] ?>" class="rounded-top" alt="Cinque Terre"></text></svg>
                <div class="card-body">
                  <p class="card-text"><?= $resultado['nome'] ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="<?= $resultado['caminho_arquivo'] ?>" class="btn btn-success" target="_blank"><?= $resultado['titulo'] ?></a>
                    </div>
                    <small class="text-body-secondary">9 mins</small>
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

<!--footer class="text-body-secondary py-5">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#">Voltar para o início</a>
    </p>
</footer-->

    <?php include_once "template/footer.php"; ?>

    <?php include_once "template/js.php"; ?>

  </body>
</html>