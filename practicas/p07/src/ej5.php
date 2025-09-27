<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
    <title>Resultado Ejercicio 5</title>
</head>
<body>
    <?php
        $edad = $_POST['edad'] ?? null;
        $sexo = $_POST['sexo'] ?? null;

        if ($sexo === "femenino" && $edad >= 18 && $edad <= 35) {
            echo "<p>Bienvenida, usted está en el rango de edad permitido.</p>";
        } else {
            echo "<p>Error: no cumple con los requisitos.</p>";
        }
    ?>
</body>
</html>
