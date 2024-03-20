<form action="php/edita/pessoa.php" method="post" autocomplete="off">
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
                        <option value="1">AMBULATÓRIO</option>
                        <option value="2">CESO</option>
                        <option value="3">HCTCO</option>
                        <option value="4">PROARTE</option>
                        <option value="5" selected>SEDE</option>
                        <option value="6">Q.PARAISO</option>
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

<div class="container-fluid">
  <footer class="p-5 pt-5 pb-0">
    <div class="d-flex flex-column flex-sm-row justify-content-between border-top pt-1">
      <p>© 2024 Feso, Todos direitos reservados.</p>
      <ul class="list-unstyled d-flex">
        <li class="ms-3">
            <a class="link-body-emphasis" href="#">
                <i class="fa-brands fa-instagram"></i>
            </a>
        </li>
        <li class="ms-3">
            <a class="link-body-emphasis" href="#">
                <i class="fa-brands fa-facebook"></i>
            </a>
          </li>
        <li class="ms-3">
            <a class="link-body-emphasis" href="#">
                <i class="fa-brands fa-youtube"></i>
            </a>
          </li>
      </ul>
    </div>
  </footer>
</div>