<?php

class LoginHandler 
{
    private $conn;

    public function __construct($conn) 
    {
        $this->conn = $conn;
    }

    public function login($matricula, $senha) 
    {
        $consulta = "SELECT p.id_pessoa, p.token, p.matricula, p.nome, p.email, p.senha, p.id_campus, 
                            c.nome campus, c.titulo, c.texto, c.url, c.imagem 
                     FROM pessoa p
                     INNER JOIN campus c ON p.id_campus = c.id_campus
                     WHERE p.matricula = :matricula
                     AND p.status IS NOT NULL ";

        $response = $this->conn->prepare($consulta);

        $response->bindParam(':matricula', $matricula, PDO::PARAM_STR);

        $response->execute();

        if ($response->rowCount() > 0) 
        {
            $resultado = $response->fetch(PDO::FETCH_ASSOC);

            if (password_verify($senha, $resultado['senha'])) 
            {
                $this->setSessionData($resultado);
            } 
            else 
            {
                echo "Senha incorreta, tente novamente!";
            }
        } 
        else 
        {
            echo "Seus dados não estão corretos.<br>Ou ainda não é cadastrado!";
        }
    }

    private function setSessionData($resultado) 
    {
        $_SESSION['id_pessoa']  = $resultado['id_pessoa'];
        $_SESSION['token']      = $resultado['token'];
        $_SESSION['matricula']  = $resultado['matricula'];
        $_SESSION['nome']       = $resultado['nome'];
        $_SESSION['email']      = $resultado['email'];
        $_SESSION['id_campus']  = $resultado['id_campus'];
        $_SESSION['campus']     = $resultado['campus'];
        $_SESSION['titulo']     = $resultado['titulo'];
        $_SESSION['texto']      = $resultado['texto'];
        $_SESSION['url']        = $resultado['url'];
        $_SESSION['imagem']     = $resultado['imagem'];

        $menuManager = new MenuManager($this->conn);

        $_SESSION['menus'] = $menuManager->getMenus();
    }
}

?>