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
                <h1 class="fw-light"><b>Feedback</b></h1>
                    <p class="lead text-body-secondary">
                        Os novos colaboradores têm a oportunidade de fornecer feedback sobre o processo de integração,
                         compartilhando suas impressões, sugestões de melhorias e eventuais preocupações.
                    </p>
                </div>
            </div>
        </section>
    </main>

<main class="container">

<?php 
    if(!empty($_GET['id']))
    {
        include_once('edit/feedback.php');
    }
    else
    {
        include_once('list/feedback.php');
    }

?>
</main>

    <?php include_once "modal/feedback.php"; ?>
    <?php include_once "template/footer.php"; ?>
    <?php include_once "template/js.php"; ?>

</body>
</html>