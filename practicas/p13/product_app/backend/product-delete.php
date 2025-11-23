<?php
    use Backend\myapi\Products;
    require_once __DIR__ . '/myapi/Products.php';

    $productManager = new Products();
    $productManager->delete($_POST); 
    echo $productManager->getData();
?>