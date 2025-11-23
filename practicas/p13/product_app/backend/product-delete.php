<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    use myapi\Delete\Delete;
    $productManager = new Delete();
    $productManager->delete($_POST); 
    echo $productManager->getData();
?>