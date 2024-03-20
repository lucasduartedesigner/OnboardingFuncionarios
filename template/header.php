    <header data-bs-theme="dark">
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" style="background-color: #006b64 !important; ">
        <div class="container-fluid">
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
            <form class="d-flex" role="search">
              <input class="form-control me-2" style="background-color: #006b64 !important;border-color: #fff" type="search" placeholder="Digite a busca" aria-label="Search">
              <button class="btn btn-outline-light me-2" type="submit">Procurar</button>
              <a class="btn btn-danger rounded" href="index.html">Sair</a>
            </form>
          </div>
        </div>
      </nav>
    </header>