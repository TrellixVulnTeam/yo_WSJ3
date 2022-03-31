<?php



function verifica_sesion( $email_cliente, $idsesion ) {
    $miApp = &get_instance();

    if ( !( $miApp->session->has_userdata( "email_cliente" ) && 
            $miApp->session->email_cliente == $email_cliente && 
            session_id() == $idsesion ) ){

            mensaje_usuario( "danger", "Sesión inválida, debes volver a ingresar" );
            redirect( base_url() );
    }  
}
?> 