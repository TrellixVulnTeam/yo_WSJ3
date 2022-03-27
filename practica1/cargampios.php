<?php
require_once ("helper.php");
$mysqli = conectar();

$idpais = $_REQUEST ["idpais"];
$idedo = $_REQUEST ["idedo"];

$sql = "SELECT idmpio, nommpio FROM municipios
    WHERE
        idpais = '$idpais' AND 
        idedo = '$idedo' 
    ORDER BY nommpio";

$rs = query( $sql );

echo json_encode( $rs->fetch_all() );

desconectar();
?>