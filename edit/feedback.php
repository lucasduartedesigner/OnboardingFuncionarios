<?php 

    $consulta = "UPDATE feedback SET visualizacao = visualizacao + 1
                WHERE id_feedback = :id";

                //Prepara a consulta para o banco
                $response = $conn->prepare($consulta);

                $response->bindParam(':id', $_GET['id'], PDO::PARAM_STR);

                //Executa a consulta 
                $response->execute();

    $consulta = "SELECT f.id_feedback, f.titulo_feedback, f.id_pessoa, f.descricao_feedback, p.nome, 
                FROM feedback f 
                inner join pessoa p on f.id_pessoa = p.id_pessoa
                WHERE f.id_feedback = :id";

            //Prepara a consulta para o banco
            $response = $conn->prepare($consulta);

            $response->bindParam(':id', $_GET['id'], PDO::PARAM_STR);

            //Executa a consulta 
            $response->execute();

            //Verifica se existe dados para retornar
            if ($response->rowCount() > 0) {
                //Coloca os dados retornados em uma variavel
                while ($resultado = $response->fetch(PDO::FETCH_ASSOC)) {                      
                ?> 
                    <div class="inner-main-body1 p-2 collapse forum-content show">
                        <div class="card-body ">
                            <div class="media forum-item">
                                <div class="card text-center">
                                    <div class="card-header" style="background: #389C81">
                                        <!-- titulo -->
                                        <h6> 
                                            <a href="forum.php?id=<?= $resultado['id_feedback'] ?>" class="text-body"> 
                                            <?= $resultado['titulo_feedback'] ?> 
                                            </a>
                                        </h6>
                                        
                                    </div>
                                    <div class="media-body">
                                        <p class="text-secondary"> <?= $resultado['descricao_feedback'] ?> </p>    
                                            <div class="text-muted small ">
                                                <!-- icone resposta mesagem --> 
                                            <span data-bs-toggle="modal" data-bs-target="#resposta-modal"><i class="far fa-comment ml-1"></i> Nova Mensagem</span>                                                                   
                                            <a class="btn btn-sm btn-danger rounded-circle deletar" data-nome="<?= $resultado['descricao_feedback'] ?>" 
                                            data-id="<?= $resultado['id_feedback'] ?>" data-table="feedback">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                            </div>                                                                                                                           
                                    </div>
                                    <div class="card-footer ">
                                        <p class="text-muted mb-0"> Criado por <a href="javascript:void(0)"> <?= $resultado['nome'] ?></a></p>  
                                    </div>
                                </div>                                    
                        </div>                                                                                            
                    </div> 
                    </div>                                     
                <?php
                }
            }
?>

<?php                                                        

    $consulta = "SELECT r.id_forum_respostas, r.id_feedback, r.id_pessoa, r.resposta, r.data_respostas, p.nome  FROM forum_respostas r 
                inner join pessoa p on r.id_pessoa = p.id_pessoa
                WHERE r.id_feedback = :id";

    //Prepara a consulta para o banco
    $response = $conn->prepare($consulta);

    $response->bindParam(':id', $_GET['id'], PDO::PARAM_STR);

    //Executa a consulta 
    $response->execute();

    //Verifica se existe dados para retornar
    if ($response->rowCount() > 0) {
        //Coloca os dados retornados em uma variavel
        while ($resultado = $response->fetch(PDO::FETCH_ASSOC)) {                      
        ?> 
            <div class="inner-main-body1 p-2 collapse forum-content show " >
                <div class="card-body ">
                    <div class="media forum-item">
                        <div class="card text-center">
                            <div class="card-header" >
                                <!-- titulo -->
                                <h6>Resposta de <?= $resultado['nome'] ?></h6>
                            </div>
                            <div class="media-body">
                                <p class="text-secondary"> <?= $resultado['resposta'] ?> </p>                                                                                                                                                         
                            </div>
                            <div class="card-footer">
                                Respondido há <?= datetimeDiferencaEmMinutos($resultado['data_respostas']) ?> minutos atrás.
                            </div>
                        </div>                                    
                </div>                                                                                            
            </div> 
            </div>                                     
        <?php
        }
    }
?>