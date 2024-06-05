<?php include_once "template/config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">

  <?php include_once "template/head.php"; ?>

  <body>

    <?php include_once "template/header.php"; ?>

    <main role="main" class="container">
        <div class="d-grid d-flex justify-content-between mb-4 mt-5">
            <h2 class="featurette-heading fw-normal lh-1">Agendamento</h2>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEvento">Adicionar</button>
        </div>

        <div class="row">
            <?php 

            include_once "php/class/tipo_evento.php";

            $tipoEventoManager = new TipoEventoManager($conn);

            $arrayTipoEvento = $tipoEventoManager->getTipoEvento();

            $consulta = "SELECT e.id_evento, e.titulo, e.descricao, e.status, e.dt_begin, e.dt_end
                         FROM evento e 
                         INNER JOIN participante pt ON pt.id_evento = e.id_evento 
                         INNER JOIN tipo_evento te ON te.id_tipo_evento = e.id_tipo_evento
                         WHERE e.status IS NOT NULL
                         AND :id_pessoa IN (pt.id_pessoa, e.id_responsavel)
                         GROUP BY e.id_evento, e.titulo, e.descricao, e.status, e.dt_begin, e.dt_end ";

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
                    $dt_begin = dataHoraToBR($resultado['dt_begin']);
                    $dt_end   = dataHoraToBR($resultado['dt_end']);

                    switch ($resultado['status']) 
                    {
                        case 1:
                            $status = "Agendado"; $status_color = 'text-bg-primary';
                            break;
                        case 2:
                            $status = "Em andamento"; $status_color = 'text-bg-info';
                            break;
                        case 3:
                            $status = "Realizado"; $status_color = 'text-bg-success';
                            break;
                        case 4:
                            $status = "Cancelado"; $status_color = 'text-bg-danger';
                            break;
                        default:
                            $status = "Inválido"; $status_color = 'text-bg-warning';
                    }
            ?>
            <div class="col-6 mb-5">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title d-flex justify-content-between"><?= $resultado['titulo'] ?><span class="badge <?= $status_color ?>"><?= $status ?></span></h5>
                  </div>
                  <ul class="list-group list-group-flush">
                    <?php
                        $sql_item = "SELECT pt.id_participante, pt.status, p.nome, p.email
                                     FROM participante pt 
                                     INNER JOIN pessoa p ON pt.id_pessoa = p.id_pessoa
                                     WHERE pt.status IS NOT NULL
                                     AND pt.id_pessoa = :id_pessoa
                                     AND pt.id_evento = :id_evento
                                     GROUP BY pt.id_participante, pt.status, p.nome, p.email
                                     ORDER BY p.nome ";

                        //Prepara a consulta para o banco
                        $res_item = $conn->prepare($sql_item);

                        //Passa os parametros via bind para evitar SQL Inject
                        $res_item->bindParam(':id_pessoa', $_SESSION['id_pessoa'], PDO::PARAM_STR);
                        $res_item->bindParam(':id_evento', $resultado['id_evento'], PDO::PARAM_STR);

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
                                 echo "<div class='text-muted d-grid d-flex justify-content-between' style='font-size: .85em;'>
                                        <div class='my-2 form-check'>
                                        <input type='checkbox' class='form-check-input participante' id='".$result_item['id_participante']."' $checked>
                                        <label class='form-check-label' for='".$result_item['id_participante']."'>".$result_item['nome']."</label>
                                        </div>
                                        <a onclick='participante(". $resultado['id_evento'] . ", " . $result_item['id_participante'].")' class='btn btn-sm me-1'>
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
                        <a onclick="evento(<?= $resultado['id_evento'] ?>)" class="btn btn-sm me-1 rounded-circle btn-success">
                            <i class="fa-solid fa-edit"></i>
                        </a>
                        <a onclick="participante(<?= $resultado['id_evento'] ?>)" class="btn btn-sm me-1 rounded-circle btn-success">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <a class="btn btn-sm btn-danger rounded-circle deletar" data-nome="<?= $resultado['titulo'] ?>" data-id="<?= $resultado['id_evento'] ?>" data-table="evento">
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

    <?php include_once "modal/evento.php"; ?>
    <?php //include_once "modal/participante.php"; ?>
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

        function evento(id)
        {
            $('#id_evento').val(id)

            $('#formEvento').attr('action', 'php/edit/evento.php')

            $.ajax({
                type: 'POST',
                url: 'php/search/evento.php',
                data: { id : id },
                dataType: 'json',
            }).done(function(response) {

                $('#titulo').val(response['titulo'])
                $('#dt_begin').val(response['dt_begin'])
                $('#dt_end').val(response['dt_end'])
                $('#tipo_evento').val(response['id_tipo_evento'])
                $('#status').val(response['status'])
                $('#descricao').val(response['descricao'])
                $('#link').val(response['link'])

                $('#modalEvento').modal('toggle');
            });
        }

        $('.participante').change(function(){

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
                url: 'php/check/participante.php',
                data: { 
                        id     : id,
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
</html>