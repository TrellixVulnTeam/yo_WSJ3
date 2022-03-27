<?php
require_once( "helper.php" );
$mysqli = conectar();

$correo         = $_REQUEST[ "correo" ];
$contrasenia    = $_REQUEST[ "contrasenia" ];

if ( verificar_usuario( $correo, $contrasenia ) ) {
    session_start();
    session_regenerate_id();
    $_SESSION[ "correo" ] = $correo;

    desconectar();
    header( "location:lista.php?c=$correo&s=".session_id() );
}
else {
    desconectar();
    header( "location:.?iderror=1" );
}
?>