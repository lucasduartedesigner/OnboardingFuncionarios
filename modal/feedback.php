<form action="php/cadastra/feedback.php" method="post" autocomplete="off">
    <div class="modal" id="mensagem-modal">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h4 class="modal-title">Cadastro de Feedback</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
            <div class="row">

                <div class="col-md-12 mb-3">
                    <label class="mb-2" for="avaliacao">Avaliação</label>
                    <div id="avaliacao" class="star-rating">
                        <input type="hidden" name="avaliacao" id="avaliacao_feedback" value="">
                        <?php for($i=1; $i<=5; $i++): ?>
                            <i class="fa-star fa-regular fa-2x text-sencondary" data-value="<?php echo $i; ?>"></i>
                        <?php endfor; ?>
                    </div>
                </div> 

                <div class="col-md-12 mb-3">
                    <label for="nome">Título</label>
                    <input type="text" class="form-control" id="titulo_feedback" name="titulo_feedback" maxlength="100" required>
                    <input type="hidden" class="form-control" id="id_pessoa" name="id_pessoa" maxlength="100" value="<?php echo $_SESSION['id_pessoa'] ?>" required>
                    <input type="hidden" class="form-control" id="id_departamento" name="id_departamento" maxlength="100" value="1" required>
                </div>

                <div class="col-md-12 mb-3">
                    <label for="matricula">Descrição</label>                    
                    <textarea class="form-control" id="descricao_feedback" name="descricao_feedback" maxlength="1000" value="" required rows="3"></textarea>
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