<form action="php/cadastra/forum.php" method="post" autocomplete="off">
    <div class="modal" id="resposta-modal">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h4 class="modal-title">Resposta</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
            <div class="row">

                <div class="col-md-12 mb-3">                    
                    <input type="hidden" class="form-control" id="id_pessoa" name="id_pessoa" maxlength="100" value="<?php echo $_SESSION['id_pessoa'] ?>" required>
                    <input type="hidden" class="form-control" id="id_departamento" name="id_departamento" maxlength="100" value="1" required>
                </div>

                <div class="col-md-12 mb-3">                    
                    <textarea class="form-control" id="resposta" name="resposta" maxlength="2000" value="" required rows="10"></textarea>
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