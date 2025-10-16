<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');

    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JASON A OBJETO
        $jsonOBJ = json_decode($producto);

        //verificar existencia
         $nombreSeguro = $conexion->real_escape_string($jsonOBJ->nombre);
        $checkSql = "SELECT id FROM productos WHERE nombre = '{$nombreSeguro}' AND eliminado = 0";
        $result = mysqli_query($conexion, $checkSql);

        if ($result && mysqli_num_rows($result) > 0) {
        // Ya existe un producto activo con ese nombre
        echo json_encode([
            "status" => "error",
            "message" => "El producto '{$jsonOBJ->nombre}' ya existe."
        ]);
    } else {
        $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen)
        VALUES (
            '{$jsonOBJ->nombre}',
            '{$jsonOBJ->marca}',
            '{$jsonOBJ->modelo}',
            {$jsonOBJ->precio},
            '{$jsonOBJ->detalles}',
            {$jsonOBJ->unidades},
            '{$jsonOBJ->imagen}'
        )";
        //echo '[SERVIDOR] Nombre: '.$jsonOBJ->nombre;
        //se devuelve un  json como repusta al js
        if (mysqli_query($conexion, $sql)) {
        // RESPUESTA JSON SI TODO SALE BIEN
            echo json_encode([
                "status" => "success",
                "message" => "Producto agregado correctamente."
            ]);
        } else {
        // RESPUESTA JSON SI OCURRE UN ERROR
            echo json_encode([
                "status" => "error",
                "message" => "Error al insertar producto: " . mysqli_error($conn)
            ]);
        }
    }
    mysqli_close($conexion);
    }
?>