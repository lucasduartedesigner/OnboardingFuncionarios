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
<a href="javascript:void(0)" class="nav-link nav-link-faded"><?= $resultado['descricao'] ?></a>
<?php }} ?>