<?php 

function verifica_token($correo,$token){
    $miApp = &get_instance();
    
if(!$miApp->Gato_model->check_token($correo,$token)){
    die(json_encode(array(
        "resultado" =>FALSE,
        "mensaje" =>"Invalid session token",
        "tokenvalido" =>FALSE
    )));
}
}
?>


