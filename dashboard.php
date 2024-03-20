<?php include_once "template/config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">

  <?php include_once "template/head.php"; ?>

  <body>

    <?php include_once "template/header.php"; ?>

    <main role="main" class="container">
      <div class="row featurette mt-4">
        <div class="col-md-12">
          <h2 class="featurette-heading fw-normal lh-1 mb-4 mt-5">Olá <?php echo $_SESSION['nome']; ?>, bem vindo à plataforma de orientações iniciais da FESO.</h2>
        </div>
        <div class="col-md-7">
          <?php echo $_SESSION['texto']; ?> 
        </div>
        <div class="col-md-5 align-self-center">
          <img src="<?php echo $_SESSION['imagem']; ?> " width="500">
        </div>
      </div>
    </main>

    <?php include_once "template/footer.php"; ?>

    <?php include_once "template/js.php"; ?>

  </body>
</html>