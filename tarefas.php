<?php include_once "template/config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">

  <?php include_once "template/head.php"; ?>

  <body>

    <?php include_once "template/header.php"; ?>

    <main role="main" class="container">
        <div class="d-grid d-flex justify-content-between mb-4 mt-5">
            <h2 class="featurette-heading fw-normal lh-1">Checklist de Tarefas</h2>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTarefa">Adicionar</button>
        </div>

        <div class="row">
            <?php 

            $consulta = "SELECT t.id_tarefa, t.nome, t.status, t.dt_begin, t.dt_end
                         FROM tarefa t 
                         LEFT JOIN pessoa_tarefa pt ON pt.id_tarefa = t.id_tarefa AND pt.id_pessoa = :id_pessoa
                         WHERE t.status IS NOT NULL
                         GROUP BY t.id_tarefa, t.nome, t.status, t.dt_begin, t.dt_end ";

            //Prepara a consulta para o banco
            $response = $conn->prepare($consulta);

            //Passa os parametros via bind para evitar SQL Inject
            $response->bindParam(':id_pessoa', $_SESSION['id_pessoa'], PDO::PARAM_STR);

            //Executa a consulta 
            $response->execute();

            //Verifica se existe dados para retornar
            if ($response->rowCount() > 0) 
            {
                //Coloca os dados retornados em uma variavel
                while ($resultado = $response->fetch(PDO::FETCH_ASSOC)) 
                {
                    
                    $dt_begin = DateTime::createFromFormat('Y-m-d', $resultado['dt_begin'])->format('d/m/Y');
                    $dt_end   = DateTime::createFromFormat('Y-m-d', $resultado['dt_end'])->format('d/m/Y');


                    if($resultado['status'] == 1)
                    {
                        $status = 'Finalizado';
                        $status_color = 'text-bg-success';
                    }
                    else
                    {
                        $status = 'Pendente';
                        $status_color = 'text-bg-warning';
                    }

            ?>
            <div class="col-4 mb-5">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title d-flex justify-content-between"><?= $resultado['nome'] ?><span class="badge <?= $status_color ?>"><?= $status ?></span></h5>
                  </div>
                  <ul class="list-group list-group-flush">
                    <?php
                        $sql_item = "SELECT it.id_item_tarefa, it.id_tarefa, it.nome, it.status, it.dt_begin, it.dt_end
                                     FROM item_tarefa it 
                                     LEFT JOIN pessoa_tarefa pt ON pt.id_tarefa = it.id_tarefa AND pt.id_pessoa = :id_pessoa
                                     WHERE it.status IS NOT NULL
                                     AND it.id_tarefa = :id_tarefa
                                     GROUP BY it.id_item_tarefa, it.id_tarefa, it.nome, it.status, it.dt_begin, it.dt_end
                                     ORDER BY it.id_item_tarefa ";

                        //Prepara a consulta para o banco
                        $res_item = $conn->prepare($sql_item);

                        //Passa os parametros via bind para evitar SQL Inject
                        $res_item->bindParam(':id_pessoa', $_SESSION['id_pessoa'], PDO::PARAM_STR);
                        $res_item->bindParam(':id_tarefa', $resultado['id_tarefa'], PDO::PARAM_STR);

                        //Executa a consulta 
                        $res_item->execute();

                        //Verifica se existe dados para retornar
                        if ($res_item->rowCount() > 0) 
                        {
                            //Coloca os dados retornados em uma variavel
                            while ($result_item = $res_item->fetch(PDO::FETCH_ASSOC)) 
                            {

                                $checked = (!empty($result_item['status'])) ? 'checked' : '';

                                echo "<li class='list-group-item'>";
                                echo "<div class='mb-3 form-check'>
                                        <input type='checkbox' class='form-check-input itemtarefa' id='".$result_item['id_item_tarefa']."' $checked>
                                        <label class='form-check-label' for='".$result_item['id_item_tarefa']."'>".$result_item['nome']."</label>
                                      </div>";
                                echo "</li>";
                           }
                        }
                    ?>
                  </ul>
                  <div class="card-body d-grid d-flex justify-content-between">
                    <div>
                        <a href="tarefas.php?id=<?= $resultado['id_tarefa'] ?>" class="btn btn-success">Editar</a>
                        <a onclick="itemTarefa(<?= $resultado['id_tarefa'] ?>)" class="btn btn-success">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </div>
                      <?= $dt_begin ?> até <?= $dt_end ?>
                  </div>
                </div>
            </div>
            <?php
                }
            } 
            ?>
        </div>
    </main>

    <?php include_once "modal/tarefas.php"; ?>
    <?php include_once "modal/itemtarefa.php"; ?>
    <?php include_once "template/footer.php"; ?>
    <?php include_once "template/js.php"; ?>
    <script>

        function itemTarefa(id)
        {
            console.log(id)

            $('#id_tarefa_item').val(id)

            $('#modalItemTarefa').modal('toggle');
        }

        $('.itemtarefa').change(function(){

            var id = $(this).attr('id')
            var status

            if ($(this).prop('checked')) 
            {
                status = 1
            } 
            else 
            {
               status = 0
            }

            $.ajax({
                type: 'POST',
                url: 'php/check/itemtarefa.php',
                data: { 
                        id : id,
                        status : status
                      }
            })
        })

    </script>
  </body>
</html>