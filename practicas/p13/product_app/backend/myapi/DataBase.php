<?php
//dump-autoload -o 

    namespace myapi;
    use mysqli;
    
    abstract class Database
    {
        protected $conexion;
        protected $response = [];

        public function __construct(string $host, string $user, string $pass, string $db)
        {
            
            $this->conexion = new mysqli($host, $user, $pass, $db);
            if ($this->conexion->connect_error) {
                die('¡Base de datos NO conectada!');
            }
            $this->conexion->set_charset("utf8");
        }

        public function getData(): string
        {
            return json_encode($this->response, JSON_PRETTY_PRINT);
        }
    }
?>