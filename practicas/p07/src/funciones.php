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


?>