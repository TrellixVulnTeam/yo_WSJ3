$( document). ready( function() {

    $.ajax({
        "url"       :"cargapersonas.php",
        "dataType"  :"json"
    })
    .done( function ( json ) {
        $.each( json, function( i, p ) {
            $( "#personas " ).append( $( "<option>", {
                "value"     : p[ 0 ],
                "text"      : p[ 1 ]
            }));
        });
    })
    .fail( error_ajax );
        
    


        //Evento Submit del formulario
        $( "#form-personas" ).submit( function( e ) {
            e.preventDefault();
            $( ".is-invalid" ).removeClass( "is-invalid" );
            $( ".invalid-feedback" ).remove();

            if( $( "#personas option:selected" ).length == 0 ) {
                error_formulario( "personas", "You must at least select 1 user");
                return false;
            }
            
            //AJAX QUE VA A MOSTRAR LA OTRA PESTAÑA CON EL RESULTADO
           $.ajax({
               "url"        : "practica3.php",
               "dataType"   : "html",
               "type"       : "post",
               "data"       : {
                   "personas[]" : $( "#personas" ).val()
               } 
           })
           .done( function( response ) {
               $( "#resultado" ).html( response );
               alerta( "success", "Great",  +
                    $( "#personas option:selected").length  + " user(s) were created " );
                $( "#personas option:selected" ).prop( "selected", false);
           })
           .fail( error_ajax);
           
           return true;
        });
    
});