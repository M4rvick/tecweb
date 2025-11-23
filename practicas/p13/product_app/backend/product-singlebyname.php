<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    use myapi\Read\Read;
    $product = new Read();
    $product->singleByName($_POST); 
    echo $product->getData();
?>