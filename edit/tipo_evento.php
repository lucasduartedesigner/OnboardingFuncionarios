<?php

  $sql = "SELECT * FROM tipo_evento WHERE id_tipo_evento = :id ORDER BY id_tipo_evento";

  $stmt = $conn->prepare($sql);

  $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_STR);

  $stmt->execute();

  $campus = $stmt->fetch(PDO::FETCH_ASSOC);

  extract($campus);

  $checked = ($status == 1) ? 'checked' : '';

?>

<form method="post" action="php/edit/tipo_evento.php">

    <h1>Formulário Tipo Evento</h1>

    <input type="hidden" name="id_tipo_evento" id="id_tipo_evento" value="<?= $id_tipo_evento; ?>">

      <div class="row">
          <div class="col-lg-12">
            <div class="mb-3">
              <label for="nome" class="form-label">Nome do Tipo Evento</label>
              <input type="text" class="form-control" id="nome" name="nome" maxlength="100" value="<?= $nome; ?>">
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