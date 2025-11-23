<?php

    namespace myapi\Update; 
    require_once __DIR__ . '/../Database.php'; 
    use myapi\Database;

    class Update extends Database
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

        public function edit(array $data): void
        {
           
            $this->response = [
                'status'  => 'error',
                'message' => 'La consulta falló'
            ];

            if( isset($data['id']) ) {
                
                $jsonOBJ = json_decode( json_encode($data) );

                $sql =  "UPDATE productos SET nombre='{$jsonOBJ->nombre}', marca='{$jsonOBJ->marca}',";
                $sql .= "modelo='{$jsonOBJ->modelo}', precio={$jsonOBJ->precio}, detalles='{$jsonOBJ->detalles}',"; 
                $sql .= "unidades={$jsonOBJ->unidades}, imagen='{$jsonOBJ->imagen}' WHERE id={$jsonOBJ->id}";

                $this->conexion->set_charset("utf8");
 
                if ( $this->conexion->query($sql) ) {
                    $this->response['status'] =  "success";
                    $this->response['message'] =  "Producto actualizado";
                } else {
                    $this->response['message'] = "ERROR: No se ejecuto $sql. " . $this->conexion->error;
                }

            }
        }
    }
?>