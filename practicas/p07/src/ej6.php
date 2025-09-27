<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
    <title>Resultado Ejercicio 5</title>
</head>
<body>
    <?php
    $parqueVehicular = array(
        "ABC1234" => array(
            "Auto" => array(
                "marca" => "HONDA",
                "modelo" => 2020,
                "tipo" => "camioneta"
            ),
            "Propietario" => array(
                "nombre" => "Alfonzo Esparza",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "C.U., Jardines de San Manuel"
            )
        ),
        "XYZ5678" => array(
            "Auto" => array(
                "marca" => "MAZDA",
                "modelo" => 2019,
                "tipo" => "sedan"
            ),
            "Propietario" => array(
                "nombre" => "Ma. del Consuelo Molina",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "97 Oriente"
            )
        ),
        "LMN9876" => array(
            "Auto" => array(
                "marca" => "TOYOTA",
                "modelo" => 2021,
                "tipo" => "hatchback"
            ),
            "Propietario" => array(
                "nombre" => "Carlos Ramírez",
                "ciudad" => "CDMX",
                "direccion" => "Av. Reforma 101"
            )
        ),
        "JKL4321" => array(
            "Auto" => array(
                "marca" => "FORD",
                "modelo" => 2018,
                "tipo" => "sedan"
            ),
            "Propietario" => array(
                "nombre" => "Lucía Méndez",
                "ciudad" => "Guadalajara, Jal.",
                "direccion" => "Av. Patria 222"
            )
        ),
        "QWE3456" => array(
            "Auto" => array(
                "marca" => "NISSAN",
                "modelo" => 2022,
                "tipo" => "camioneta"
            ),
            "Propietario" => array(
                "nombre" => "Miguel Torres",
                "ciudad" => "Monterrey, NL",
                "direccion" => "Calle Hidalgo 55"
            )
        ),
        "RTY7890" => array(
            "Auto" => array(
                "marca" => "CHEVROLET",
                "modelo" => 2017,
                "tipo" => "hatchback"
            ),
            "Propietario" => array(
                "nombre" => "Fernanda López",
                "ciudad" => "Mérida, Yuc.",
                "direccion" => "Col. Centro"
            )
        ),
        "UIO1122" => array(
            "Auto" => array(
                "marca" => "VOLKSWAGEN",
                "modelo" => 2020,
                "tipo" => "sedan"
            ),
            "Propietario" => array(
                "nombre" => "Jorge Hernández",
                "ciudad" => "Querétaro, Qro.",
                "direccion" => "Calle Juárez 12"
            )
        ),
        "PAS3344" => array(
            "Auto" => array(
                "marca" => "TESLA",
                "modelo" => 2023,
                "tipo" => "sedan"
            ),
            "Propietario" => array(
                "nombre" => "Andrea Martínez",
                "ciudad" => "CDMX",
                "direccion" => "Santa Fe"
            )
        ),
        "DFG5566" => array(
            "Auto" => array(
                "marca" => "BMW",
                "modelo" => 2021,
                "tipo" => "camioneta"
            ),
            "Propietario" => array(
                "nombre" => "Roberto Sánchez",
                "ciudad" => "León, Gto.",
                "direccion" => "Blvd. López Mateos"
            )
        ),
        "HJK7788" => array(
            "Auto" => array(
                "marca" => "KIA",
                "modelo" => 2019,
                "tipo" => "hatchback"
            ),
            "Propietario" => array(
                "nombre" => "Paola Reyes",
                "ciudad" => "Tijuana, BC",
                "direccion" => "Zona Río"
            )
        ),
        "BNM9900" => array(
            "Auto" => array(
                "marca" => "HYUNDAI",
                "modelo" => 2022,
                "tipo" => "camioneta"
            ),
            "Propietario" => array(
                "nombre" => "Luis Fernández",
                "ciudad" => "Chihuahua, Chih.",
                "direccion" => "Av. Universidad"
            )
        ),
        "VFR2233" => array(
            "Auto" => array(
                "marca" => "AUDI",
                "modelo" => 2020,
                "tipo" => "sedan"
            ),
            "Propietario" => array(
                "nombre" => "Claudia Núñez",
                "ciudad" => "San Luis Potosí",
                "direccion" => "Col. Centro"
            )
        ),
        "CDE4455" => array(
            "Auto" => array(
                "marca" => "MERCEDES",
                "modelo" => 2021,
                "tipo" => "camioneta"
            ),
            "Propietario" => array(
                "nombre" => "Ricardo Ortega",
                "ciudad" => "Toluca, Edo. Mex.",
                "direccion" => "Col. Reforma"
            )
        ),
        "FGH6677" => array(
            "Auto" => array(
                "marca" => "PEUGEOT",
                "modelo" => 2018,
                "tipo" => "hatchback"
            ),
            "Propietario" => array(
                "nombre" => "Daniela Castro",
                "ciudad" => "Cancún, Q. Roo",
                "direccion" => "Av. Kukulkán"
            )
        ),
        "IKL8899" => array(
            "Auto" => array(
                "marca" => "JEEP",
                "modelo" => 2023,
                "tipo" => "camioneta"
            ),
            "Propietario" => array(
                "nombre" => "Arturo Vega",
                "ciudad" => "Oaxaca, Oax.",
                "direccion" => "Centro Histórico"
            )
        )
    );
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['matricula']) && $_POST['matricula'] != "") {
            $matricula = strtoupper($_POST['matricula']);
            if (isset($parqueVehicular[$matricula])) {
                echo "<h2>Información del vehículo $matricula</h2>";
                echo "<pre>";
                print_r($parqueVehicular[$matricula]);
                echo "</pre>";
            } else {
                echo "<p>No se encontró vehículo con matrícula $matricula</p>";
            }
        } else {
            echo "<h2>Parque vehicular completo</h2>";
            echo "<pre>";
            print_r($parqueVehicular);
            echo "</pre>";
        }
    }
    ?>
</body>
</html>
