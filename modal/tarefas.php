<form method="post" action="php/cadastra/tarefa.php" id="formTarefa">

    <input type="hidden" class="form-control" id="id_tarefa" name="id_tarefa">

    <div class="modal fade" id="modalTarefa" tabindex="-1" aria-labelledby="modalTarefaLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTarefaLabel">Formulário de Tarefa</h5>
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
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="nome" class="form-label">Início:</label>
                      <input type="text" class="form-control" id="dt_begin" name="dt_begin" maxlength="10">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="nome" class="form-label">Término:</label>
                      <input type="text" class="form-control" id="dt_end" name="dt_end" maxlength="10">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1" checked>
                        <label class="form-check-label" for="status">Tarefa Ativa</label>
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