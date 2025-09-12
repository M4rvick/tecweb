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
        unset($a, $b, $c);
    ?>
    <h2>Ejercicio 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación,
    verificar la evolución del tipo de estas variables (imprime todos los componentes de los
    arreglo):
        <ul>   
            <li>$a = “PHP5”;</li>
            <li>$z[] = &$a;</li>
            <li>$b = “5a version de PHP”;</li>
            <li>$c = $b*10;</li>
            <li>$a .= $b;</li>
            <li>$b *= $c;</li>
            <li>$z[0] = “MySQL”;</li>
        </ul>
    </p>
    <p>Solucion: </p>
    <?php
        $a = "PHP5";
        echo '$a = '.$a. "<br>";
        $z[] = &$a;
        echo '$z[] = ';
        print_r($z);
        echo "<br>";
        $b = "5a version de PHP";
        echo '$b = '.$b. "<br>";
        @$c = $b*10;
        echo '$c = '.$c. "<br>";
        $a .= $b;
        echo '$a = '.$a. "<br>";
        @$b *= $c;
        echo '$b = '.$b. "<br>";
        $z[0] = "MySQL";
        echo '$z[0] = '.$z[0]."<br>";
        
    ?>
    <h2>Ejercicio 4</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de
    la matriz $GLOBALS o del modificador global de PHP.</p>
    <?php
        echo '$GLOBALS["a"] = '.$GLOBALS['a']."<br>";
        echo '$GLOBALS["z"] = ';
        print_r($GLOBALS['z']);
        echo "<br>";
        echo '$GLOBALS["b"] = '.$GLOBALS['b']."<br>";
        echo '$GLOBALS["c"] = '.$GLOBALS['c']."<br>";    
    ?>
    <h2>Ejercicio 5</h2>
    <p>Dar el valor de las variables $a, $b, $c al final del siguiente script:
        <ul>   
            <li>$a = “7 personas”;</li>
            <li>$b = (integer) $a;</li>
            <li>$a = “9E3”;</li>
            <li>$c = (double) $a;</li>
        </ul>
    </p>
    <?php
        $a = "7 personas";
        echo '$a = '.$a. "<br>";
        $b = (integer) $a;
        echo '$b = '.$b. "<br>";
        $a = "9E3";
        echo '$a = '.$a. "<br>";
        $c = (double) $a;   
        echo '$c = '.$c. "<br>";
    ?>

    <h2>Ejercicio 6</h2>
    <p>Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas
        usando la función var_dump(<datos>).
    <?php
        $a = "0";
        $b = "TRUE";
        $c = FALSE;  
        $d = ($a OR $b);
        $e = ($a AND $c);
        $f = ($a XOR $b);
        echo '$a = '; var_dump((bool)$a); echo "<br>";
        echo '$b = '; var_dump((bool)$b); echo "<br>";
        echo '$c = '; var_dump((bool)$c); echo "<br>";
        echo '$d = '; var_dump((bool)$d); echo "<br>";
        echo '$e = '; var_dump((bool)$e); echo "<br>";
        echo '$f = '; var_dump((bool)$f); echo "<br>";
        echo '<p>Después investiga una función de PHP que permita transformar el valor booleano de $c y $e
        en uno que se pueda mostrar con un echo:</p>';
        echo '<h4>Solución:</h4>'; 
        echo "Usando la funcion var_export() <br>";
        echo '$c = '. var_export($c, true); echo "<br>"; 
        echo '$e = '. var_export($e, true); echo "<br>";
    ?>

    <h2>Ejercicio 7</h2>
    <p>Usando la variable predefinida $_SERVER, determina lo siguiente:
        <ol type="a">   
            <li>La versión de Apache y PHP</li>
            <li>El nombre del sistema operativo (servidor)</li>
            <li>El idioma del navegador (cliente)</li>
        </ol>
    <p>
    <?php
        echo '<h4>Solución:</h4>';
        echo "  Servidor: " . $_SERVER['SERVER_SOFTWARE'] . "<br>"; 
        echo "  Versión de PHP: " . phpversion() . "<br>";
        echo "  Sistema operativo del servidor: " . php_uname('s') . "<br>";
        echo "  Idioma del navegador: " . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "<br>";
    ?>
    
</body>
</html>