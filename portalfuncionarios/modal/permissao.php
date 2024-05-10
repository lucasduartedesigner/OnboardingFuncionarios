<form method="post" action="php/edita/grupo_acesso.php">
   
    <input type="hidden" id="id_grupo_acesso" name="id_grupo_acesso">

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
                      <input type="text" class="form-control nome" id="nome" name="nome">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="mb-3">
                      <div class="form-check form-switch">
                        <input class="form-check-input status" type="checkbox" id="status" name="status" value="1" checked>
                        <label class="form-check-label" for="status">Grupo Ativo</label>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6 text-center mb-2">
                        </div>
                        <div class="col-sm-2 text-center mb-2">
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <div class="col-sm-2 text-center mb-2">
                            <i class="fa-solid fa-edit"></i>
                        </div>
                        <div class="col-sm-2 text-center mb-2">
                            <i class="fa-solid fa-trash"></i>
                        </div>
                    <?php 

                        $consulta = "SELECT m.id_menu, m.titulo
                                     FROM menu m 
                                     ORDER BY m.status, m.ordem ";

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
                                extract($resultado);
                                
                                echo '<div class="col-sm-6">'. $titulo . '</div>
                                <div class="col-sm-2 text-center">
                                    <input class="form-check-input" type="checkbox" value="" id="v-'. $id_menu .'" name="v-'. $id_menu .'">
                                </div>
                                <div class="col-sm-2 text-center">
                                    <input class="form-check-input" type="checkbox" value="" id="e-'. $id_menu .'" name="e-'. $id_menu .'">
                                </div>
                                <div class="col-sm-2 text-center">
                                    <input class="form-check-input" type="checkbox" value="" id="d-'. $id_menu .'" name="d-'. $id_menu .'">
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