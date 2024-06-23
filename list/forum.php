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

                                                    <?php 

                                                        $consulta = "SELECT * FROM forum_topicos";


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

                                                    <a href="forum.php?id_topicos=<?= $resultado['id_topicos'] ?>" class="nav-link nav-link-faded"><?= $resultado['descricao'] ?></a>
                                                        <?php
                                                        }
                                                    } 
                                                    ?>   
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
              
              $id_topicos = isset($_GET['id_topicos']) ? $_GET['id_topicos'] : 1;

              $baseQuery = "
                  SELECT f.id_forum_perguntas, f.titulo_pergunta, f.id_pessoa, f.id_departamento, 
                         f.descricao_pergunta, p.nome, f.data_pergunta, f.visualizacao, f.qtd_resposta
                  FROM forum_perguntas f 
                  INNER JOIN pessoa p ON f.id_pessoa = p.id_pessoa
                  LEFT JOIN forum_topicos t ON f.id_topico = t.id_topicos
                  WHERE f.status IN (1,2)";
              
              switch ($id_topicos) {
                  case 2:
                      $consulta = $baseQuery . " ORDER BY f.visualizacao DESC";
                      break;
                  case 3:
                      $consulta = $baseQuery . " AND f.status = 2";
                      break;
                  case 4:
                      $consulta = $baseQuery . " AND f.status = 1";
                      break;
                  case 5:
                      $consulta = $baseQuery . " AND f.qtd_resposta = 0";
                      break;
                  default:
                      $consulta = $baseQuery;
                      break;
              }
                    
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
                                                                <p class="text-muted"> Criado por <a href="javascript:void(0)"> 
                                                                <?= $resultado['nome'] ?></a> há <span class="text-secondary font-weight-bold">
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

<!-- PAGINAÇÃO -->
<?php

// Inicializa a variável de página com o valor padrão de 1
$pagina = 1;

// Verifica se o parâmetro 'pagina' foi passado na URL e valida como um inteiro
if (isset($_GET['pagina'])) {
    $pagina = filter_input(INPUT_GET, "pagina", FILTER_VALIDATE_INT);
}

// Se a validação falhar, define a página como 1
if (!$pagina) {
    $pagina = 1;
}

// Define o limite de registros por página
$limite = 4;

// Calcula o índice inicial para a consulta SQL
$inicio = ($pagina - 1) * $limite; // Ajusta para garantir que o início esteja correto

// Prepara a consulta para obter os dados da página atual com limite e offset
$stmt = $conn->prepare("SELECT * FROM forum_perguntas ORDER BY id_forum_perguntas LIMIT :inicio, :limite");
$stmt->bindValue(':inicio', $inicio, PDO::PARAM_INT); // Vincula o valor de início
$stmt->bindValue(':limite', $limite, PDO::PARAM_INT); // Vincula o valor de limite
$stmt->execute(); // Executa a consulta
$result = $stmt->fetchAll(); // Obtém todos os resultados

// Consulta para obter o número total de registros na tabela
$registros = $conn->query("SELECT COUNT(id_forum_perguntas) count FROM forum_perguntas")->fetch()["count"];

// Calcula o número total de páginas necessárias
$paginas = ceil($registros / $limite);
?>

<!-- Início da navegação de paginação -->
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <!-- Link para a primeira página -->
        <li class="page-item <?php if ($pagina == 1) echo 'disabled'; ?>">
            <a class="page-link" href="?pagina=1">Início</a>
        </li>
        <!-- Link para a página anterior, se não estiver na primeira página -->
        <?php if ($pagina > 1): ?>
            <li class="page-item"><a class="page-link" href="?pagina=<?= $pagina - 1 ?>"><?= $pagina - 1 ?></a></li>
        <?php endif; ?>
        <!-- Link para a página atual, marcado como ativo -->
        <li class="page-item active"><a class="page-link" href="?pagina=<?= $pagina ?>"><?= $pagina ?></a></li>
        <!-- Link para a próxima página, se não estiver na última página -->
        <?php if ($pagina < $paginas): ?>
            <li class="page-item"><a class="page-link" href="?pagina=<?= $pagina + 1 ?>"><?= $pagina + 1 ?></a></li>
        <?php endif; ?>
        <!-- Link para a última página -->
        <li class="page-item <?php if ($pagina == $paginas) echo 'disabled'; ?>">
            <a class="page-link" href="?pagina=<?= $paginas ?>">Última</a>
        </li>
    </ul>
</nav>
