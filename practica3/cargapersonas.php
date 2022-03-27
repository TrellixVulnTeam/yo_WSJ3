<?php
require_once( "helper.php" );
$mysqli = conectar();

$sql = "SELECT idpersona, concat(apellidos,' ',nombre) AS nompersona
        FROM personas
        ORDER BY apellidos, nombre";
$rs  = query( $sql);

echo json_encode( $rs->fetch_all() );

desconectar();
?>