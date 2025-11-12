<?php
    use Backend\Myapi\Products;
    require_once __DIR__ . '/myapi/Products.php';

    $productManager = new Products();
    $productManager->single($_POST);
    echo $productManager->getData();
?>