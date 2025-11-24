<?php

    namespace myapi\Delete; 
    require_once __DIR__ . '/../Database.php'; 
    use myapi\Database;

    class Delete extends Database
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

        public function delete(array $data): void
            {

                $this->response = [
                    'status'  => 'error',
                    'message' => 'La consulta falló'
                ];

                if ( isset($data['id']) ) {

                    $id = $data['id'];
                    $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";
      
                    $this->conexion->set_charset("utf8");
                                            if ( $this->conexion->query($sql) ) {
                        $this->response['status'] =  "success";
                        $this->response['message'] =  "Producto eliminado";
                    } else {
                        $this->response['message'] = "ERROR: No se ejecuto $sql. " . $this->conexion->error;
                    }
                }
            }
    }
?>