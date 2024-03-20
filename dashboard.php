<?php

    session_start();

    if(empty($_SESSION['token']))
    {
        header("Location: index.html");

        exit();
    }

    function obterNomeCampus($valor)
    {
        switch ($valor) {
            case '1':
                return 'AMBULATÓRIO';
                break;
            case '2':
                return 'CESO';
                break;
            case '3':
                return 'HCTCO';
                break;
            case '4':
                return 'PROARTE';
                break;
            case '5':
                return 'SEDE';
                break;
            case '6':
                return 'Q.PARAISO';
                break;
            default:
                return 'Campus desconhecido';
                break;
        }
    }

    $nomeCampus = obterNomeCampus($_SESSION['campus']);

?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://www.unifeso.edu.br/images/favicon.png">

    <title>Portal do Colaborador</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      
    <link href="https://getbootstrap.com.br/docs/4.1/examples/starter-template/starter-template.css" rel="stylesheet">
  </head>

  <body>

    <header data-bs-theme="dark">
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" style="background-color: #006b64 !important; ">
        <div class="container-fluid">
          <a class="navbar-brand ms-4" href="#"><img src="https://unifeso.edu.br/apps/assets/img/feso.png" alt="" width="100"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Tarefas</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Recursos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Documentação</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Agendamento</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Fórum</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Feedback</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" style="background-color: #006b64 !important;border-color: #fff" type="search" placeholder="Digite a busca" aria-label="Search">
              <button class="btn btn-outline-light me-2" type="submit">Procurar</button>
              <a class="btn btn-danger rounded" href="index.html">Sair</a>
            </form>
          </div>
        </div>
      </nav>
    </header>

    <main role="main" class="container">
        
    <div class="row featurette mt-5">
      <div class="col-md-7">
        <h2 class="featurette-heading fw-normal lh-1 mb-4 mt-5">Olá <?php echo $_SESSION['nome']; ?>, bem vindo à plataforma de orientações iniciais da FESO.</h2>
        <p class="lead">A partir de agora você faz parte do campus <?php echo $nomeCampus ?>.</p>
        <p class="lead">Esta plataforma tem por objetivo facilitar a sua adaptação às nossas políticas e cultura institucional. </p>    
            Nela você vai encontrar informações financeiras, benefícios, normas de trabalho e responsabilidades e os principais canais de comunicação. Esta plataforma tem por objetivo facilitar a sua adaptação às nossas políticas e cultura institucional.</p>
        <p class="lead">Leia com atenção e conheça seus direitos e deveres.</p>
        <p class="lead">Estará sempre disponível sempre que precisar.</p>
      </div>
      <div class="col-md-5">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-bg)"></rect><text x="35%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">Foto do campus <?php echo $nomeCampus ?></text></svg>
      </div>
    </div>

    </main>

    <div class="container-fluid">
      <footer class="p-5 pt-5 pb-0">
        <div class="d-flex flex-column flex-sm-row justify-content-between border-top pt-1">
          <p>© 2024 Feso, Todos direitos reservados.</p>
          <ul class="list-unstyled d-flex">
            <li class="ms-3">
                <a class="link-body-emphasis" href="#">
                    <i class="fa-brands fa-instagram"></i>
                </a>
            </li>
            <li class="ms-3">
                <a class="link-body-emphasis" href="#">
                    <i class="fa-brands fa-facebook"></i>
                </a>
              </li>
            <li class="ms-3">
                <a class="link-body-emphasis" href="#">
                    <i class="fa-brands fa-youtube"></i>
                </a>
              </li>
          </ul>
        </div>
      </footer>
    </div>
    
	<script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  </body>
</html>