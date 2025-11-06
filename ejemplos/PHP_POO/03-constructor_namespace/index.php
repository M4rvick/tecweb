<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>03-constructor-namespace</title>
</head>
<body>
    <?php
    use EJEMPLOS\POO\cabecera2 as cabecera;
    require_once __DIR__ . "/cabecera.php";

    // $cab1 = new cabecera ('El rincon del programador', 'center');
    // $cab1-> graficar(); 

    $cab2 = new cabecera ('El rincon del programador', 'center', 'HDHH');
    $cab2-> graficar();
    ?>
    
</body>
</html>