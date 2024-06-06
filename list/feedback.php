<div class="row">
  <div class="main-body p-0">
      <div class="inner-wrapper">
          <!-- Inner sidebar -->
          <div class="inner-sidebar">
              <!-- Inner sidebar header -->
              <div class="inner-sidebar-header justify-content-center">            
                  <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#mensagem-modal">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" 
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-2">
                          <line x1="12" y1="5" x2="12" y2="19"></line>
                          <line x1="5" y1="12" x2="19" y2="12"></line>
                      </svg>
                      Novo tópico
                  </button>
              </div>
          </div>
          
          <!-- /Inner sidebar -->

          <!-- Inner main -->
        <div class="inner-main ">

              <!-- Forum List -->
              <?php   
  
                    $consulta = "SELECT f.id_feedback, f.titulo_feedback, f.id_pessoa,
                    f.descricao_feedback, p.nome, f.visualizacao
                    FROM feedback f 
                    inner join pessoa p on f.id_pessoa = p.id_pessoa";

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
                                                    <!-- titulo -->
                                                    <h6> 
                                                        <a href="forum.php?id=<?= $resultado['id_feedback'] ?>" class="text-body"> 
                                                        <?= $resultado['titulo_feedback'] ?>                                                                                                                                        
                                                        </a>
                                                    </h6>
                                                
                                                </div>
                                                    <div class="media-body">
                                                        <p class="text-secondary"> <?= $resultado['descricao_feedback'] ?> </p>    
                                                        <div class="text-muted small ">                                                                
                                                            </head>
                                                            <body>
                                                            <div class="container mt-5">                                                                
                                                                <p><h6>Avaliação</h6>
                                                                    <div class="btn-group" role="group sm" aria-label="Escala de Avaliação">
                                                                        <button type="button" class="btn btn-outline-primary rating-button" data-rating="1">1</button>
                                                                        <button type="button" class="btn btn-outline-primary rating-button" data-rating="2">2</button>
                                                                        <button type="button" class="btn btn-outline-primary rating-button" data-rating="3">3</button>
                                                                        <button type="button" class="btn btn-outline-primary rating-button" data-rating="4">4</button>
                                                                        <button type="button" class="btn btn-outline-primary rating-button" data-rating="5">5</button>
                                                                    </div>
                                                                </p>                                                                
                                                            </div>
                                                        </div> 
                                                    </div>
                                                <div class="card-footer ">
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
    </div>
</div>
