<?php

function conectar()
{
    $servidor = "localhost";
    $usuario = "root";
    $password = "alejandro2mx";
    $bd = "bd_awos";
    $mysqli = new mysqli ($servidor, $usuario, $password, $bd);
    mysqli_set_charset( $mysqli, "UTF-8" );
    
    return $mysqli;
}

function desconectar()
{
    global $mysqli;
    $mysqli->close();
}

function query($sql){
    global $mysqli;
    $rs = $mysqli->query($sql)
    or die ("ERROR base de datos: ".$mysqli->error);
    return $rs;
}

function verificar_usuario( $correo, $contrasenia)
{
    $rs = query( "SELECT * from personas where
    correo like binary '$correo' and
    contrasenia like binary '$contrasenia' ");
    return $rs->num_rows == 1;
}

function sesion_valida( $correo, $idsesion )
{
    return  $correo   == $_SESSION[ "correo" ] &&
            $idsesion == session_id();
}
?>