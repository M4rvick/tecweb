<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 7</title>
</head>
<body>
    <?php
        require_once('src/funciones.php'); 
        ejercicio1();
        ejercicio2();
        ejercicio3();
        ejercicio4();
    ?>
    
    <h2>Ejercicio 5</h2>
    <p>Usar las variables $edad y $sexo en una instrucción if para identificar una persona de
        sexo “femenino”, cuya edad oscile entre los 18 y 35 años y mostrar un mensaje de
        bienvenida apropiado. Por ejemplo: "Bienvenida, usted está en el rango de edad permitido."</p>
    <p>En caso contrario, deberá devolverse otro mensaje indicando el error.</p>
    <h2>Verificación de edad y sexo</h2>
    <form action="src/ej5.php" method="post">
        <label for="edad">Edad:</label>
        <input type="number" name="edad" id="edad" required><br><br>

        <label for="sexo">Sexo:</label>
        <select name="sexo" id="sexo" required>
            <option value="">Seleccione</option>
            <option value="femenino">Femenino</option>
            <option value="masculino">Masculino</option>
        </select><br /><br />

        <input type="submit" value="Enviar" />
    </form>

    <h2>Ejercicio 6</h2>
    <p>Crea en código duro un arreglo asociativo que sirva para registrar el parque vehicular de
        una ciudad. Cada vehículo debe ser identificado por:</p>
    <ul>
        <li>Matricula</li>
        <li>Auto</li>
        <ul>
            <li>Marca</li>
            <li>Modelo (año)</li>
            <li>Tipo (sedan|hachback|camioneta)</li>
        </ul>
        <li>Propietario</li>
        <ul>
            <li>Nombre</li>
            <li>Ciudad</li>
            <li>Dirección</li>
        </ul>
    </ul>

    <h2>Consulta de Vehículos</h2>
    <form action="src/ej6.php" method="post">
        <label for="matricula">Matrícula:</label>
        <input type="text" id="matricula" name="matricula" placeholder="Ej: ABC1234">
        <p>Deja vacío para consultar todos los autos</p>
        <input type="submit" value="Consultar">
    </form>
</body>
</html>

