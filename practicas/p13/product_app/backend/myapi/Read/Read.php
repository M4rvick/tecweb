<?php

    namespace myapi\Read;  
    require_once __DIR__ . '/../Database.php'; 
    use myapi\Database;


    class Read extends Database
    {
        public function __construct(
            string $db = 'marketzone',
            string $host = 'localhost',
            string $user = 'root',
            string $pass = 'dinos4urio'
        ) {
            $this->response = [];
            parent::__construct($host, $user, $pass, $db);
        }

        
        
        public function list(): void
        {
           
            $this->response = [];
            $sql = "SELECT * FROM productos WHERE eliminado = 0";

            if ( $result = $this->conexion->query($sql) ) {
                
                $this->response = $result->fetch_all(MYSQLI_ASSOC);
                
                $result->free();
            }
            
        }


        public function search(array $getData): void
        {
            $this->response = [];
            
            if ( isset($getData['search']) ) {

                $search = $getData['search'];

                $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";

                if ( $result = $this->conexion->query($sql) ) {

                    $this->response = $result->fetch_all(MYSQLI_ASSOC);
  
                    $result->free();
                }

            }
        }

        public function single(array $data): void
        {
            
            if ( isset($data['id']) ) {
              
                $id = $data['id'];
                $sql = "SELECT * FROM productos WHERE id = {$id}";
 
                if ( $result = $this->conexion->query($sql) ) {
    
                    $row = $result->fetch_assoc();

                    if(!is_null($row)) {
                        $this->response = $row;
                    }

                    $result->free();
                }
            }
        }

        public function singleByName(array $data): void
        {
            $this->response = [];
            if ( isset($data['name']) ) {
                
                $name = $data['name'];
                $sql = "SELECT * FROM productos WHERE nombre = '{$name}' AND eliminado = 0 LIMIT 1";

                if ( $result = $this->conexion->query($sql) ) {
                    $row = $result->fetch_assoc();

                    if(!is_null($row)) {
                        $this->response = $row;
                    }
                    $result->free();
                }
            }
        }

    }
?>