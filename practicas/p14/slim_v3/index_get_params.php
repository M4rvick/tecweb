<?php
require 'vendor/autoload.php'; 

//se crea objeto de clase slim
$app = new Slim\App();

// $app->get('/', function($request, $response, $args){
//     $response->write("Hola mundo Slim");
//     return $response;
// });

$app->get("/hola[/{nombre}]", function($request, $response, $args){
    $response->write("Hola " . $args["nombre"]);
    return $response;
});

$app->run(); 
?>