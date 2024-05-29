<?php

    class TipoEventoManager 
    {
        private $conn;

        public function __construct($conn) 
        {
            $this->conn = $conn;
        }

        public function getTipoEvento() 
        {
            $sql = "SELECT id_tipo_evento, nome FROM tipo_evento WHERE status = 1 ORDER BY id_tipo_evento ";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            $tipoEvento = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $tipoEvento;
        }
    }

?>