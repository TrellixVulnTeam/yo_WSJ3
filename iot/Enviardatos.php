<?php
$valor=$_POST['valor'];
echo $valor;
$conexion=mysqli_connect("localhost","root","alejandro2mx","boton") or die("Problemas con la conexión");
$registros=mysqli_query($conexion,"INSERT INTO estado VALUES (0,$valor,SYSDATE(),SYSDATE())") or die("Problemas en el
select:".mysqli_error($conexion));