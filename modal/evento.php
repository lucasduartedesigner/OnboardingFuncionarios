<form method="post" action="php/cadastra/evento.php" id="formEvento">

    <input type="hidden" class="form-control" id="id_evento" name="id_evento">

    <div class="modal fade" id="modalEvento" tabindex="-1" aria-labelledby="modalEventoLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEventoLabel">Formulário de Evento</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-sm-12">
                    <div class="mb-3">
                      <label for="nome" class="form-label">Titulo</label>
                      <input type="text" class="form-control" id="titulo" name="titulo" maxlength="255">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="nome" class="form-label">Início:</label>
                      <input type="text" class="form-control" id="dt_begin" name="dt_begin" maxlength="16">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="nome" class="form-label">Término:</label>
                      <input type="text" class="form-control" id="dt_end" name="dt_end" maxlength="16">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="nome" class="form-label">Tipo Evento:</label>
                      <select class="form-control" id="tipo_evento" name="tipo_evento" required>
                        <?php 
                          foreach($arrayTipoEvento as $value)
                          {
                            $selected = ($_SESSION['id_tipo_evento'] == $value['id_tipo_evento']) ? 'selected' : '';

                            echo "<option value=".$value['id_tipo_evento']." $selected>".$value['nome']."</option>";
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="mb-3">
                      <label for="nome" class="form-label">Status:</label>
                      <select class="form-control" id="status" name="status">
                        <option value="1">Agendado</option>
                        <option value="2">Em andamento</option>
                        <option value="3">Realizado</option>
                        <option value="4">Cancelado</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="mb-3">
                      <label for="nome" class="form-label">Descrição</label>
                      <textarea class="form-control" id="descricao" name="descricao" maxlength="500" rows="4"></textarea>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="mb-3">
                      <label for="nome" class="form-label">Link do Evento</label>
                      <input type="text" class="form-control" id="link" name="link" maxlength="255">
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