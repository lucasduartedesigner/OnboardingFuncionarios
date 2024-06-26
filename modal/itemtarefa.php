<form method="post" action="php/cadastra/itemtarefa.php" id="form-item-tarefa">

    <input type="hidden" id="id_item_tarefa" name="id_item_tarefa">

    <div class="modal fade" id="modalItemTarefa" tabindex="-1" aria-labelledby="modalTarefaLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTarefaLabel">Formulário de Item Tarefa</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-sm-12">
                    <div class="mb-3">
                      <label for="nome" class="form-label">Item da Tarefa</label>
                      <input type="text" class="form-control" id="nome1" name="nome">
                      <input type="hidden" class="form-control" id="id_tarefa1" name="id_tarefa">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="nome" class="form-label">Início:</label>
                      <input type="text" class="form-control" id="dt_begin1" name="dt_begin">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="nome" class="form-label">Término:</label>
                      <input type="text" class="form-control" id="dt_end1" name="dt_end">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="status1" name="status" value="1">
                        <label class="form-check-label" for="status1">Finalizado</label>
                      </div>
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