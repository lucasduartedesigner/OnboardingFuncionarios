<form action="php/cadastra/forum.php" method="post" autocomplete="off">
    <div class="modal" id="mensagem-modal">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h4 class="modal-title">Editar Dados</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
            <div class="row">

                <div class="col-md-12 mb-3">
                    <label for="nome">Título</label>
                    <input type="text" class="form-control" id="titulo_pergunta" name="titulo_pergunta" maxlength="100" required>
                    <input type="hidden" class="form-control" id="id_pessoa" name="id_pessoa" maxlength="100" value="<?php echo $_SESSION['id_pessoa'] ?>" required>
                    <input type="hidden" class="form-control" id="id_departamento" name="id_departamento" maxlength="100" value="1" required>

                </div>

                <div class="col-md-12 mb-3">
                    <label for="matricula">Descrição</label>
                    <input type="text" class="form-control" id="descricao_pergunta" name="descricao_pergunta" maxlength="50" value="" required>
                </div>              

            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Alterar</button>
          </div>
        </div>
      </div>
    </div>
</form>