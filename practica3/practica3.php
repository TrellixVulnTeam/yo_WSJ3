<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Practica 3</title>

    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./node_modules/fontawesome-free-5.15.4-web/css/all.min.css">
    <script src="./node_modules/jquery/jquery.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/practica2.css">

</head>

<body>

    <?php
    require_once("helper.php");
    require_once("clases/Persona.php");

    $mysqli = conectar();
    $personas = $_REQUEST["personas"];

    for ($i = 0; $i < count($personas); $i++) {
        $p = new Persona($personas[$i]);
        $p->imprimir();
    }
    desconectar();
    ?>

</body>

</html>
