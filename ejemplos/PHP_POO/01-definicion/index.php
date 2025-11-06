<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>01-definicion</title>
</head>
    <body>
        <?php
        require_once _DIR_ . "/persona.php";
        $per1 = new Persona();
        $per1->inicializar("je");
        $per1->mostrar();

        $per2 = new Persona();
        $per2->inicializar("Mar");
        $per2->mostrar();
        ?>
    </body>
</html>