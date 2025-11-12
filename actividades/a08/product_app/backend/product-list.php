<?php

require_once __DIR__ . '/myapi/Products.php';

use Backend\Myapi\Products;
use Backend\Myapi\DataBase;

try {
    $productManager = new Products();
    $productManager->list();
    echo $productManager->getData();

} catch (Exception $e) {
    echo json_encode([]); 
}

?>