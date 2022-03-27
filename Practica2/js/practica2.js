$( document).ready( function() {

    //Evento submit del formulario
    $( "#form-cantidad" ).submit ( function ( e ) {
        $( ".is-invalid" ).removeClass( "is-invalid" );
        $( ".invalid-feedback" ).remove();

        e.preventDefault();

         if ( $( "#cantidad" ).val () == "") {
            error_formulario( "cantidad ", "Void result, failed. Please fill the input box " );
            return false;
        
         }
        
        else if ( $( "#cantidad" ).val() <=0 ){
            error_formulario ( "cantidad ", "Quatity must be grater than 0" );
            return false;
        
        }

        $.ajax({
            "url"       :"practica2.php",
            "dataType"  :"html",
            "type"      :"post",
            "data"      : {
                "cantidad" : $( "#cantidad" ).val()
            }
        })
        .done( function( response) {
            $( "#resultado").html( response);

        })
        .fail( function(){
            alert( "ERROR:Something happened!");
        });


     return true;
    });
});

