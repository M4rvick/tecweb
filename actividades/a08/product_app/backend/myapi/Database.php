<?php

    namespace Backend\Myapi;

    use mysqli;
    use Exception;

    abstract class DataBase
    {

        protected $conexion;

        public function __construct(string $host, string $user, string $pass, string $db)
        {
            try {
                $this->conexion = new mysqli($host, $user, $pass, $db);

                if ($this->conexion->connect_error) {
                    throw new Exception('¡Base de datos NO conectada!: ' . $this->conexion->connect_error);
                }

                $this->conexion->set_charset("utf8");

            } catch (Exception $e) {
                die($e->getMessage());
            }
        }

        public function __destruct()
        {
            if ($this->conexion) {
                $this->conexion->close();
            }
        }
    }
?>