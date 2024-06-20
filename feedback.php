<?php include_once "template/config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">

  <?php include_once "template/head.php"; ?>

<body>

<?php include_once "template/header.php"; ?>

    <main class="container">
     <section class="py-1 text-center container">
        <div class="row py-lg-2">
            <div class="col-lg-8 col-md-8 mx-auto">
            <h1 class="fw-light"><b>Feedback</b></h1>
                <p class="lead text-body-secondary">
                    Os novos colaboradores têm a oportunidade de fornecer feedback sobre o processo de integração,
                     compartilhando suas impressões, sugestões de melhorias e eventuais preocupações.
                </p>
            </div>
        </div>
     </section>
       <div class="row">
           <div class="main-body p-0">
              <div class="inner-wrapper">
                  <div class="inner-sidebar">
                      <div class="inner-sidebar-header justify-content-center">            
                          <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#mensagem-modal">
                              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" 
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-2">
                                  <line x1="12" y1="5" x2="12" y2="19"></line>
                                  <line x1="5" y1="12" x2="19" y2="12"></line>
                              </svg>
                              Adicionar Feedback
                          </button>
                      </div>
                  </div>
                  <div class="inner-main">
                      <?php   

                        $consulta = "SELECT f.id_feedback, f.titulo_feedback, f.id_pessoa,
                                            f.descricao_feedback, p.nome, f.avaliacao, f.visualizacao
                                     FROM feedback f 
                                     INNER JOIN pessoa p on f.id_pessoa = p.id_pessoa ";

                        //Prepara a consulta para o banco
                        $response = $conn->prepare($consulta);

                        //Executa a consulta 
                        $response->execute();

                        //Verifica se existe dados para retornar
                        if ($response->rowCount() > 0) {
                              //Coloca os dados retornados em uma variavel
                              while ($resultado = $response->fetch(PDO::FETCH_ASSOC)) {                     
                              ?>
                                    <div class="inner-main-body1 p-2 collapse forum-content show">
                                        <div class="card-body ">
                                            <div class="media forum-item">
                                                <div class="card text-center">
                                                    <div class="card-header" style="background: #389C81">
                                                        <h6><?= $resultado['titulo_feedback'] ?></h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="text-muted small mb-2">
                                                            <h6>Avaliação</h6>
                                                            <div class="btn-group" role="group sm" aria-label="Escala de Avaliação">
                                                                <?php 
                                                                    for($i=1; $i<=5; $i++)
                                                                    {
                                                                        if($i <= $resultado['avaliacao'])
                                                                        {
                                                                            echo '<i class="fa-solid fa-star text-warning"></i>';
                                                                        }
                                                                        else
                                                                        {
                                                                            echo '<i class="fa-regular fa-star"></i>';
                                                                        } 
                                                                    } 
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <p class="text-secondary"><?= $resultado['descricao_feedback'] ?></p> 
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="text-muted"> 
                                                            Criado por <a href="javascript:void(0)"><?= $resultado['nome'] ?></a><span class="text-secondary font-weight-bold">
                                                        </p> 
                                                    </div>
                                                </div>                                    
                                            </div>                                                                                            
                                        </div> 
                                    </div>                                     
                                <?php
                                }
                            }
                        ?>
                  </div>
              </div>
           </div>
        </div>
    </main>

    <?php include_once "modal/feedback.php"; ?>
    <?php include_once "template/footer.php"; ?>
    <?php include_once "template/js.php"; ?>

</body>
</html>