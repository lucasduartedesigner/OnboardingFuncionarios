<form method="post" action="php/cadastra/participante.php" id="form-participante">

    <input type="hidden" id="id_participante" name="id_participante">
    <input type="hidden" id="id_evento1" name="id_evento">

    <div class="modal fade" id="modalParticipante" tabindex="-1" aria-labelledby="modalParticipanteLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalParticipanteLabel">Formulário de Participante</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-sm-12">
                    <div class="mb-3">
                      <label for="nome" class="form-label">Nome</label>
                      <select id="id_pessoa" name="id_pessoa" class="form-control">
                          <?php

                            $sql_nome = "SELECT p.id_pessoa, p.nome
                                         FROM pessoa p
                                         WHERE p.status = 1
                                         AND NOT EXISTS (
                                                          SELECT 1 FROM participante pt WHERE pt.id_pessoa = p.id_pessoa
                                                        )
                                         ORDER BY p.nome ";

                            //Prepara a consulta para o banco
                            $res_nome = $conn->prepare($sql_nome);

                            //Executa a consulta 
                            $res_nome->execute();

                            //Verifica se existe dados para retornar
                            if ($res_nome->rowCount() > 0) 
                            {
                                //Coloca os dados retornados em uma variavel
                                while ($result_nome = $res_nome->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    extract($result_nome);

                                    echo "<option value='$id_pessoa'>$nome</option>";
                                }
                            }

                          ?>
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