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

?>