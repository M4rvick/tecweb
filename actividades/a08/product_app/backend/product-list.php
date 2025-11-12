<?php
    require_once __DIR__ . '/myapi/Products.php';
    use Backend\Myapi\Products;

    $productManager = new Products();
    $productManager->list();
    echo $productManager->getData();

?>