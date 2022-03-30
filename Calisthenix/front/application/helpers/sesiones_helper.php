<?php



function verifica_sesion( $correo, $idsesion ) {
    $miApp = &get_instance();

    if ( !( $miApp->session->has_userdata( "correo" ) && 
            $miApp->session->correo == $correo && 
            session_id() == $idsesion ) ){

            mensaje_usuario( "danger", "Sesión inválida, debes volver a ingresar" );
            redirect( base_url() );
    }  
}
?>