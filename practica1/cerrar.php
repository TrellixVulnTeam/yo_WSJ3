<?php
require_once( "helper.php" );

extract( $_REQUEST );

session_start();
if ( !sesion_valida( $c, $s ) ) :
    header( "location:.?iderror=2" );
    else :

        session_unset();
        session_destroy();
        header( "location:." );

    endif;
    ?>