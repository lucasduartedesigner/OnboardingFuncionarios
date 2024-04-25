<?php include_once "template/config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">

  <?php include_once "template/head.php"; ?>


<style>
    
    body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
    background-color: #ffff;    
    }

    .inner-wrapper {
        position: relative;
        height: calc(100vh - 3.5rem);
        transition: transform 0.3s;
    }

    @media (min-width: 992px) {
        .sticky-navbar .inner-wrapper {
            height: calc(100vh - 3.5rem - 48px);
        }
    }

    .inner-main,
    .inner-sidebar {
        position: absolute;
        top: 0;
        bottom: 0;
        display: flex;
        flex-direction: column;
    }
        

    .inner-main {
        right: 0;
        left: 235px;
    }
    
    .inner-main-footer,
    .inner-main-header,
    .inner-sidebar-footer,
    .inner-sidebar-header {
        height: 3.5rem;        
        display: flex;
        align-items: center;
        padding: 0 1rem;
        flex-shrink: 0;
    }

    .inner-main-body,
    .inner-sidebar-body {
        padding: 1rem;
        overflow-y: auto;
        position: relative;
        flex: 1 1 auto;
    }

    .inner-main-body .sticky-top,
    .inner-sidebar-body .sticky-top {
        z-index: 999;
    }

    .inner-main-footer,
    .inner-main-header {
        background-color: #ffff;
    }

    .inner-main-footer,
    .inner-sidebar-footer {
        border-top: 1px solid #cbd5e0;
        border-bottom: 0;
        height: auto;
        min-height: 3.5rem;
    }

    @media (max-width: 767.98px) {
        .inner-sidebar {
            left: -235px;
        }
        .inner-main {
            left: 0;
        }
        .inner-expand .main-body {
            overflow: hidden;
        }
        .inner-expand .inner-wrapper {
            transform: translate3d(235px, 0, 0);
        }
    }

    .nav .show>.nav-link.nav-link-faded, .nav-link.nav-link-faded.active, 
    .nav-link.nav-link-faded:active, .nav-pills .nav-link.nav-link-faded.active, 
    .navbar-nav .show>.nav-link.nav-link-faded {
        color: #3367b5;
        background-color: #c9d8f0;
    }

    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #467bcb;
    }

    .nav-link.has-icon {
        display: flex;
        align-items: center;
    }
    
    .nav-link.active {
        color: #467bcb;
    }
    .nav-pills .nav-link {
        border-radius: .25rem;
    }
    
    .card {
        box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0,0,0,.125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }     
    
</style> 

  <body>

    <?php include_once "template/header.php"; ?>

    <main role="main" class="container">
      <div class="row mt-0">
        <div class="col-md-12">
          <h2 class="featurette-heading fw-normal lh-1 mb-3 mt-3">Fórum de Perguntas e Respostas</h2>
          <p class="mb-4 mt-2">Um fórum interativo onde os novos colaboradores podem fazer perguntas, compartilhar experiências e receber orientações de colegas 
            mais experientes e da equipe de recursos humanos.</p>        
      </div>
    </div>
  </nav>

<div class="nav-scroller bg-body shadow-sm">
  <nav class="nav nav-underline" aria-label="Secondary navigation">
    <a class="nav-link active" aria-current="page" href="#">Página principal</a>
    <a class="nav-link" href="#"> Amigos <span class="badge bg-light text-dark rounded-pill align-text-bottom">27</span> </a>
    <a class="nav-link" href="#">Explorar</a>
    <a class="nav-link" href="#">Sugestões</a>    
  </nav>
</div>



<main class="container">

<div class="container">
<div class="row mt-3">
<div class="main-body p-0">
    <div class="inner-wrapper">
        <!-- Inner sidebar -->
        <div class="inner-sidebar">
            <!-- Inner sidebar header -->
            <div class="inner-sidebar-header justify-content-center">            
                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#threadModal">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" 
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-2">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Nova mensagem
                </button>
            </div>
            <!-- /Inner sidebar header -->

            <!-- Inner sidebar body -->
            <div class="inner-sidebar-body p-0">
                <div class="p-3 h-100" data-simplebar="">
                    <div class="simplebar-wrapper" style="margin: -16px;">
                        <div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div>
                            <div class="simplebar-mask">
                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                    <div class="simplebar-content-wrapper" style="height: 100%">
                                        <div class="simplebar-content" style="padding: 16px;">
                                            <nav class="nav nav-pills nav-gap-y-1 flex-column">
                                                <a href="javascript:void(0)" class="nav-link nav-link-faded has-icon active">Todos os tópicos</a>
                                                <a href="javascript:void(0)" class="nav-link nav-link-faded has-icon">Populares da semana</a>
                                                <a href="javascript:void(0)" class="nav-link nav-link-faded has-icon">Mais Populares</a>
                                                <a href="javascript:void(0)" class="nav-link nav-link-faded has-icon">Resolvidos</a>
                                                <a href="javascript:void(0)" class="nav-link nav-link-faded has-icon">Não resolvidos</a>
                                                <a href="javascript:void(0)" class="nav-link nav-link-faded has-icon">Sem respostas</a>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="simplebar-placeholder" style="width: 234px; height: 292px;"></div>
                    </div>
                    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
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
            <div class="inner-main-header justify-content-between">                    
            <select class="btn btn-success mb-4 mt-4  dropdown-toggle">
                <option selected="">Recentes</option>
                    <option value="1">Populares</option>
                    <option value="3">Resolvidos</option>
                    <option value="3">Não resolvidos</option>
                    <option value="3">Sem Resposta</option> 
                </select>

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

            function datetimeDiferencaEmMinutos($dataHora) {
                // Obter a data e hora atuais
                $dataAtual = date_create();
            
                // Definir a data e hora de comparação
                $dataComparacao = date_create($dataHora);
            
                // Calcular a diferença
                $diferenca = date_diff($dataAtual, $dataComparacao);
            
                // Converter a diferença para minutos
                $minutosDiferenca = $diferenca->days * 24 * 60 + $diferenca->h * 60 + $diferenca->i;
            
                return $minutosDiferenca;
            }

                $consulta = "SELECT titulo, p.nome, descricao, f.data FROM forum f inner join pessoa p on f.id_pessoa = p.id_pessoa";

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
              <div class="inner-main-body p-2 p-sm-3 collapse forum-content show">
                  <div class="card mb-2">
                      <div class="card-body p-2 p-sm-3">
                          <div class="media forum-item">
                              <a href="#" data-toggle="collapse" data-target=".forum-content"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="mr-3 rounded-circle" width="50" alt="User" /></a>
                              <div class="media-body">
                                  <h6><a href="#" data-toggle="collapse" data-target=".forum-content" class="text-body"><?= $resultado['titulo'] ?></a></h6>
                                  <p class="text-secondary">
                                      <?= $resultado['descricao'] ?>
                                  </p>
                                  <p class="text-muted"><a href="javascript:void(0)"> <?= $resultado['nome'] ?></a> respondeu <span class="text-secondary font-weight-bold"><?= datetimeDiferencaEmMinutos($resultado['data'])  ?> minutos atrás</span></p>
                              </div>
                              <div class="text-muted small text-center align-self-center">
                                  <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i> 19</span>
                                  <span><i class="far fa-comment ml-2"></i> 3</span>
                              </div>
                        </div>
                    </div>
                </div>
              <?php
                    }
                } 
              ?>              
            </div>
        <!-- /Inner main -->
    </div>

    <!-- New Thread Modal -->
    <div class="modal fade" id="threadModal" tabindex="-1" role="dialog" aria-labelledby="threadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header d-flex align-items-center bg-primary text-white">
                        <h6 class="modal-title mb-0" id="threadModalLabel">New Discussion</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="threadTitle">Title</label>
                            <input type="text" class="form-control" id="threadTitle" placeholder="Enter title" autofocus="" />
                        </div>
                        <textarea class="form-control summernote" style="display: none;"></textarea>

                        <div class="custom-file form-control-sm mt-3" style="max-width: 300px;">
                            <input type="file" class="custom-file-input" id="customFile" multiple="" />
                            <label class="custom-file-label" for="customFile">Attachment</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</main>


    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

      <script src="offcanvas.js"></script>
  </body>
</html>

          <?php include_once "template/config.php"; ?>
        </div>
      </div>
    </main>

    <?php include_once "template/footer.php"; ?>

    <?php include_once "template/js.php"; ?>

  </body>
</html>


