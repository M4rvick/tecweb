<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    use myapi\Read\Read;
    $product = new Read();
    $product ->list();
    echo $product->getData();
?>