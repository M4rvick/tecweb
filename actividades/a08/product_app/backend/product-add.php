<?php

require_once __DIR__ . '/myapi/Products.php';
use Backend\Myapi\Products;

$json_response = '';

if (
    isset($_POST['nombre']) &&
    isset($_POST['precio']) &&
    isset($_POST['unidades']) &&
    isset($_POST['modelo']) &&
    isset($_POST['marca']) &&
    isset($_POST['detalles'])
) {
    try {
        $productManager = new Products();
        $productManager->add($_POST);
        $json_response = $productManager->getData();

    } catch (Exception $e) {
        $data = [
            'status' => 'error',
            'message' => 'Error de conexión: ' . $e.getMessage()
        ];
        $json_response = json_encode($data, JSON_PRETTY_PRINT);
    }

} else {
    $data = [
        'status'  => 'error',
        'message' => 'Faltan datos requeridos'
    ];
    $json_response = json_encode($data, JSON_PRETTY_PRINT);
}
echo $json_response;
?>