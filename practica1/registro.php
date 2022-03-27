<?php
require_once("helper.php");
$mysqli= conectar();

extract( $_REQUEST ); 
//Verificar correo duplicado

$sql = "SELECT * FROM personas WHERE correo = '$modalcorreo'";
$rs = query( $sql );
if ( $rs->num_rows > 0 ) {
    desconectar();
    header( "location:.?iderror=3");
}
else {
    $modalnombre    = mb_strtoupper( $modalnombre );
    $modalapellidos  = mb_strtoupper( $modalapellidos );

    $sql = "INSERT INTO personas (nombre, apellidos, correo, contrasenia )
        VALUES (
            '$modalnombre',
            '$modalapellidos',
            '$modalcorreo',
            '$modalcontrasenia'
            )";
    query( $sql );
    desconectar();
    header( "location:.?iderror=4" );
}
?>