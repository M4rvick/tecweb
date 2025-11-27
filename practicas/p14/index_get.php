<?php
require 'vendor/autoload.php'; 

//se crea objeto de clase slim
$app = new Slim\App();

$app->get('/', function($request, $response, $args){
    $response->write("Hola mundo Slim");
    return $response;
});

$app->run(); 
?>