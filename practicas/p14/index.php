<?php
require 'vendor/autoload.php'; 

//se crea objeto de clase slim
$app = new Slim\App();

$app -> get("/testjson", function($request, $response, $args){
    $data[0]["nombre"] = "Marvick";
    $data[0]["apellidos"] = "Osorio";
    $data[1]["nombre"] = "Jesus";
    $data[1]["apellidos"] = "Aguilar";
    $response->write(json_encode($data, JSON_PRETTY_PRINT));
    return $response;
});

$app->run(); 
?>