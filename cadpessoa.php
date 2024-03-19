<?php
session_start(); //Iniciar a sessao

//Criar conexão com o banco nesse bloco de codigo
$host = "127.0.0.1"; // endereço do Banco de dados
$user = "root"; //seu usuario de acesso ao banco de dados
$pass = ""; // sua senha de acesso ao banco de dados
$dbname = "portalfuncionarios"; // nome do banco de dados
$port = 3308; // porta onde esta alocado o banco de dados

// Cria uma Conexão
$conn = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);

// Verificar conexão
//if ($conn->connect_error) {
 //   die("Conexão falhou: " . $conn->connect_error);
//}

?>
<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Cadastro de Login </title>
</head>

<body>
    <h1>Cadastrar Usuário</h1>

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <form method="POST" action="pessoa.php">
        <h3>Dados básicos</h3>

        <label>Nome: </label>
        <input type="text" name="nome" id="nome" placeholder="Nome "><br><br>
        <label>CPF: </label>
        <input type="text" name="cpf" id="cpf" placeholder="Senha do usuário"><br><br>
        <label> Email: </label>
        <input type="text" name="email" id="email" placeholder="E-mail"><br><br>

        <h3>Endereço</h3>
        <label>Logradouro: </label>
        <input type="text" name="logradouro" id="logradouro" placeholder="Rua, Quadra e etc... "><br><br>
        <label>Numero: </label>
        <input type="text" name="numero" id="numero" placeholder="Numero da Casa/APT"><br><br>
        <label>Cidade: </label>
        <input type="text" name="cidade" id="cidade" placeholder="Cidade"><br><br>
        <select name="estados" id="estados">
            <option>Selecione o Estado</option>
            <?php
            $result_estados = $conn->query("SELECT * FROM estados");
            //$resultado_estados = mysqli_query($conn, $result_estados);
            while($row_estados = $result_estados->fetch(PDO::FETCH_ASSOC)){ ?>
                <option value="<?php echo $row_estados['idestados']; ?>"><?php echo $row_estados['nome']; ?>
                </option> <?php
            }
            ?>

        </select><br><br>
        <input type="submit" value="Cadastrar">
        

    </form>

</body>

</html>
