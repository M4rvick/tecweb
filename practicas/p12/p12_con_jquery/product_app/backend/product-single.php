<?php
    include_once __DIR__.'/database.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM productos WHERE id = $id AND eliminado = 0";
        $result = $conexion->query($sql);

        if ($result && $row = $result->fetch_assoc()) {
            $json = array(
            'name'    => $row['nombre'],
            'precio'    => floatval($row['precio']),
            'unidades'  => intval($row['unidades']),
            'modelo'    => $row['modelo'],
            'marca'     => $row['marca'],
            'detalles'  => $row['detalles'],
            'imagen'    => $row['imagen']

            );

            echo json_encode($json, JSON_PRETTY_PRINT);
        } else {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Producto no encontrado o error en la consulta'
            ));
        }

        $conexion->close();
    } else {
        echo json_encode(array(
            'status' => 'error',
            'message' => 'No se recibió un ID'
        ));
    }
?>
