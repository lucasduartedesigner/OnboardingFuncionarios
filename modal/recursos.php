<form method="post" action="php/cadastra/recursos.php">
    <div class="modal fade" id="modalRecursos" tabindex="-1" aria-labelledby="modalTarefaLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTarefaLabel">Formulário recursos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="row">
          <div class="col-lg-12">
            <div class="mb-3">
              <label for="nome" class="form-label">Titulo do Documento</label>
              <input type="text" class="form-control" id="titulo" name="titulo" maxlength="100">
            </div>
          </div>
          <div class="col-lg-12">
            <div class="mb-3">
              <label for="nome" class="form-label">Nome do Documento</label>
              <input type="text" class="form-control" id="nome" name="nome" maxlength="100">
            </div>
          </div>

          <div class="col-lg-12">
            <div class="mb-3">
              <label for="nome" class="form-label">Link Imagem</label>
              <input type="text" class="form-control" id="imagem" name="imagem" maxlength="255">
            </div>
          </div>
          
          <div class="col-lg-8">
            <div class="mb-3">
              <label for="nome" class="form-label">Caminho Arquivo</label>
              <input type="text" class="form-control" id="caminho_arquivo" name="caminho_arquivo" maxlength="255">
            </div>
          </div>
          
          <div class="col-lg-4">
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
                        ?>
                            <option value="<?= $resultado['formato'] ?>"><?= $resultado['descricao'] ?></option>
                        <?php }} ?>
                </select>
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