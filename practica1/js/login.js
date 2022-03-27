var expMail = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

$( document ).ready( function() {

    setTimeout( function() {
        $( ".alert" ).fadeOut( "show" );
    }, 8000 );

    $( "#form-login" ).submit( function( e ) {
        $( ".is-invalid" ).removeClass( "is-invalid" );
        $( ".invalid-feedback" ).remove();
        
        if( $( "#correo" ).val() == "" ) {
            error_formulario( "correo", "El correo esta vacio" );
            return false;
        }
        else if( !expMail.test( $( "#correo" ).val() ) ) {
            error_formulario( "correo", "El formato del correo es erroneo ej(usuario@ejemplo.algo)" );
            return false;
        }
        else if( $( "#contrasenia" ).val() == "" ) {
            error_formulario( "contrasenia", "La contraseña esta vacia" );
            return false;
        }
        return true;
    });

    $ ( "#form-modal-registro" ).submit( function() {
        $( ".is-invalid" ).removeClass( "is-invalid" );
        $( ".invalid-feedback" ).remove();
        
        if( $( "#modal-nombre" ).val() == "" ) {
            error_formulario( "modal-nombre", "El nombre es requerido" );
            return false;
        }
        else if( $( "#modal-apellidos" ).val() == "" ) {
            error_formulario( "modal-apellidos", "El apellido es requerido" );
            return false;
        }
        else if( $( "#modal-correo" ).val() == "" ) {
            error_formulario( "modal-correo", "El correo es requerido" );
            return false;
        }
        else if( !expMail.test( $( "#modal-correo" ).val() ) ) {
            error_formulario( "modal-correo", "El formato del correo es erroneo ej(usuario@ejemplo.algo)" );
            return false;
        }
        else if( $( "#modal-contrasenia" ).val() == "" ) {
            error_formulario( "modal-contrasenia", "La contraseña es requerida" );
            return false;
        }

        else if( $( "#modal-contrasenia" ).val() != $("#modal-contrasenia2").val() ) {
            error_formulario( "modal-contrasenia2", "Las contraseñas no coinciden" );
            return false;
        }
        
        return true;
    });

    $( "a[data-bs-toggle='modal']" ).click( function () {
        $( ".is-invalid" ).removeClass( "is-invalid" );
        $( ".invalid-feedback" ).remove();

        $( "#modal-nombre, #modal-apellidos, #modal-correo, #modal-contrasenia, #modal-contrasenia2" ).val( "" );

        $( "#group-modal-contrasenia2" ).hide();
    });

    $ ("#modal-contrasenia").keyup( function() {
        if ( $(this).val() != "") {
            $("#group-modal-contrasenia2").show();
        }
    });

    $( "#modal-contrasenia2").keyup( function() {
        $( "#group-modal-contrasenia2 .invalid-feedback").remove();

        if ( $( "#modal-contrasenia2" ).val() != "" &&
             $( "#modal-contrasenia" ).val() != $( "#modal-contrasenia2" ).val() ){
             error_formulario( "modal-contrasenia2", "Las contraseñas no coinciden" );
        }
        else {
            $( "#modal-contrasenia2" ).removeClass( "is-invalid" );
            $( "group-modal-contrasenia2 .invalid-feedback").remove();
        }
    });

});