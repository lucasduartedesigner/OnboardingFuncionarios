<<<<<<< HEAD
<?php

    class CampusManager 
    {
        private $conn;

        public function __construct($conn) 
        {
            $this->conn = $conn;
        }

        public function getCampus() 
        {
            $sql = "SELECT id_campus, nome FROM campus WHERE status = 1 ORDER BY id_campus";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            $campus = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $campus;
        }
    }

=======
<?php

    class CampusManager 
    {
        private $conn;

        public function __construct($conn) 
        {
            $this->conn = $conn;
        }

        public function getCampus() 
        {
            $sql = "SELECT id_campus, nome FROM campus WHERE status = 1 ORDER BY id_campus";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            $campus = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $campus;
        }
    }

>>>>>>> 8028e3b0c92799132ac2548aed8228df9ce14e6a
?>