<form action="php/cadastra/forum.php" method="post" autocomplete="off">
    <div class="modal" id="pergunta-modal">
      <div class="modal-dialog-md">
        <div class="modal-content">

          <div class="modal-header">
            <h4 class="modal-title"> exemplo </h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
            <div class="row">
                <?php 
                
                    $consulta = "SELECT f.titulo_pergunta, f.id_pessoa, f.id_departamento, f.descricao_pergunta, p.nome, f.data_pergunta FROM forum_perguntas f 
                    inner join pessoa p on f.id_pessoa = p.id_pessoa";

                    //Prepara a consulta para o banco
                    $response = $conn->prepare($consulta);

                    //Executa a consulta 
                    $response->execute();

                    //Verifica se existe dados para retornar
                    if ($response->rowCount() > 0) {
                        //Coloca os dados retornados em uma variavel
                        while ($resultado = $response->fetch(PDO::FETCH_ASSOC)) {                      
                        ?> 
                            <div class="inner-main-body p-2 p-sm-3 collapse forum-content show">
                                <div class="card-body ">
                                    <div class="media forum-item">
                                        <div class="card text-center">
                                            <div class="card-header">
                                                <!-- titulo -->
                                                <h6> 
                                                    <a href="#" data-toggle="collapse" data-target=".forum-content" 
                                                    class="text-body" data-bs-toggle="modal" data-bs-target="#titulo_pergunta-modal"> 
                                                    <?= $resultado['titulo_pergunta'] ?> 
                                                    </a>
                                                </h6>
                                            </div>
                                            <div class="media-body">
                                                <p class="text-secondary"> <?= $resultado['descricao_pergunta'] ?> </p>                                                                                                                                                                                 
                                            </div>
                                            <div class="card-footer ">
                                                <p class="text-muted"> Criado por <a href="javascript:void(0)"> <?= $resultado['nome'] ?></a> <span class="text-secondary font-weight-bold">
                                                <?= datetimeDiferencaEmMinutos($resultado['data_pergunta']) ?> há minutos atrás.</span></p>  
                                            </div>
                                        </div>                                    
                                </div>                                                                                            
                            </div>                                     
                        <?php
                        }
                    }
                ?>  

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