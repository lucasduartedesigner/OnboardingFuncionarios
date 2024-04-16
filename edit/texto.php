<?php

  $sql = "SELECT * FROM campus WHERE id_campus = :id ORDER BY id_campus";

  $stmt = $conn->prepare($sql);

  $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_STR);

  $stmt->execute();

  $campus = $stmt->fetch(PDO::FETCH_ASSOC);

  extract($campus);

  $checked = ($status == 1) ? 'checked' : '';

?>

<form method="post" action="php/edit/campus.php">

    <h1>Formulário Campus</h1>

    <input type="hidden" name="id_campus" id="id_campus" value="<?= $id_campus; ?>">

      <div class="row">
          <div class="col-lg-12">
            <div class="mb-3">
              <label for="nome" class="form-label">Nome do Campus</label>
              <input type="text" class="form-control" id="nome" name="nome" maxlength="100" value="<?= $nome; ?>">
            </div>
          </div>

          <div class="col-lg-12">
            <div class="mb-3">
              <label for="nome" class="form-label">Link Imagem</label>
              <input type="text" class="form-control" id="imagem" name="imagem" maxlength="255" value="<?= $imagem; ?>">
            </div>
          </div>

          <div class="col-lg-6">
            <div class="mb-3">
              <label for="nome" class="form-label">Texto</label>
              <textarea type="text" class="form-control" id="texto" name="texto" rows="4"><?= $texto; ?></textarea>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="mb-3">
              <label for="nome" class="form-label">Missão</label>
              <textarea type="text" class="form-control" id="missao" name="missao" rows="4" maxlength="1000"><?= $missao; ?></textarea>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="mb-3">
              <label for="nome" class="form-label">Visão</label>
              <textarea type="text" class="form-control" id="visao" name="visao" rows="4" maxlength="1000"><?= $visao; ?></textarea>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="mb-3">
              <label for="nome" class="form-label">Valores</label>
              <textarea type="text" class="form-control" id="valores" name="valores" rows="4" maxlength="1000"><?= $valores; ?></textarea>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="mb-3">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="status" name="status" value="1" <?= $checked; ?>>
                <label class="form-check-label" for="status">Status</label>
              </div>
            </div>
          </div>
      </div>
  
    <button type="submit" class="btn btn-success">Salvar</button>

</form>