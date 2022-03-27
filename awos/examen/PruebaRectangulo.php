<?php
include ( "rectangulo.php" );
$posicion_x = 100;
$posicion_y = 30;
$ancho      = 200;
$alto       = 50;
$color      = FF2D00;
$r = new rectangulo (
    $posicion_x,
    $posicion_y,
    $ancho, $alto,  $color );

    $r->imprimir () ;
    ?>