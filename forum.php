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

        <?php

            function datetimeDiferencaEmMinutos($dataHora)
            {
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
    </main>

    <?php include_once "modal/mensagem.php"; ?>
    <?php include_once "modal/resposta.php"; ?>

    <?php include_once "template/footer.php"; ?>
    <?php include_once "template/js.php"; ?>
    <script>
        
        function pesquisa()
        {
            var pesquisa = $('#pesquisa').val()

            window.location.href = "forum.php?pesquisa=" + pesquisa
        }
    </script>
</body>
</html>