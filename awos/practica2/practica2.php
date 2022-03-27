<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='../node_modules/fontawesome-free-5.15.4-web/css/all.min.css'>
    </link>
    <link rel="stylesheet" href="./css/practica2.css">
    <title>Practica 2</title>
    <script>
        $cantidad = $('#cantidad').val();
    </script>
</head>

<body>
    
    <?php
    require_once("helper.php");
    require_once("clases/Circulo.php");
    $cantidad  = $_REQUEST["cantidad"];
   
    $iconos = array(
        "ambulance",
        "anchor",
        "baby-carriage",
        "bus",
        "brain",
        "box-open",
        "bowling-ball"

    );
    for ($i = 0; $i < $cantidad; $i++) {
        $miCirculo = new Circulo(
            rand(0, 400),
            rand(100, 300),
            rand(70, 150),
            $iconos[rand(0, count($iconos) - 1)],
            rgb(rand(0,255),rand(0,255),rand(0,255))
        );
        $miCirculo->imprimir();
    }
    ?>

</body>

</html>