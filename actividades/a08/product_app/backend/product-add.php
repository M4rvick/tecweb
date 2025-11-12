<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $data = array(
        'status'  => 'error',
        'message' => 'Ya existe un producto con ese nombre'
    );
    if(
        isset($_POST['nombre']) &&
        isset($_POST['precio']) &&
        isset($_POST['unidades']) &&
        isset($_POST['modelo']) &&
        isset($_POST['marca']) &&
        isset($_POST['detalles']) &&
        isset($_POST['imagen'])
    ) {
        // SE TRANSFORMA EL POST A UN STRING EN JSON, Y LUEGO A OBJETO
        $jsonOBJ = json_decode( json_encode($_POST) );
        // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
        $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
	    $result = $conexion->query($sql);
        
        if ($result->num_rows == 0) {
            $conexion->set_charset("utf8");

            if (!isset($_POST['imagen']) || $_POST['imagen'] == '') {
                $jsonOBJ->imagen = 'default.jpg';
            }

            $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}', 0)";
            if($conexion->query($sql)){
                $data['status'] =  "success";
                $data['message'] =  "Producto agregado";
            } else {
                $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($conexion);
            }
        }

        $result->free();
        // Cierra la conexion
        $conexion->close();
    }

    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>