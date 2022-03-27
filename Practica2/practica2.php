<!DOCTYPE html>
<html>

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Practica 2</title>
        <link rel="stylesheet" href="./node_modules/fontawesome-free-5.15.4-web/css/all.min.css">
        <link rel="stylesheet" href="css/practica2.css">

</head>

<body>

        <?php
        require_once("clases/Circulo.php");
        require_once("helper.php");

        $cantidad = $_REQUEST["cantidad"]; //Variable de cantidad para manipular la cantidad que saldra

        $iconos = array(             //Variable que coloca los diferentes iconos.
                 "calculator", "venus","xbox", "mouse", "terminal",
                "pizza-slice", "cat", "shower", "dog", "dove", "bread-slice",

// class='fas fa-bo'
        );

        for ($i = 1; $i <= $cantidad; $i++) { //Contador que sea menor a la cantidad lo repite
                $cir1 = new Circulo(
                        rand(10, 915),
                        rand(50, 300),
                        rand(70, 200),
                        $iconos[rand(0, count($iconos) - 1)],
                        rgb(rand(0, 255), rand(0, 255), rand(0, 255))
                );

                $cir1->imprimir();
        }

        ?>

</body>

</html>