<?php
function ejercicio1(){
    echo '<h2>Ejercicio 1</h2>';
    echo '<p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>';
    echo '<p>Enviar numero mendiante la url: index.php?numero=x';
    if(isset($_GET['numero'])){
            $num = $_GET['numero'];
            if ($num%5==0 && $num%7==0){
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            }
            else{
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
        }
}

function ejercicio2(){
    echo '<h2>Ejercicio 2</h2>';
    echo '<p>Crea un programa para la generación repetitiva de 3 números aleatorios usando una matriz de m*3, hasta obtener una
    fila m compuesta por la secuencia impar - par - impar:</p>';
    
    $matriz = [];
    $numGenerados = 0;
    $numIteraciones = 0;

    while (true) {
        $fila = [
            mt_rand(1, 1000),
            mt_rand(1, 1000),
            mt_rand(1, 1000)
        ];
        $numGenerados +=3;
        $numIteraciones ++;
        $matriz[] = $fila;
        if ($fila[0] % 2 !== 0 && $fila[1] % 2 === 0 && $fila[2] % 2 !== 0) { //impar, par, impar 
            break; 
        }
    }
    echo "$numGenerados numeros generados en " . "$numIteraciones iteraciones. ";

    // foreach ($matriz as $index => $fila) {
    //     echo "Fila $index: " . implode(", ", $fila) . "\n";
    // }
}

function ejercicio3(){
    echo '<h2>Ejercicio 3</h2>';
    echo '<p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente,
    pero que además sea múltiplo de un número dado.</p>';
    echo '<ul>';
        echo '<li>Crear una variante de este script utilizando el ciclo do-while.';
        echo '<li>El número dado se debe obtener vía GET.';
    echo '</ul>';

   if(isset($_GET['numero'])){
        $num = $_GET['numero'];
        while (true) {
            $random = mt_rand(1, 1000);
            if ($random%$num===0){
                echo "$random es el primer entero generado multiplo de " . "$num.";
                break; 
            }
        }
        echo "<br>";
        do{
            $random = mt_rand(1, 1000);
        }while($random % $num !== 0);
        echo "$random es el primer entero generado múltiplo de $num.";

    }
}

function ejercicio4(){
    echo '<h2>Ejercicio 4</h2>';
    echo '<p>Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la ‘a’
    a la ‘z’. Usa la función chr(n) que devuelve el caracter cuyo código ASCII es n para poner
    el valor en cada índice.</p>';
    echo '<ul>';
        echo '<li>Crea el arreglo con un ciclo for.';
        echo '<li>Lee el arreglo y crea una tabla en XHTML con echo y un ciclo foreach';
    echo '</ul>';

    $letras = [];
    for ($i = 97; $i <= 122; $i++) {
        $letras[$i] = chr($i);
    }
    
    echo '<table border="1" cellpadding="5" cellspacing="0">';
    echo '<tr><th>Índice</th><th>Letra</th></tr>';
    foreach ($letras as $indice => $valor) {
        echo "<tr><td>$indice</td><td>$valor</td></tr>";
    }
    echo '</table>';

}
?>