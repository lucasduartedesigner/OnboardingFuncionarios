<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Portal do Colaborador</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://getbootstrap.com/docs/5.3/examples/sign-in/sign-in.css" rel="stylesheet">

	<style>
		.bd-placeholder-img 
        {
		  font-size: 1.125rem;
		  text-anchor: middle;
		  -webkit-user-select: none;
		  -moz-user-select: none;
		  user-select: none;
		}
  
		@media (min-width: 768px) 
        {
		    .bd-placeholder-img-lg 
            {
			    font-size: 3.5rem;
            }
		}
  
		.b-example-divider 
        {
		  width: 100%;
		  height: 3rem;
		  background-color: rgba(0, 0, 0, 0.1);
		  border: solid rgba(0, 0, 0, .15);
		  border-width: 1px 0;
		  box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, 0.15);
		}
  
		.b-example-vr 
        {
		  flex-shrink: 0;
		  width: 1.5rem;
		  height: 100vh;
		}
  
		.bi 
        {
		  vertical-align: -.125em;
		  fill: currentColor;
		}
  
		.nav-scroller 
        {
		  position: relative;
		  z-index: 2;
		  height: 2.75rem;
		  overflow-y: hidden;
		}
  
		.nav-scroller .nav 
        {
		  display: flex;
		  flex-wrap: nowrap;
		  padding-bottom: 1rem;
		  margin-top: -1px;
		  overflow-x: auto;
		  text-align: center;
		  white-space: nowrap;
		  -webkit-overflow-scrolling: touch;
		}
  
		.btn-bd-primary 
        {
		  --bd-violet-bg: #712cf9;
		  --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
  
		  --bs-btn-font-weight: 600;
		  --bs-btn-color: var(--bs-white);
		  --bs-btn-bg: var(--bd-violet-bg);
		  --bs-btn-border-color: var(--bd-violet-bg);
		  --bs-btn-hover-color: var(--bs-white);
		  --bs-btn-hover-bg: #ec0000;
		  --bs-btn-hover-border-color: #ff0000;
		  --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
		  --bs-btn-active-color: var(--bs-btn-hover-color);
		  --bs-btn-active-bg: #00ff55;
		  --bs-btn-active-border-color: #00ff55;
		}
  
		.bd-mode-toggle 
        {
		  z-index: 1500;
		}
  
		.bd-mode-toggle .dropdown-menu .active .bi 
        {
		  display: block !important;
		}
        
        .btn-success
        {
            background: #008675;
            border-color: #008675;
        }
        
        .btn-success:hover
        {
            background: #046d5f;
            border-color: #046d5f;
        }
	  </style>
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">

	<main class="form-signin w-100 m-auto">

	  <form action="php/cadastra/nova_senha.php" method="post" autocomplete="off" class="text-center">

		<img class="mb-3" src="https://unifeso.edu.br/apps/assets/img/feso.png" alt="" width="280">

		<h1 class="h3 mb-4 fw-normal text-center text-secondary">
            Cadastre nova senha
		</h1>

		<div class="form-floating">
		  <input type="text" class="form-control" id="senha" name="senha" autocomplete="off" required>
          <input type="hidden" class="form-control" id="id_pessoa" name="id_pessoa" autocomplete="off" value="<?= $_GET['id'] ?>">
		  <label for="senha">Digite a nova senha</label>	
		</div>

		<div class="form-floating">
		  <input type="text" class="form-control" id="senha_confirma" name="senha_confirma" autocomplete="off" required>
		  <label for="senha">Confirme a senha</label>
		</div>

		

		<button class="btn btn-success w-100 py-2" type="submit">Entrar</button>

		<p class="mt-5 mb-3 text-body-secondary text-center">Ainda não criou sua conta? <a href="cadastro.html">Cadastre-se</a></p>

	  </form>

	</main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js" ></script>
    <script>

        $(document).ready(function () {

            $("form").submit(function(e){

                e.preventDefault();

                var type  = $(this).attr('method')
                var url   = $(this).attr('action')
                var dados = $(this).serialize()
                var senha_confirma = $('#senha_confirma').val()
                var senha = $('#senha').val()

                if(senha_confirma == senha){
                    $.ajax({
                        type: type,
                        url: url,
                        data: dados
                    }).done(function(response) {

                        if(response == "") 
                        {
                            bootbox.alert('<h4 class="text-center">'+'Cadastro não encontrado.'+'</h4>');
                        } 
                        else 
                        {
                            window.location.href = "dashboard.php";                       
                        }
                    });
                }
                else 
                {
                    bootbox.alert('<h4 class="text-center">'+'As senhas precisam ser iguais.'+'</h4>');                     
                }
            });
        });

    </script>
</body>
</html>