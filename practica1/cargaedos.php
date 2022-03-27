<?php
require_once("helper.php");
$mysqli = conectar();
$idpais = $_REQUEST[ "idpais" ];

$sql = "SELECT idedo, nomestado from estados WHERE idpais = '$idpais' ORDER BY nomestado";
$rs = query( $sql );

echo json_encode( $rs->fetch_all() );

desconectar();
?>