<?php

require "Cuadrado.php";

$c1 = new Cuadrado(100);

echo $c1->obetenerLado();
echo "<br/>";
echo $c1->obtenerPerimetro();
echo "<br/>";
echo $c1->obetenerArea();

 $c1->imprimir();
?>