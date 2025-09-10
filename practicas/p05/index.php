<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
        // unset()
        // @$ = $b*10

    ?>
    <h2>Ejercicio 2</h2>
    <p>Proporcionar los valores de $a, $b, $c como se muestra en el archivo</p>
    <p>a. Ahora muestra el contenido de cada variable:</p>
    <?php
        $a = "ManejadorSQL";
        $b = "MySQL";
        $c = &$a;
        //imprimir variables
        echo '$a = '.$a. "<br>";    
        echo '$b = '.$b. "<br>";
        echo '$c = '.$c . "<br>";
        
        echo '<p>b. Agrega al código actual las siguientes asignaciones:</p>';
        echo "<p>\$a = \"PHP server\"; \$b = &\$a;</p>";

        $a = "PHP server";
        $b = &$a;       
        echo '<p>c. Vuelve a mostrar el contenido de cada uno:</p>';
        echo '$a = '.$a. "<br>";
        echo '$b = '.$b. "<br>";

        echo '<p>d. Describe en y muestra en la página obtenida qué ocurrió en el segundo bloque de
        asignaciones</p>';
        echo '<ul>';
        echo '<li>El valor de $a cambio a "PHP server" (antes era "ManejadorSQL").</li>';
        echo '<li>$b apunta al valor de $a, por lo que, al cambiar $a tambien cambia el valor de $b</li>';
        echo '</ul>';
    ?>
    
</body>
</html>