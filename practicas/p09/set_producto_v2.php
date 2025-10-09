<?php
$nombre   = $_POST['nombre']   ?? '';
$marca    = $_POST['marca']    ?? '';
$modelo   = $_POST['modelo']   ?? '';
$precio   = $_POST['precio']   ?? 0;
$detalles = $_POST['detalles'] ?? '';
$unidades = $_POST['unidades'] ?? 0;
$imagen   = $_POST['imagen']   ?? '';

if (empty($nombre) || empty($marca) || empty($modelo)) {
    die("Error: Nombre, Marca y Modelo son obligatorios.");
}

/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', 'dinos4urio', 'marketzone');	

/** comprobar la conexión */
if ($link->connect_errno) 
{
    die('Falló la conexión: '.$link->connect_error.'<br/>');
    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
}

//validacionde la existencia
$sql_check = "SELECT * FROM productos 
              WHERE nombre = '{$nombre}' 
              AND marca = '{$marca}' 
              AND modelo = '{$modelo}'";

$result = $link->query($sql_check);

if ($result->num_rows > 0) {
    echo "Error: El producto con ese Nombre, Marca y Modelo ya existe en la base de datos.";
    $result->free();
    $link->close();
    exit;
}


/** Crear una tabla que no devuelve un conjunto de resultados */
$sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";
if ( $link->query($sql) ) 
{
    echo 'Producto insertado con ID: '.$link->insert_id;
}
else
{
	echo 'El Producto no pudo ser insertado =(';
}

$link->close();
?>