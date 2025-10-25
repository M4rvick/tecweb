<?php
include_once __DIR__.'/database.php';

// SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$producto = file_get_contents('php://input');
$data = array(
    'status'  => 'error',
    'message' => 'No se pudo editar el producto'
);

if (!empty($producto)) {
    // SE TRANSFORMA EL STRING DEL JSON A OBJETO
    $jsonOBJ = json_decode($producto);

    // Validamos que tenga ID
    if (!isset($jsonOBJ->id)) {
        $data['message'] = 'No se recibió un ID válido para editar.';
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }

    // Comprobamos que no exista otro producto con el mismo nombre
    $sql = "SELECT * FROM productos 
            WHERE nombre = '{$jsonOBJ->nombre}' 
            AND id != {$jsonOBJ->id} 
            AND eliminado = 0";

    $result = $conexion->query($sql);

    if ($result->num_rows == 0) {
        // Actualizamos los datos del producto
        $conexion->set_charset("utf8");
        $sql = "UPDATE productos SET
                    nombre   = '{$jsonOBJ->nombre}',
                    marca    = '{$jsonOBJ->marca}',
                    modelo   = '{$jsonOBJ->modelo}',
                    precio   = {$jsonOBJ->precio},
                    detalles = '{$jsonOBJ->detalles}',
                    unidades = {$jsonOBJ->unidades},
                    imagen   = '{$jsonOBJ->imagen}'
                WHERE id = {$jsonOBJ->id}";

        if ($conexion->query($sql)) {
            $data['status']  = "success";
            $data['message'] = "Producto actualizado correctamente";
        } else {
            $data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($conexion);
        }
    } else {
        $data['message'] = "Ya existe otro producto con ese nombre.";
    }

    $result->free();
    $conexion->close();
}

// SE HACE LA CONVERSIÓN DE ARRAY A JSON
echo json_encode($data, JSON_PRETTY_PRINT);
?>
