<<<<<<< HEAD
<?php

    class MenuManager 
    {
        private $conn;

        public function __construct($conn) 
        {
            $this->conn = $conn;
        }

        public function getMenus() 
        {
            $sql = "SELECT titulo, url, ordem FROM menu ORDER BY ordem";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $menus;
        }
    }

=======
<?php

    class MenuManager 
    {
        private $conn;

        public function __construct($conn) 
        {
            $this->conn = $conn;
        }

        public function getMenus() 
        {
            $sql = "SELECT titulo, url, ordem FROM menu ORDER BY ordem";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $menus;
        }
    }

>>>>>>> 8028e3b0c92799132ac2548aed8228df9ce14e6a
?>