<?php
    use Backend\Myapi\Products;
    require_once __DIR__ . '/myapi/Products.php';
    
    $productManager = new Products();
    $productManager->edit($_POST);
    echo $productManager->getData();
?>