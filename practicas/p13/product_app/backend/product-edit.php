<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    use myapi\Update\Update;
    $product = new Update();
    $product ->edit($_POST);
    echo $product ->getData();
?>