<<<<<<< HEAD
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
                         INNER JOIN pessoa_tarefa pt ON pt.id_tarefa = t.id_tarefa AND pt.id_pessoa = :id_pessoa
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
                    $dt_begin = dataToBR($resultado['dt_begin']);
                    $dt_end   = dataToBR($resultado['dt_end']);

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
                                $data = (!empty($result_item['dt_begin']) && !empty($result_item['dt_begin'])) ? dataToBR($result_item['dt_begin'])." até ". dataToBR($result_item['dt_end']) : '';

                                echo "<li class='list-group-item'>";
                                echo "<div class='my-2 form-check'>
                                        <input type='checkbox' class='form-check-input itemtarefa' id='".$result_item['id_item_tarefa']."' $checked>
                                        <label class='form-check-label' for='".$result_item['id_item_tarefa']."'>".$result_item['nome']."</label>
                                      </div>";
                                echo "<div class='text-muted d-grid d-flex justify-content-between' style='font-size: .85em;'>
                                        <small>".$data."</small>
                                        <a onclick='itemTarefa(". $resultado['id_tarefa'] . ", " . $result_item['id_item_tarefa'].")' class='btn btn-sm me-1'>
                                          <i class='fa-solid fa-ellipsis-vertical'></i>
                                        </a>
                                      </div>";
                                echo "</li>";
                           }
                        }
                    ?>
                  </ul>
                  <div class="card-body d-grid d-flex justify-content-between">
                    <div>
                        <a onclick="tarefa(<?= $resultado['id_tarefa'] ?>)" class="btn btn-sm me-1 rounded-circle btn-success">
                            <i class="fa-solid fa-edit"></i>
                        </a>
                        <a onclick="itemTarefa(<?= $resultado['id_tarefa'] ?>)" class="btn btn-sm me-1 rounded-circle btn-success">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                        <a class="btn btn-sm btn-danger rounded-circle deletar" data-nome="<?= $resultado['nome'] ?>" data-id="<?= $resultado['id_tarefa'] ?>" data-table="tarefa">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                      <?php if(!empty($dt_begin) && !empty($dt_end)) { echo $dt_begin .' até '. $dt_end; } ?>
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

        function itemTarefa(id, item)
        {
            if(item)
            {
                $('#id_item_tarefa').val(item)

                $('#form-item-tarefa').attr('action', 'php/edit/itemtarefa.php')

                $.ajax({
                    type: 'POST',
                    url: 'php/search/item_tarefa.php',
                    data: { id : item },
                    dataType: 'json',
                }).done(function(response) {

                    $('#nome1').val(response['nome'])
                    $('#dt_begin1').val(response['dt_begin'])
                    $('#dt_end1').val(response['dt_end'])

                    if(response['status'] == 1)
                    {
                        $('#status1').prop('checked', true);
                    }

                    $('#modalItemTarefa').modal('toggle')
                });
            }
            else
            {
                $('#id_tarefa1').val(id)
                
                $('#modalItemTarefa').modal('toggle')
            }
        }

        function tarefa(id)
        {
            $('#id_tarefa').val(id)

            $('#formTarefa').attr('action', 'php/edit/tarefa.php')
            
            $.ajax({
                type: 'POST',
                url: 'php/search/tarefa.php',
                data: { id : id },
                dataType: 'json',
            }).done(function(response) {
                
                $('#nome').val(response['nome'])
                $('#dt_begin').val(response['dt_begin'])
                $('#dt_end').val(response['dt_end'])

                if(response['status'] == 1)
                {
                    $('#status').prop('checked', true);
                }

                $('#modalTarefa').modal('toggle');
            });
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
        
		$('#modalTarefa').on('hidden.bs.modal', function () {

            $('#id_tarefa').val('')
            $('#nome').val('')
            $('#dt_begin').val('')
            $('#dt_end').val('')
 
            $('#formTarefa').attr('action', 'php/cadastra/tarefa.php')
		});
        
		$('#modalItemTarefa').on('hidden.bs.modal', function () {

            $('#id_item_tarefa').val('')
            $('#nome1').val('')
            $('#dt_begin1').val('')
            $('#dt_end1').val('')
            $('#status1').prop('checked', false);

            $('#form-item-tarefa').attr('action', 'php/cadastra/itemtarefa.php')
		});

    </script>
  </body>
=======
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
                         INNER JOIN pessoa_tarefa pt ON pt.id_tarefa = t.id_tarefa AND pt.id_pessoa = :id_pessoa
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
                    $dt_begin = dataToBR($resultado['dt_begin']);
                    $dt_end   = dataToBR($resultado['dt_end']);

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
                                $data = (!empty($result_item['dt_begin']) && !empty($result_item['dt_begin'])) ? dataToBR($result_item['dt_begin'])." até ". dataToBR($result_item['dt_end']) : '';

                                echo "<li class='list-group-item'>";
                                echo "<div class='my-2 form-check'>
                                        <input type='checkbox' class='form-check-input itemtarefa' id='".$result_item['id_item_tarefa']."' $checked>
                                        <label class='form-check-label' for='".$result_item['id_item_tarefa']."'>".$result_item['nome']."</label>
                                      </div>";
                                echo "<div class='text-muted d-grid d-flex justify-content-between' style='font-size: .85em;'>
                                        <small>".$data."</small>
                                        <a onclick='itemTarefa(". $resultado['id_tarefa'] . ", " . $result_item['id_item_tarefa'].")' class='btn btn-sm me-1'>
                                          <i class='fa-solid fa-ellipsis-vertical'></i>
                                        </a>
                                      </div>";
                                echo "</li>";
                           }
                        }
                    ?>
                  </ul>
                  <div class="card-body d-grid d-flex justify-content-between">
                    <div>
                        <a onclick="tarefa(<?= $resultado['id_tarefa'] ?>)" class="btn btn-sm me-1 rounded-circle btn-success">
                            <i class="fa-solid fa-edit"></i>
                        </a>
                        <a onclick="itemTarefa(<?= $resultado['id_tarefa'] ?>)" class="btn btn-sm me-1 rounded-circle btn-success">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                        <a class="btn btn-sm btn-danger rounded-circle deletar" data-nome="<?= $resultado['nome'] ?>" data-id="<?= $resultado['id_tarefa'] ?>" data-table="tarefa">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                      <?php if(!empty($dt_begin) && !empty($dt_end)) { echo $dt_begin .' até '. $dt_end; } ?>
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

        function itemTarefa(id, item)
        {
            if(item)
            {
                $('#id_item_tarefa').val(item)

                $('#form-item-tarefa').attr('action', 'php/edit/itemtarefa.php')

                $.ajax({
                    type: 'POST',
                    url: 'php/search/item_tarefa.php',
                    data: { id : item },
                    dataType: 'json',
                }).done(function(response) {

                    $('#nome1').val(response['nome'])
                    $('#dt_begin1').val(response['dt_begin'])
                    $('#dt_end1').val(response['dt_end'])

                    if(response['status'] == 1)
                    {
                        $('#status1').prop('checked', true);
                    }

                    $('#modalItemTarefa').modal('toggle')
                });
            }
            else
            {
                $('#id_tarefa1').val(id)
                
                $('#modalItemTarefa').modal('toggle')
            }
        }

        function tarefa(id)
        {
            $('#id_tarefa').val(id)

            $('#formTarefa').attr('action', 'php/edit/tarefa.php')
            
            $.ajax({
                type: 'POST',
                url: 'php/search/tarefa.php',
                data: { id : id },
                dataType: 'json',
            }).done(function(response) {
                
                $('#nome').val(response['nome'])
                $('#dt_begin').val(response['dt_begin'])
                $('#dt_end').val(response['dt_end'])

                if(response['status'] == 1)
                {
                    $('#status').prop('checked', true);
                }

                $('#modalTarefa').modal('toggle');
            });
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
        
		$('#modalTarefa').on('hidden.bs.modal', function () {

            $('#id_tarefa').val('')
            $('#nome').val('')
            $('#dt_begin').val('')
            $('#dt_end').val('')
 
            $('#formTarefa').attr('action', 'php/cadastra/tarefa.php')
		});
        
		$('#modalItemTarefa').on('hidden.bs.modal', function () {

            $('#id_item_tarefa').val('')
            $('#nome1').val('')
            $('#dt_begin1').val('')
            $('#dt_end1').val('')
            $('#status1').prop('checked', false);

            $('#form-item-tarefa').attr('action', 'php/cadastra/itemtarefa.php')
		});

    </script>
  </body>
>>>>>>> 6de3e2f9dc8878a2f59a1fcdca1a8cd17121abe6
</html>