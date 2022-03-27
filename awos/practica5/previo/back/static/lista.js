$( document ).ready( function() {

    setTimeout( function(){
        $( ".alert").fadeOut();
    },8000);



    $( ".btn-borrar" ).click( function() {

        $( "#nombre-persona-borrar" ).html( $ (this).attr( "data-nombre-persona" ) );
        $( "#btn-borrar-confirmar" ).attr(
            "data-idpersona",
            $(this).attr( "data-idpersona" )
        );
    });
    //Evento click del boton 'Eliminar' de la venta modal
    $( "#btn-borrar-confirmar" ).click( function() {
        $( location ).attr( "href", 
        appData.base_url +
        "personas/borrar/"+ 
        $(this).attr( "data-idpersona" ) 
        );
    });
}); 