<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Practica 2</title>
    <link rel="stylesheet" href="css/practica2.css">

    <head>

    <body>

        <h3>Practica 2</h3>

        <?php

        require_once("clases/Circulo.php");

        $cir1 = new Circulo(100, 20, 80, "1", "#ff0000");
        $cir1->imprimir();

        $cir2 = new Circulo(20, 100, 150, "2", "#00fff0");
        $cir2->imprimir();

        $cir3 = new Circulo(200, 80, 200, "3", "#ff0ff0");
        $cir3->imprimir();

        ?>
    </body>

</html>