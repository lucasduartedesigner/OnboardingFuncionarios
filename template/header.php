<<<<<<< HEAD
<header data-bs-theme="dark">
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" style="background-color: #006b64 !important; ">
    <div class="container">
      <a class="navbar-brand ms-4" href="#"><img src="https://unifeso.edu.br/apps/assets/img/feso.png" alt="" width="100"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <?php

                $url_atual = basename($_SERVER['PHP_SELF']);

                foreach ($menus as $menu) 
                {
                    $active = ($menu['url'] == $url_atual) ? "active" : "";

                    echo "<li class='nav-item'><a class='nav-link $active' href='" . $menu['url'] . "'>" . $menu['titulo'] . "</a></li>";
                }

            ?>
        </ul>
        <div class="d-flex" role="search">
           <button type="button" class="btn btn-outline-light me-2 rounded-pill" data-bs-toggle="modal" data-bs-target="#perfil-modal">
             <i class="far fa-user-circle"></i> 
             <?php echo strtoupper($_SESSION['nome']) . " - " . $_SESSION['campus']; ?>
          </button>
          <a class="btn btn-outline-light me-2 rounded-circle" href="configuracao.php"><i class="fa-solid fa-gear"></i></a>
          <a class="btn btn-danger rounded-circle" href="index.html"><i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
      </div>
    </div>
  </nav>
=======
<header data-bs-theme="dark">
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" style="background-color: #006b64 !important; ">
    <div class="container">
      <a class="navbar-brand ms-4" href="#"><img src="https://unifeso.edu.br/apps/assets/img/feso.png" alt="" width="100"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <?php

                $url_atual = basename($_SERVER['PHP_SELF']);

                foreach ($menus as $menu) 
                {
                    $active = ($menu['url'] == $url_atual) ? "active" : "";

                    echo "<li class='nav-item'><a class='nav-link $active' href='" . $menu['url'] . "'>" . $menu['titulo'] . "</a></li>";
                }

            ?>
        </ul>
        <div class="d-flex" role="search">
           <button type="button" class="btn btn-outline-light me-2 rounded-pill" data-bs-toggle="modal" data-bs-target="#perfil-modal">
             <i class="far fa-user-circle"></i> 
             <?php echo strtoupper($_SESSION['nome']) . " - " . $_SESSION['campus']; ?>
          </button>
          <a class="btn btn-outline-light me-2 rounded-circle" href="configuracao.php"><i class="fa-solid fa-gear"></i></a>
          <a class="btn btn-danger rounded-circle" href="index.html"><i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
      </div>
    </div>
  </nav>
>>>>>>> 8028e3b0c92799132ac2548aed8228df9ce14e6a
</header>