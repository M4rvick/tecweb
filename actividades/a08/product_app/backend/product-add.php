<?php
    require_once __DIR__ . '/myapi/Products.php';
    use Backend\Myapi\Products;

    $productManager = new Products();
    $productManager->add($_POST);
    $json_response = $productManager->getData();
?>