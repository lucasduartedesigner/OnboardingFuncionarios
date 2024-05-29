<form method="post" action="php/cadastra/tipo_evento.php">
    <div class="modal fade" id="modalTipoEvento" tabindex="-1" aria-labelledby="modalTipoEventoLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTipoEventoLabel">Formulário Tipo Evento</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-sm-12">
                    <div class="mb-3">
                      <label for="nome" class="form-label">Nome do Tipo Evento</label>
                      <input type="text" class="form-control" id="nome" name="nome" maxlength="100">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="mb-3">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1" checked>
                        <label class="form-check-label" for="status">Status</label>
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