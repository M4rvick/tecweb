<?php
    namespace Backend\Myapi; 
    require_once __DIR__ . '/DataBase.php'; 
    use Backend\Myapi\DataBase; 


    class Products extends DataBase
    {

        private $response = [];

        public function __construct(
            string $db = 'marketzone',
            string $host = 'localhost',
            string $user = 'root',
            string $pass = 'dinos4urio'
        ) {
            $this->response = [];
            parent::__construct($host, $user, $pass, $db);
        }

        public function getData(): string
        {
            return json_encode($this->response, JSON_PRETTY_PRINT);
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

        public function add(array $data): void
        {
            // VERIFICAR SI YA EXISTE EL PRODUCTO
            $sql_check = "SELECT * FROM productos WHERE nombre = ? AND eliminado = 0";
            
            // PREPARAR LA QUERY
            $stmt_check = $this->conexion->prepare($sql_check);
            if (!$stmt_check) {
                $this->response = ['status' => 'error', 'message' => 'Error al preparar la consulta: ' . $this->conexion->error];
                return;
            }

            $stmt_check->bind_param('s', $data['nombre']);
            $stmt_check->execute();
            $result = $stmt_check->get_result();

            if ($result->num_rows > 0) {
                $this->response = [
                    'status'  => 'error',
                    'message' => 'Ya existe un producto con ese nombre'
                ];
                $result->free(); // Liberamos resultado
                $stmt_check->close(); // Cerramos statement
                return; // Salimos del método
            }

            $result->free();
            $stmt_check->close();


            $imagen = (!isset($data['imagen']) || $data['imagen'] == '') ? 'default.jpg' : $data['imagen'];
            
            
            $sql_insert = "INSERT INTO productos (id, nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) 
                        VALUES (null, ?, ?, ?, ?, ?, ?, ?, 0)";
            
            $stmt_insert = $this->conexion->prepare($sql_insert);
            if (!$stmt_insert) {
                $this->response = ['status' => 'error', 'message' => 'Error al preparar el INSERT: ' . $this->conexion->error];
                return;
            }


            $stmt_insert->bind_param(
                'sssdsis', 
                $data['nombre'],
                $data['marca'],
                $data['modelo'],
                $data['precio'],
                $data['detalles'],
                $data['unidades'],
                $imagen
            );

            if ($stmt_insert->execute()) {
                $this->response['status'] = "success";
                $this->response['message'] = "Producto agregado";
            } else {
                $this->response['status'] = "error";
                $this->response['message'] = "ERROR: No se ejecuto $sql_insert. " . $stmt_insert->error;
            }

            $stmt_insert->close();
        }

        public function delete(string $id): void
        {

        }

        public function edit(array $data): void
        {
            
        }

        public function search(string $searchTerm): void
        {

        }

        public function single(string $id): void
        {

        }

        public function singleByName(string $name): void
        {

        }

    }
?>