<div class="row">
  <div class="col-sm-12 col-md-3">
    <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#mensagem-modal">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" 
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-2">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        Nova mensagem
    </button>

    <?php include('list/topicos.php'); ?>
  </div>

  <div class="col-sm-12 col-md-9">
    <div class="d-flex">                                                       
        <input class="form-control bg-gray-200 border-gray-200 shadow-none mb-4 mt-4" placeholder="Digite sua pesquisa" name="pesquisa" id="pesquisa" />
        <button type="button" class="btn btn-success ms-2 mb-4 mt-4" onClick="pesquisa()">Pesquisar</button>
    </div>

    <?php

        $id_topicos = isset($_GET['id_topicos']) ? $_GET['id_topicos'] : 1;

        // Inicializa a variável de página com o valor padrão de 1
        $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
      
        $pesquisa = (isset($_GET['pesquisa'])) ? $_GET['pesquisa'] : '';

        // Define o limite de registros por página
        $limite = 4;

        // Calcula o índice inicial para a consulta SQL
        $inicio = ($pagina - 1) * $limite; // Ajusta para garantir que o início esteja correto

        $consulta_qtd_itens = "SELECT COUNT(f.id_forum_perguntas) count 
                                FROM forum_perguntas f 
                                WHERE f.status IN (1,2)
                                AND (f.titulo_pergunta LIKE '%$pesquisa%' OR f.descricao_pergunta LIKE '%$pesquisa%' ) ";

        switch ($id_topicos) {
          case 2:
              $consulta_qtd_itens .= " ORDER BY f.visualizacao DESC";
              break;
          case 3:
              $consulta_qtd_itens .= " AND f.status = 2";
              break;
          case 4:
              $consulta_qtd_itens .= " AND f.status = 1";
              break;
          case 5:
              $consulta_qtd_itens .= " AND f.qtd_resposta = 0";
              break;
          case 6:
              $consulta_qtd_itens .= " AND f.qtd_resposta = 0";
              break;
          default:
              $consulta_qtd_itens = $consulta_qtd_itens;
              break;
        }

        // Consulta para obter o número total de registros na tabela
        $registros = $conn->query($consulta_qtd_itens)->fetch()["count"];

        // Calcula o número total de páginas necessárias
        $paginas = ceil($registros / $limite);

        $condicao = "";

        $baseQuery = "
              SELECT f.id_forum_perguntas, f.titulo_pergunta, f.id_pessoa, f.id_departamento, 
                     f.descricao_pergunta, p.nome, f.data_pergunta, f.visualizacao, f.qtd_resposta
              FROM forum_perguntas f 
              INNER JOIN pessoa p ON f.id_pessoa = p.id_pessoa
              LEFT JOIN forum_topicos t ON f.id_topico = t.id_topicos
              WHERE f.status IN (1,2)
              AND (f.titulo_pergunta LIKE '%$pesquisa%' OR f.descricao_pergunta LIKE '%$pesquisa%' ) ";

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
          case 6:
              $consulta = $baseQuery . " AND f.qtd_resposta = 0";
              break;
          default:
              $consulta = $baseQuery;
              break;
        }

        $consulta = $consulta . " LIMIT :inicio, :limite";

        //Prepara a consulta para o banco
        $response = $conn->prepare($consulta);

        $response->bindValue(':inicio', $inicio, PDO::PARAM_INT); // Vincula o valor de início
        $response->bindValue(':limite', $limite, PDO::PARAM_INT); // Vincula o valor de limite

        //Executa a consulta 
        $response->execute();

        //Verifica se existe dados para retornar
        if ($response->rowCount() > 0) {
              //Coloca os dados retornados em uma variavel
              while ($resultado = $response->fetch(PDO::FETCH_ASSOC)) {                      
              ?>
              <div class="card text-center">
                <div class="card-header" style="background: #389C81">
                  <h6><a href="forum.php?id=<?= $resultado['id_forum_perguntas'] ?>" class="text-body"><?= $resultado['titulo_pergunta'] ?></a></h6>
                </div>
                <div class="card-body">
                  <p class="text-secondary"> <?= $resultado['descricao_pergunta'] ?> </p>    
                  <div class="text-muted small">
                    <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i> <?= $resultado['visualizacao'] ?> visualizações </span>         
                    <span><i class="far fa-comment ml-1"> </i> <?= $resultado['qtd_resposta'] ?> Respostas </span>              
                  </div> 
                </div>
                <div class="card-footer">
                  <p class="text-muted"> Criado por <a href="javascript:void(0)"> 
                  <?= $resultado['nome'] ?></a> há <span class="text-secondary font-weight-bold">
                  <?= datetimeDiferencaEmMinutos($resultado['data_pergunta']) ?> minutos atrás.</span></p>  
                </div>
              </div>                                    
              <?php
                }
            }
              ?>
 
    <!-- Início da navegação de paginação -->
    <nav class="mt-5">
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
  </div>
</div>