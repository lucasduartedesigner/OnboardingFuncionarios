<?php include_once "template/config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">

  <?php include_once "template/head.php"; ?>

  <body>

    <?php include_once "template/header.php"; ?>

    <main role="main" class="container">
        <?php 

            if(!empty($_GET['id']))
            {
                include_once('edit/departamento.php');
            }
            else
            {
                include_once('list/departamento.php');
            }

        ?>
    </main>

    <?php include_once "modal/departamento.php"; ?>
    <?php include_once "template/footer.php"; ?>
    <?php include_once "template/js.php"; ?>

  </body>
</html>