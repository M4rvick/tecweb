<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>05 - Colaboración entre paginas</title>
</head>
    <body>
        <?php
        require_once __DIR__ . "/pagina.php";
        $pag1 = new pagina("El amor de Samantha", "El amor de Samantha abajo");
        for ($i = 0; $i < 10; $i++) {
            $pag1->insertar_cuerpo(
                "Amor No." . ($i + 1) . " de Jesus pa Samantha",
            );
        }
        $pag1->graficar();
        ?>
    </body>
</html>