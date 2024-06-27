<div class="simplebar-mask">
    <div class="simplebar-offset">
        <div class="simplebar-content-wrapper">
            <div class="simplebar-content">
                <nav class="nav nav-pills nav-gap-y-1 flex-column">
                    <?php 

                        $consulta = "SELECT * FROM forum_topicos";

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
                    <a href="forum.php?id_topicos=<?= $resultado['id_topicos'] ?>" class="nav-link nav-link-faded"><?= $resultado['descricao'] ?></a>
                        <?php
                        }
                    } 
                    ?>   
                </nav>
            </div>
        </div>
    </div>
</div>