<?php

  $sql = "SELECT * FROM documentos WHERE id_documentos = :id ORDER BY id_documentos";

  $stmt = $conn->prepare($sql);

  $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_STR);

  $stmt->execute();

  $campus = $stmt->fetch(PDO::FETCH_ASSOC);

  extract($campus);

  $checked = ($status == 1) ? 'checked' : '';

?>

<form method="post" action="php/edit/recursos.php">

    <h1>Formulário Documento</h1>

    <input type="hidden" name="id_documentos" id="id_documentos" value="<?= $id_documentos; ?>">

      <div class="row">
          <div class="col-lg-12">
            <div class="mb-3">
              <label for="nome" class="form-label">Titulo do Documento</label>
              <input type="text" class="form-control" id="titulo" name="titulo" maxlength="100" value="<?= $titulo; ?>">
            </div>
          </div>
          <div class="col-lg-12">
            <div class="mb-3">
              <label for="nome" class="form-label">Nome do Documento</label>
              <input type="text" class="form-control" id="nome" name="nome" maxlength="100" value="<?= $nome; ?>">
            </div>
          </div>

          <div class="col-lg-12">
            <div class="mb-3">
              <label for="nome" class="form-label">Link Imagem</label>
              <input type="text" class="form-control" id="imagem" name="imagem" maxlength="255" value="<?= $imagem; ?>">
            </div>
          </div>
          
          <div class="col-lg-10">
            <div class="mb-3">
              <label for="nome" class="form-label">Caminho Arquivo</label>
              <input type="text" class="form-control" id="caminho_arquivo" name="caminho_arquivo" maxlength="255" value="<?= $caminho_arquivo; ?>">
            </div>
          </div>
          
          <div class="col-lg-2">
            <div class="mb-3">
              <label for="nome" class="form-label">Tipo Arquivo</label>
                <select class="form-select" id="tipo_arquivo" name="tipo_arquivo">
                    <?php 
                        $consulta = "SELECT * FROM tipo_arquivo";

                        //Prepara a consulta para o banco
                        $response = $conn->prepare($consulta);

                        //Executa a consulta 
                        $response->execute();

                        //Verifica se existe dados para retornar
                        if ($response->rowCount() > 0) 
                        {
                            //Coloca os dados retornados em uma variavel
                            while ($resultado = $response->fetch(PDO::FETCH_ASSOC)) 
                            {   
                                
                                if($resultado['formato'] == $tipo_arquivo)
                                { 
                                    $selected = "selected";
                                }
                                else
                                {
                                   $selected = ""; 
                                }

                        ?>
                            <option value="<?= $resultado['formato'] ?>" <?= $selected ?>><?= $resultado['descricao'] ?></option>
                        <?php }} ?>
                </select>
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