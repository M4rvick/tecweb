<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_POST['query']) ) {
        $query_str = $conexion->real_escape_string($_POST['query']);
        $search_term = "%{$query_str}%"; 
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql = "SELECT * FROM productos 
                WHERE nombre LIKE '{$search_term}' 
                OR marca LIKE '{$search_term}' 
                OR detalles LIKE '{$search_term}'";

        if ( $result = $conexion->query($sql) ) {
            // SE OBTIENEN LOS RESULTADOS
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $producto = array();
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($row as $key => $value) {
                    $producto[$key] = utf8_encode($value);
                }
                $data[] = $producto; // Se añade el producto completo al array de datos
            }
            $result->free();
		} else {
            die('Query Error: '.mysqli_error($conexion));
        }
		$conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>