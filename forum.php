<?php include_once "template/config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">

  <?php include_once "template/head.php"; ?>

<body>

<?php include_once "template/header.php"; ?>

    <main role="main" class="container">
        <section class="py-1 text-center container">
            <div class="row py-lg-2">
                <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light"><b>Fórum</b></h1>
                    <p class="lead text-body-secondary">Um fórum interativo onde os colaboradores podem fazer perguntas, compartilhar experiências e receber orientações de colegas 
            mais experientes e da equipe de recursos humanos.</p>
                </div>
            </div>
        </section>
    </main>

    

<main class="container">

    <?php 
        function datetimeDiferencaEmMinutos($dataHora) {
            // Obter a data e hora atuais
            $dataAtual = date_create();

            // Definir a data e hora de comparação
            $dataComparacao = date_create($dataHora);

            // Calcular a diferença
            $diferenca = date_diff($dataAtual, $dataComparacao);

            // Converter a diferença para minutos
            $minutosDiferenca = $diferenca->days * 24 * 60 + $diferenca->h * 60 + $diferenca->i;

            return $minutosDiferenca;
        }

        if(!empty($_GET['id']))
        {
            include_once('edit/forum.php');
        }
        else
        {
            include_once('list/forum.php');
        }

    ?>

<!-- PAGINAÇÃO -->
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item disabled">    
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
        </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav>

</main>

    <?php include_once "modal/mensagem.php"; ?>
    <?php include_once "modal/resposta.php"; ?>
    <?php include_once "modal/pergunta.php"; ?>
    <?php include_once "template/footer.php"; ?>

    <?php include_once "template/js.php"; ?>

</body>
</html>