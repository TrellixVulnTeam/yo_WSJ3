<?php
require_once( "helper.php" );
$mysqli = conectar();

extract( $_REQUEST );

session_start();
if (!sesion_valida( $c, $s ) ) :
    desconectar();
    header( "location:.?iderror=2");
else:

    if ($accion == "alta" || $accion == "cambio") {
        $nombre = mb_strtoupper( $nombre );
        $apellidos = mb_strtoupper( $apellidos );
    }

    switch ($accion) {
        case "alta":
            $sql = "INSERT INTO personas(nombre, apellidos, correo, contrasenia, idpais, idedo,
            idmpio ) 
                values (
                '$nombre',
                '$apellidos',
                '$correo',
                '$contrasenia',
                '$idpais',
                '$idedo',
                '$idmpio'
                )";
            break;
        
            case "cambio":
                $sql = "UPDATE personas SET 
                    nombre = '$nombre',
                    apellidos = '$apellidos',
                    correo = '$correo',
                    idpais = '$idpais',
                    idedo = '$idedo',
                    idmpio = '$idmpio'
                WHERE idpersona = '$idpersona'";
        if ( $contrasenia != "") {
            query( "UPDATE personas SET contrasenia = '$contrasenia' WHERE idpersona = '$idpersona'"
        );
        }
                break;
        case "baja":
            $sql = "DELETE FROM personas WHERE idpersona = '$idpersona'";
            break;
    }

    query( $sql );

    desconectar();
    header( "location:lista.php?c=$c&s=$s" );
    
endif;
?>