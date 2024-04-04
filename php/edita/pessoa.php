<<<<<<< HEAD
<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    //Receber os dados do formulario
    $matricula = $_POST['matricula'];
    $nome      = $_POST['nome'];
    $id_campus = $_POST['campus'];
    $email     = $_POST['email'];
    $token     = $_SESSION['token'];

    //Monta update em uma string
    $consulta = "UPDATE pessoa SET  
                     matricula = :matricula, 
                     nome = :nome, 
                     id_campus = :id_campus, 
                     email = :email 
                 WHERE token = :token ";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':matricula', $matricula, PDO::PARAM_STR);
    $response->bindParam(':nome', $nome, PDO::PARAM_STR);
    $response->bindParam(':id_campus', $id_campus, PDO::PARAM_STR);
    $response->bindParam(':email', $email, PDO::PARAM_STR);
    $response->bindParam(':token', $token, PDO::PARAM_STR);

    //Executa a insert 
    $response->execute();

    $_SESSION['matricula'] = $matricula;
    $_SESSION['nome']      = $nome;
    $_SESSION['id_campus'] = $id_campus;
    $_SESSION['email']     = $email;

=======
<?php 

    // Inicia a sessão 
    session_start(); 

    //Incluir a conexao com BD
    include_once "../../conn/conexao.php";

    //Receber os dados do formulario
    $matricula = $_POST['matricula'];
    $nome      = $_POST['nome'];
    $id_campus = $_POST['campus'];
    $email     = $_POST['email'];
    $token     = $_SESSION['token'];

    //Monta update em uma string
    $consulta = "UPDATE pessoa SET  
                     matricula = :matricula, 
                     nome = :nome, 
                     id_campus = :id_campus, 
                     email = :email 
                 WHERE token = :token ";

    //Prepara o insert para o banco
    $response = $conn->prepare($consulta);

    //Passa os parametros via bind para evitar SQL Inject
    $response->bindParam(':matricula', $matricula, PDO::PARAM_STR);
    $response->bindParam(':nome', $nome, PDO::PARAM_STR);
    $response->bindParam(':id_campus', $id_campus, PDO::PARAM_STR);
    $response->bindParam(':email', $email, PDO::PARAM_STR);
    $response->bindParam(':token', $token, PDO::PARAM_STR);

    //Executa a insert 
    $response->execute();

    $_SESSION['matricula'] = $matricula;
    $_SESSION['nome']      = $nome;
    $_SESSION['id_campus'] = $id_campus;
    $_SESSION['email']     = $email;

>>>>>>> 8028e3b0c92799132ac2548aed8228df9ce14e6a
?>