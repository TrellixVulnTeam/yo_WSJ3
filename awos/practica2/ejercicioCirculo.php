<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google Fonts Pre Connect -->
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com"> -->
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts Links (Roboto 400    , 500 and 700 included) -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap"> -->

    <!-- CSS Files Links -->
    <link rel="stylesheet" href="./css/practica2.css">

    <!-- Title -->
    <title>Practica 2</title>
</head>

<body>
    <h3>-PHP Orientado a objetos</h3>
  
    <?php
    require_once("clases/Circulo.php");
    $miCirculo = new Circulo(100, 100, 50 , "1",'pink');
    $miCirculo->imprimir();
    $miCirculo2 = new Circulo(100, 200, 10, "2",'green' );
    $miCirculo2->imprimir();
    $miCirculo2 = new Circulo(200, 100, 10, "2",'red' );
    $miCirculo2->imprimir();
    $miCirculo2 = new Circulo(200, 200, 50, "2",'black' );
    $miCirculo2->imprimir();
    ?> 

</body>

</html>