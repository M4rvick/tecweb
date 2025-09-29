<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 5</title>
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
        echo '<p>'.'$a = '.$a. "<br/>".'</p>';    
        echo '<p>'.'$b = '.$b. "<br/>".'</p>';
        echo '<p>'.'$c = '.$c . "<br/>".'</p>';
        
        echo '<p>b. Agrega al código actual las siguientes asignaciones:</p>';
        echo "<p>\$a = \"PHP server\"; \$b = &amp;\$a;</p>";

        $a = "PHP server";
        $b = &$a;       
        echo '<p>c. Vuelve a mostrar el contenido de cada uno:</p>';
        echo '<p>'.'$a = '.$a.'</p>';
        echo '<p>'.'$b = '.$b.'</p>';

        echo '<p>d. Describe en y muestra en la página obtenida qué ocurrió en el segundo bloque de
        asignaciones</p>';
        echo '<ul>';
        echo '<li>El valor de $a cambio a "PHP server" (antes er    a "ManejadorSQL").</li>';
        echo '<li>$b apunta al valor de $a, por lo que, al cambiar $a tambien cambia el valor de $b</li>';
        echo '</ul>';
        unset($a, $b, $c);
    ?>
    <h2>Ejercicio 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación,
    verificar la evolución del tipo de estas variables (imprime todos los componentes de los
    arreglo):
    </p>
    <ul>   
        <li>$a = “PHP5”;</li>
        <li>$z[] = &amp;$a;</li>    
        <li>$b = “5a version de PHP”;</li>
        <li>$c = $b*10;</li>
        <li>$a .= $b;</li>
        <li>$b *= $c;</li>
        <li>$z[0] = “MySQL”;</li>
    </ul>
    <p>Solucion: </p>
    <?php
        $a = "PHP5";
        echo '<p>'.'$a = '. $a .'</p>';   
        $z[] = &$a;
        echo '<p>$z[] = </p><pre>';
        print_r($z);
        echo '</pre>';
        $b = "5a version de PHP";
        echo '<p>'.'$b = '.$b. '</p>';
        @$c = $b*10;
        echo '<p>'.'$c = '.$c. '</p>';
        $a .= $b;
        echo '<p>'.'$a = '.$a. '</p>';;
        @$b *= $c;
        echo '<p>'.'$b = '.$b. '</p>';
        $z[0] = "MySQL";
        echo '<p>'.'$z[0] = '.$z[0].'</p>';
        
    ?>
    <h2>Ejercicio 4</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de
    la matriz $GLOBALS o del modificador global de PHP.</p>
    <?php
        echo '<p>'.'$GLOBALS["a"] = '.$GLOBALS['a'].'</p>';
        echo '<p>$GLOBALS["z"] = </p><pre>';
        print_r($GLOBALS['z']);
        echo '</pre>';
        echo '<p>'.'$GLOBALS["b"] = '.$GLOBALS['b'].'</p>';
        echo '<p>'.'$GLOBALS["c"] = '.$GLOBALS['c'].'</p>';    
    ?>
    <h2>Ejercicio 5</h2>
    <p>Dar el valor de las variables $a, $b, $c al final del siguiente script:</p>
    <ul>   
         <li>$a = “7 personas”;</li>
         <li>$b = (integer) $a;</li>
         <li>$a = “9E3”;</li>
         <li>$c = (double) $a;</li>
    </ul>
    <?php
        $a = "7 personas";
        echo '<p>'.'$a = '.$a.'</p>';
        $b = (integer) $a;
        echo '<p>'.'$b = '.$b.'</p>';
        $a = "9E3";
        echo '<p>'.'$a = '.$a.'</p>';
        $c = (double) $a;   
        echo '<p>'.'$c = '.$c.'</p>';
    ?>

    <h2>Ejercicio 6</h2>
    <p>Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas
        usando la función var_dump()</p>
    <?php
        $a = "0";
        $b = "TRUE";
        $c = FALSE;  
        $d = ($a OR $b);
        $e = ($a AND $c);
        $f = ($a XOR $b);
        echo '<p>'.'$a = '.'</p>'; 
        echo '<p>'.'$b = '.'</p>'; 
        echo '<p>'.'$c = '.'</p>'; 
        echo '<p>'.'$d = '.'</p>'; 
        echo '<p>'.'$e = '.'</p>'; 
        echo '<p>'.'$f = '.'</p>';
        echo "<pre>";
        
        var_dump((bool)$a);
        var_dump((bool)$b);
        var_dump((bool)$c);
        var_dump((bool)$d);
        var_dump((bool)$e);
        var_dump((bool)$f);
        
        echo "</pre>" ;
        echo '<p>Después investiga una función de PHP que permita transformar el valor booleano de $c y $e
        en uno que se pueda mostrar con un echo:</p>';
        echo '<h4>Solución:</h4>'; 
        echo '<p>'."Usando la funcion var_export()".'</p>';
        echo '<p>'.'$c = '. var_export($c, true).'</p>'; 
        echo '<p>'.'$e = '. var_export($e, true).'</p>';
    ?>

    <h2>Ejercicio 7</h2>
    <p>Usando la variable predefinida $_SERVER, determina lo siguiente:</p>
    <ol style="list-style-type: lower-alpha;">   
        <li>La versión de Apache y PHP</li>
        <li>El nombre del sistema operativo (servidor)</li>
        <li>El idioma del navegador (cliente)</li>
    </ol>
    <?php
        echo '<h4>Solución:</h4>';
        echo '<p>'."  Servidor: " . $_SERVER['SERVER_SOFTWARE'] .'</p>';
        echo '<p>'."  Versión de PHP: " . phpversion() .'</p>';
        echo '<p>'."  Sistema operativo del servidor: " . php_uname('s') .'</p>';
        echo '<p>'."  Idioma del navegador: " . $_SERVER['HTTP_ACCEPT_LANGUAGE'] .'</p>';
    ?>
    <p>
        <a href="https://validator.w3.org/check?uri=referer"><img
         src="https://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" /></a>
    </p>

</body>
</html>