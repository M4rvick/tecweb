<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    use myapi\Delete\Delete;
    $product = new Delete();
    $product->delete($_POST); 
    echo $product->getData();
?>