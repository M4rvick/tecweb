<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
require '../vendor/autoload.php';
$app = AppFactory::create();
$app->setBasepath("/tecweb/practicas/p14/slim_v4");

//video1
$app->get('/', function($request, $response, $args){
    $response->getBody()->write("Hola mundo Slim");
    return $response;
});

//video2
$app->get("/hola[/{nombre}]", function($request, $response, $args){
    $response->getBody()->write("Hola " . $args["nombre"]);
    return $response;
});

//video3
$app -> post("/pruebapost", function($request, $response, $args){
    $reqPost = $request -> getParsedBody();
    $val1 = $reqPost["val1"];
    $val2 = $reqPost["val2"];

    $response ->getBody()-> write("Valores: ".$val1." ".$val2);
    return $response;
});

//video4
$app -> get("/testjson", function($request, $response, $args){
    $data[0]["nombre"] = "Marvick";
    $data[0]["apellidos"] = "Osorio";
    $data[1]["nombre"] = "Jesus";
    $data[1]["apellidos"] = "Aguilar";
    $response->getBody()->write(json_encode($data, JSON_PRETTY_PRINT));
    return $response;
});

$app->run(); 
?>