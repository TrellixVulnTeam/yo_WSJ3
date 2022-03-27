<?php
require_once("./Cuadrado.php")
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>

<FORM action="procesa.php">
<INPUT type="text" name="lado"placeholder="Ingresa lado de cuadrado">
<BUTTON type="submit">Enviar</BUTTON>
</FORM>


<?php

if($_GET){
    $lado = $_GET["lado"];
    $c1 = new Cuadrado($lado);
    echo $c1->obetenerLado();
    echo "<br/>";
    echo $c1->obtenerPerimetro();
    echo "<br/>";
    echo $c1->obetenerArea();
    
    $c1->imprimir();
}
?>

</body>
</html>




