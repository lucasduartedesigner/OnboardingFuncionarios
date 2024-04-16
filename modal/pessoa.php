<form action="php/edit/pessoa.php" method="post" autocomplete="off">
    <div class="modal" id="perfil-modal">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h4 class="modal-title">Editar Dados</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
            <div class="row">

                <div class="col-md-7 mb-3">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" maxlength="100" value="<?php echo $_SESSION['nome'] ?>" required>
                </div>

                <div class="col-md-5 mb-3">
                    <label for="matricula">Matrícula</label>
                    <input type="text" class="form-control" id="matricula" name="matricula" maxlength="50" value="<?php echo $_SESSION['matricula'] ?>" required>
                </div>

                <div class="col-md-7 mb-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" maxlength="255" value="<?php echo $_SESSION['email'] ?>" required>
                </div>

                <div class="col-md-5 mb-3">
                    <label for="campus">Campus</label>
                    <select class="form-control" id="campus" name="campus" required>
                    <?php 
                        foreach($arrayCampus as $value)
                        {
                            $selected = ($_SESSION['id_campus'] == $value['id_campus']) ? 'selected' : '';

                            echo "<option value=".$value['id_campus']." $selected>".$value['nome']."</option>";
                        }
                    ?>
                    </select>
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