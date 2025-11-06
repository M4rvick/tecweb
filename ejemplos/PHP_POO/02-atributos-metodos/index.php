<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>02-atributos y metodos</title>
</head>
<body>
    <?php
    require_once __DIR__ . "/menu.php";

    $menu1 = new menu;
    $menu1->cargar_opcion('https://www.facebook.com', 'Facebook');
    $menu1->cargar_opcion('https://www.twitter.com', 'Twitter');
    $menu1->cargar_opcion('https://www.x.com', 'X');
    $menu1->mostrar();
    ?>
    
</body>
</html>