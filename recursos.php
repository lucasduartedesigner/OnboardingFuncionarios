<?php include_once "template/config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">

  <?php include_once "template/head.php"; ?>

  <body>

    <?php include_once "template/header.php"; ?>

    <main role="main" class="container">
      <div class="row mt-1">
        <div class="col-md-12">
          <h2 class="featurette-heading fw-normal lh-1 mb-4 mt-5">Recursos</h2>
          <p class="mb-4 mt-2">
             <?php
              
                $sql = "SELECT * FROM documentos";                                      

                //Prepara a consulta para o banco
                $result = $conn->prepare($sql);

                //Executa a consulta 
                $result->execute();

                //Verifica se existe dados para retornar
                if ($result->rowCount() > 0) 
                {
                    //Coloca os dados retornados em uma variavel
                    while ($retorno = $result->fetch(PDO::FETCH_ASSOC)) 
                    {
                        if($retorno['tipo_arquivo'] == 'pdf')
                        {
                            echo "<a href='".$retorno['caminho_arquivo']."' target='_blank'>".$retorno['nome']."</a><br>";
                        }
                        else
                        {
                            echo "<iframe width='560' height='315' src='".$retorno['caminho_arquivo']."' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>";
                            echo $retorno['nome'];
                        }
                    }
                }

             ?>
          </p>
        </div>
      </div>
    </main>

    <?php include_once "template/footer.php"; ?>

    <?php include_once "template/js.php"; ?>

  </body>
</html>