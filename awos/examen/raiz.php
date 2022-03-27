<?php
$resultado = "";
if (isset($_REQUEST["valor"])) {
    $resultado = sqrt( $_REQUEST["valor"]);
    echo json_encode($resultado);   
}


?>