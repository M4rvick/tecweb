<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>04 - metodos_privados</title>
</head>
<body>
    <?php
    require_once __DIR__.'/tabla.php';

    $tab1 = new tabla(2, 3, 'border: 1px solid');
    $tab1->cargar(0, 0, 'A');
    $tab1->cargar(0, 1, 'A');
    $tab1->cargar(0, 2, 'A');
    $tab1->cargar(1, 0, 'A');
    $tab1->cargar(1, 1, 'A');
    $tab1->cargar(1, 2, 'A');
    $tab1->graficar();
    ?>
</body>
</html>