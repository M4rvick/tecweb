<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conexión a la base de datos
    @$link = new mysqli('localhost', 'root', 'dinos4urio', 'marketzone'); 

    if ($link->connect_errno) {
        die("ERROR: No se pudo conectar con la DB. " . $link->connect_error);
    }

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $detalles = $_POST['detalles'];
    $unidades = $_POST['unidades'];
    $imagen = $_POST['imagen'];

    $sql = "UPDATE productos SET nombre = ?, marca = ?, modelo = ?, precio = ?, detalles = ?, unidades = ?, imagen = ? WHERE id = ?";
    
    if ($stmt = $link->prepare($sql)) {
        // Vincular los datos a la consulta
        $stmt->bind_param("ssdssisi", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen, $id);
        
        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<h1>Registro actualizado exitosamente.</h1>";
            echo "<a href='get_producto_xhtml_v2.php?tope=100'>Volver a la lista</a>";
        } else {
            echo "<h1>ERROR: No se pudo ejecutar la actualización. " . $stmt->error . "</h1>";
        }
        $stmt->close();
    } else {
        echo "<h1>ERROR: No se pudo preparar la consulta. " . $link->error . "</h1>";
    }

    // Cerrar la conexión
    $link->close();

    // Detener el script para que no muestre el formulario de nuevo
    exit();
}


// Validar que se recibió un ID por la URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('ERROR: ID de producto no válido.');
}
$id_producto = $_GET['id'];
$producto = null;

// Conectar a la DB para buscar los datos del producto
@$link = new mysqli('localhost', 'root', 'dinos4urio', 'marketzone'); 
if ($link->connect_errno) {
    die("ERROR: No se pudo conectar con la DB. " . $link->connect_error);
}

// Preparar y ejecutar la consulta SELECT
$sql_select = "SELECT * FROM productos WHERE id = ?";
if ($stmt_select = $link->prepare($sql_select)) {
    $stmt_select->bind_param("i", $id_producto);
    $stmt_select->execute();
    $result = $stmt_select->get_result();
    if ($result->num_rows == 1) {
        $producto = $result->fetch_assoc();
    } else {
        die('ERROR: Producto no encontrado.');
    }
    $stmt_select->close();
}
$link->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <style type="text/css">
        /* Tu CSS aquí */
        ol, ul { list-style-type: none; }
        label, input[type="text"], input[type="number"], textarea, select {
            display: block; width: 20%; box-sizing: border-box; margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <h1>Modificar Producto</h1>
    <p>A continuación, edite los datos del producto:</p>

    <form id="formSetProduct" action="" method="post" onsubmit="return validarFormulario();">
    
        <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id']) ?>">

        <ul>
            <li><label for="nombre">Nombre del producto:</label>
                <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required>
            </li>
            <li>
                <label for="marca">Marca:</label>
                <select name="marca" id="marca" required>
                    <?php
                    $marcas = ["Apple", "Samsung", "Google", "Xiaomi", "Motorola"];
                    foreach ($marcas as $m) {
                        // Si la marca del producto coincide, se marca como 'selected'
                        $selected = ($producto['marca'] == $m) ? 'selected' : '';
                        echo "<option value=\"$m\" $selected>$m</option>";
                    }
                    ?>
                </select>
            </li>
            <li><label for="modelo">Modelo:</label>
                <input type="text" name="modelo" id="modelo" value="<?= htmlspecialchars($producto['modelo']) ?>" required>
            </li>
            <li><label for="precio">Precio:</label>
                <input type="number" step="0.01" name="precio" id="precio" value="<?= htmlspecialchars($producto['precio']) ?>" required>
            </li>
            <li><label for="detalles">Inserte detalles:</label>
                <textarea name="detalles" id="detalles" rows="4"><?= htmlspecialchars($producto['detalles']) ?></textarea>
            </li>
            <li><label for="unidades">Unidades:</label>
                <input type="number" name="unidades" id="unidades" value="<?= htmlspecialchars($producto['unidades']) ?>" required>
            </li>
            <li><label for="imagen">Imagen:</label>
                <input type="text" name="imagen" id="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>">
            </li>
            <li>
                <input type="submit" value="Actualizar">
                <input type="reset" value="Reiniciar">
            </li>
        </ul>
    </form>
    
    <script>
        function validarFormulario() {
            //array para los errores
            let errores = [];
            const nombre = document.getElementById('nombre').value.trim();
            const marca = document.getElementById('marca').value;
            const modelo = document.getElementById('modelo').value.trim();
            const precio = document.getElementById('precio').value;
            const detalles = document.getElementById('detalles').value.trim();
            const unidades = document.getElementById('unidades').value;
            const imagenInput = document.getElementById('imagen');

            //validacion del nombre
            if (nombre === "") {
                errores.push("El nombre del producto es requerido.");
            } else if (nombre.length > 100) {
                errores.push("El nombre no puede tener más de 100 caracteres.");
            }

            // validacion de la marca
            if (marca === "") {
                errores.push("Debe seleccionar una marca.");
            }

            // validacion del modelo
            const modeloRegex = /^[a-zA-Z0-9\s\-]+$/; // Permite letras, números, espacios y guiones
            if (modelo === "") {
                errores.push("El modelo es requerido.");
            } else if (modelo.length > 25) {
                errores.push("El modelo no puede tener más de 25 caracteres.");
            } else if (!modeloRegex.test(modelo)) {
                errores.push("El modelo solo puede contener caracteres alfanuméricos, espacios y guiones.");
            }

            // validacion del precio 
            if (precio === "") {
                errores.push("El precio es requerido.");
            } else if (parseFloat(precio) <= 99.99) {
                errores.push("El precio debe ser mayor a $99.99.");
            }

            // validacion de los detalles
            if (detalles.length > 250) {
                errores.push("Los detalles no pueden exceder los 250 caracteres.");
            }

            // validacionde las unidades
            if (unidades === "") {
                errores.push("El número de unidades es requerido.");
            } else if (parseInt(unidades, 10) < 0) {
                errores.push("Las unidades no pueden ser un número negativo.");
            }

            // asigancion por defecto de la imagen 
            if (errores.length === 0) {
                // Si la ruta de la imagen está vacía, se asigna una por defecto.
                if (imagenInput.value.trim() === '') {
                    imagenInput.value = 'img/default.jpg';
                }
                alert("¡Validación exitosa! Enviando datos al servidor...");
                return true; // Permite el envío del formulario.
            } else {
                // Si hay errores, se muestran en una sola alerta y se detiene el envío.
                alert("Por favor, corrija los siguientes errores:\n\n" + errores.join("\n"));
                return false; // Detiene el envío del formulario.
            }
        }
    </script>
</body>
</html>