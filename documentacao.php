<?php include_once "template/config.php"; ?>
<!DOCTYPE html>
<html lang="pt-br">

  <?php include_once "template/head.php"; ?>

  <body>

    <?php include_once "template/header.php"; ?>


    <!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="/docs/5.3/assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Album example · Bootstrap v5.3</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">

    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

<link href="/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
<link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#712cf9">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
    </style>
  

<main>

  <section class="py-1 text-center container">
    <div class="row py-lg-2">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light"><b>Recursos e Documentação</b></h1>
        <p class="lead text-body-secondary">Seja bem-vindo aos documentos e recursos! Neste espaço, você terá acesso a todo o conteúdo inicial! Seja bem-vindo!</p>
        <p>
        <button type="button" class="btn btn-success">Documentos</button>
                  <button type="button" class="btn btn-success">Vídeos</button>
        </p>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-body-tertiary">
    <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
<!--manual do colaborador-->
<?php 

$consulta = "SELECT nome, titulo, caminho_arquivo, tipo_arquivo, imagem FROM documentos WHERE status = 1 ORDER BY data";

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
        
        
?>

        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="0" xmlns="http://www.w3.org/2000/svg"role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><text x="50%" y="50%" fill="#eceeef" dy=".3em">
              <img src="<?= $resultado['imagem'] ?>" class="rounded-top" alt="Cinque Terre"></text></svg>
            <div class="card-body">
              <p class="card-text"><?= $resultado['nome'] ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="<?= $resultado['caminho_arquivo'] ?>" class="btn btn-success" target="_blank"><?= $resultado['titulo'] ?></a>
                </div>
                <small class="text-body-secondary">9 mins</small>
              </div>
            </div>
          </div>
        </div>
<?php
    }
} 
?>
</div>

<!--vídeo ambientação
                <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="0" xmlns="http://www.w3.org/2000/svg"role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><text x="50%" y="50%" fill="#eceeef" dy=".3em"><img src="https://www.unifeso.edu.br/cursos/images/cursos/head/632739744f3d488a5a7b4910caf4f306.png" class="rounded" alt="Cinque Terre"></text></svg>
            <div class="card-body">
              <p class="card-text">Acesse aqui, o seu manual do colaborador!</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-success">Manual do Colaborador</button>
                </div>
                <small class="text-body-secondary">9 mins</small>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="0" xmlns="http://www.w3.org/2000/svg"role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><text x="50%" y="50%" fill="#eceeef" dy=".3em"><img src="https://www.unifeso.edu.br/cursos/images/cursos/head/632739744f3d488a5a7b4910caf4f306.png" class="rounded" alt="Cinque Terre"></text></svg>
            <div class="card-body">
              <p class="card-text">Acesse aqui, o seu manual do colaborador!</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-success">Manual do Colaborador</button>
                </div>
                <small class="text-body-secondary">9 mins</small>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="0" xmlns="http://www.w3.org/2000/svg"role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><text x="50%" y="50%" fill="#eceeef" dy=".3em"><img src="https://www.unifeso.edu.br/cursos/images/cursos/head/632739744f3d488a5a7b4910caf4f306.png" class="rounded" alt="Cinque Terre"></text></svg>
            <div class="card-body">
              <p class="card-text">Acesse aqui, o seu manual do colaborador!</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-success">Manual do Colaborador</button>
                </div>
                <small class="text-body-secondary">9 mins</small>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
-->
</main>

<footer class="text-body-secondary py-5">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#">Voltar para o início</a>
    </p>

</footer>
<script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </body>
</html>

    
    <?php include_once "template/footer.php"; ?>

    <?php include_once "template/js.php"; ?>

  </body>
</html>