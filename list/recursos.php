<div class="d-grid d-flex justify-content-between mb-4 mt-5">
    <h2 class="featurette-heading fw-normal lh-1">Recursos e Documentação</h2>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRecursos">Adicionar Documento</button>
</div>

<div class="card p-1">
    <table class="table border-radius pb-0">
      <thead>
        <tr>
          <th width="1" scope="col"></th>
          <th scope="col">Titulo</th>
          <th scope="col">Nome</th>
          <th width="1" scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php

        $consulta = "SELECT id_documentos, titulo, nome FROM documentos WHERE status IS NOT NULL ";

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
                echo "<tr>
                        <td>
                          <a class='btn btn-sm btn-success me-2 rounded-circle' href='recursos.php?id={$resultado['id_documentos']}'>
                            <i class='fa-solid fa-edit'></i>
                          </a>
                        </td>
                        <td>{$resultado['titulo']}</td>
                        <td>{$resultado['nome']}</td>
                        <td>
                          <a class='btn btn-sm btn-danger me-2 rounded-circle deletar' data-nome='{$resultado['nome']}' data-id='{$resultado['id_documentos']}' data-table='documentos'>
                            <i class='fa-solid fa-trash'></i>
                          </a>
                        </td>
                      </tr>";
            }
        } 

        ?>
      </tbody>
    </table>
</div>
