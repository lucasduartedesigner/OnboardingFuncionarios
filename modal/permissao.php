<form method="post" action="php/cadastra/grupo_acesso.php">
    <div class="modal fade" id="modalpermissao" tabindex="-1" aria-labelledby="modalTarefaLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTarefaLabel">Permissão</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-sm-12">
                    <div class="mb-3">
                      <label for="nome" class="form-label">Nome da Tarefa</label>
                      <input type="text" class="form-control" id="nome" name="nome">
                    </div>
                  </div>
                  
                  <div class="col-sm-12">
                    <div class="row">
                    <?php 

                        $consulta = "SELECT m.id_menu, m.titulo FROM menu m";

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
                                echo '<div class="col-sm-3">'. $resultado['titulo']. '</div>
                                <div class="col-sm-3 ">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    visualizar 
                                </label>
                                </div>
                                <div class="col-sm-3 ">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        editar 
                                    </label>
                                </div>
                                <div class="col-sm-3 ">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        deletar 
                                    </label>
                                </div>'; 
                            }  
                        }   
                    ?>
                      
                    </div>
                  </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Salvar</button>
          </div>
        </div>
      </div>
    </div>
</form>