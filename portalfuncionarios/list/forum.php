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
                      Nova mensagem
                  </button>
              </div>
          
              <!-- Inner sidebar body / menu lateral de filtros -->
              <div class="inner-sidebar-body p-0">
                  <div class="p-3 h-100" data-simplebar="">
                      <div class="simplebar-wrapper" style="margin: -16px;">
                          <div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div>
                              <div class="simplebar-mask">
                                  <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                      <div class="simplebar-content-wrapper" style="height: 100%">
                                          <div class="simplebar-content"  style="padding: 16px;">
                                              <nav class="nav nav-pills nav-gap-y-1 flex-column">
                                                  <?php include 'list/topicos.php'; ?>
                                              </nav>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          <div class="simplebar-placeholder" style="width: 234px; height: 292px;"></div>
                      </div>
                      <div class="simplebar-track simplebar-vertical" style="visibility: visible">
                      <div class="simplebar-scrollbar" style="height: 151px; display: block; transform: translate3d(0px, 0px, 0px);"></div>
                      </div>
                  </div>
              </div>
              <!-- /Inner sidebar body -->
          </div>
          <!-- /Inner sidebar -->

          <!-- Inner main -->
        <div class="inner-main ">
              <!-- Inner main header -->
              <div class="inner-main-header justify-content-end"> 
                  <span class="input-icon input-icon-sm ml-auto w-auto">
                  <form class="d-flex ">                                                       
                      <input type="text" class="form-control bg-gray-200 border-gray-200 shadow-none mb-4 mt-4" placeholder="Digite sua pesquisa" />
                      <button type="button" class="btn btn-success mb-4 mt-4 " data-bs-toggle="modal" data-bs-target="#modalTarefa" Small button >Pesquisar </button>
                  </form>
                  </span>
              </div>
              <!-- /Inner main header -->

              <!-- Inner main body -->

              <!-- Forum List -->
              <?php   
              
              $condicao = "";
              
              if(!empty($_GET['id_topicos'])) {
              $condicao = "WHERE t.id_topicos = :id_topicos";
              }

                    $consulta = "SELECT f.id_forum_perguntas, f.titulo_pergunta, f.id_pessoa, f.id_departamento, 
                    f.descricao_pergunta, p.nome, f.data_pergunta , f.visualizacao, f.qtd_resposta
                    FROM forum_perguntas f 
                    inner join pessoa p on f.id_pessoa = p.id_pessoa
                    left join forum_topicos t on f.id_topicos = t.id_topicos
                    $condicao";

                    //Prepara a consulta para o banco
                    $response = $conn->prepare($consulta);

                    if(!empty($_GET['id_topicos'])) {
                        $response->bindParam(':id_topicos', $_GET['id_topicos'], PDO::PARAM_STR);
                    }
                    
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
                                                                    <a href="forum.php?id=<?= $resultado['id_forum_perguntas'] ?>" class="text-body"> 
                                                                    <?= $resultado['titulo_pergunta'] ?> 
                                                                    </a>
                                                                </h6>
                                                            
                                                            </div>
                                                                <div class="media-body">
                                                                    <p class="text-secondary"> <?= $resultado['descricao_pergunta'] ?> </p>    
                                                                            <div class="text-muted small ">
                                                                                <!-- icone visualizações -->
                                                                                <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i> <?= $resultado['visualizacao'] ?> visualizações </span>
                                                                                <!-- icone resposta mesagem -->                                                                    
                                                                                <span><i class="far fa-comment ml-1"> </i> <?= $resultado['qtd_resposta'] ?> Respostas </span>                                                                   
                                                                            </div>                                                                                                       
                                                            
                                                                        </div>

                                                            <div class="card-footer ">
                                                                <p class="text-muted"> Criado por <a href="javascript:void(0)"> <?= $resultado['nome'] ?></a> há <span class="text-secondary font-weight-bold">
                                                                <?= datetimeDiferencaEmMinutos($resultado['data_pergunta']) ?> minutos atrás.</span></p>  
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